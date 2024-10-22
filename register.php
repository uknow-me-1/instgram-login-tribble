<?php
// الاتصال بقاعدة البيانات SQLite
$db = new PDO('sqlite:users.db');

// إنشاء جدول إذا لم يكن موجودًا
$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL
)";
$db->exec($query);

// معالجة البيانات القادمة من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور

    // إدخال البيانات في قاعدة البيانات
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    echo "تم التسجيل بنجاح!";
}
?>
