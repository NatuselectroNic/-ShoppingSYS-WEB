<?php
session_start();
//require 'getin.php';
require 'link.php';
//if($_POST['登录']){

// 验证码验证
if ($_POST["captcha"] !== $_SESSION["captcha"]) {
    //die("验证码错误");
    die('<p>验证码错误！点击<a href="getin.php">这里</a>返回登录页面。</p>');
}

// 输入内容过滤和防止 SQL 注入
$username = mysqli_real_escape_string($conn, $_POST["username"]);
//$username = $_POST['username'];
$password = mysqli_real_escape_string($conn, $_POST["password"]);

// 加密用户密码
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
//$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //echo $row["password"];
    if (password_verify($password, $row["password"])) {
        // 用户登录成功，创建安全会话 Token
        $token = bin2hex(random_bytes(32));
        $_SESSION["token"] = $token;
        $_SESSION["username"] = $username;
        if($_SESSION["username"]==='root'){
        // 重定向到管理员页面或其他逻辑
        header("Location: root.php");
        }else{
        echo "登陆成功";
        header("Location: admin.php");
        exit();}
    } else {
        echo "密码错误".'<a href="getin.php">回到登录界面</a>';
        exit();
    }
} else {
    echo "用户不存在".'<a href="getin.php">回到登录界面</a>';
    exit();

}
?>
