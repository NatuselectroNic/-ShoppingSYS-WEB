<!DOCTYPE html>
<html>
<head>
    <title>订单列表</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a.button {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
session_start();
require 'link.php';
$root = $_SESSION['username'];
echo '当前用户:'.$root;
echo '<a href="root.php">回到管理员界面</a>';
// 查询 users 表的所有 username
$usersQuery = "SELECT username FROM users";
$usersResult = mysqli_query($conn, $usersQuery);

// 检查是否有用户数据
if (mysqli_num_rows($usersResult) > 0) {
    // 循环遍历每个用户
    while ($userRow = mysqli_fetch_assoc($usersResult)) {
        $username = $userRow['username'];

        // 根据 username 查询订单
        $ordersQuery = "SELECT order_id FROM orders WHERE username = '$username' AND order_id IS NOT NULL";
        $ordersResult = mysqli_query($conn, $ordersQuery);

        // 检查是否有订单数据
        if (mysqli_num_rows($ordersResult) > 0) {
            // 显示表格标题
            echo "<h2>" . $username . "的订单</h2>";
            echo "<table>";
            echo "<tr><th>订单号</th><th>产品ID</th><th>产品名称</th><th>价格</th><th>数量</th><th>商品状态</th><th>订单状态</th><th>操作</th></tr>";

            // 循环遍历每个订单
            while ($orderRow = mysqli_fetch_assoc($ordersResult)) {
                $orderID = $orderRow['order_id'];

                // 查询订单详情
                $detailsQuery = "SELECT * FROM order_details WHERE order_id = '$orderID'";
                $detailsResult = mysqli_query($conn, $detailsQuery);

                // 循环遍历订单详情
                while ($detailsRow = mysqli_fetch_assoc($detailsResult)) {
                    // 获取商品状态
                    $productStatus = "";
                    if ($detailsRow['Checked'] == 0) {
                        $productStatus = "未收货";
                    } elseif ($detailsRow['Checked'] == 1) {
                        $productStatus = "已确认收货";
                    } elseif ($detailsRow['Checked'] == 2) {
                        $productStatus = "已发货";
                    }

                    // 获取订单状态
                    $orderStatus = "";
                    if ($detailsRow['Cancelled'] == 0) {
                        $orderStatus = "正常";
                    } elseif ($detailsRow['Cancelled'] == 1) {
                        $orderStatus = "已取消";
                    }

                    // 输出表格行
                    echo "<tr>";
                    echo "<td>" .$orderID . "</td>";
                    echo "<td>" . $detailsRow['product_id'] . "</td>";
                    echo "<td>" . $detailsRow['product_name'] . "</td>";
                    echo "<td>" . $detailsRow['price'] . "</td>";
                    echo "<td>" . $detailsRow['quantity'] . "</td>";
                    echo "<td>" . $productStatus . "</td>";
                    echo "<td>" . $orderStatus . "</td>";
                    echo "<td>";
                    echo "<a href='confirm.php?order_id=" . $orderID . "&product_id=" . $detailsRow['product_id'] . "' class='button'>发货</a> ";
                    echo "<a href='cancel_order.php?order_id=" . $orderID . "&product_id=" . $detailsRow['product_id'] . "' class='button'>取消订单</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }

            // 关闭表格
            echo "</table>";
        } else {
            //echo "<p>" . $username . "没有找到订单。</p>";
        }
    }
} else {
    echo "<p>没有找到用户数据。</p>";
}

// 关闭数据库连接
mysqli_close($conn);
?>
</body>
</html>
