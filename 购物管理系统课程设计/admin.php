<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>选择操作</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .welcome-message {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            display: block;
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<h1>选择要进行的操作</h1>

<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo '<div class="welcome-message">欢迎用户 ' . $username . '</div>';
    echo '<a href="getin.php">切换用户</a>';
}
?>

<a href="shopcar.php">进入购物车</a>
<a href="usersearch.php">进入商品首页</a>
<a href="detials.php">查看已下单商品</a>
</body>
</html>
