<?php

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (is_string($username) and is_string($password)) {
        $db = new Db();
        $result = $db->userLogin($username, $password);
        if (is_array($result)) {
            $_SESSION['user_info'] = $result;
            header('location: index.php');
        }
    }
}
?>
