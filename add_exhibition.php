<?php
// تفعيل تقارير الأخطاء
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// معلومات الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net';
$db   = '4584173_seif';
$user = '4584173_seif';
$pass = 'Sseeiiff1@';

// إنشاء الاتصال
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من أن النموذج تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج مع التحقق من وجودها
    $اسم_المعرض = isset($_POST['اسم_المعرض']) ? $_POST['اسم_المعرض'] : '';
    $المكان = isset($_POST['المكان']) ? $_POST['المكان'] : '';
    $التاريخ = isset($_POST['التاريخ']) ? $_POST['التاريخ'] : '';
    $الوقت = isset($_POST['الوقت']) ? $_POST['الوقت'] : '';
    $المشرف = isset($_POST['المشرف']) ? $_POST['المشرف'] : '';

    // التحقق من أن جميع الحقول مملوءة
    if (!empty($اسم_المعرض) && !empty($المكان) && !empty($التاريخ) && !empty($الوقت) && !empty($المشرف)) {
        // إعداد الاستعلام باستخدام prepared statements
        $stmt = $conn->prepare("INSERT INTO المعارض (اسم_المعرض, المكان, التاريخ, الوقت, المشرف) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $اسم_المعرض, $المكان, $التاريخ, $الوقت, $المشرف);

        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            echo "تمت إضافة المعرض بنجاح";
        } else {
            echo "خطأ: " . $stmt->error;
        }

        // إغلاق الاستعلام
        $stmt->close();
    } else {
        echo "يرجى ملء جميع الحقول.";
    }
} else {
    echo "لم يتم إرسال النموذج.";
}

// إغلاق الاتصال
$conn->close();
?>

