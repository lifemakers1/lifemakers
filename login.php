<?php
session_start(); // بدء الجلسة لتخزين بيانات المستخدم

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
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

$errorMessage = ''; // متغير لتخزين رسالة التحذير

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // البحث عن المستخدم في قاعدة البيانات
    $stmt = $pdo->prepare("SELECT * FROM المتطوعين WHERE الايميل = ? AND الباسورد = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // التحقق إذا كان الايميل موجود في جدول الطلبات
    $stmt_order = $pdo->prepare("SELECT * FROM الطلبات WHERE الايميل = ?");
    $stmt_order->execute([$email]);
    $order = $stmt_order->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        // إذا كان الإيميل موجودًا في جدول الطلبات
        $errorMessage = "انتظر، سيتم مراجعة الطلب من قبل الادمن أولاً 😝";
    } elseif ($user) {
        // إذا كان المستخدم موجودًا في جدول المتطوعين
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['الاسم_الكامل'];
        $_SESSION['team_name'] = $user['اسم_التيم'];

        // تسجيل آخر دخول للمستخدم
      // تسجيل آخر دخول للمستخدم
$stmt_login = $pdo->prepare("INSERT INTO تسجيل_الدخول (user_name) VALUES (?)");
$stmt_login->execute([$user['الاسم_الكامل']]);


        // نقل المستخدم إلى صفحة المتطوعين
        header("Location: volunteers.php");
        exit();
    } else {
        // إذا لم يكن هناك تطابق مع أي من الجدولين
        $errorMessage = "الإيميل أو كلمة المرور غير صحيحة";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            width: 30%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a {
            text-decoration: none;
            display: block;
            margin-top: 10px;
            color: #007bff;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>تسجيل الدخول</h1>

        <!-- عرض رسالة التحذير إذا كانت موجودة -->
        <?php if (!empty($errorMessage)) { ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php } ?>

        <form action="login.php" method="post">
            <label for="email">الإيميل:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">دخول</button>
        </form>

        <a href="register.html">إنشاء حساب جديد</a>
    </div>

</body>
</html>



