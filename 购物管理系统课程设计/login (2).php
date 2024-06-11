<?php
session_start();

// 验证码验证
if ($_POST["captcha"] !== $_SESSION["captcha"]) {
    die("验证码错误");
}

// 输入内容过滤和防止 SQL 注入
$username = mysqli_real_escape_string($conn, $_POST["username"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

// 加密用户密码
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        // 用户登录成功，创建安全会话 Token
        $token = bin2hex(random_bytes(32));
        $_SESSION["token"] = $token;
        $_SESSION["username"] = $username;
        // 重定向到管理员页面或其他逻辑
        header("Location: admin.php");
        exit();
    } else {
        die("密码错误");
    }
} else {
    die("用户不存在");
}
?>
