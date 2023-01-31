<?php session_start();
require("php/error_handle.php");
require('php/Db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>宝淘网 - 商品</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('php/header.php') ?>
    <div class="result search-container">
        <img src="img/logo.svg" alt="logo" id="logo" class="result">
        <form action="" method="get" class="result form">
            <input type="text" id="search-input" class="result" name="search" value="<?php if (isset($_GET['search']))
                echo $_GET['search']; ?>">
            <button type="submit" id="search-button" class="result">搜索</button>
        </form>
    </div>
    <div class="content">
        <?php include("php/show_goods.php") ?>
    </div>
    <div class="error_msgs">
        <?php include("php/show_error.php") ?>
    </div>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/goods.js"></script>
</body>

</html>
