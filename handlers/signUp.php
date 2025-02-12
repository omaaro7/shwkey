<?php
require "../config/conn.php";
require "../vendor/autoload.php"; // Include JWT library
use Firebase\JWT\JWT;

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get input data
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['user_name'], $data['parent_phonenumber'], $data['password'])) {
    echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
    exit;
}

$user_name = $conn->real_escape_string($data['user_name']);
$parent_phonenumber = $conn->real_escape_string($data['parent_phonenumber']);
$password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash the password

// Check if user_name or parent_phonenumber already exists
$sql_check = "SELECT * FROM users WHERE user_name = '$user_name' OR parent_phonenumber = '$parent_phonenumber'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    http_response_code(409);
    echo json_encode(["status" => "error", "message" => "user_name or parent_phonenumber already exists."]);
    exit;
}

// Generate JWT token
$key = "myAppSecretKey"; // Replace with a secure key
$payload = [
    "iss" => "yourdomain.com", // Issuer
    "aud" => "yourdomain.com", // Audience
    "iat" => time(),           // Issued at
    "exp" => time() + (12 * 30 * 24 * 60 * 60), // Expiration time (1 year)
    "data" => [
        "user_name" => $user_name,
        "parent_phonenumber" => $parent_phonenumber
    ]
];

$jwt = JWT::encode($payload, $key, 'HS256');

// Insert new user into the database
$sql_insert = "INSERT INTO users (name, date_birth, type, parent_name, parent_data_birth, parent_type, parent_phonenumber, user_name, password, stat, coins, level, token) 
               VALUES (
                   '{$conn->real_escape_string($data['name'])}', 
                   '{$conn->real_escape_string($data['date_birth'])}', 
                   '{$conn->real_escape_string($data['type'])}', 
                   '{$conn->real_escape_string($data['parent_name'])}', 
                   '{$conn->real_escape_string($data['parent_data_birth'])}', 
                   '{$conn->real_escape_string($data['parent_type'])}', 
                   '$parent_phonenumber', 
                   '$user_name', 
                   '$password', 
                   '{$conn->real_escape_string($data['stat'])}', 
                   '{$conn->real_escape_string($data['coins'])}', 
                   '{$conn->real_escape_string($data['level'])}',
                   '$jwt'
               )";

if ($conn->query($sql_insert) === TRUE) {
    echo json_encode([
        "status" => "success",
        "message" => "User registered successfully.",
        "token" => $jwt
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Error inserting user: " . $conn->error]);
}

// Close the database connection
$conn->close();
?>
