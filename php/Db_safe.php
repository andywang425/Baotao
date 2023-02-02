<?php
class Db
{
    private $conn;
    private $stmt;

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

    public function __destruct()
    {
        // $this->stmt->close();
        $this->conn->close();
    }

    /**
     * 搜索商品
     * @param mixed $name
     * @return array
     */
    public function searchGoodsByName($name)
    {
        $name = str_replace(array('_', '%'), array('\_', '\%'), $name);
        $name = "%" . $name . "%";
        $query = "SELECT * FROM goods WHERE name like ?";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bind_param("s", $name);
        $this->stmt->execute();
        return $this->stmt->get_result()->fetch_all();
    }

    private function searchUserByName($name)
    {
        $query = "SELECT * FROM users where name = ?";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bind_param("s", $name);
        $this->stmt->execute();
        return $this->stmt->get_result()->fetch_all();
    }
    /**
     * 用户注册
     * @param mixed $name
     * @param mixed $password
     * @return mixed 成功：[id, name, password] 失败：void
     */
    public function registerUser($name, $password)
    {
        if (empty($this->searchUserByName($name))) {
            $query = "INSERT INTO users (name, password) VALUES (?, ?)";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bind_param("ss", $name, $password);
            $this->stmt->execute();
            return array($this->conn->insert_id, $name, $password);
        } else {
            trigger_error("已存在名为 $name 的用户", E_USER_WARNING);
            return;
        }
    }
    /**
     * 用户登录
     * @param string $name
     * @param string $password
     * @return mixed 成功：[id, name, password] 失败：void
     */
    public function userLogin($name, $password)
    {
        $query = "SELECT * FROM users WHERE name = ? and password = ?";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bind_param("ss", $name, $password);
        $this->stmt->execute();
        $result = $this->stmt->get_result()->fetch_all();
        if (empty($result)) {
            trigger_error("登录失败，用户名或密码错误", E_USER_WARNING);
            return;
        } else {
            return $result[0];
        }
    }
}
?>
