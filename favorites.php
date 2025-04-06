<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное</title>
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
            max-width: 1200px;
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

        /* Main container */
        .favorites-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 120px;
            padding: 10px;
        }
        
        .product-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
        .product-info {
            padding: 10px;
        }
        
        .product-info h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 500;
        }
        
        .product-series {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        
        .product-price {
            margin: 5px 0;
            font-size: 14px;
            font-weight: 500;
        }
        
        .product-actions {
            padding: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .cart-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s;
        }
        
        .cart-button:hover {
            transform: scale(1.1);
        }
        
        .cart-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .remove-favorite {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s;
        }
        
        .remove-favorite:hover {
            transform: scale(1.1);
        }
        
        #favorites-empty {
            text-align: center;
            padding: 40px;
            display: none;
        }
        
        .continue-shopping {
            display: inline-block;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background 0.2s;
        }
        
        .continue-shopping:hover {
            background: #333;
        }

        /* Favorites table styles */
        .favorites-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .favorites-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .favorites-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .favorites-table tr:last-child td {
            border-bottom: none;
        }

        .favorite-item-image img {
            width: 150px;
            height: 400px;
            object-fit: contain;
            border-radius: 4px;
        }

        .favorite-item-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .favorite-item-price {
            color: #666;
            margin-bottom: 5px;
        }

        .favorite-item-stock {
            margin-bottom: 5px;
        }

        .favorite-item-stock.in-stock {
            color: #28a745;
        }

        .favorite-item-stock.out-of-stock {
            color: #dc3545;
        }

        .favorite-item-category {
            color: #666;
            margin-top: 5px;
        }

        .favorite-item-series {
            color: #666;
            margin-top: 5px;
        }

        .favorite-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
        }

        .action-btn svg {
            width: 80px;
            height: 80px;
        }

        .remove-btn {
            color: #ff5722;
        }

        .remove-btn:hover {
            background-color: rgba(255, 87, 34, 0.1);
        }

        .cart-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
        }

        .cart-button svg {
            width: 80px;
            height: 80px;
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



        .cart-button.in-cart svg {
            fill: white;
        }

        @media (max-width: 768px) {
            .burger-menu-icon {
                display: block;
            }
            
            nav {
                display: none;
            }

            .favorites-table {
                display: block;
                overflow-x: auto;
            }

            .favorite-actions {
                flex-direction: column;
            }

            .action-btn {
                width: 50px;
                height: 50px;
            }

            .action-btn svg {
                width: 50px;
                height: 50px;
            }

            .cart-button {
                width: 50px;
                height: 50px;
            }

            .cart-button svg {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.html">Каталог</a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="favorites.html" class="active">Избранное</a></li>
                    <li><a href="cart.html">Корзина <span class="cart-count" id="header-cart-count"></span></a></li>
                </ul>
            </nav>
            <div class="burger-menu-icon">☰</div>
        </div>
    </header> -->
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

    <div class="favorites-container">
        <h1>Избранное</h1>
        
        <div id="favorites-empty" class="favorites-empty" style="display: none;">
            <p>В избранном пока нет товаров</p>
            <a href="index.php" class="continue-shopping">Перейти в каталог</a>
        </div>
        
        <table class="favorites-table">
            <tbody id="favoritesTableBody">
                <!-- Избранные товары будут добавлены сюда -->
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; ?>
    <script>
    function loadFavorites() {
        const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const tableBody = document.getElementById('favoritesTableBody');
        const emptyMessage = document.getElementById('favorites-empty');
        
        if (favorites.length === 0) {
            tableBody.innerHTML = '';
            emptyMessage.style.display = 'block';
            return;
        }
        
        tableBody.innerHTML = '';
        emptyMessage.style.display = 'none';
        
        favorites.forEach(product => {
            const row = document.createElement('tr');
            const isInCart = cart[product.id] > 0;
            
            row.innerHTML = `
                <td class="product-image">
                    <img src="${product.image}" alt="${product.displayTitle || product.name}">
                </td>
                <td class="product-info">
                    <h3>${product.displayTitle || product.name}</h3>
                    <p class="product-series">Серия: ${product.series}</p>
                    <p class="product-price">Цена: ${product.price} руб.</p>
                </td>
                <td class="product-actions">
                    <button class="cart-button ${isInCart ? 'in-cart' : ''}" 
                            onclick="toggleCart('${product.id}')"
                            ${!product.inStock ? 'disabled' : ''}>
                        ${isInCart ? 
                            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#000000" fill-rule="evenodd" d="M9.612 6.084C9.16 6.711 9 7.494 9 8v1h6V8c0-.507-.16-1.289-.611-1.916C13.974 5.508 13.274 5 12 5c-1.274 0-1.974.508-2.388 1.084zM17 9V8c0-.827-.24-2.044-.988-3.084C15.226 3.825 13.926 3 12 3c-1.926 0-3.226.825-4.012 1.916C7.24 5.956 7 7.173 7 8v1H3a1 1 0 0 0 0 2h.095l.91 9.1A1 1 0 0 0 5 21h14a1 1 0 0 0 .995-.9l.91-9.1H21a1 1 0 1 0 0-2h-4zm-8 5a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2z" clip-rule="evenodd"/></svg>' : 
                            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/></svg>'}
                    </button>
                    <button class="remove-favorite" onclick="removeFavorite('${product.id}')">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </td>
            `;
            
            tableBody.appendChild(row);
        });
        
        updateCartCount();
    }

    function removeFavorite(productId) {
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        
        // Удаляем товар из избранного
        favorites = favorites.filter(item => item.id !== productId);
        
        // Сохраняем обновленное избранное
        localStorage.setItem('favorites', JSON.stringify(favorites));
        
        // Обновляем отображение страницы
        loadFavorites();
        
        // Показываем уведомление
        showNotification('Товар удален из избранного');
        
        // Обновляем счетчик корзины в шапке
        updateCartCount();
    }

    function toggleCart(productId) {
        // Get current cart state
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let allProducts = JSON.parse(localStorage.getItem('allProducts')) || {};
        
        // Get product from favorites
        const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        const product = favorites.find(p => p.id === productId);
        
        if (!product) {
            console.error("Продукт не найден:", productId);
            return;
        }
        
        // Toggle cart state
        if (cart[productId]) {
            delete cart[productId];
            delete allProducts[productId];
            showNotification('Товар удален из корзины');
        } else {
            cart[productId] = 1;
            // Сохраняем информацию о продукте с выбранными параметрами
            allProducts[productId] = {
                id: product.id,
                title: product.name,
                price: product.price,
                images: [product.image],
                series: product.series,
                selectedColor: product.selectedColor,
                selectedSize: product.selectedSize,
                displayTitle: product.displayTitle || `${product.name} (${product.selectedColor}, ${product.selectedSize})`
            };
            showNotification('Товар добавлен в корзину');
        }
        
        // Save the updated cart and products
        localStorage.setItem('cart', JSON.stringify(cart));
        localStorage.setItem('allProducts', JSON.stringify(allProducts));
        
        // Обновляем состояние кнопки корзины
        const cartButton = document.querySelector(`.cart-button[onclick*="${productId}"]`);
        if (cartButton) {
            const isInCart = cart[productId] > 0;
            cartButton.classList.toggle('in-cart', isInCart);
            cartButton.innerHTML = isInCart ? 
                '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#000000" fill-rule="evenodd" d="M9.612 6.084C9.16 6.711 9 7.494 9 8v1h6V8c0-.507-.16-1.289-.611-1.916C13.974 5.508 13.274 5 12 5c-1.274 0-1.974.508-2.388 1.084zM17 9V8c0-.827-.24-2.044-.988-3.084C15.226 3.825 13.926 3 12 3c-1.926 0-3.226.825-4.012 1.916C7.24 5.956 7 7.173 7 8v1H3a1 1 0 0 0 0 2h.095l.91 9.1A1 1 0 0 0 5 21h14a1 1 0 0 0 .995-.9l.91-9.1H21a1 1 0 1 0 0-2h-4zm-8 5a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2z" clip-rule="evenodd"/></svg>' : 
                '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/></svg>';
        }
        
        // Refresh the favorites display
        loadFavorites();
        
        // Обновляем счетчик корзины в шапке
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
    
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.padding = '12px 20px';
        notification.style.backgroundColor = '#28a745';
        notification.style.color = 'white';
        notification.style.borderRadius = '4px';
        notification.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
        notification.style.zIndex = '1000';
        notification.style.transition = 'opacity 0.3s';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
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

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        loadFavorites();
        setupBurgerMenu();
        updateCartCount();
    });
    </script>
</body>
</html>