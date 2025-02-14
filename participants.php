<?php
// بيانات الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net';
$db   = '4584173_seif';
$user = '4584173_seif';
$pass = 'Sseeiiff1@';

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// حذف السجل إذا تم استلام طلب الحذف
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM `المشاركون_في_الزيارات` WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: participants.php"); // إعادة تحميل الصفحة بعد الحذف
        exit(); // إنهاء تنفيذ الكود بعد إعادة التوجيه
    } else {
        echo "خطأ في الحذف: " . $conn->error;
    }
}

// استعلام جلب البيانات
$sql = "SELECT id, user_id, الاسم, اسم_التيم, visit_id FROM `المشاركون_في_الزيارات`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المشاركين في الزيارات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f9f9f9;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
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
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-delete {
            background-color: red;
            color: white;
        }
        .btn-print {
            background-color: green;
            color: white;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn:hover {
            opacity: 0.8;
        }
        @media print {
            .btn { display: none; } /* إخفاء الأزرار عند الطباعة */
        }
    </style>
</head>
<body>
    <h2>المشاركون في الزيارات</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>الاسم</th>
            <th>اسم الفريق</th>
            <th>زيارة ID</th>
            <th>إجراء</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["الاسم"] . "</td>";
                echo "<td>" . $row["اسم_التيم"] . "</td>";
                echo "<td>" . $row["visit_id"] . "</td>";
                echo "<td><a href='?delete_id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>حذف</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>لا توجد بيانات</td></tr>";
        }
        ?>
    </table>

    <button class="btn btn-print" onclick="window.print()">طباعة</button>
</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>


