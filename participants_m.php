<?php
// بيانات الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net';  // اسم السيرفر
$db   = '4584173_seif';            // اسم قاعدة البيانات
$user = '4584173_seif';            // اسم المستخدم
$pass = 'Sseeiiff1@';              // كلمة المرور

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// حذف الصف عند الضغط على زر الحذف
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM `المشاركون_في_المعارض` WHERE id = $delete_id");
}

// استعلام جلب البيانات
$sql = "SELECT id, user_id, الاسم, اسم_التيم, معرض_id FROM `المشاركون_في_المعارض`"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المشاركين في المعارض</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f4f4f4;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .delete-btn {
            background-color: red;
            color: white;
        }
        .print-btn {
            background-color: green;
            color: white;
        }
        /* إخفاء الأزرار عند الطباعة */
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>المشاركون في المعارض</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>الاسم</th>
            <th>اسم الفريق</th>
            <th>معرض ID</th>
            <th class="btn">إجراء</th> <!-- إخفاء الزر عند الطباعة -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["الاسم"] . "</td>";
                echo "<td>" . $row["اسم_التيم"] . "</td>";
                echo "<td>" . $row["معرض_id"] . "</td>";
                echo "<td class='btn'>
                    <form method='post' onsubmit='return confirm(\"هل أنت متأكد من الحذف؟\");'>
                        <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                        <button type='submit' class='btn delete-btn'>حذف</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>لا توجد بيانات</td></tr>";
        }
        ?>
    </table>

    <br>
    <button class="btn print-btn" onclick="window.print()">طباعة</button>

</body>
</html>

<?php
$conn->close();
?>


