<?php
// الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net'; // اسم المضيف
$db   = '4584173_seif'; // اسم قاعدة البيانات
$user = '4584173_seif'; // اسم المستخدم
$pass = 'Sseeiiff1@'; // كلمة المرور

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}


// استقبال البيانات من النموذج
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];

// تحديد الجدول المناسب بناءً على الفئة
$table = ($category == "money") ? "money_items" : "food_clothes_items";

// إدخال البيانات في الجدول المناسب
$sql = "INSERT INTO `$table` (name, quantity) VALUES ('$item_name', '$quantity')";

if ($conn->query($sql) === TRUE) {
    echo "تم إدخال البيانات بنجاح!";
} else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
