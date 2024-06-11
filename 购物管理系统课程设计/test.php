<?php
// 假设已经连接到数据库，并且数据库连接句柄为 $conn

// 获取传递的商品ID
$productId = $_GET['id'];

// 根据商品ID查询商品信息
$queryProduct = "SELECT * FROM products WHERE id = $productId";
$resultProduct = mysqli_query($conn, $queryProduct);

if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
    // 获取商品的当前信息
    $rowProduct = mysqli_fetch_assoc($resultProduct);
    $productName = $rowProduct['name'];
    $productPrice = $rowProduct['price'];
    $productDescription = $rowProduct['description'];

    // 处理修改商品信息的逻辑
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 获取表单提交的新信息
        $newProductName = $_POST['name'];
        $newProductPrice = $_POST['price'];
        $newProductDescription = $_POST['description'];

        // 执行更新商品信息的查询语句
        $updateQuery = "UPDATE products SET name = '$newProductName', price = $newProductPrice, description = '$newProductDescription' WHERE id = $productId";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "商品信息已成功更新！";
        } else {
            echo "更新商品信息时发生错误：" . mysqli_error($conn);
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>修改商品信息</title>
    </head>
    <body>
    <h1>修改商品信息</h1>
    <form method="POST">
        <label for="name">商品名称:</label>
        <input type="text" id="name" name="name" value="<?php echo $productName; ?>" required><br><br>

        <label for="price">价格:</label>
        <input type="number" id="price" name="price" value="<?php echo $productPrice; ?>" required><br><br>

        <label for="description">描述:</label>
        <textarea id="description" name="description" required><?php echo $productDescription; ?></textarea><br><br>

        <input type="submit" value="更新商品信息">
    </form>
    </body>
    </html>

    <?php
} else {
    echo "无法找到指定的商品ID：" . $productId;
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单提交的新信息
    $newProductName = $_POST['name'];
    $newProductPrice = $_POST['price'];
    $newProductDescription = $_POST['description'];

    // 执行更新商品信息的查询语句
    $updateQuery = "UPDATE products SET name = '$newProductName', price = $newProductPrice, description = '$newProductDescription' WHERE id = $productId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "商品信息已成功更新！";
    } else {
        echo "更新商品信息时发生错误：" . mysqli_error($conn);
    }
} else {
    // 根据传递的商品ID查询商品信息
    $productId = $_GET['id'];
    $queryProduct = "SELECT * FROM products WHERE id = $productId";
    $resultProduct = mysqli_query($conn, $queryProduct);

    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $productName = $rowProduct['name'];
        $productPrice = $rowProduct['price'];
        $productDescription = $rowProduct['description'];

        // 显示商品信息和修改表单
        echo '<h1>修改商品信息</h1>';
        echo '<form method="POST">';
        echo '<label for="name">商品名称:</label>';
        echo '<input type="text" id="name" name="name" value="' . $productName . '" required><br><br>';
        echo '<label for="price">价格:</label>';
        echo '<input type="number" id="price" name="price" value="' . $productPrice . '" required><br><br>';
        echo '<label for="description">描述:</label>';
        echo '<textarea id="description" name="description" required>' . $productDescription . '</textarea><br><br>';
        echo '<input type="submit" value="更新商品信息">';
        echo '</form>';
    } else {
        echo "无法找到指定的商品ID：" . $productId;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>商品类别</title>
    <style>
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
<table>
    <tr>
        <th>类别</th>
        <th>商品名称</th>
        <th>价格</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php
    // 假设已经连接到数据库，并且数据库连接句柄为 $conn
    require 'link.php';
    // 查询商品类别
    $queryCategories = "SELECT * FROM categories";
    $resultCategories = mysqli_query($conn, $queryCategories);

    if ($resultCategories) {
        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
            $categoryId = $rowCategory['id'];
            $categoryName = $rowCategory['name'];

            // 查询该类别下的商品信息
            $queryProducts = "SELECT * FROM products WHERE category_id = $categoryId";
            $resultProducts = mysqli_query($conn, $queryProducts);

            if ($resultProducts && mysqli_num_rows($resultProducts) > 0) {
                echo '<tr>';
                echo '<td colspan="5">' . $categoryName . '</td>';
                echo '</tr>';

                while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
                    $productId = $rowProduct['id'];
                    $productName = $rowProduct['name'];
                    $productPrice = $rowProduct['price'];
                    $productDescription = $rowProduct['description'];

                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td>' . $productName . '</td>';
                    echo '<td>$' . $productPrice . '</td>';
                    echo '<td>' . $productDescription . '</td>';
                    echo '<td><a href="modify_product.php?id=' . $productId . '">修改</a></td>';
                    echo '</tr>';
                }
            }
        }
    }
    ?>
