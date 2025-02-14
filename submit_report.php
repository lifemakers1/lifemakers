<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'غير مسجل الدخول']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$user_name = $data['user_name'];
$team_name = $data['team_name'];
$problem_description = $data['problem_description'];

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

// إدخال التقرير في الجدول
$stmt = $pdo->prepare("INSERT INTO تقارير_المشاكل (user_id, user_name, team_name, problem_description) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $user_name, $team_name, $problem_description]);

echo json_encode(['success' => true]);
?>