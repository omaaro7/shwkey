<?php
// Include the database connection file
require_once '../config/conn.php';

// Function to fetch data from a specified table with optional conditions
function fetchData($tableName, $conditions, $conn, $isAdmin = false, $limit = null, $orderDir = 'ASC') {
    if(isset($_COOKIE['admin_token']) == "myadmin" ){
        $isAdmin = true;
    }
    // Sanitize the table name to prevent SQL injection
    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

    // Define columns to exclude for 'users' table unless admin_token is provided
    $excludedColumns = (!$isAdmin && $tableName === 'users') ? ['password', 'token', 'parent_phonenumber'] : [];

    // Fetch column names from the table
    $columnsResult = $conn->query("SHOW COLUMNS FROM `$tableName`");
    if (!$columnsResult) {
        die("Error fetching columns: " . $conn->error);
    }

    $columns = [];
    while ($row = $columnsResult->fetch_assoc()) {
        if (!in_array($row['Field'], $excludedColumns)) {
            $columns[] = "`" . $row['Field'] . "`";
        }
    }
    $columnsResult->free();

    // If no columns are left after filtering
    if (empty($columns)) {
        die("Error: No valid columns to fetch.");
    }

    // Build the query with selected columns
    $query = "SELECT " . implode(", ", $columns) . " FROM `$tableName`";

    // Add conditions if provided
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Add ORDER direction if provided (ASC or DESC)
    $orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC';
    $query .= " ORDER BY id $orderDir"; // Assuming 'id' is the default column to order by

    // Add LIMIT if provided and valid
    if ($limit !== null && is_numeric($limit) && (int)$limit > 0) {
        $query .= " LIMIT " . (int)$limit;
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

    // Check for admin_token
    $isAdmin = isset($_GET['admin_token']) && $_GET['admin_token'] === 'myadmin';

    // Build conditions array from request parameters
    $conditions = [];
    foreach ($_GET as $key => $value) {
        if ($key !== 'table' && $key !== 'admin_token' && $key !== 'limit' && $key !== 'order_dir') {
            $sanitizedKey = preg_replace('/[^a-zA-Z0-9_]/', '', $key);
            $sanitizedValue = $conn->real_escape_string($value);
            $conditions[] = "`$sanitizedKey` = '$sanitizedValue'";
        }
    }

    // Get the limit if provided
    $limit = isset($_GET['limit']) ? $_GET['limit'] : null;

    // Get order direction if provided
    $orderDir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'ASC';

    // Fetch the data
    $data = fetchData($tableName, $conditions, $conn, $isAdmin, $limit, $orderDir);

    // Print the fetched data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle missing table name in the request
    die("Error: Table name is required in the request.");
}
?>
