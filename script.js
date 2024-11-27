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
ddocument.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', (event) => {
        const product = event.target.closest('.product');
        const name = product.querySelector('h3').textContent;
        const price = parseFloat(product.querySelector('.price').textContent);
        const quantity = parseInt(product.querySelector('input').value);

        const productItem = { name, price, quantity, total: price * quantity };

        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existingProductIndex = cart.findIndex(item => item.name === name);
        if (existingProductIndex > -1) {
            // เพิ่มจำนวนสินค้าหากมีสินค้าซ้ำ
            cart[existingProductIndex].quantity += quantity;
            cart[existingProductIndex].total = cart[existingProductIndex].quantity * cart[existingProductIndex].price;
        } else {
            cart.push(productItem);  // เพิ่มสินค้าลงในตะกร้า
        }

        localStorage.setItem('cart', JSON.stringify(cart));  // บันทึกข้อมูล

        const cartToast = document.getElementById('cartToast');
        cartToast.classList.remove('hidden');
        cartToast.textContent = `${name} ถูกเพิ่มลงในตะกร้า`;

        setTimeout(() => {
            cartToast.classList.add('hidden');
        }, 3000);
    });
});

ddocument.addEventListener("DOMContentLoaded", () => {
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
        // ป้องกันไม่ให้เหตุการณ์ bubble ไปที่ document
        event.stopPropagation();
        toggleLogoutPopup(true); // แสดง Popup
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



// ฟังก์ชันแสดงข้อมูลสินค้าใน modal
document.querySelectorAll('.product img').forEach(image => {
    image.addEventListener('click', (event) => {
        const product = event.target.closest('.product');
        const productName = product.dataset.name;
        const productPrice = product.dataset.price;
        const productDescription = product.dataset.description;
        const productImage = product.querySelector('img').src;

        // แสดงข้อมูลใน modal
        document.getElementById('modalProductImage').src = productImage;
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalProductDescription').textContent = productDescription;
        document.getElementById('modalProductPrice').textContent = productPrice;

        // แสดง modal
        document.getElementById('productModal').classList.remove('hidden');
    });
});

// ปิด modal
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('productModal').classList.add('hidden');
});

// เมื่อคลิกที่ไอคอนตะกร้า 
const cartIcon = document.getElementById('cartIcon');
const cartPopup = document.getElementById('cartPopup');
const closeCartButton = document.getElementById('closeCartButton');
const cartItemsContainer = document.getElementById('cartItems');
const cartTotalElement = document.getElementById('cartTotal');

// ฟังก์ชันแสดงป๊อปอัพตะกร้า
cartIcon.addEventListener('click', () => {
    cartPopup.classList.toggle('hidden');  // เปิด/ปิด ป๊อปอัพ
    displayCartItems();  // แสดงรายการสินค้าที่เพิ่มในตะกร้า
});

// ปิดป๊อปอัพเมื่อคลิกที่ปุ่มปิด
closeCartButton.addEventListener('click', () => {
    cartPopup.classList.add('hidden');
});

// ฟังก์ชันแสดงรายการสินค้าที่เพิ่มในตะกร้า
function displayCartItems() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartItemsContainer.innerHTML = ''; // ล้างรายการเดิม

    let total = 0;  // คำนวณราคารวมของสินค้าทั้งหมด

    // แสดงรายการสินค้าในตะกร้า
    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.name} x ${item.quantity} - ฿${item.total}`;
        cartItemsContainer.appendChild(li);
        total += item.total;
    });

    // แสดงราคาทั้งหมดในตะกร้า
    cartTotalElement.textContent = `รวม: ฿${total}`;
}

// ฟังก์ชันเพิ่มสินค้าลงในตะกร้า
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', (event) => {
        const product = event.target.closest('.product');
        const name = product.querySelector('h3').textContent;
        const price = parseFloat(product.querySelector('.price').textContent);
        const quantity = parseInt(product.querySelector('input').value);

        // สร้างสินค้าใหม่
        const productItem = { name, price, quantity, total: price * quantity };

        // อ่านข้อมูลสินค้าใน LocalStorage
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // ตรวจสอบว่าสินค้าซ้ำหรือไม่
        const existingProductIndex = cart.findIndex(item => item.name === name);
        if (existingProductIndex > -1) {
            cart[existingProductIndex].quantity += quantity;
            cart[existingProductIndex].total = cart[existingProductIndex].quantity * cart[existingProductIndex].price;
        } else {
            cart.push(productItem);
        }

        // บันทึกข้อมูลลง LocalStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // แสดงข้อความแจ้งเตือน
        const cartToast = document.getElementById('cartToast');
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
    window.location.href = 'cart.html';  // เปลี่ยนเส้นทางไปที่หน้า cart.html
});

document.getElementById('profileIcon').addEventListener('click', () => {
    window.location.href = 'logout.html';  // เปลี่ยนเส้นทางไปที่หน้า logout.html
});