<?php
require "../config/conn.php";
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ✅ استقبل البيانات
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

// ✅ تأكد من صحة post_id
if ($post_id === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid post ID"]);
    exit;
}

// ✅ تحقق من وجود التوكن في الكوكيز
if (!isset($_COOKIE['token'])) {
    echo json_encode(["status" => "error", "message" => "No token provided"]);
    exit;
}

$token = $_COOKIE['token'];
$secretKey ='myAppSecretKey';

try {
    // ✅ فك التوكن والتحقق منه
    $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

    // ✅ استرجاع بيانات المستخدم
    $userQuery = $conn->prepare("SELECT id FROM users WHERE token = ?");
    $userQuery->bind_param("s", $token);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Invalid or expired token"]);
        exit;
    }

    $user = $userResult->fetch_assoc();
    $userId = $user['id'];

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
    exit;
}

// ✅ التحقق هل المستخدم عمل لايك قبل كده
$sql = "SELECT * FROM likes WHERE user_id = ? AND post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $post_id);
$stmt->execute();
$result = $stmt->get_result();
$like = $result->fetch_assoc();

// ✅ تبديل اللايك (إضافة/إلغاء)
if ($like) {
    $sql = "DELETE FROM likes WHERE user_id = ? AND post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $post_id);
    $stmt->execute();

    echo json_encode(["status" => "success", "action" => "unliked"]);
} else {
    $sql = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $post_id);
    $stmt->execute();

    echo json_encode(["status" => "success", "action" => "liked"]);
}

// ✅ إنهاء الستيتمنت
$stmt->close();
?>