</table>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>商品类别</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .hidden-row {
            display: none;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>类别</th>
        <th>商品名称</th>
        <th>价格</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php
    // 假设已经连接到数据库，并且数据库连接句柄为 $conn
    require 'link.php';
    // 查询商品类别
    $queryCategories = "SELECT * FROM categories";
    $resultCategories = mysqli_query($conn, $queryCategories);

    if ($resultCategories) {
        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
            $categoryId = $rowCategory['id'];
            $categoryName = $rowCategory['name'];

            // 查询该类别下的商品信息
            $queryProducts = "SELECT * FROM products WHERE category_id = $categoryId";
            $resultProducts = mysqli_query($conn, $queryProducts);

            if ($resultProducts && mysqli_num_rows($resultProducts) > 0) {
                echo '<tr>';
                echo '<td colspan="5">' . $categoryName . '</td>';
                echo '</tr>';

                while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
                    $productId = $rowProduct['id'];
                    $productName = $rowProduct['name'];
                    $productPrice = $rowProduct['price'];
                    $productDescription = $rowProduct['description'];

                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td>' . $productName . '</td>';
                    echo '<td>$' . $productPrice . '</td>';
                    echo '<td>' . $productDescription . '</td>';
                    echo '<td><button onclick="editProduct(' . $productId . ', \'' . $productName . '\', ' . $productPrice . ', \'' . $productDescription . '\')">修改</button></td>';
                    echo '</tr>';

                    // 添加隐藏行，用于编辑商品信息
                    echo '<tr class="hidden-row" id="edit-row-' . $productId . '">';
                    echo '<td colspan="5">';
                    echo '<form onsubmit="return saveProduct(' . $productId . ')">';
                    echo '名称: <input type="text" id="name-' . $productId . '" value="' . $productName . '" required> ';
                    echo '价格: <input type="number" id="price-' . $productId . '" value="' . $productPrice . '" required> ';
                    echo '描述: <input type="text" id="description-' . $productId . '" value="' . $productDescription . '" required> ';
                    echo '<input type="submit" value="保存">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
    ?>
</table>

<script>
    function editProduct(productId, productName, productPrice, productDescription) {
        // 隐藏当前行
        const currentRow = document.getElementById('edit-row-' + productId);
        currentRow.classList.remove('hidden-row');

        // 填充编辑框
        document.getElementById('name-' + productId).value = productName;
        document.getElementById('price-' + productId).value = productPrice;
        document.getElementById('description-' + productId).value = productDescription;

        return false; // 阻止表单默认提交
    }

    function saveProduct(productId) {
        const name = document.getElementById('name-' + productId).value;
        const price = document.getElementById('price-' + productId).value;
        const description = document.getElementById('description-' + productId).value;

        // 执行保存商品信息的操作，可以使用 Ajax 发送到服务器进行保存

        // 隐藏当前行
        const currentRow = document.getElementById('edit-row-' + productId);
        currentRow.classList.add('hidden-row');

        return false; // 阻止表单默认提交
    }
</script>
</body>
</html>


<?php
require 'link.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单提交的新信息
    $newProductName = $_POST['name'];
    $newProductPrice = $_POST['price'];
    $newProductDescription = $_POST['description'];

    // 执行更新商品信息的查询语句
    $updateQuery = "UPDATE products SET name = '$newProductName', price = $newProductPrice, description = '$newProductDescription' WHERE id = $productId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "商品信息已成功更新！";
    } else {
        echo "更新商品信息时发生错误：" . mysqli_error($conn);
    }
} else {
    // 根据传递的商品ID查询商品信息
    $productId = $_GET['id'];
    $queryProduct = "SELECT * FROM products WHERE id = $productId";
    $resultProduct = mysqli_query($conn, $queryProduct);

    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $productName = $rowProduct['name'];
        $productPrice = $rowProduct['price'];
        $productDescription = $rowProduct['description'];

        // 显示商品信息和修改表单
        echo '<h1>修改商品信息</h1>';
        echo '<form method="POST">';
        echo '<label for="name">商品名称:</label>';
        echo '<input type="text" id="name" name="name" value="' . $productName . '" required><br><br>';
        echo '<label for="price">价格:</label>';
        echo '<input type="number" id="price" name="price" value="' . $productPrice . '" required><br><br>';
        echo '<label for="description">描述:</label>';
        echo '<textarea id="description" name="description" required>' . $productDescription . '</textarea><br><br>';
        echo '<input type="submit" value="更新商品信息">';
        echo '</form>';
    } else {
        echo "无法找到指定的商品ID：" . $productId;
    }
}
?>



