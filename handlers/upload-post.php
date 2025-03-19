<?php
require "../config/conn.php";
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$data = $_POST;
$token = $data['token'] ?? '';
$postText = $conn->real_escape_string($data['post_text'] ?? '');
$visibility = $conn->real_escape_string($data['visibility'] ?? 'public');  // Default to "public"

// Ensure token is provided
if (!$token) {
    echo json_encode(["status" => "error", "message" => "Authentication token is missing"]);
    exit;
}

$key = getenv('myAppSecretKey') ?: 'myAppSecretKey';

try {
    // Decode the token
    $decoded = JWT::decode($token, new Key($key, 'HS256'));

    // Check if token exists in DB
    $userQuery = $conn->prepare("SELECT id, user_name, profile_path FROM users WHERE token = ?");
    $userQuery->bind_param("s", $token);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Invalid or expired token"]);
        exit;
    }

    // Get user data from the result
    $user = $userResult->fetch_assoc();
    $userId = $user['id'];
    $userName = $user['user_name'];
    $profilePath = $user['profile_path'];

    // Handle image upload if provided
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imageDir = '../uploads/posts/';
        $imagePath = $imageDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
            exit;
        }
    }

    // Insert the post into the database
    $stmt = $conn->prepare("
        INSERT INTO posts (user_id, user_name, profile_path, post_text, image_path, likes, comments, shares, date_added, num_edits, visibility)
        VALUES (?, ?, ?, ?, ?, 0, 0, 0, NOW(), 0, ?)
    ");
    $stmt->bind_param("isssss", $userId, $userName, $profilePath, $postText, $imagePath, $visibility);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Post created successfully",
            "user_id" => $userId,
            "visibility" => $visibility
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to create post"]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
}
?>