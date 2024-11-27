<?php
session_start();
$open_connect = 1;
require('connect.php');

if(!isset($_SESSION['id_account'])|| $_SESSION['role_account'] != 'admin'){
    die(header('Location: login.php'));
}elseif(isset($_GET['logout'])){
    session_destroy();
    die(header('Location: login.php'));
}else{
    $id_account = $_SESSION['id_account'];
    $query_show = "SELECT * FROM account WHERE id_account = '$id_account'";
    $call_back_show = mysqli_query($connect, $query_show);
    $result_show = mysqli_fetch_assoc($call_back_show);
    $directory = 'images/';
    $image_name = $directory.$result_show['imgages_account'];
    $clear_cache = '?' . filemtime($image_name);
    $image_account = $image_name.$clear_cache;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <img src="<?php echo $image_account; ?>">
    <h1>สวัสดี <?php echo $result_show['username_account'];?> พวกชั้นสูงในฐานะ <?php echo $result_show['role_account'];?> </h1>
    <a href="index.php?logout=1">logout</a>
    </center>
</body>
</html>