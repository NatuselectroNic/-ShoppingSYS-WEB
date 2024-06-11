<!DOCTYPE html>
<html>
<head>
    <title>商品列表</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        div {
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }
    </style>
</head>
<body>
<?php
session_start();
//require 'login.php';
require 'link.php';

// 检查用户是否登录，根据需要使用 cookie 或 session 进行验证
$userName = ""; // 用户名
$loggedIn = false; // 用户是否登录的标志
$userName = $_SESSION['username'];
//$userName = $_COOKIE['username'];
// 如果用户已登录，从 cookie 或 session 中获取用户名
if ($loggedIn) {
    //$userName = $_COOKIE['username']; // 假设用户名保存在 cookie 中
    // 或者使用 $_SESSION['username']，根据具体实现方式来获取用户名
}

// 获取当前系统时间
$currentDateTime = date('Y-m-d H:i:s');

// 处理搜索功能
$searchKeyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
$searchCategory = isset($_POST['category']) ? $_POST['category'] : '';
$minPrice = isset($_POST['min_price']) ? $_POST['min_price'] : '';
$maxPrice = isset($_POST['max_price']) ? $_POST['max_price'] : '';
$orderBy = isset($_POST['order_by']) ? $_POST['order_by'] : '';
$sortOrder = isset($_POST['sort_order']) ? $_POST['sort_order'] : '';

// 查询类别选项
$categoryQuery = "SELECT id, name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);
$categoryOptions = array();
if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
    while ($row = mysqli_fetch_assoc($categoryResult)) {
        $categoryOptions[$row['id']] = $row['name'];
    }
}

// 构建查询语句
$query = "SELECT p.id, p.name, p.description, p.price, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id";

if (!empty($searchKeyword) || !empty($searchCategory) || !empty($minPrice) || !empty($maxPrice)) {
    $query .= " WHERE";

    if (!empty($searchKeyword)) {
        $query .= " (p.name LIKE '%$searchKeyword%' OR p.description LIKE '%$searchKeyword%')";
        if (!empty($searchCategory) || !empty($minPrice) || !empty($maxPrice)) {
            $query .= " AND";
        }
    }

    if (!empty($searchCategory)) {
        $query .= " p.category_id = $searchCategory";
        if (!empty($minPrice) || !empty($maxPrice)) {
            $query .= " AND";
        }
    }

    if (!empty($minPrice) && !empty($maxPrice)) {
        $query .= " p.price BETWEEN $minPrice AND $maxPrice";
    } elseif (!empty($minPrice)) {
        $query .= " p.price >= $minPrice";
    } elseif (!empty($maxPrice)) {
        $query .= " p.price <= $maxPrice";
    }
}

if (!empty($orderBy)) {
    $query .= " ORDER BY $orderBy $sortOrder";
}

// 执行查询
$result = mysqli_query($conn, $query);
?>

<h1>商品列表</h1>
<p><a href="admin.php">回到个人中心</a></p>
<div>当前系统时间：<?php echo $currentDateTime; ?></div>
<div>当前用户：<?php echo $userName; ?></div>

<form method="POST" action="">
    <label for="keyword">关键字：</label>
    <input type="text" id="keyword" name="keyword" value="<?php echo $searchKeyword; ?>">

    <label for="category">类别：</label>
    <select id="category" name="category">
        <option value="">全部</option>
        <?php
        foreach ($categoryOptions as $categoryId => $categoryName) {
            ?>
            <option value="<?php echo $categoryId; ?>" <?php echo ($searchCategory == $categoryId) ? "selected" : ""; ?>><?php echo $categoryName; ?></option>
            <?php
        }
        ?>
    </select>

    <label for="min_price">最低价格：</label>
    <input type="number" id="min_price" name="min_price" min="0" step="0.01" value="<?php echo $minPrice; ?>">

    <label for="max_price">最高价格：</label>
    <input type="number" id="max_price" name="max_price" min="0" step="0.01" value="<?php echo $maxPrice; ?>">

    <label for="order_by">排序方式：</label>
    <select id="order_by" name="order_by">
        <option value="">请选择</option>
        <option value="p.price" <?php echo ($orderBy == "p.price") ? "selected" : ""; ?>>价格</option>
        <option value="p.name" <?php echo ($orderBy == "p.name") ? "selected" : ""; ?>>名称</option>
    </select>

    <label for="sort_order">排序顺序：</label>
    <select id="sort_order" name="sort_order">
        <option value="ASC" <?php echo ($sortOrder == "ASC") ? "selected" : ""; ?>>升序</option>
        <option value="DESC" <?php echo ($sortOrder == "DESC") ? "selected" : ""; ?>>降序</option>
    </select>

    <input type="submit" value="搜索">
</form>

<table>
    <tr>
        <th>商品名称</th>
        <th>描述</th>
        <th>价格</th>
        <th>类别</th>
        <th>操作</th>
    </tr>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['id'];
            $productName = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $category = $row['category'];
            ?>
            <tr>
                <td><?php echo $productName; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $category; ?></td>
                <td><a href="shopcar.php?id=<?php echo $productId; ?>">加入购物车</a></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">没有找到匹配的商品</td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
