<!DOCTYPE html>
<html>
<head>
    <title>修改用户信息</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
require 'link.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_GET['id'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    // 使用预处理语句来执行更新用户信息的操作
    $updateQuery = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);

    // 使用 password_hash() 函数对密码进行加密
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'ssi', $newUsername, $hashedPassword, $userId);
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        echo "<h1>用户信息已成功更新！</h1>";
        echo '<a href="usershow.php">回到用户修改界面</a>';
    } else {
        echo "<h1>更新用户信息时发生错误：" . mysqli_error($conn) . "</h1>";
        echo '<a href="usershow.php">回到用户修改界面</a>';
    }
} else {
    $userId = $_GET['id'];
    $queryUser = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $queryUser);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $resultUser = mysqli_stmt_get_result($stmt);

    if ($resultUser && mysqli_num_rows($resultUser) > 0) {
        $rowUser = mysqli_fetch_assoc($resultUser);
        $username = $rowUser['username'];

        // 显示用户信息和修改表单
        echo '<a href="usershow.php">回到用户修改界面</a>';
        echo '<h1>修改用户信息</h1>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="id" value="' . $userId . '">';
        echo '<label for="username">用户名:</label>';
        echo '<input type="text" id="username" name="username" value="' . $username . '" required><br><br>';
        echo '<label for="password">密码:</label>';
        echo '<input type="password" id="password" name="password" required><br><br>';
        echo '<input type="submit" value="更新用户信息">';
        echo '</form>';
    } else {
        echo "<h1>无法找到指定的用户ID：" . $userId . "</h1>";
    }
}
?>
</body>
</html>
