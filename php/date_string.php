<?php

$date = date("今天是Y年n月j日，星期");
$weekday_cn = array('日', '一', '二', '三', '四', '五', '六');
$weekday_num = date('w');
echo $date . $weekday_cn[$weekday_num];
