<?php
session_start();
require 'link.php';

$root = $_SESSION['username'];
// 获取传递的订单号和产品ID参数
$orderID = $_GET['order_id'];
$productID = $_GET['product_id'];

// 检查订单号和产品ID是否有效
if (!empty($orderID) && !empty($productID)) {
    // 检查订单是否已取消
    $checkCancelledQuery = "SELECT Cancelled FROM order_details WHERE order_id = '$orderID' AND product_id = '$productID'";
    $checkCancelledResult = mysqli_query($conn, $checkCancelledQuery);

    if ($checkCancelledResult && mysqli_num_rows($checkCancelledResult) > 0) {
        $cancelledStatus = mysqli_fetch_assoc($checkCancelledResult)['Cancelled'];

        if ($cancelledStatus == 0) {
            if ($root !== 'root') {
                //echo "您不是管理员用户，无法执行发货操作。";
                $updateQuery = "UPDATE order_details SET Checked = 1 WHERE order_id = '$orderID' AND product_id = '$productID'";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "订单已确认收货。";
                } else {
                    echo "确认收货时出现问题，请重试。";
                }
            } else {
                // 根据订单号和产品ID执行确认收货的操作，例如更新数据库状态或进行其他逻辑处理
                // ...

                // 示例：更新订单详情中的Checked字段为1，表示订单已收货
                $updateQuery = "UPDATE order_details SET Checked = 2 WHERE order_id = '$orderID' AND product_id = '$productID'";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "订单已发货。";
                } else {
                    echo "发货时出现问题，请重试。";
                }
            }
        } else {
            echo "该商品已被取消，无法确认收货。";
        }
    } else {
        echo "无效的订单信息。";
    }
} else {
    echo "无效的订单信息。";
}

if ($root === 'root') {
    echo '<a href="rootdetails.php">回到管理员订单界面</a>';
} else {
    echo '<a href="detials.php">回到订单界面</a>';
}

// 关闭数据库连接
mysqli_close($conn);
?>
