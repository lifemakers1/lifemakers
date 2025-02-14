<?php
// إعدادات الاتصال بقاعدة البيانات
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

// تحديد الوقت الحالي قبل 3 ساعات
$three_hours_ago = date('Y-m-d H:i:s', strtotime('-3 hours'));

// استعلام لجلب بيانات تسجيل الدخول لآخر 3 ساعات
$stmt = $pdo->prepare("SELECT user_name, timestamp FROM تسجيل_الدخول WHERE timestamp >= ?");
$stmt->execute([$three_hours_ago]);

// جلب البيانات وإرجاعها بصيغة JSON
$logins = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($logins);
?>
