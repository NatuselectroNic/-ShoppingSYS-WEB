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
//echo $userName;
// 数据库连接
require 'link.php';

// 处理提交订单的逻辑
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    // 执行第一次插入操作
    $createOrderQuery = "INSERT INTO orders (username) VALUES ('$userName')";
    $createOrderResult = mysqli_query($conn, $createOrderQuery);

    if ($createOrderResult) {
        // 获取刚创建的订单的ID
        $orderId = mysqli_insert_id($conn) + 1;
        //两条插入语句，导致两次insert_id不一致 所以需要加一

        // 执行第二次插入操作，使用获取到的订单ID
        $secondInsertQuery = "INSERT INTO orders (order_id, username) VALUES ('$orderId', '$userName')";
        $secondInsertResult = mysqli_query($conn, $secondInsertQuery);

        if ($secondInsertResult) {
            // 第二次插入操作成功
            echo "第二次插入成功！";
        } else {
            // 第二次插入操作失败
            echo "第二次插入失败：" . mysqli_error($conn);
        }
    } else {
        // 第一次插入操作失败
        echo "创建订单失败：" . mysqli_error($conn);
    }



    if ($createOrderResult) {
        // 获取刚创建的订单的ID
        $orderId = mysqli_insert_id($conn);
        //echo $orderId;



        $queryProduct = "SELECT name, price FROM products WHERE id = product_id";
        $resultProduct = mysqli_query($conn, $queryProduct);

        if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
            $rowProduct = mysqli_fetch_assoc($resultProduct);
            $product_name = $rowProduct['name'];
            $price = $rowProduct['price'];
            echo $product_name;
            echo $price;
            // 使用 $product_name 和 $price 进行后续操作
        } else {
            // 未找到匹配的产品
        }

        $moveCartQuery = "INSERT INTO order_details (order_id, product_id, product_name, price, quantity) SELECT $orderId, product_id, '$product_name', '$price', quantity FROM cart WHERE username = '$userName'";


        mysqli_query($conn, $moveCartQuery);

        $moveCartResult = mysqli_query($conn, $moveCartQuery);

        if ($moveCartResult) {
            // 继续处理清空购物车等操作
        } else {
            // 插入订单明细失败
            echo "移动购物车数据到订单明细失败：" . mysqli_error($conn);
        }


        if ($moveCartResult) {
            // 清空购物车
            $clearCartQuery = "DELETE FROM cart WHERE username = ?";
            $stmtClearCart = mysqli_prepare($conn, $clearCartQuery);
            mysqli_stmt_bind_param($stmtClearCart, 's', $userName);
            mysqli_stmt_execute($stmtClearCart);

            // 重定向到订单详情页面
            //header("Location: order_details.php?id=$orderId");
            exit();
        }
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
