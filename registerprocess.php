<?php

$open_connect = 1;
require('connect.php');

if(isset($_POST['username_account']) && isset($_POST['email_account']) && isset($_POST['password_account1']) && isset($_POST['password_account2'])){
     $username_account = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['username_account']));
     $email_account = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['email_account']));
     $password_account1 = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password_account1']));
     $password_account2 = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password_account2']));
    
     if(empty($username_account)){
        die(header('Location: register.php')); //คุณไม่ได้กรอกชื่อผู้ใช้
     }elseif(empty($email_account)){
        die(header('Location: register.php')); //คุณไม่ได้กรอกอีเมล
     }elseif(empty($password_account1)){
        die(header('Location: register.php')); //คุณไม่ได้กรอกรหัสผ่าน
     }elseif(empty($password_account2)){
        die(header('Location: register.php')); //คุณไม่ได้กรอกการยืนยันรหัสผ่าน
     }elseif($password_account1 != $password_account2){
        die(header('Location: register.php')); //กรุณายืนยันรหัสผ่านให้ถูกต้อง
     }else{
         $query_check_email_account = "SELECT email_account FROM account WHERE email_account = '$email_account'";
         $call_back_query_check_email_account = mysqli_query($connect, $query_check_email_account);
         if(mysqli_num_rows($call_back_query_check_email_account) > 0){
            die(header('Location: register.php')); //มีผู้ใช้อีเมลนี้แล้ว
         }else{
             $length = random_int(97, 128);
             $salt_account = bin2hex(random_bytes($length)); //สร้างค่าเกลือ
             $password_account1 = $password_account1 . $salt_account; //เอารหัสผ่านต่อกับค่าเกลือ
             $algo = PASSWORD_ARGON2ID;
             $options = [
                'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                'threads' => PASSWORD_ARGON2_DEFAULT_THREADS
             ];
             $password_account =password_hash($password_account1, $algo, $options); //นำรหัสผ่านที่ต่อกับค่าเกลือแล้ว เข้ารหัสด้วยวิธี ARGON2ID
             $query_create_account = "INSERT INTO account VALUES ('', '$username_account', '$email_account', '$password_account', '$salt_account', 'member', 'default_images_account.jpg', '', '', '')";
             $call_back_create_account = mysqli_query($connect, $query_create_account);
             if($call_back_create_account){
                 die(header('Location: login.php')); //สร้างบัญชีสำเร็จ
             }else{
                die(header('Location: register.php')); //สร้างบัญชีล้มเหลว
             }
         }
     }

}else{
    die(header('Location: register.php')); //ไม่มีข้อมูล
}

?>