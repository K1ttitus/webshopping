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
    <title>Fresh Market - Shop</title>
    <link rel="stylesheet" href="shop.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="Screenshot 2024-11-26 205633.png" alt="Search Icon" class="icon profile-icon" id="profileIcon" style="width: 20px; height: 20px; cursor: pointer;">
            <h1 class="logo-text">Fresh Market</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php" class="active">Shop</a></li>
                <!--<li><a href="contact.html">Contact</li>-->
                <li>Contact</li>
                <li><a href="index.php?logout=1">logout</a></li>
            </ul>
        </nav>
        <div class="icons">
            <input type="text" placeholder="Search">
            <!-- ไอคอนตะกร้าสินค้า -->
            <span class="icon" id="cartIcon">🛒</span>
            <img src="PROFILE.jpg" alt="profile-icon" class="icon" style="width: 20px; height: 20px; cursor: pointer;" id="profileIcon" />
            
            <!-- Popup logout -->
            <div id="logoutPopup" class="popup hidden">
                <div class="popup-content">
                    <p>คุณต้องการออกจากระบบใช่หรือไม่?</p>
                    <button id="confirmLogout">ยืนยัน</button>
                    <button id="cancelLogout">ยกเลิก</button>
                </div>
            </div>
        </div>
        
    </header>

    <!-- Main Content -->
    <main>
        <section id="shop">
            <h2>Fresh Market</h2>
            <div class="products">
                <!-- Product 1 -->
                <div class="product" data-name="ไข่ไก่" data-price="83" data-description="ไข่ไก่คุณภาพดี" data-image="egg.jpg">
                    <img src="egg.jpg" alt="ไข่ไก่">
                    <h3>ไข่ไก่</h3>
                    <p>ราคา: <span class="price">83</span> บาท</p>
                    <div class="quantity">
                        <button class="decrease">-</button>
                        <input type="number" value="1" min="1">
                        <button class="increase">+</button>
                    </div>
                    <button class="add-to-cart">เพิ่มลงในตะกร้า</button>
                </div>
                <!-- Product 2 -->
                <div class="product" data-name="นมวัว" data-price="65" data-description="นมวัวคุณภาพดี" data-image="milk.jpg">
                    <img src="milk.jpg" alt="นมวัว">
                    <h3>นมวัว</h3>
                    <p>ราคา: <span class="price">65</span> บาท</p>
                    <div class="quantity">
                        <button class="decrease">-</button>
                        <input type="number" value="1" min="1">
                        <button class="increase">+</button>
                    </div>
                    <button class="add-to-cart">เพิ่มลงในตะกร้า</button>
                </div>
                <!-- Product 3 -->
                <div class="product" data-name="ผักกาด" data-price="30" data-description="ผักกาดสด" data-image="Veg.jpg">
                    <img src="Veg.jpg" alt="ผักกาด">
                    <h3>ผักกาด</h3>
                    <p>ราคา: <span class="price">30</span> บาท</p>
                    <div class="quantity">
                        <button class="decrease">-</button>
                        <input type="number" value="1" min="1">
                        <button class="increase">+</button>
                    </div>
                    <button class="add-to-cart">เพิ่มลงในตะกร้า</button>
                </div>
                <!-- Product 4 -->
                <div class="product" data-name="แครอท" data-price="17" data-description="แครอทสด" data-image="carot.jpg">
                    <img src="carot.jpg" alt="แครอท">
                    <h3>แครอท</h3>
                    <p>ราคา: <span class="price">17</span> บาท</p>
                    <div class="quantity">
                        <button class="decrease">-</button>
                        <input type="number" value="1" min="1">
                        <button class="increase">+</button>
                    </div>
                    <button class="add-to-cart">เพิ่มลงในตะกร้า</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Toast Notification -->
    <div id="cartToast" class="toast hidden">
        เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว!
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2024 Fresh Market</p>
    </footer>

    <!-- JavaScript -->
    <script>
        // ฟังก์ชันเพิ่ม/ลดจำนวนสินค้า
        document.querySelectorAll('.quantity').forEach(quantityDiv => {
            const decreaseBtn = quantityDiv.querySelector('.decrease');
            const increaseBtn = quantityDiv.querySelector('.increase');
            const inputField = quantityDiv.querySelector('input');

            decreaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(inputField.value);
                if (currentValue > 1) {
                    inputField.value = currentValue - 1;
                } else {
                    alert("จำนวนสินค้าต่ำสุดคือ 1"); // แจ้งเตือนเมื่อถึงจำนวนต่ำสุด
                }
            });

            increaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(inputField.value);
                inputField.value = currentValue + 1;
            });
        });

        // เพิ่มสินค้าลงในตะกร้า
        document.querySelectorAll('.add-to-cart').forEach((button) => {
            button.addEventListener('click', (e) => {
                const productElement = e.target.closest('.product');
                const name = productElement.dataset.name;
                const price = parseFloat(productElement.dataset.price);
                const quantity = parseInt(productElement.querySelector('input').value);

                if (quantity <= 0) {
                    alert("จำนวนสินค้าต้องมากกว่าศูนย์");
                    return;
                }

                // สร้างสินค้าใหม่
                const product = { name, price, quantity, total: price * quantity };

                // อ่านข้อมูลสินค้าใน Local Storage
                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                // ตรวจสอบว่าสินค้าซ้ำหรือไม่
                const existingProductIndex = cart.findIndex((item) => item.name === name);
                if (existingProductIndex > -1) {
                    cart[existingProductIndex].quantity += quantity;
                    cart[existingProductIndex].total = cart[existingProductIndex].quantity * cart[existingProductIndex].price;
                } else {
                    cart.push(product);
                }

                // บันทึกลง Local Storage
                localStorage.setItem('cart', JSON.stringify(cart));

                // แสดง Toast Notification
                const cartToast = document.getElementById('cartToast'); // ค้นหาส่วน Toast Notification
                cartToast.classList.remove('hidden');
                cartToast.textContent = `${name} ถูกเพิ่มลงในตะกร้า`;

                // ซ่อน Toast หลังจาก 3 วินาที
                setTimeout(() => {
                    cartToast.classList.add('hidden');
                }, 3000);
            });
        });

        // เมื่อคลิกที่ไอคอนตะกร้า 🛒
        document.getElementById('cartIcon').addEventListener('click', () => {
            window.location.href = 'cart.php';  // เปลี่ยนเส้นทางไปที่หน้า cart.html
        });



        
    document.addEventListener("DOMContentLoaded", () => {
        const profileIcon = document.getElementById('profileIcon');
        const logoutPopup = document.getElementById('logoutPopup');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        // เปิด/ปิด Popup
        const toggleLogoutPopup = (isVisible) => {
            logoutPopup.classList.toggle('hidden', !isVisible);
        };

        // เมื่อคลิกที่ไอคอนโปรไฟล์
        profileIcon.addEventListener('click', (event) => {
            toggleLogoutPopup(true); // แสดง Popup
            event.stopPropagation(); // หยุดไม่ให้ event bubble ไปยัง document
        });

        // เมื่อคลิก "ยืนยันการ Logout"
        confirmLogout.addEventListener('click', () => {
            // ลบข้อมูลที่เกี่ยวข้องกับการเข้าสู่ระบบ
            localStorage.removeItem('authToken'); // ตัวอย่างลบ token
            localStorage.removeItem('cart'); // ลบตะกร้าสินค้า
            sessionStorage.clear(); // ลบข้อมูลใน sessionStorage

            // เปลี่ยนเส้นทางไปหน้า Login
            window.location.href = 'logout.html';
        });

        // เมื่อคลิก "ยกเลิก"
        cancelLogout.addEventListener('click', () => {
            toggleLogoutPopup(false); // ปิด Popup
        });

        // คลิกนอกพื้นที่ Popup เพื่อปิด
        document.addEventListener('click', (event) => {
            if (!logoutPopup.contains(event.target) && !profileIcon.contains(event.target)) {
                toggleLogoutPopup(false);
            }
        });
    });
</script>


</body>
</html>
