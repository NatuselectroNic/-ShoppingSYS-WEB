<!DOCTYPE html>
<html>
<head>
    <title>商品类别</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        .category {
            font-weight: bold;
        }

        .modify-link {
            color: #333;
            text-decoration: none;
        }

        .modify-link:hover {
            color: #555;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<a href="root.php">回到管理员首页</a>
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
                echo '<tr class="category">';
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
                    echo '<td><a class="modify-link" href="modify_product.php?id=' . $productId . '">修改</a></td>';
                    echo '</tr>';
                }
            }
        }
    }
    ?>
</table>
</body>
</html>
