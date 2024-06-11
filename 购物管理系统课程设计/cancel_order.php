<?php
session_start();
require 'link.php';
$root = $_SESSION['username'];
// 获取传递的订单号和产品ID参数
$orderID = $_GET['order_id'];
$productID = $_GET['product_id'];

// 检查订单号和产品ID是否有效
if (!empty($orderID) && !empty($productID)) {
    // 根据订单号和产品ID执行取消订单的操作，例如更新数据库状态或进行其他逻辑处理
    // ...

    // 示例：更新订单详情中的Cancelled字段为1，表示订单已取消
    $updateQuery = "UPDATE order_details SET Cancelled = 1 WHERE order_id = '$orderID' AND product_id = '$productID'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "订单已取消。";
    } else {
        echo "取消订单时出现问题，请重试。";
    }
} else {
    echo "无效的订单信息。";
}
if($root === 'root'){
    echo '<a href="rootdetails.php">回到管理员订单界面</a>';
}else echo '<a href="detials.php">回到订单界面</a>';
// 关闭数据库连接
mysqli_close($conn);
?>
