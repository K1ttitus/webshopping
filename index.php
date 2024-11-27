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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="member.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <i class="fa-solid fa-store"></i>
            <h1>FRESH MARKET</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li>Contact</li>       
            <li><a href="index.php?logout=1">logout</a></li>
        </ul>
        <div class="icons">
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </header>

    <main>
        <section id="home" class="content">
            <div class="content-text">
                <h1>Fresh Market</h1>
                <p>Welcome to Fresh Market,<br>where every corner whispers tales of freshness and flavor.</p>
                <a href="shop.php"><button class="shop-now-btn">SHOP NOW</button></a>
            </div>
            <div class="market-image">
                <img src="market.png" alt="Market Illustration">
            </div>
        </section>

        <section class="features-section">
            <div class="features-container">
                <div class="center-image">
                    <img src="supermarket.png" alt="Supermarket">
                </div>
                <div class="feature-box top-center">
                    <h3>Delicious Taste</h3>
                    <p>สัมผัสความสดใหม่และความหลงใหลในศิลปะแห่งอาหาร...</p>
                </div>
                <div class="feature-box middle-left">
                    <h3>Variety of Choices</h3>
                    <p>เรามีวัตถุดิบสดใหม่หลากหลายชนิดเพื่อตอบสนองทุกความต้องการ...</p>
                </div>
                <div class="feature-box middle-right">
                    <h3>Always Fresh</h3>
                    <p>วัตถุดิบที่คัดสรรมาอย่างพิถีพิถันเพื่อความสดใหม่ที่สุด...</p>
                </div>
                <div class="feature-box bottom-center">
                    <h3>Same Day Delivery</h3>
                    <p>บริการจัดส่งที่เชื่อถือได้และรวดเร็วถึงหน้าประตูบ้านคุณ...</p>
                </div>
            </div>
        </section>
        <div class="shipping">
            <div class="icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <div class="Pick up Option">Pick up</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-car"></i>
                <div class="Same Day Delivery">Delivery</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user-shield"></i>
                <div class="Health & Safety Rules">Health</div>
            </div>
        </div>
    </main>
</body>
</html>