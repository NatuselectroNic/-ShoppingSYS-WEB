<!DOCTYPE html>
<html>
<head>
    <title>用户管理</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
<h1>用户管理</h1>
<table>
    <a href="root.php">回到管理员首页</a>
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>创建时间</th>
        <th>最后更新时间</th>
        <th>操作</th>
    </tr>
    <?php
    require 'link.php';
    // 查询用户信息
    $query = "SELECT id, username, created_at, updated_at FROM users";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['id'];
            $username = $row['username'];
            $createdAt = $row['created_at'];
            $updatedAt = $row['updated_at'];
            ?>
            <tr>
                <td><?php echo $userId; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $createdAt; ?></td>
                <td><?php echo $updatedAt; ?></td>
                <td>
                    <a href="modify_user.php?id=<?php echo $userId; ?>">修改</a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">无用户信息</td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
