<?php session_start([
    'cookie_lifetime' => 2678400 // 30天
]);
require("php/error_handle.php");
require('php/Db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>宝淘网</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('php/header.php') ?>
    <div class="index search-container">
        <img src="img/logo.svg" alt="logo" id="logo">
        <form action="goods.php" method="get">
            <input type="text" autofocus="true" placeholder="输入商品名..." id="search-input" name="search">
            <button type="submit" id="search-button">搜索</button>
        </form>
    </div>
    <div class="error_msgs">
        <?php include("php/show_error.php") ?>
    </div>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>
