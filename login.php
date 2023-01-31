<?php session_start();
require("php/error_handle.php");
require('php/Db.php');
require("php/login.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>宝淘网 - 登录</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('php/header.php') ?>
    <div class="register-form-wrap">
        <h2 class="register title">登录</h2>
        <form action="" method="POST" class="register form">
            <div class="register form-item">
                <label for="username" class="register label">用户名:</label>
                <input type="text" id="username" name="username" class="register input" autocomplete="new-password">
            </div>
            <div class="register form-item">
                <label for="password" class="register label">密码:</label>
                <input type="password" id="password" name="password" class="register input" autocomplete="new-password">
            </div>
            <div class="register-submit-wrap">
                <input type="submit" value="登录" class="register submit">
            </div>
        </form>
    </div>
    <div class="error_msgs">
        <?php include("php/show_error.php") ?>
    </div>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/login.js"></script>
</body>

</html>
