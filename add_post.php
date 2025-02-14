<?php
// إعداد الاتصال بقاعدة البيانات
$host = 'fdb1030.awardspace.net'; // اسم المضيف
$dbname = '4584173_seif'; // اسم قاعدة البيانات
$user = '4584173_seif'; // اسم المستخدم
$password = 'Sseeiiff1@'; // كلمة المرور

$conn = new mysqli($host, $user, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $image = '';
    
    // معالجة رفع الصورة
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $target_file;
        }
    }
    
    // إدخال البيانات إلى الجدول
    $sql = "INSERT INTO team_insan_posts (content, image, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $content, $image);
    
    if ($stmt->execute()) {
        echo "<p class='success-message'>تم نشر المنشور بنجاح!</p>";
    } else {
        echo "<p class='error-message'>حدث خطأ: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منشور</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
            min-height: 150px;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        .success-message {
            color: #2ecc71;
            text-align: center;
            margin-top: 10px;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 style="text-align: center; color: #333;">إضافة منشور جديد</h1>
        <form action="add_post.php" method="POST" enctype="multipart/form-data">
            <textarea name="content" placeholder="اكتب محتوى المنشور هنا..." required></textarea><br>
            <input type="file" name="image" accept="image/*"><br>
            <button type="submit">نشر المنشور</button>
        </form>
    </div>
</body>
</html>