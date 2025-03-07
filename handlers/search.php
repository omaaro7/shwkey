<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("X-Content-Type-Options: nosniff");

require_once '../config/conn.php';

const SEARCH_CONFIG = [
    'categories' => [
        'fields' => ['name', 'description'],
        'columns' => ['id', 'create_time', 'name', 'description']
    ],
    'games' => [
        'fields' => ['name', 'description', 'category'],
        'columns' => ['id', 'name', 'points', 'level', 'tech', 'description', 
                     'path', 'thumnail', 'storage_value', 'storage_value_value', 'category']
    ],
    'users' => [
        'fields' => ['user_name', 'name', 'parent_name','parent_type',"date_birth","parent_phonenumber","parent_data_birth"],
        'columns' => ['id', 'create_time', 'user_name', 'name', 'parent_name', 
                     'date_birth', 'parent_data_birth', 'parent_type', 
                     'finshed_games', 'parent_phonenumber', 'type', 'stat', 
                     'level', 'coins', 'edited']
    ]
];

try {
    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        throw new RuntimeException('Method Not Allowed');
    }

    // Initialize response
    $response = [
        'success' => true,
        'data' => [
            'categories' => [],
            'games' => [],
            'users' => []
        ]
    ];

    $searchTerm = trim($_GET['q'] ?? '');

    if (!empty($searchTerm)) {
        // Validate database connection
        if ($conn->connect_error) {
            throw new RuntimeException('Database connection failed');
        }

        foreach (SEARCH_CONFIG as $table => $config) {
            $fields = $config['fields'];
            $columns = $config['columns'];
            
            // Build SQL query
            $conditions = implode(' OR ', array_map(
                fn($f) => "$f LIKE CONCAT('%', ?, '%')", 
                $fields
            ));
            
            $stmt = $conn->prepare("
                SELECT " . implode(', ', $columns) . "
                FROM $table
                WHERE $conditions
            ");
            
            // Bind parameters
            $params = array_fill(0, count($fields), $searchTerm);
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
            
            // Execute and process results
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $matched = [];
                foreach ($fields as $field) {
                    if (stripos($row[$field], $searchTerm) !== false) {
                        $matched[] = $field;
                    }
                }
                $row['matched_columns'] = $matched;
                $response['data'][$table][] = $row;
            }
            
            $stmt->close();
        }
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (RuntimeException $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    error_log('Search Error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Internal server error'
    ], JSON_UNESCAPED_UNICODE);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}