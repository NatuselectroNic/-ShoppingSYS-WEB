<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "123";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>
