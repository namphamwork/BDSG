<?php
include '../include/function.php';
session_start();
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$email = $_SESSION['forgotmail'];
if ($password == $repassword) {
    $sql = "update user
        set
        password='$password'
        where email = '$email'";
    connect($sql);
    $_SESSION['resetpass-success'] = 'Mật khẩu đã đặt lại';
    header('Location: ../?page=Log-in');
} else {
    echo 'Mật Khẩu Không trùng';
}
