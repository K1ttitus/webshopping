<?php
session_start();
$open_connect = 1;
require('connect.php');

if(!isset($_SESSION['id_account'])|| !isset($_SESSION['role_account'])){
    die(header('Location: login.php'));
}elseif(isset($_GET['logout'])){
    session_destroy();
    die(header('Location: index.html'));
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
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Fresh Market</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Fresh Market</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php" >Home</a></li>
                <li><a href="shop.php" >Shop</a></li>
                <li><a href="cart.php" class="active">Cart</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h2>รถเข็นสินค้า</h2>
        <div id="cart">
            <table>
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รวม</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <!-- รายการสินค้าจะแสดงที่นี่ -->
                </tbody>
            </table>
            <div class="cart-total">
                <h3>ยอดรวมทั้งหมด: <span id="totalPrice">0</span> บาท</h3>
            </div>
            <button id="checkoutButton">ชำระเงิน</button>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>© 2024 Fresh Market</p>
    </footer>

    <script src="cart.js"></script>
</body>
</html>
