<?php
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

// جلب الطلبات من جدول "الطلبات"
$stmt = $pdo->query("SELECT * FROM الطلبات WHERE id NOT IN (SELECT id FROM المتطوعين)");
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// معالجة القبول والرفض
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        if (isset($_POST['accept'])) {
            // جلب بيانات المتطوع
            $stmt = $pdo->prepare("SELECT * FROM الطلبات WHERE id = ?");
            $stmt->execute([$id]);
            $volunteer = $stmt->fetch(PDO::FETCH_ASSOC);

            // إضافة المتطوع إلى جدول المتطوعين
            $stmt = $pdo->prepare("INSERT INTO المتطوعين (id, الاسم_الكامل, اسم_التيم, رقم_الموبيل, الايميل, الباسورد) 
                                   SELECT id, الاسم_الكامل, اسم_التيم, رقم_الموبيل, الايميل, الباسورد FROM الطلبات WHERE id = ?");
            $stmt->execute([$id]);

            // حذف الطلب من جدول الطلبات
            $stmt = $pdo->prepare("DELETE FROM الطلبات WHERE id = ?");
            $stmt->execute([$id]);

            echo "<p style='color: green;'>تم قبول الطلب بنجاح!</p>";

        } elseif (isset($_POST['reject'])) {
            $stmt = $pdo->prepare("DELETE FROM الطلبات WHERE id = ?");
            $stmt->execute([$id]);

            echo "<p style='color: red;'>تم رفض الطلب.</p>";
        }

        echo "<meta http-equiv='refresh' content='1'>"; // تحديث الصفحة بعد ثانية واحدة
    } catch (PDOException $e) {
        echo "<p style='color: red;'>حدث خطأ: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صفحة الأدمن</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-accept {
            background-color: #28a745;
            color: white;
        }
        .btn-reject {
            background-color: #dc3545;
            color: white;
        }
        .btn-home {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border-radius: 5px;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>مرحبًا بك في صفحة الأدمن</h1>
        <p>هذه الصفحة تحتوي على طلبات التسجيل.</p>

        <?php if (count($requests) > 0): ?>
            <table>
                <tr><th>ID</th><th>الاسم</th><th>اسم التيم</th><th>رقم الموبايل</th><th>الإيميل</th><th>الإجراء</th></tr>
                <?php foreach ($requests as $row): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['الاسم_الكامل']); ?></td>
                        <td><?= htmlspecialchars($row['اسم_التيم']); ?></td>
                        <td><?= htmlspecialchars($row['رقم_الموبيل']); ?></td>
                        <td><?= htmlspecialchars($row['الايميل']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="submit" name="accept" class="btn btn-accept">قبول</button>
                                <button type="submit" name="reject" class="btn btn-reject">رفض</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>لا توجد طلبات جديدة.</p>
        <?php endif; ?>

        <a href="index.html" class="btn-home">الرجوع إلى الصفحة الرئيسية</a>
    </div>

</body>
</html>