<?php
require 'link.php';
//require 'rootshow.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单提交的新信息
    $newProductName = $_POST['name'];
    $newProductPrice = $_POST['price'];
    $newProductDescription = $_POST['description'];
    $productId = $_GET['id'];

    //$productId = $_POST['']
    // 执行更新商品信息的查询语句
    $updateQuery = "UPDATE products SET name = '$newProductName', price = $newProductPrice, description = '$newProductDescription' WHERE id = '$productId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "商品信息已成功更新！";
        //echo $productId;
    } else {
        echo "更新商品信息时发生错误：" . mysqli_error($conn);
    }
} else {
    // 根据传递的商品ID查询商品信息
    $productId = $_GET['id'];
    $queryProduct = "SELECT * FROM products WHERE id = $productId";
    $resultProduct = mysqli_query($conn, $queryProduct);

    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $productName = $rowProduct['name'];
        $productPrice = $rowProduct['price'];
        $productDescription = $rowProduct['description'];

        // 显示商品信息和修改表单
        echo '<h1>修改商品信息</h1>';
        echo '<form method="POST">';
        echo '<label for="name">商品名称:</label>';
        echo '<input type="text" id="name" name="name" value="' . $productName . '" required><br><br>';
        echo '<label for="price">价格:</label>';
        echo '<input type="number" id="price" name="price" value="' . $productPrice . '" required><br><br>';
        echo '<label for="description">描述:</label>';
        echo '<textarea id="description" name="description" required>' . $productDescription . '</textarea><br><br>';
        echo '<input type="submit" value="更新商品信息">';
        echo '</form>';
    } else {
        echo "无法找到指定的商品ID：" . $productId;
    }
}
?>



