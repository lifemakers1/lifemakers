<?php
session_start();
session_destroy(); // إنهاء الجلسة
header("Location: login.php"); // إعادة التوجيه لصفحة تسجيل الدخول
exit();
?>
