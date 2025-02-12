<?php

// Include the database connection file
require_once '../config/conn.php';

// Function to fetch data from a specified table with optional conditions
function fetchData($tableName, $conditions, $conn) {
    // Sanitize the table name to prevent SQL injection
    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

    // Build the query
    $query = "SELECT * FROM `$tableName`";

    // Add conditions if provided
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Execute the query
    $result = $conn->query($query);

    if ($result === false) {
        // Handle query error
        die("Error executing query: " . $conn->error);
    }

    // Fetch all rows as an associative array
    $data = $result->fetch_all(MYSQLI_ASSOC);

    // Free the result set
    $result->free();

    return $data;
}

// Get the table name from the request
if (isset($_GET['table'])) {
    $tableName = $_GET['table']; // Dynamic table name from request

    // Build conditions array from request parameters
    $conditions = [];
    foreach ($_GET as $key => $value) {
        if ($key !== 'table') {
            $sanitizedKey = preg_replace('/[^a-zA-Z0-9_]/', '', $key);
            $sanitizedValue = $conn->real_escape_string($value);
            $conditions[] = "`$sanitizedKey` = '$sanitizedValue'";
        }
    }

    // Fetch the data
    $data = fetchData($tableName, $conditions, $conn);

    // Print the fetched data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle missing table name in the request
    die("Error: Table name is required in the request.");
}

?>
