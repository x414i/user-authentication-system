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


// $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
// $result = $conn->query($sql);
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "تسجيل الدخول ناجح!";
} else {
    echo "اسم المستخدم أو كلمة المرور غير صحيحة.";
}

$conn->close();

// username: admin
// password: ' OR '1'='1
//SELECT * FROM users WHERE username = 'admin' AND password = '' OR '1'='1'

// ' OR 1=1#

// ' UNION SELECT table_name,null FROM 	information_schema.tables#



















// // SQL Injection
// $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
// $stmt->bind_param("ss", $user, $pass);
// $stmt->execute();
// $result = $stmt->get_result();