<?php
require "../config/conn.php";
require "../vendor/autoload.php"; // Include JWT library
use Firebase\JWT\JWT;

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if a file was uploaded
if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["status" => "error", "message" => "Photo upload is required."]);
    exit;
}

// Get other input data from FormData
$data = $_POST;

// Validate required fields
if (!isset($data['user_name'], $data['parent_phonenumber'], $data['password'])) {
    echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
    exit;
}

$user_name = $conn->real_escape_string($data['user_name']);
$parent_phonenumber = $conn->real_escape_string($data['parent_phonenumber']);
$password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash the password

// Handle the photo upload
$upload_dir = '../uploads/pictures/';
$photo_name = uniqid() . '_' . basename($_FILES['photo']['name']);
$photo_path = $upload_dir . $photo_name;

if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
    echo json_encode(["status" => "error", "message" => "Failed to upload photo."]);
    exit;
}

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
    "exp" => time() + (3600 * 24 * 30 * 6), // Expiration time (1 year)
    "data" => [
        "user_name" => $user_name,
        "parent_phonenumber" => $parent_phonenumber
    ]
];

$jwt = JWT::encode($payload, $key, 'HS256');

// Insert new user into the database
$sql_insert = "INSERT INTO users (name, date_birth, type, parent_name, parent_data_birth, parent_type, parent_phonenumber, user_name, password, stat, coins, level, token, finshed_games, profile_path) 
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
                   '$jwt',
                   '{$conn->real_escape_string($data['finshed_games'])}',
                   '$photo_path'
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