<?php
//// 启动会话
//session_start();
//
//// 检查用户是否已登录，若未登录则重定向到登录页面
//if (!isset($_SESSION['username'])) {
//    header("Location: login.php");
//    exit();
//}
//
//// 获取当前用户的用户名
//$userName = $_SESSION['username'];
////$userName = 'admin';
//// 数据库连接
//require 'link.php';
//
//// 检查当前用户是否已在购物车表中
//$queryCheckCart = "SELECT * FROM cart WHERE username = ?";
//$stmtCheckCart = mysqli_prepare($conn, $queryCheckCart);
//mysqli_stmt_bind_param($stmtCheckCart, 's', $userName);
//mysqli_stmt_execute($stmtCheckCart);
//$resultCheckCart = mysqli_stmt_get_result($stmtCheckCart);
//
//if (!$resultCheckCart || mysqli_num_rows($resultCheckCart) === 0) {
//    // 如果购物车中没有当前用户，则将用户添加到购物车表中
//    $queryAddUserToCart = "INSERT INTO cart (username) VALUES (?)";
//    $stmtAddUserToCart = mysqli_prepare($conn, $queryAddUserToCart);
//    mysqli_stmt_bind_param($stmtAddUserToCart, 's', $userName);
//    mysqli_stmt_execute($stmtAddUserToCart);
//}
//
//
//// 处理移除购物车商品的请求
//if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['remove'])) {
//    $cartId = $_GET['remove'];
//
//    // 删除购物车记录
//    $deleteQuery = "DELETE FROM cart WHERE id = ? AND username = ?";
//    $stmtDelete = mysqli_prepare($conn, $deleteQuery);
//    mysqli_stmt_bind_param($stmtDelete, 'is', $cartId, $userName);
//    $deleteResult = mysqli_stmt_execute($stmtDelete);
//
//    if ($deleteResult) {
//        header("Location: cart.php");
//        exit();
//    }
//}
//
//// 处理提交订单的逻辑
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
//    // 创建订单
//    $createOrderQuery = "INSERT INTO orders (username) VALUES (?)";
//    $stmtCreateOrder = mysqli_prepare($conn, $createOrderQuery);
//    mysqli_stmt_bind_param($stmtCreateOrder, 's', $userName);
//    $createOrderResult = mysqli_stmt_execute($stmtCreateOrder);
//
//    if ($createOrderResult) {
//        // 获取刚创建的订单的ID
//        $orderId = mysqli_insert_id($conn);
//
//        // 将购物车数据移到订单明细表
//        $moveCartQuery = "INSERT INTO order_details (order_id, product_id, product_name, price, quantity) SELECT ?, product_id, product_name, price, quantity FROM cart WHERE username = ?";
//        $stmtMoveCart = mysqli_prepare($conn, $moveCartQuery);
//        mysqli_stmt_bind_param($stmtMoveCart, 'is', $orderId, $userName);
//        $moveCartResult = mysqli_stmt_execute($stmtMoveCart);
//
//        if ($moveCartResult) {
//            // 清空购物车
//            $clearCartQuery = "DELETE FROM cart WHERE username = ?";
//            $stmtClearCart = mysqli_prepare($conn, $clearCartQuery);
//            mysqli_stmt_bind_param($stmtClearCart, 's', $userName);
//            mysqli_stmt_execute($stmtClearCart);
//
//            // 重定向到订单详情页面
//            header("Location: order_details.php?id=$orderId");
//            exit();
//        }
//    }
//}
//?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>购物车</title>-->
<!--    <style>-->
<!--        table {-->
<!--            border-collapse: collapse;-->
<!--        }-->
<!--        table, th, td {-->
<!--            border: 1px solid black;-->
<!--            padding: 5px;-->
<!--        }-->
<!--        .remove-link {-->
<!--            color: red;-->
<!--            text-decoration: underline;-->
<!--            cursor: pointer;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<h1>购物车</h1>-->
<!---->
<!--<div>-->
<!--    当前时间：--><?php //echo date('Y-m-d H:i:s'); ?><!--<br>-->
<!--    当前用户：--><?php //echo $userName; ?>
<!--</div>-->
<!---->
<!--<table>-->
<!--    <tr>-->
<!--        <th>商品名称</th>-->
<!--        <th>价格</th>-->
<!--        <th>数量</th>-->
<!--        <th>操作</th>-->
<!--    </tr>-->
<!--    --><?php
//
//    // 获取购物车数据
//    $queryCart = "SELECT * FROM cart WHERE username = ?";
//    $stmtCart = mysqli_prepare($conn, $queryCart);
//    mysqli_stmt_bind_param($stmtCart, 's', $userName);
//    mysqli_stmt_execute($stmtCart);
//    $resultCart = mysqli_stmt_get_result($stmtCart);
//
//    // 获取购物车总价
//    $totalPrice = 0;
//    if ($resultCart && mysqli_num_rows($resultCart) > 0) {
//        while ($rowCart = mysqli_fetch_assoc($resultCart)) {
//            $cartId = $rowCart['id'];
//            $productName = $rowCart['product_name'];
//            $price = $rowCart['price'];
//            $quantity = $rowCart['quantity'];
//            $subtotal = $price * $quantity;
//            $totalPrice += $subtotal;
//            ?>
<!--            <tr>-->
<!--                <td>--><?php //echo $productName; ?><!--</td>-->
<!--                <td>--><?php //echo $price; ?><!--</td>-->
<!--                <td>--><?php //echo $quantity; ?><!--</td>-->
<!--                <td>-->
<!--                    <a href="?remove=--><?php //echo $cartId; ?><!--" class="remove-link">移除</a>-->
<!--                </td>-->
<!--            </tr>-->
<!--            --><?php
//        }
//    } else {
//        ?>
<!--        <tr>-->
<!--            <td colspan="4">购物车为空</td>-->
<!--        </tr>-->
<!--        --><?php
//    }
//    ?>
<!--</table>-->
<!---->
<!--<p>购物车总价：--><?php //echo $totalPrice; ?><!--</p>-->
<!---->
<!--<form action="--><?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?><!--" method="POST">-->
<!--    <button type="submit" name="checkout">提交订单</button>-->
<!--</form>-->
<!---->
<!--<script>-->
<!--    // 移除购物车商品确认提示-->
<!--    var removeLinks = document.querySelectorAll('.remove-link');-->
<!--    removeLinks.forEach(function(link) {-->
<!--        link.addEventListener('click', function(event) {-->
<!--            var confirmRemove = confirm("确定要移除该商品吗？");-->
<!--            if (!confirmRemove) {-->
<!--                event.preventDefault();-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!--</body>-->
<!--</html>-->
