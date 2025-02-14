<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'غير مصرح بالوصول']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$message_id = $data['message_id'];
$user_id = $data['user_id'];
$is_admin = $data['is_admin'];

// الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net';
$db   = '4584173_seif';
$user = '4584173_seif';
$pass = 'Sseeiiff1@';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

// التحقق مما إذا كان المستخدم هو المرسل أو المسؤول
$stmt = $pdo->prepare("SELECT user_id FROM الدردشة WHERE id = ?");
$stmt->execute([$message_id]);
$message = $stmt->fetch(PDO::FETCH_ASSOC);

if ($message && ($message['user_id'] == $user_id || $is_admin)) {
    $delete_stmt = $pdo->prepare("DELETE FROM الدردشة WHERE id = ?");
    $delete_stmt->execute([$message_id]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'غير مصرح لك بحذف هذه الرسالة']);
}
?>