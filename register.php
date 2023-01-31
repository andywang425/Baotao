<?php session_start();
require("php/error_handle.php");
require('php/Db.php');
require("php/reg.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>宝淘网 - 注册</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('php/header.php') ?>
    <div class="register-form-wrap">
        <h2 class="register title">用户注册</h2>
        <form action="" method="POST" class="register form">
            <div class="register form-item">
                <label for="username" class="register label">用户名:</label>
                <input type="text" id="username" name="username" class="register input" autocomplete="new-password">
            </div>
            <div class="register form-item">
                <label for="password" class="register label">密码:</label>
                <input type="password" id="password" name="password" class="register input" autocomplete="new-password">
            </div>
            <div class="register form-item">
                <label for="confirm_password" class="register label">确认密码:</label>
                <input type="password" id="confirm_password" class="register input" autocomplete="new-password">
            </div>
            <div class="register-submit-wrap">
                <input type="submit" value="注册" class="register submit">
            </div>
        </form>
    </div>
    <div class="error_msgs">
        <?php include("php/show_error.php") ?>
    </div>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/register.js"></script>
</body>

</html>
