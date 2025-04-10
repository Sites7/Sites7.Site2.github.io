<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', Arial, sans-serif;
        }

        body {
            line-height: 1.6;
            background-color: #f4f4f4;
        }

        /* Header Styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav li {
            margin-left: 1.5rem;
        }
        
        nav a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        nav a:hover {
            color: #ffcc00;
        }
        
        nav a.active {
            color: #ffcc00;
            font-weight: bold;
        }

        .burger-menu-icon {
            display: none;
            cursor: pointer;
            font-size: 24px;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: -300px;
            width: 280px;
            height: 100%;
            background-color: #333;
            z-index: 1000;
            padding: 20px;
            box-shadow: 4px 0 10px rgba(0,0,0,0.2);
            transition: left 0.3s ease-in-out;
        }

        .mobile-nav.active {
            left: 0;
        }

        .mobile-nav-close {
            color: #fff;
            font-size: 24px;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }

        .mobile-nav ul {
            list-style: none;
            margin-top: 40px;
        }

        .mobile-nav li {
            margin: 15px 0;
        }

        .mobile-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        /* Cart styles */
        .cart-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .cart-empty {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-empty p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .continue-shopping {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .continue-shopping:hover {
            background-color: #0056b3;
        }

        .cart-content {
            display: flex;
            gap: 20px;
        }

        .cart-items {
            flex: 2;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-summary {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-image {
            width: 150px;
            height: 400px;
            object-fit: contain;
            border-radius: 4px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: #666;
            margin-bottom: 10px;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            cursor: pointer;
            border-radius: 4px;
        }

        .quantity-value {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .remove-btn {
            padding: 6px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .cart-item-subtotal {
            font-weight: bold;
            margin-top: 10px;
        }

        .cart-total {
            margin-bottom: 20px;
        }

        .checkout-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #218838;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .form-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-buttons button[type="submit"] {
            background-color: #28a745;
            color: white;
        }

        .form-buttons button[type="button"] {
            background-color: #6c757d;
            color: white;
        }

        .order-summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        /* Cart count styles */
        .cart-count {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            text-align: center;
            line-height: 20px;
            margin-left: 5px;
        }

        @media (max-width: 768px) {
            .cart-content {
                flex-direction: column;
            }
            
            .burger-menu-icon {
                display: block;
            }
            
            nav {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="mobile-nav">
        <div class="mobile-nav-close">✕</div>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="favorites.php">Избранное</a></li>
            <li><a href="cart.php">Корзина <span class="cart-count" id="mobile-cart-count"></span></a></li>
        </ul>
    </div>

    <div class="mobile-nav-overlay"></div>

    <div class="cart-container">
        <h1>Корзина</h1>
        
        <div id="cart-empty" class="cart-empty">
            <p>Ваша корзина пуста</p>
            <a href="index.php" class="continue-shopping">Продолжить покупки</a>
        </div>
        
        <div id="cart-content" class="cart-content">
            <div class="cart-items" id="cart-items">
                <!-- Cart items will be rendered here -->
            </div>
            
            <div class="cart-summary">
                <h2>Ваш заказ</h2>
                <div class="cart-total">
                    <p>Товаров в корзине: <span id="items-count">0</span></p>
                    <p>Итого: <span id="cart-total-price">0</span> руб.</p>
                </div>
                <button class="checkout-button" id="checkout-button">Оформить заказ</button>
                <a href="index.php" class="continue-shopping">Продолжить покупки</a>
            </div>
        </div>
    </div>
    
    <!-- Order Form Modal -->
    <div id="checkout-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCheckoutModal()">&times;</span>
            <h2>Оформление заказа</h2>
            <form id="order-form">
                <div class="form-group">
                    <label for="fullname">ФИО:</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Адрес доставки:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="comments">Комментарий к заказу:</label>
                    <textarea id="comments" name="comments"></textarea>
                </div>
                <div class="order-summary">
                    <h3>Ваш заказ на сумму: <span id="modal-cart-total">0</span> руб.</h3>
                </div>
                <div class="form-buttons">
                    <button type="button" onclick="closeCheckoutModal()">Отмена</button>
                    <button type="submit">Подтвердить заказ</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            renderCart();
            setupEventListeners();
            updateCartCount();
            setupBurgerMenu();
        });

        function renderCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};
            const allProducts = JSON.parse(localStorage.getItem('allProducts')) || {};
            const cartItemsContainer = document.getElementById('cart-items');
            const cartEmptyElement = document.getElementById('cart-empty');
            const cartContentElement = document.getElementById('cart-content');
            
            // Debug information
            console.log("Cart items:", cart);
            console.log("Available products:", allProducts);
            
            // Check if cart is empty
            if (Object.keys(cart).length === 0) {
                cartEmptyElement.style.display = 'block';
                cartContentElement.style.display = 'none';
                return;
            }
            
            // Clear cart items container
            cartItemsContainer.innerHTML = '';
            
            // Variables for cart summary
            let totalItems = 0;
            let totalPrice = 0;
            let validItemsFound = false;
            
            // Generate cart items
            Object.keys(cart).forEach(productId => {
                const quantity = cart[productId];
                const product = allProducts[productId];
                
                console.log(`Processing product ${productId}:`, product);
                
                if (!product) {
                    console.warn(`Product with ID ${productId} not found in allProducts`);
                    return;
                }
                
                if (quantity <= 0) {
                    console.warn(`Product ${productId} has invalid quantity: ${quantity}`);
                    return;
                }
                
                validItemsFound = true;
                const subtotal = product.price * quantity;
                totalItems += quantity;
                totalPrice += subtotal;
                
                // Safely access the image URL
                let imageUrl = 'placeholder.jpg';
                if (product.images && product.images.length > 0) {
                    if (typeof product.images[0] === 'string') {
                        imageUrl = product.images[0];
                    } else if (product.images[0] && product.images[0].thumbnail) {
                        imageUrl = product.images[0].thumbnail;
                    } else if (product.images[0] && product.images[0].url) {
                        imageUrl = product.images[0].url;
                    }
                }
                
                const cartItemElement = document.createElement('div');
                cartItemElement.className = 'cart-item';
                cartItemElement.innerHTML = `
                    <img class="cart-item-image" src="${imageUrl}" alt="${product.title}">
                    <div class="cart-item-details">
                        <h3 class="cart-item-title">${product.title}</h3>
                        <p class="cart-item-price">Цена: ${product.price} руб.</p>
                        <div class="cart-item-controls">
                            <div class="quantity-control">
                                <button class="quantity-btn minus-btn" data-id="${productId}">-</button>
                                <input type="number" class="quantity-value" value="${quantity}" min="1" data-id="${productId}">
                                <button class="quantity-btn plus-btn" data-id="${productId}">+</button>
                            </div>
                            <button class="remove-btn" data-id="${productId}">Удалить</button>
                        </div>
                        <p class="cart-item-subtotal">Сумма: ${subtotal} руб.</p>
                    </div>
                `;
                
                cartItemsContainer.appendChild(cartItemElement);
            });
            
            // Check if any valid items were found and update UI accordingly
            if (validItemsFound) {
                cartEmptyElement.style.display = 'none';
                cartContentElement.style.display = 'flex';
            } else {
                cartEmptyElement.style.display = 'block';
                cartContentElement.style.display = 'none';
                console.error('No valid items found in cart. Check product data structure.');
            }
            
            // Update summary information
            document.getElementById('items-count').textContent = totalItems;
            document.getElementById('cart-total-price').textContent = totalPrice;
            if (document.getElementById('modal-cart-total')) {
                document.getElementById('modal-cart-total').textContent = totalPrice;
            }
            
            // Add event listeners to cart item controls
            addCartItemControlListeners();
        }

        function addCartItemControlListeners() {
            // Minus buttons
            document.querySelectorAll('.minus-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    updateCartItemQuantity(productId, -1);
                });
            });
            
            // Plus buttons
            document.querySelectorAll('.plus-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    updateCartItemQuantity(productId, 1);
                });
            });
            
            // Quantity input
            document.querySelectorAll('.quantity-value').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.dataset.id;
                    const newValue = parseInt(this.value) || 1;
                    
                    if (newValue < 1) {
                        this.value = 1;
                        updateCartItemQuantity(productId, 0, 1);
                    } else {
                        updateCartItemQuantity(productId, 0, newValue);
                    }
                });
            });
            
            // Remove buttons
            document.querySelectorAll('.remove-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    removeCartItem(productId);
                });
            });
        }

        function updateCartItemQuantity(productId, change, absoluteValue = null) {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            
            if (absoluteValue !== null) {
                cart[productId] = absoluteValue;
            } else {
                cart[productId] = (cart[productId] || 0) + change;
                if (cart[productId] < 1) cart[productId] = 1;
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCount();
        }

        function removeCartItem(productId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            delete cart[productId];
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCount();
        }

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};
            let totalItems = 0;
            
            for (const productId in cart) {
                totalItems += cart[productId];
            }
            
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
                element.textContent = totalItems;
                element.style.display = totalItems > 0 ? 'inline-block' : 'none';
            });
        }

        function setupEventListeners() {
            // Checkout button
            const checkoutButton = document.getElementById('checkout-button');
            if (checkoutButton) {
                checkoutButton.addEventListener('click', openCheckoutModal);
            }
            
            // Order form submission
            const orderForm = document.getElementById('order-form');
            if (orderForm) {
                orderForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    submitOrder();
                });
            }
        }

        function openCheckoutModal() {
            const modal = document.getElementById('checkout-modal');
            if (modal) {
                modal.style.display = 'block';
            }
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkout-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function submitOrder() {
            // Get form data
            const form = document.getElementById('order-form');
            const formData = new FormData(form);
            const orderData = {
                customer: {
                    name: formData.get('fullname'),
                    phone: formData.get('phone'),
                    email: formData.get('email'),
                    address: formData.get('address')
                },
                cart: JSON.parse(localStorage.getItem('cart')) || {},
                totalPrice: document.getElementById('modal-cart-total').textContent
            };
            
            // Here you would typically send this data to your server
            console.log('Order submitted:', orderData);
            
            // Show success message
            const modalContent = document.querySelector('.modal-content');
            const successMessage = document.createElement('div');
            successMessage.className = 'order-success';
            successMessage.innerHTML = `
                <h3>Заказ успешно оформлен!</h3>
                <p>Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время.</p>
                <button id="close-success-btn">Закрыть</button>
            `;
            
            modalContent.innerHTML = '';
            modalContent.appendChild(successMessage);
            
            // Add event listener to close button
            document.getElementById('close-success-btn').addEventListener('click', function() {
                closeCheckoutModal();
                // Clear cart after successful order
                localStorage.setItem('cart', JSON.stringify({}));
                renderCart();
                updateCartCount();
            });
        }

        function setupBurgerMenu() {
            const burgerIcon = document.querySelector('.burger-menu-icon');
            const mobileNav = document.querySelector('.mobile-nav');
            const closeBtn = document.querySelector('.mobile-nav-close');
            const overlay = document.querySelector('.mobile-nav-overlay');
            
            // Toggle menu when burger icon is clicked
            burgerIcon.addEventListener('click', () => {
                mobileNav.classList.add('active');
                overlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
            
            // Close menu when X is clicked
            closeBtn.addEventListener('click', () => {
                mobileNav.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            });
            
            // Close menu when clicking outside
            overlay.addEventListener('click', () => {
                mobileNav.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            });
        }
    </script>
</body>
</html>