DROP database IF EXISTS vuln;

CREATE database vuln;

USE vuln;

CREATE TABLE
    `goods` (
        `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(16) NOT NULL,
        `price` float NOT NULL,
        `description` varchar(256) NOT NULL
    ) ENGINE = MyISAM DEFAULT CHARSET = utf8;

CREATE TABLE
    `users` (
        `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(16) NOT NULL,
        `password` varchar(16) NOT NULL
    ) ENGINE = MyISAM DEFAULT CHARSET = gbk;

INSERT INTO
    `users` (`name`, `password`)
VALUES ('admin', 'admin123'), ('andy', 'andy456'), ('hacker', 'hacker666');

INSERT INTO
    `goods` (`name`, `price`, `description`)
VALUES (
        '乐事薯片',
        25.8,
        'Lay\'s/乐事薯片超值组合包（原味+红烩味+大波浪鸡翅），70克x3包。'
    ), (
        '卡乐比薯片',
        29.9,
        '卡乐比（Calbee）海太蜂蜜黄油味薯片60g*2，韩国进口零食，休闲膨化食品。'
    ), (
        '可口可乐',
        58.9,
        '可口可乐 Coca-Cola 汽水，碳酸饮料整箱装，摩登罐，330ml×24罐。'
    ), (
        '百事可乐',
        26.9,
        '百事可乐 Pepsi 太汽系列，白桃乌龙口味，瓶装500ml*12瓶，百事出品。'
    ), (
        'ಥ_ಥ',
        398.0,
        'Wow, a secret good！'
    );
