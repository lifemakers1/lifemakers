<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['team_name'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'غير مصرح بالوصول']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$message_id = $data['message_id'];

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

// حذف الرسالة نهائيًا
$delete_stmt = $pdo->prepare("DELETE FROM الدردشة WHERE id = ?");
$delete_stmt->execute([$message_id]);
echo json_encode(['success' => true]);
?>