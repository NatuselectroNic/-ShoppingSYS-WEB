<?php
// 启动会话
session_start();

// 检查用户是否已登录，若未登录则重定向到登录页面
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 获取当前用户的用户名
$userName = $_SESSION['username'];

// 数据库连接
require 'link.php';

// 处理提交订单的逻辑
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    // 执行第一次插入操作
    $createOrderQuery = "INSERT INTO orders (username) VALUES ('$userName')";
    $createOrderResult = mysqli_query($conn, $createOrderQuery);

    if ($createOrderResult) {
        // 获取刚创建的订单的ID
        $orderId = mysqli_insert_id($conn)+1;

        // 执行第二次插入操作，使用获取到的订单ID
        $secondInsertQuery = "INSERT INTO orders (order_id, username) VALUES ('$orderId', '$userName')";
        $secondInsertResult = mysqli_query($conn, $secondInsertQuery);

        if ($secondInsertResult) {
            // 第二次插入操作成功
            echo "提交成功！";

        } else {
            // 第二次插入操作失败
            echo "提交失败：" . mysqli_error($conn);
        }
    } else {
        // 第一次插入操作失败
        echo "创建订单失败：" . mysqli_error($conn);
    }

    if ($createOrderResult) {
        // 获取刚创建的订单的ID
        $orderId = mysqli_insert_id($conn);

        // 查询购物车数据并插入订单明细
        $selectCartQuery = "SELECT product_id, quantity FROM cart WHERE username = '$userName'";
        $resultSelectCart = mysqli_query($conn, $selectCartQuery);

        if ($resultSelectCart && mysqli_num_rows($resultSelectCart) > 0) {
            while ($rowSelectCart = mysqli_fetch_assoc($resultSelectCart)) {
                $product_id = $rowSelectCart['product_id'];
                $quantity = $rowSelectCart['quantity'];

                // 获取产品名称和价格
                $selectProductQuery = "SELECT name, price FROM products WHERE id = '$product_id'";
                $resultProduct = mysqli_query($conn, $selectProductQuery);

                if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
                    $rowProduct = mysqli_fetch_assoc($resultProduct);
                    $product_name = $rowProduct['name'];
                    $price = $rowProduct['price'];

                    // 插入订单明细
                    $moveCartQuery = "INSERT INTO order_details (order_id, product_id, product_name, price, quantity) VALUES ('$orderId', '$product_id', '$product_name', '$price', '$quantity')";
                    $moveCartResult = mysqli_query($conn, $moveCartQuery);

                    if (!$moveCartResult) {
                        // 插入订单明细失败
                        echo "移动购物车数据到订单明细失败：" . mysqli_error($conn);
                    }
                } else {
                    // 未找到匹配的产品
                }
            }
        } else {
            // 购物车为空
        }

        // 清空购物车
        $clearCartQuery = "DELETE FROM cart WHERE username = '$userName'";
        $clearCartResult = mysqli_query($conn, $clearCartQuery);

        if (!$clearCartResult) {
            // 清空购物车失败
            echo "清空购物车失败：" . mysqli_error($conn);
        }

        // 重定向到订单详情页面
        //header("Location: order_details.php?id=$orderId");
        echo '<br>'.'<a href="admin.php">回到个人中心</a>'.'<br>';
        echo '<a href="shopcar.php">回到购物车</a>'.'<br>';
        echo '<a href="usersearch.php">回到商城</a>'.'<br>';
        exit();

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>提交订单</title>
</head>
<body>
<h1>提交订单</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <button type="submit" name="checkout">提交订单</button>
</form>

</body>
</html>
