<div class="header">
        <div class="header-left">
            <div class="header-items">
                <?php include('date_string.php') ?>
            </div>
        </div>
        <div class="header-right">
            <?php
            $db = new Db();
            if (isset($_SESSION['user_info'])) {
                $user_name = $_SESSION['user_info'][1];
                echo <<<EOF
                <div class="header-items"> <a href="logout.php" class="header-links">登出</a> </div>
                <div class="header-items left-split"> $user_name </div>
                <div class="header-items"> <img src="img/avatar/default.png" id="avatar"> </div>
                EOF;
            } else {
                echo '<div class="header-items"> <a href="login.php" class="header-links">登录</a> </div>
                <div class="header-items"> <a href="register.php" class="header-links">注册</a> </div>';
            }
            ?>
        </div>
    </div>
