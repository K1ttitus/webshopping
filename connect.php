<?php

if($open_connect != 1){
    die(header('Location: login.php'));
}
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'market';
$port = NULL ;
$socket = NULL;

$connect = mysqli_connect($hostname, $username, $password, $database);

if(!$connect){
    die("Access Denied : " . mysqli_connect_error($connect));
}else{
    mysqli_set_charset($connect, 'utf8');
    $limit_login_account = 3;
    $time_ban_account = 1;
    $query_reset_ban_account = "UPDATE account SET lock_account = 0,
    login_count_account = 0
    WHERE ban_account <= NOW() AND login_count_account >= '$limit_login_account'";
    $call_back_reset_ban_account = mysqli_query($connect, $query_reset_ban_account);
}
?>