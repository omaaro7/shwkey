<?php

// Include the database connection file
include('../config/conn.php');

// Static admin token for validation
define('ADMIN_TOKEN', 'myadmin'); // Replace with your desired static admin token

// Function to sanitize input data
function sanitize_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Handle PUT request
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Retrieve parameters from the URL
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $table = isset($_GET['table']) ? sanitize_input($_GET['table']) : null;
    $adminToken = isset($_GET['admin_token']) ? sanitize_input($_GET['admin_token']) : null;
    $userToken = isset($_GET['token']) ? sanitize_input($_GET['token']) : null;

    // Validate URL parameters
    if (!$id || !$table) {
        http_response_code(400); // Bad request
        echo json_encode(["error" => "Missing required parameters (id or table)."]);
        exit;
    }

    // Validate the table name to prevent SQL injection
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        http_response_code(400); // Bad request
        echo json_encode(["error" => "Invalid table name."]);
        exit;
    }

    // Check if admin token is valid
    if ($adminToken === ADMIN_TOKEN) {
        // Admin token is valid; skip user token validation
        $isAdmin = true;
    } elseif ($userToken) {
        // Validate user token in the database
        $query = "SELECT * FROM `$table` WHERE `token` = ? AND `id` = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("si", $userToken, $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                http_response_code(401); // Unauthorized
                echo json_encode(["error" => "Authentication failed: Invalid user token or ID."]);
                exit;
            }
            $stmt->close();
        } else {
            http_response_code(500); // Internal server error
            echo json_encode(["error" => "Failed to prepare token validation query."]);
            exit;
        }
        $isAdmin = false;
    } else {
        http_response_code(401); // Unauthorized
        echo json_encode(["error" => "Authentication failed: Missing token or admin token."]);
        exit;
    }

    // Parse input data from the request body
    $rawBody = file_get_contents("php://input");
    $data = json_decode($rawBody, true);

    // Check if data is empty or invalid
    if (empty($data) || !is_array($data)) {
        http_response_code(400); // Bad request
        echo json_encode(["error" => "Invalid or missing data to update."]);
        exit;
    }

    // Ensure values are scalar (no nested arrays/objects)
    foreach ($data as $key => $value) {
        if (!is_scalar($value)) {
            http_response_code(400); // Bad request
            echo json_encode(["error" => "Invalid data for field `$key`. Only scalar values are allowed."]);
            exit;
        }
    }

    // Build the dynamic SQL UPDATE query
    $updateFields = [];
    $params = [];
    $types = "";

    foreach ($data as $key => $value) {
        // Sanitize the field names and values to prevent SQL injection
        $updateFields[] = "`$key` = ?";
        $params[] = $value;
        $types .= "s"; // Assuming all fields are strings; adjust as needed
    }

    // Include id in the WHERE clause to specify the record to update
    $updateFieldsString = implode(", ", $updateFields);
    $whereClause = "`id` = ?";
    $params[] = $id;
    $types .= "i"; // id is an integer

    $sql = "UPDATE `$table` SET $updateFieldsString WHERE $whereClause";

    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "Record updated successfully."]);
            } else {
                http_response_code(404); // Not found
                echo json_encode(["error" => "No record updated. ID or conditions may not match."]);
            }
        } else {
            http_response_code(500); // Internal server error
            echo json_encode(["error" => "Failed to update record: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        http_response_code(500); // Internal server error
        echo json_encode(["error" => "Failed to prepare update query: " . $conn->error]);
    }

    // Close the connection
    $conn->close();
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(["error" => "Only PUT requests are allowed."]);
}

?>
