<?php
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (is_string($username) and is_string($password)) {
        $db = new Db();
        $result = $db->registerUser($username, $password);
        if (is_array($result) and $result[0] !== 0) {
            $_SESSION['user_info'] = $result;
            header('location: index.php');
        }
    }
}
?>
