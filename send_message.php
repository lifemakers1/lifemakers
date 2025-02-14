<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("غير مصرح به");
}

$data = json_decode(file_get_contents('php://input'), true);

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

$stmt = $pdo->prepare("INSERT INTO الدردشة (user_id, user_name, team_name, message) VALUES (?, ?, ?, ?)");
$stmt->execute([$data['user_id'], $data['user_name'], $data['team_name'], $data['message']]);

echo json_encode(['success' => true]);
?>