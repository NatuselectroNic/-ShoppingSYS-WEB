<!DOCTYPE html>
<html>
<head>
    <title>订单详情</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .cancelled {
            color: red;
        }

        .received {
            color: green;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
session_start();
// 假设已经连接到数据库并选择了正确的数据库

// 获取当前用户的用户名
$userName = $_SESSION['username']; // 假设使用会话来存储当前用户的用户名
echo $_SESSION['username'];
echo '<br>'.'<a href="admin.php">回到个人中心</a>';
require 'link.php';
// 查询用户的订单
$username = $userName;
$query = "SELECT order_id FROM orders WHERE username = '$username' AND order_id IS NOT NULL";
//$query = "SELECT * FROM orders WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// 检查是否有订单
if (mysqli_num_rows($result) > 0) {
    // 循环遍历每个订单
    while ($row = mysqli_fetch_assoc($result)) {
        $orderID = $row['order_id'];

        // ...

        echo "<h2>订单号: " . $row['order_id'] . "</h2>";
        echo "<p>订单日期: " . $row['order_date'] . "</p>";

        // 显示订单详细信息表格
        echo "<table>";
        echo "<tr><th>产品ID</th><th>产品名称</th><th>价格</th><th>数量</th><th>状态</th><th>收货状态</th><th>取消订单</th><th>确认收货</th></tr>";

        // 循环遍历订单的详细信息
        $detailsQuery = "SELECT * FROM order_details WHERE order_id = '$orderID'";
        $detailsResult = mysqli_query($conn, $detailsQuery);
        while ($detailsRow = mysqli_fetch_assoc($detailsResult)) {
            echo "<tr>";
            echo "<td>" . $detailsRow['product_id'] . "</td>";
            echo "<td>" . $detailsRow['product_name'] . "</td>";
            echo "<td>" . $detailsRow['price'] . "</td>";
            echo "<td>" . $detailsRow['quantity'] . "</td>";

            // 根据 Cancelled 字段的值确定订单状态
            $statusClass = $detailsRow['Cancelled'] == 1 ? "cancelled" : "";
            $status = $detailsRow['Cancelled'] == 1 ? "已取消" : "正常";
            echo "<td class='" . $statusClass . "'>" .$status . "</td>";

            // 根据 Checked 字段的值确定订单收货状态
            $checkedStatusClass = '';
            $checkedStatus = '';
            if ($detailsRow['Checked'] == 1) {
                $checkedStatusClass = "received";
                $checkedStatus = "已收货";
            } elseif ($detailsRow['Checked'] == 2) {
                $checkedStatus = "已发货";
            } else {
                $checkedStatus = "未收货";
            }
            echo "<td class='" . $checkedStatusClass . "'>" . $checkedStatus . "</td>";

            // 添加取消订单的链接按钮
            echo "<td><a href='cancel_order.php?order_id=" . $orderID . "&product_id=" . $detailsRow['product_id'] . "'>取消订单</a></td>";

            // 添加确认收货的超链接按钮
            if ($detailsRow['Checked'] == 1) {
                echo "<td>-</td>"; // 已收货，显示占位符
            } else {
                echo "<td><a class='btn' href='confirm.php?order_id=" . $orderID . "&product_id=" . $detailsRow['product_id'] . "'>确认收货</a></td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    }
} else {
    echo "没有找到订单。";
}

// 关闭数据库连接
mysqli_close($conn);
?>
</body>
</html>
