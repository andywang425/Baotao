<?php
if (empty($_SESSION['user_info'])) {
    echo <<<EOF
    <div class="good">
        <img src="img/goods/default.svg" class="pic">
        <div class="text">
            <h3 class="name"> 未登录 </h3>
            <div class="info"> 请先登录再搜索想要的宝贝！</div>
        </div>
    </div>
    EOF;
} elseif (empty($_GET['search'])) {
    echo <<<EOF
    <div class="good">
        <img src="img/goods/default.svg" class="pic">
        <div class="text">
            <h3 class="name"> 没有找到相关的宝贝 </h3>
            <div class="info"> 请在搜索栏中输入您想要的宝贝。 </div>
        </div>
    </div>
    EOF;
} else {
    $db = new Db();
    $result = $db->searchGoodsByName($_GET['search']);
    if (empty($result)) {
        // VULN：XSS注入
        // payload：<script>alert('xss')</script>
        // 防御：htmlspecialchars()
        echo <<<EOF
        <div class="good">
            <img src="img/goods/default.svg" class="pic">
            <div class="text">
                <h3 class="name"> 没有找到相关的宝贝 </h3>
                <div class="info"> 抱歉，您搜索的商品 {$_GET['search']} 不存在。</div>
            </div>
        </div>
    EOF;
    } else {
        foreach ($result as $good) {
            $id = $good[0];
            $name = $good[1];
            $price = $good[2];
            $description = $good[3];
            echo <<<EOF
            <div class="good">
                <img src="img/goods/$id.jpg" class="pic">
                <div class="text">
                    <a href="#">
                        <h3 class="name"> $name </h3>
                    </a>
                    <div class="info"> $description </div>
                    <div class="price">￥$price</div>
                </div>
            </div>
            EOF;
        }
    }
}
?>
