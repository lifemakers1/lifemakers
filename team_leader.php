<?php
session_start();


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

// التحقق من إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $place = $_POST['place'];
    $date = $_POST['date'];
    $gather_time = $_POST['gather_time'];
    $gather_place = $_POST['gather_place'];
    $supervisor = $_POST['supervisor'];

    // إدخال البيانات إلى جدول "الزيارات"
    $stmt = $pdo->prepare("INSERT INTO الزيارات (المكان, التاريخ, وقت_التجمع, مكان_التجمع, المشرف) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$place, $date, $gather_time, $gather_place, $supervisor]);

    $success_message = "✅ تم إضافة الزيارة بنجاح!";
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>رئيس تيم الزيارات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            color: #003366;
            font-size: 28px;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success {
            color: green;
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>إضافة زيارة جديدة</h1>

        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="place">📍 المكان:</label>
            <input type="text" id="place" name="place" required>

            <label for="date">📆 التاريخ:</label>
            <input type="date" id="date" name="date" required>

            <label for="gather_time">⏰ وقت التجمع:</label>
            <input type="time" id="gather_time" name="gather_time" required>

            <label for="gather_place">📍 مكان التجمع:</label>
            <input type="text" id="gather_place" name="gather_place" required>

            <label for="supervisor">👤 المشرف:</label>
            <input type="text" id="supervisor" name="supervisor" required>

            <button type="submit">إضافة الزيارة</button>
        </form>

        <br>
        <a href="volunteers.php">🔙 العودة إلى الصفحة الرئيسية</a>
    </div>

</body>
</html>



