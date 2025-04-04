<?php
require_once '../config/conn.php';
require_once '../vendor/autoload.php'; // Correct JWT path
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CommentManager {
    private $conn;
    private $secretKey = 'myAppSecretKey';

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function authenticateUser() {
        if (!isset($_COOKIE['token'])) {
            return ["success" => false, "message" => "Authentication required"];
        }

        $token = $_COOKIE['token'];
        
        $stmt = $this->conn->prepare("SELECT id, user_name, profile_path FROM users WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ["success" => false, "message" => "Invalid or expired token"];
        }

        return ["success" => true, "user" => $result->fetch_assoc()];
    }

    public function uploadCommentImage($file) {
        $uploadDir = '../uploads/comments/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $filePath = $uploadDir . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return str_replace('../', '../', $filePath); // Store relative path
        }
        return null;
    }

    public function addComment($post_id, $user, $comment_text, $comment_img_path = null, $parent_id = null) {
        $stmt = $this->conn->prepare("INSERT INTO comments (post_id, user_id, user_name, profile_path, comment_text, comment_img_path, parent_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssi", $post_id, $user['id'], $user['user_name'], $user['profile_path'], $comment_text, $comment_img_path, $parent_id);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Comment added successfully", "id" => $stmt->insert_id];
        }
        return ["success" => false, "message" => "Error: " . $this->conn->error];
    }

    public function fetchComments($post_id) {
        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY date_added ASC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[$row['id']] = $row;
            $comments[$row['id']]['replies'] = [];
        }

        foreach ($comments as $id => &$comment) {
            if ($comment['parent_id'] !== null && isset($comments[$comment['parent_id']])) {
                $comments[$comment['parent_id']]['replies'][] = &$comment;
                unset($comments[$id]);
            }
        }
        return array_values($comments);
    }

    public function deleteComment($comment_id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $comment_id, $user_id);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Comment deleted successfully"];
        }
        return ["success" => false, "message" => "Error: " . $this->conn->error];
    }
}

$commentManager = new CommentManager($conn);
$authResult = $commentManager->authenticateUser();
if (!$authResult['success']) {
    echo json_encode($authResult);
    exit;
}

$user = $authResult['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;
    $comment_text = $_POST['comment_text'] ?? null;
    $comment_img_path = null;
    $parent_id = $_POST['parent_id'] ?? null;
    
    if (!empty($_FILES['comment_img'])) {
        $comment_img_path = $commentManager->uploadCommentImage($_FILES['comment_img']);
    }
    
    if ($post_id && $comment_text) {
        $response = $commentManager->addComment($post_id, $user, $comment_text, $comment_img_path, $parent_id);
    } else {
        $response = ["success" => false, "message" => "Missing required parameters"];
    }
    echo json_encode($response);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $post_id = $_GET['post_id'] ?? null;
    if ($post_id) {
        echo json_encode($commentManager->fetchComments($post_id));
    } else {
        echo json_encode(["success" => false, "message" => "Post ID is required"]);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $comment_id = $_DELETE['comment_id'] ?? null;
    if ($comment_id) {
        echo json_encode($commentManager->deleteComment($comment_id, $user['id']));
    } else {
        echo json_encode(["success" => false, "message" => "Comment ID is required"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
