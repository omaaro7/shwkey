<?php
// Authentication Checker
require "../../config/conn.php";
require "../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Validates and authenticates a user using a JWT token stored in cookies.
 *
 * @param string $loginPagePath Path to the login page to redirect unauthenticated users.
 * @return array Authenticated user's details if successful.
 */
function checkAuth($loginPagePath = '/login.php') {
    global $conn;

    // Retrieve the secret key from environment variables or fallback
    $key = getenv('myAppSecretKey') ?: 'myAppSecretKey';

    // Ensure token is present in cookies
    if (!isset($_COOKIE['token'])) {
        error_log("Authentication failed: No token found in cookies.");
        header("Location: $loginPagePath");
        exit;
    }

    $token = $_COOKIE['token'];
    
    try {
        // Decode and validate the JWT token
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        error_log("Token successfully decoded.");

        // Verify the token exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE token = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("s", $token);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            error_log("Authentication failed: Token not found in the database.");
            header("Location: $loginPagePath");
            exit;
        }

        $user = $result->fetch_assoc();
        error_log("User authenticated: " . json_encode($user));

        return $user;
    } catch (Exception $e) {
        // Log any errors and redirect to the login page
        error_log("Authentication error: " . $e->getMessage());
        header("Location: $loginPagePath");
        exit;
    }
}
?>
