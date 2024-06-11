<?php
//require 'regist.php';
session_start();
require 'link.php';
// 接受注册表单提交的数据
if ($_POST["captcha"] !== $_SESSION["captcha"]) {
    //echo '<p>验证码错误！点击<a href="regist.php">这里</a>返回登录页面。</p>';
    die('<p>验证码错误！点击<a href="regist.php">这里</a>返回注册页面。</p>');
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 验证密码匹配
    if ($password !== $confirm_password) {
        die('<p>密码不匹配，请重新输入！点击<a href="regist.php">这里</a>返回注册页面。</p>');
    } else {
        // 对密码进行加密（例如使用 password_hash() 函数）
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 准备插入语句
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        // 执行插入操作
        if ($conn->query($sql) === TRUE) {
            //echo "注册成功！";
            echo '<p>注册成功！点击<a href="getin.php">这里</a>返回登录页面。</p>';

        } else {
            echo "注册失败: " . $conn->error;
        }
    }
}

// 关闭数据库连接
$conn->close();
?>

