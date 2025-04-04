<?php
// Login Handler
require "../config/conn.php";
require "../vendor/autoload.php";
use Firebase\JWT\JWT;

// Login handler logic
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['parent_phonenumber'], $data['password'])) {
    echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
    exit;
}

$parent_phonenumber = $conn->real_escape_string($data['parent_phonenumber']);
$password = $data['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE parent_phonenumber = ?");
$stmt->bind_param("s", $parent_phonenumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $key = getenv('myAppSecretKey') ?: 'myAppSecretKey';
        $payload = [
            "iss" => "yourdomain.com",
            "aud" => "yourdomain.com",
            "iat" => time(),
            "exp" => time() + (3600 * 24 * 30 * 6), // 1-hour token expiration
            "data" => ["parent_phonenumber" => $user['parent_phonenumber']]
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');

        $stmt_update = $conn->prepare("UPDATE users SET token = ? WHERE parent_phonenumber = ?");
        $stmt_update->bind_param("ss", $jwt, $parent_phonenumber);
        $stmt_update->execute();

        setcookie("token", $jwt, [
            'expires' => time() + (365 * 24 * 60 * 60), // 1-year token expiration
            'path' => '/',
            'secure' => false,       // Set true for HTTPS
            'httponly' => false
        ]);

        unset($user['password']);
        echo json_encode(["status" => "success", "token" => $jwt, "user" => $user]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid password."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found."]);
}
?>