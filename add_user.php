<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];


$hashed_password = password_hash($pass, PASSWORD_DEFAULT);


$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $hashed_password);

if ($stmt->execute()) {
    echo "تم إضافة المستخدم بنجاح!";
} else {
    echo "حدث خطأ أثناء إضافة المستخدم: " . $stmt->error;
}

$stmt->close();
$conn->close();
