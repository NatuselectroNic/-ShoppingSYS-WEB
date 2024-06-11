<?php
require 'link.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单提交的新信息
    $newProductName = $_POST['name'];
    $newProductPrice = $_POST['price'];
    $newProductDescription = $_POST['description'];
    $newProductCategory = $_POST['category'];
    $productId = $_GET['id'];
    // 使用预处理语句来执行更新商品信息的操作
    $updateQuery = "UPDATE products SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sdssi', $newProductName, $newProductPrice, $newProductDescription, $newProductCategory, $productId);
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        echo '<h1>商品信息已成功更新！</h1>';
        echo '<a href="rootshow.php">回到订单修改界面</a>';
    } else {
        echo '<h1>更新商品信息时发生错误：</h1>';
        echo '<p>' . mysqli_error($conn) . '</p>';
        echo '<a href="rootshow.php">回到订单修改界面</a>';
    }
} else {
    // 根据传递的商品ID查询商品信息
    $productId = $_GET['id'];
    $queryProduct = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $queryProduct);
    mysqli_stmt_bind_param($stmt, 'i', $productId);
    mysqli_stmt_execute($stmt);
    $resultProduct = mysqli_stmt_get_result($stmt);

    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $productName = $rowProduct['name'];
        $productPrice = $rowProduct['price'];
        $productDescription = $rowProduct['description'];
        $productCategory = $rowProduct['category_id'];

        // 查询所有商品分类
        $queryCategories = "SELECT * FROM categories";
        $resultCategories = mysqli_query($conn, $queryCategories);

        // 显示商品信息和修改表单
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<title>修改商品信息</title>';
        echo '<a href="rootshow.php">回到订单修改界面</a>';
        echo '<style>';
        echo 'body {';
        echo '    font-family: Arial, sans-serif;';
        echo '    background-color: #f2f2f2;';
        echo '    margin: 0;';
        echo '    padding: 20px;';
        echo '}';
        echo 'h1 {';
        echo '    margin-bottom: 20px;';
        echo '}';
        echo 'form {';
        echo '    background-color: #fff;';
        echo '    padding: 20px;';
        echo '}';
        echo 'label {';
        echo '    display: block;';
        echo '    margin-bottom: 10px;';
        echo '    font-weight: bold;';
        echo '}';
        echo 'input[type="text"], input[type="number"], select, textarea {';
        echo '    width: 100%;';
        echo '    padding: 10px;';
        echo '    margin-bottom: 10px;';
        echo '    border: 1px solid #ccc;';
        echo '    border-radius: 4px;';
        echo '}';
        echo 'input[type="submit"] {';
        echo '    background-color: #4CAF50;';
        echo '    color: #fff;';
        echo '    border: none;';
        echo '    padding: 10px 20px;';
        echo '    cursor: pointer;';
        echo '}';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        echo '<h1>修改商品信息</h1>';
        echo '<form method="POST">';
        echo '<label for="name">商品名称:</label>';
        echo '<input type="text" id="name" name="name" value="' . $productName . '" required><br>';
        echo '<label for="price">价格:</label>';
        echo '<input type="number" id="price" name="price" value="' . $productPrice . '" required><br>';
        echo '<label for="description">描述:</label>';
        echo '<textarea id="description" name="description" required>' . $productDescription . '</textarea><br>';
        echo '<label for="category">商品分类:</label>';
        echo '<select id="category" name="category">';
        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
            $categoryId = $rowCategory['id'];
            $categoryName = $rowCategory['name'];
            $selected = ($categoryId == $productCategory) ? 'selected' : '';
            echo '<option value="' . $categoryId . '" ' . $selected . '>' . $categoryName . '</option>';
        }
        echo '</select><br>';
        echo '<input type="submit" value="更新商品信息">';
        echo '</form>';
        echo '</body>';
        echo '</html>';
    } else {
        echo '<h1>无法找到指定的商品ID：' . $productId . '</h1>';
    }
}
?>
