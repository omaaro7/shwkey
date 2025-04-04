<?php
require_once '../config/conn.php';
require_once '../vendor/autoload.php'; // JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PollManager {
    private $conn;
    private $secretKey = 'myAppSecretKey';

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Authenticate the user using a token stored in a cookie
    public function authenticateUser() {
        // Check if the token exists in the cookie
        if (!isset($_COOKIE['token'])) {
            return ["success" => false, "message" => "No token provided"];
        }

        $token = $_COOKIE['token'];  // Directly get the token from the cookie

        try {
            // Decode the JWT token to verify it
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

            // Query the database for the user_id associated with the token
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE token = ?");
            $stmt->bind_param("s", $token); // Bind the token to the query
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return ["success" => false, "message" => "Invalid or expired token"];
            }

            // Fetch user_id
            $user = $result->fetch_assoc();
            return ["success" => true, "user_id" => $user['id']];  // Return user_id from the database
        } catch (Exception $e) {
            return ["success" => false, "message" => "Invalid token"];
        }
    }

    // Create a poll
    public function createPoll($user_id, $question, $options, $expiration_days) {
        // Calculate expiration date (current date + expiration_days)
        $expiration_date = date('Y-m-d H:i:s', strtotime("+$expiration_days days"));

        // Convert options into JSON
        $optionsJson = json_encode($options);
        $votesJson = json_encode(array_fill(0, count($options), []));  // Initialize votes as empty arrays

        $stmt = $this->conn->prepare("INSERT INTO polls (user_id, question, options, votes, expires_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $question, $optionsJson, $votesJson, $expiration_date);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Poll created successfully", "id" => $stmt->insert_id];
        }
        return ["success" => false, "message" => "Error: " . $this->conn->error];
    }

    // Cast a vote in a poll
    public function vote($poll_id, $user_id, $option_index) {
        // Check if poll is expired
        $stmt = $this->conn->prepare("SELECT expires_at, votes FROM polls WHERE id = ?");
        $stmt->bind_param("i", $poll_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ["success" => false, "message" => "Poll not found"];
        }

        $poll = $result->fetch_assoc();

        // Check if poll is expired
        if (strtotime($poll['expires_at']) < time()) {
            return ["success" => false, "message" => "Poll has expired"];
        }

        // Check if user has already voted
        $votes = json_decode($poll['votes'], true);
        foreach ($votes as $voteList) {
            if (in_array($user_id, $voteList)) {
                return ["success" => false, "message" => "User has already voted"];
            }
        }

        // Record the vote
        $votes[$option_index][] = $user_id;
        $votesJson = json_encode($votes);
        
        $stmt = $this->conn->prepare("UPDATE polls SET votes = ? WHERE id = ?");
        $stmt->bind_param("si", $votesJson, $poll_id);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Vote recorded successfully"];
        }
        return ["success" => false, "message" => "Error: " . $this->conn->error];
    }

    // Get the poll details (question, options, votes)
    public function getPoll($poll_id) {
        $stmt = $this->conn->prepare("SELECT question, options, votes, expires_at FROM polls WHERE id = ?");
        $stmt->bind_param("i", $poll_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ["success" => false, "message" => "Poll not found"];
        }

        $poll = $result->fetch_assoc();

        // Check if poll is expired
        if (strtotime($poll['expires_at']) < time()) {
            return ["success" => false, "message" => "Poll has expired"];
        }

        return [
            "success" => true,
            "question" => $poll['question'],
            "options" => json_decode($poll['options'], true),
            "votes" => array_map('count', json_decode($poll['votes'], true))  // Count votes for each option
        ];
    }

    // Delete a poll
    public function deletePoll($poll_id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM polls WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $poll_id, $user_id);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Poll deleted successfully"];
        }
        return ["success" => false, "message" => "Error: " . $this->conn->error];
    }
}

// Create an instance of PollManager
$pollManager = new PollManager($conn);

// Authenticate the user by checking the token in the cookie
$authResult = $pollManager->authenticateUser();

// If authentication fails, return the error
if (!$authResult['success']) {
    echo json_encode($authResult);
    exit;
}

// Get the authenticated user ID
$user_id = $authResult['user_id'];

// Handle POST requests to create a poll
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the body of the request
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Retrieve the data from the JSON
    $question = $inputData['question'] ?? null;
    $options = $inputData['options'] ?? null;
    $expiration_days = $inputData['expiration_days'] ?? 7;  // Default expiration time is 7 days
    
    if ($question && is_array($options)) {
        echo json_encode($pollManager->createPoll($user_id, $question, $options, $expiration_days));
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
}
// Handle PUT requests to record a vote
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the JSON data from the body of the request
    $inputData = json_decode(file_get_contents('php://input'), true);

    $poll_id = $inputData['poll_id'] ?? null;
    $option_index = $inputData['option_index'] ?? null;
    
    if ($poll_id !== null && $option_index !== null) {
        echo json_encode($pollManager->vote($poll_id, $user_id, intval($option_index)));
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
}
// Handle GET requests to fetch poll data
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $poll_id = $_GET['poll_id'] ?? null;
    if ($poll_id) {
        echo json_encode($pollManager->getPoll($poll_id));
    } else {
        echo json_encode(["success" => false, "message" => "Poll ID is required"]);
    }
}
// Handle DELETE requests to delete a poll
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the JSON data from the body of the request
    $inputData = json_decode(file_get_contents('php://input'), true);

    $poll_id = $inputData['poll_id'] ?? null;
    
    if ($poll_id) {
        echo json_encode($pollManager->deletePoll($poll_id, $user_id));
    } else {
        echo json_encode(["success" => false, "message" => "Poll ID is required"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
