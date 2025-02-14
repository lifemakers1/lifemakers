<?php
ob_start();  // تشغيل تخزين الإخراج المؤقت لمنع أخطاء header()

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'fdb1030.awardspace.net';
$db   = '4584173_seif';
$user = '4584173_seif';
$pass = 'Sseeiiff1@';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => "فشل الاتصال بقاعدة البيانات: " . $e->getMessage()]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $teamname = trim($_POST['teamname']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // التحقق من تطابق كلمتي المرور
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => "كلمتا المرور غير متطابقتين!"]);
        exit();
    }

    // التحقق من وجود البريد الإلكتروني في جدول المتطوعين
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM المتطوعين WHERE الايميل = ?");
        $stmt->execute([$email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists > 0) {
            echo json_encode(['success' => false, 'message' => "البريد الإلكتروني مستخدم مسبقًا!"]);
            exit();
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "حدث خطأ أثناء التحقق من البريد الإلكتروني: " . $e->getMessage()]);
        exit();
    }

    // إدخال البيانات إلى جدول "الطلبات"
    try {
        $stmt = $pdo->prepare("INSERT INTO الطلبات (الاسم_الكامل, اسم_التيم, رقم_الموبيل, الايميل, الباسورد) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fullname, $teamname, $mobile, $email, $password]);

        // إرجاع رسالة نجاح
        echo json_encode(['success' => true, 'message' => "تم إرسال الطلب بنجاح، سيتم مراجعته من قبل الأدمن."]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "حدث خطأ أثناء التسجيل: " . $e->getMessage()]);
        exit();
    }
}

ob_end_flush(); // إنهاء التخزين المؤقت للإخراج
?>
