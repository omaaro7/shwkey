<?php
require_once '../config/conn.php';

header('Content-Type: application/json');

// Get single category by ID
function getCategoryById($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT 
                cc.*,
                COUNT(c.id) as total_courses,
                COUNT(DISTINCT c.instructor) as unique_instructors,
                SUM(CASE WHEN c.status = 'active' THEN 1 ELSE 0 END) as active_courses
              FROM courses_categories cc
              LEFT JOIN courses c ON cc.id = c.category
              WHERE cc.id = '$id'
              GROUP BY cc.id";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return array(
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'metrics' => array(
                'total_courses' => (int)$row['total_courses'],
                'active_courses' => (int)$row['active_courses'],
                'inactive_courses' => (int)($row['total_courses'] - $row['active_courses']),
                'unique_instructors' => (int)$row['unique_instructors']
            ),
            'status' => $row['total_courses'] > 0 ? 'active' : 'inactive',
            'created_at' => $row['created_at']
        );
    }
    return null;
}

// Get single course by ID
function getCourseById($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT 
                c.*,
                cc.name as category_name
              FROM courses c
              LEFT JOIN courses_categories cc ON c.category = cc.id
              WHERE c.id = '$id'";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return array(
            'id' => (int)$row['id'],
            'title' => $row['title'],
            'category' => array(
                'id' => (int)$row['category'],
                'name' => $row['category_name']
            ),
            'instructor' => $row['instructor'],
            'status' => $row['status'],
            'created_at' => $row['created_at']
        );
    }
    return null;
}

// Get categories data with pagination
function getCategoriesData($conn, $page = 1, $limit = 10) {
    $offset = ($page - 1) * $limit;
    $offset = mysqli_real_escape_string($conn, $offset);
    $limit = mysqli_real_escape_string($conn, $limit);
    
    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM courses_categories";
    $countResult = mysqli_query($conn, $countQuery);
    $totalItems = ($countResult && $row = mysqli_fetch_assoc($countResult)) ? $row['total'] : 0;
    
    // Get paginated data
    $query = "SELECT 
                cc.*,
                COUNT(c.id) as total_courses,
                COUNT(DISTINCT c.instructor) as unique_instructors,
                SUM(CASE WHEN c.status = 'active' THEN 1 ELSE 0 END) as active_courses
              FROM courses_categories cc
              LEFT JOIN courses c ON cc.id = c.category
              GROUP BY cc.id
              LIMIT $offset, $limit";
    
    $result = mysqli_query($conn, $query);
    $categories = array();
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = array(
                'id' => (int)$row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'metrics' => array(
                    'total_courses' => (int)$row['total_courses'],
                    'active_courses' => (int)$row['active_courses'],
                    'inactive_courses' => (int)($row['total_courses'] - $row['active_courses']),
                    'unique_instructors' => (int)$row['unique_instructors']
                ),
                'status' => $row['total_courses'] > 0 ? 'active' : 'inactive',
                'created_at' => $row['created_at']
            );
        }
    }
    
    return array(
        'items' => $categories,
        'pagination' => array(
            'total' => (int)$totalItems,
            'page' => (int)$page,
            'limit' => (int)$limit,
            'total_pages' => ceil($totalItems / $limit)
        )
    );
}

// Get courses data with pagination
function getCoursesData($conn, $page = 1, $limit = 10) {
    $offset = ($page - 1) * $limit;
    $offset = mysqli_real_escape_string($conn, $offset);
    $limit = mysqli_real_escape_string($conn, $limit);
    
    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM courses";
    $countResult = mysqli_query($conn, $countQuery);
    $totalItems = ($countResult && $row = mysqli_fetch_assoc($countResult)) ? $row['total'] : 0;
    
    // Get paginated data
    $query = "SELECT 
                c.*,
                cc.name as category_name
              FROM courses c
              LEFT JOIN courses_categories cc ON c.category = cc.id
              LIMIT $offset, $limit";
    
    $result = mysqli_query($conn, $query);
    $courses = array();
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = array(
                'id' => (int)$row['id'],
                'title' => $row['title'],
                'category' => array(
                    'id' => (int)$row['category'],
                    'name' => $row['category_name']
                ),
                'instructor' => $row['instructor'],
                'status' => $row['status'],
                'created_at' => $row['created_at']
            );
        }
    }
    
    return array(
        'items' => $courses,
        'pagination' => array(
            'total' => (int)$totalItems,
            'page' => (int)$page,
            'limit' => (int)$limit,
            'total_pages' => ceil($totalItems / $limit)
        )
    );
}

// Handle the request
try {
    $type = isset($_GET['type']) ? $_GET['type'] : 'all';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    
    // Ensure valid pagination parameters
    $page = max(1, $page);
    $limit = max(1, min(100, $limit)); // Limit between 1 and 100
    
    $response = array('status' => 'success');

    switch ($type) {
        case 'category':
            if ($id) {
                $category = getCategoryById($conn, $id);
                if ($category) {
                    $response['data'] = array(
                        'category' => $category,
                        'type' => 'category',
                        'timestamp' => date('Y-m-d H:i:s')
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Category not found'
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Category ID is required'
                );
            }
            break;
            
        case 'course':
            if ($id) {
                $course = getCourseById($conn, $id);
                if ($course) {
                    $response['data'] = array(
                        'course' => $course,
                        'type' => 'course',
                        'timestamp' => date('Y-m-d H:i:s')
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Course not found'
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Course ID is required'
                );
            }
            break;
            
        case 'categories':
            $response['data'] = array(
                'categories' => getCategoriesData($conn, $page, $limit),
                'type' => 'categories',
                'timestamp' => date('Y-m-d H:i:s')
            );
            break;
            
        case 'courses':
            $response['data'] = array(
                'courses' => getCoursesData($conn, $page, $limit),
                'type' => 'courses',
                'timestamp' => date('Y-m-d H:i:s')
            );
            break;
            
        default:
            // Return both categories and courses with pagination
            $response['data'] = array(
                'categories' => getCategoriesData($conn, $page, $limit),
                'courses' => getCoursesData($conn, $page, $limit),
                'type' => 'all',
                'timestamp' => date('Y-m-d H:i:s')
            );
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    echo json_encode(array(
        'status' => 'error',
        'message' => $e->getMessage()
    ));
}