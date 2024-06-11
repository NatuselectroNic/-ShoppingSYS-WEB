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

// 处理将商品添加到购物车的请求
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $quantity = 1; // 可以根据需要设置商品数量

    // 检查购物车中是否已存在相同的商品
    $queryCheckCartItem = "SELECT * FROM cart WHERE product_id = ? AND username = ?";
    $stmtCheckCartItem = mysqli_prepare($conn, $queryCheckCartItem);
    mysqli_stmt_bind_param($stmtCheckCartItem, 'is', $productId, $userName);
    mysqli_stmt_execute($stmtCheckCartItem);
    $resultCheckCartItem = mysqli_stmt_get_result($stmtCheckCartItem);

    if ($resultCheckCartItem && mysqli_num_rows($resultCheckCartItem) > 0) {
        // 更新购物车中已存在的商品数量
        $updateQuery = "UPDATE cart SET quantity = quantity + ? WHERE product_id = ? AND username = ?";
        $stmtUpdate = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmtUpdate, 'iis', $quantity, $productId, $userName);
        $updateResult = mysqli_stmt_execute($stmtUpdate);

        if ($updateResult) {
            // 商品数量更新成功
            header("Location: shopcar.php");
            exit();
        }
    } else {
        // 添加新的购物车商品
        $addQuery = "INSERT INTO cart (username, product_id, quantity) VALUES (?, ?, ?)";
        $stmtAdd = mysqli_prepare($conn, $addQuery);
        mysqli_stmt_bind_param($stmtAdd, 'sii', $userName, $productId, $quantity);
        $addResult = mysqli_stmt_execute($stmtAdd);

        if ($addResult) {
            // 商品成功添加到购物车
            header("Location: shopcar.php");
            exit();
        }
    }
}

// 处理移除购物车商品的请求
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['remove'])) {
    $cartId = $_GET['remove'];

    // 删除购物车记录
    $deleteQuery = "DELETE FROM cart WHERE id = ? AND username = ?";
    $stmtDelete = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmtDelete, 'is', $cartId, $userName);
    $deleteResult = mysqli_stmt_execute($stmtDelete);

    if ($deleteResult) {
        header("Location: shopcar.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>购物车</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #333;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        .remove-link {
            color: red;
            text-decoration: none;
        }

        .remove-link:hover {
            text-decoration: underline;
        }

        .total-price {
            font-weight: bold;
        }

        .checkout-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }

        .empty-cart {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>

</head>
<body>
<h1>购物车</h1>

<div>
    当前时间：<?php echo date('Y-m-d H:i:s'); ?><br>
    当前用户：<?php echo $userName; ?>
</div>

<table>
    <tr>
        <th>商品名称</th>
        <th>价格</th>
        <th>数量</th>
        <th>操作</th>
    </tr>
    <?php
    // 获取购物车数据
    $queryCart = "SELECT * FROM cart WHERE username = ?";
    $stmtCart = mysqli_prepare($conn, $queryCart);
    mysqli_stmt_bind_param($stmtCart, 's', $userName);
    mysqli_stmt_execute($stmtCart);
    $resultCart = mysqli_stmt_get_result($stmtCart);

    // 获取购物车总价
    $totalPrice = 0;
    if ($resultCart && mysqli_num_rows($resultCart) > 0) {
        while ($rowCart = mysqli_fetch_assoc($resultCart)) {
            $cartId = $rowCart['id'];
            $productId = $rowCart['product_id'];
            $quantity = $rowCart['quantity'];

            // 获取商品信息
            $queryProduct = "SELECT * FROM products WHERE id = ?";
            $stmtProduct = mysqli_prepare($conn, $queryProduct);
            mysqli_stmt_bind_param($stmtProduct, 'i', $productId);
            mysqli_stmt_execute($stmtProduct);
            $resultProduct = mysqli_stmt_get_result($stmtProduct);

            if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
                $rowProduct = mysqli_fetch_assoc($resultProduct);
                $productName = $rowProduct['name'];
                $price = $rowProduct['price'];
                $subtotal = $price * $quantity;
                $totalPrice += $subtotal;
                ?>
                <tr>
                    <td><?php echo $productName; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>
                        <a href="?remove=<?php echo $cartId; ?>" class="remove-link">移除</a>
                    </td>
                </tr>
                <?php
            }
        }
    } else {
        ?>
        <tr>
            <td colspan="4">购物车为空</td>
        </tr>
        <?php
    }
    ?>
</table>

<?php if ($totalPrice > 0) { ?>
    <p class="total-price">购物车总价：<?php echo $totalPrice; ?></p>
    <form action="checkout.php" method="POST">
        <button type="submit" name="checkout" class="checkout-btn">提交订单</button>
        <p><a href="usersearch.php">回到商城</a></p>
        <p><a href="admin.php">回到个人中心</a></p>
    </form>
<?php } else { ?>
    <p class="empty-cart">购物车为空，无法提交订单。</p>
    <p><a href="usersearch.php">回到商城</a></p>
    <p><a href="admin.php">回到个人中心</a></p>
<?php } ?>

<script>
    // 移除购物车商品确认提示
    var removeLinks = document.querySelectorAll('.remove-link');
    removeLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            var confirmRemove = confirm("确定要移除该商品吗？");
            if (!confirmRemove) {
                event.preventDefault();
            }
        });
    });
</script>
</body>
</html>
