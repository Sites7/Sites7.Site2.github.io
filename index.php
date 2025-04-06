<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <style>
/* Original reset and basic styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', Arial, sans-serif;
}

body {
    line-height: 1.6;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Main content layout with new responsive approach */
#container_cart {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    flex: 1;
    padding: 0 20px;
    gap: 20px;
}
/* Added title styling from second CSS */
.section-title {
    font-size: 3rem;
    font-weight: 700;
    margin: 0 0 20px 0;
}
.section-divider {
    width: 150px;
    height: 3px;
    background-color: #333;
    margin: 30px 0;
    transform-origin: left center;
}
.section-subtitle {
    font-style: italic;
    font-size: 1.25rem;
    margin: 0 0 30px 0;
}
#sidebar {
    width: 280px;
    min-width: 280px;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    height: fit-content;
}
#main-content {
    flex: 1;
}
/* Filter styles */
.filter-group {
    margin-bottom: 15px;
}
.filter-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}
.filter-group input[type="text"],
.filter-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.price-inputs {
    display: flex;
    gap: 10px;
    margin-bottom: 5px;
}
.price-inputs input {
    width: calc(50% - 5px);
    background-color: #ffffff;
    color: #000000;
    border: 2px solid #02a6ec;
    padding: 5px;
    box-sizing: border-box;
}

.price-inputs input::placeholder {
    color: #999;
}

.ui-widget-content {
    border: 1px solid #bdc3c7;
    background: #e1e1e1;
    color: #222222;
    margin-top: 4px;
}

.ui-slider .ui-slider-handle {
    cursor: default;
    width: 2em;
    height: 1.2em;
    background: #d8ec02;
    color: #000000;
    text-align: center;
    margin-left: -1em;
}

#slider {
    margin: 10px 8px 20px 8px;
    width: calc(100% - 16px);
}

#sidebar button {
    background-color: #333;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 5px;
    width: 100%;
    transition: background-color 0.3s;
}

#sidebar button:hover {
    background-color: #555;
}

#sidebar button:last-child {
    background-color: #666;
    margin-top: 10px;
}

/* Products grid - adapted to use repeater approach from second CSS */
#product-list {
    display: grid;
    grid-template-columns: repeat(4, 25%); /* Changed from 3 columns to 4 for smaller cards */
    grid-gap: 15px; /* Reduced gap between cards */
    margin-bottom: 20px;
}

.product-card {
    position: relative;
    background-color: white;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.product-image-container {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
}

.product-slider {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-slide {
    display: none;
    width: 100%;
    text-align: center;
}

.product-slide.active {
    display: block;
}

.product-slide img {
    width: 100px;
    height: auto;
    max-height: 150px;
    object-fit: contain;
    margin: 0 auto;
    display: block;
}

.slider-indicator {
    position: absolute;
    bottom: 10px;
    left: 0;
    width: 200px;
    display: flex;
    justify-content: center;
    gap: 5px;
    z-index: 3;
}

.slider-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-dot.active {
    background-color: #333;
    transform: scale(1.2);
}

.slide-color {
    font-size: 12px;
    margin-top: 5px;
    color: #666;
}

.slider-controls {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    z-index: 2;
}

.slider-prev, .slider-next {
    background: rgba(255, 255, 255, 0.7);
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.product-image-container:hover .slider-prev,
.product-image-container:hover .slider-next {
    opacity: 1;
}

.product-card h3 {
    margin: 15px 0 5px 0; /* Reduced margin from 32px to 15px top and 10px to 5px bottom */
    text-align: center;
    font-size: 1.5rem; /* Reduced font size from 1.875rem to 1.5rem */
    letter-spacing: normal;
    text-transform: none;
}

.product-card p {
    color: #666;
    font-size: 0.85em; /* Reduced font size from 0.9em to 0.85em */
    font-style: italic;
    line-height: 1.8; /* Reduced line height from 2 to 1.8 */
    margin: 20px 0 0; /* Reduced top margin from 30px to 20px */
    text-align: center;
}

.price {
    font-weight: bold;
    color: #333;
    text-align: center;
    margin: 8px 0; /* Reduced margin from 10px to 8px */
}

.availability {
    text-align: center;
    color: green;
    margin-bottom: 8px; /* Reduced margin from 10px to 8px */
}

.availability:not(:empty)::before {
    content: "• ";
}

.favorite-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #ccc;
    transition: color 0.3s;
    z-index: 1;
}

.favorite-btn.active {
    color: red;
}

.cart-button {
    background: none;
    border: none;
    cursor: pointer;
    align-self: center;
    padding: 5px;
    transition: transform 0.3s;
}

.cart-button:hover {
    transform: scale(1.1);
}

.cart-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

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

.size-preview {
    text-align: center;
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

/* Pagination styles */
#pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    margin-bottom: 30px;
}

#pagination button {
    background-color: #333;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 12px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#pagination button:hover {
    background-color: #555;
}

#page-info {
    display: flex;
    align-items: center;
    padding: 0 10px;
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    overflow: auto;
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 5% auto;
    padding: 25px;
    border-radius: 8px;
    width: 80%;
    max-width: 900px;
    display: flex;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modalFadeIn 0.3s;
}

@keyframes modalFadeIn {
    from {opacity: 0; transform: translateY(-30px);}
    to {opacity: 1; transform: translateY(0);}
}

.modal-column {
    flex: 1;
    padding: 0 15px;
}

.modal-column:first-child {
    border-right: 1px solid #eee;
}

#modal-image {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    margin: 15px 0;
    border-radius: 4px;
}

#modal-title {
    font-size: 1.6em;
    margin-bottom: 15px;
    color: #333;
}

#modal-price {
    font-size: 1.4em;
    color: #333;
    margin: 15px 0;
}

.sizes-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
}

.size-option {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.size-option:hover, .size-option.selected {
    background-color: #333;
    color: white;
    border-color: #333;
}

#color-options {
    margin-bottom: 20px;
}

/* .color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin: 0 8px 8px 0;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: transform 0.2s;
    display: inline-block;
} */

.color-option:hover, .color-option.selected {
    transform: scale(1.1);
    box-shadow: 0 0 0 2px #333;
}

#modal-features {
    padding-left: 20px;
    margin-bottom: 20px;
}

#modal-features li {
    margin-bottom: 8px;
    color: #555;
}

.favorite-button {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    opacity: 0.5;
    transition: opacity 0.3s, transform 0.3s;
}

.favorite-button:hover {
    opacity: 1;
    transform: scale(1.1);
}

.favorite-button.active {
    opacity: 1;
}

.button9 {
    display: inline-block;
    padding: 12px 24px;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    text-align: center;
    transition: background-color 0.3s;
    margin-top: 15px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    font-size: 16px;
}

.button9:hover {
    background-color: #555;
}

.button9.in-cart {
    background-color: #4CAF50;
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    cursor: pointer;
    color: #aaa;
    transition: color 0.3s;
}

.close:hover {
    color: #333;
}

/* Стили для хлебных крошек в модальном окне */
.modal-breadcrumbs {
    display: flex;
    justify-content: center;
    margin: 10px 0;
    padding: 5px 0;
    gap: 10px;
}
.modal-breadcrumb-dot {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}
.modal-breadcrumb-dot.active {
    background-color: #4682B4;
    transform: scale(1.2);
}
/* Стили для названия цвета в модальном окне */
.modal-color-name {
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 10px;
    color: #4682B4;
}

/* Responsive styles - adapted from second CSS */
@media (max-width: 1199px) {
    .section-title {
        font-size: 2.5rem;
    }
    {
        
        #container_cart {
            padding: 0 10px;
        }
        
        #product-list {
            grid-template-columns: repeat(3, 33.333%); /* 3 columns on large screens */
        }
 
    
    .product-card h3 {
        font-size: 1.75rem;
    }
    
    .section-subtitle {
        width: auto;
        margin-top: 17px;
        margin-left: 22px;
    }
}

@media (max-width: 991px) {
    #container_cart {
        padding: 0 8px;
    }
    
    #sidebar {
        padding: 15px;
    }
    
    .section-subtitle {
        margin-left: 0;
    }
    #product-list {
        grid-template-columns: repeat(3, 33.333%); /* Still 3 columns on medium screens */
    }

}

@media (max-width: 767px) {
    #container_cart {
        flex-direction: column;
        padding: 10px;
    }
    
    #sidebar {
        width: 100%;
        margin-bottom: 20px;
        min-width: auto;
    }
    
    .section-title {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .section-subtitle {
        padding-top: 0;
    }
    
    #product-list {
        grid-template-columns: repeat(2, 50%); /* 2 columns on tablets */
    }
    
    .product-card {
        padding: 12px; /* Further reduced padding on smaller screens */
    }
    
    .product-card h3 {
        font-size: 1.3rem; /* Smaller font on tablets */
    }
    
    .burger-menu-icon {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 100;
    }
    
    .header-container .logo {
        margin-left: 40px;
    }
    
    .header-container .phone-number,
    .header-container nav,
    .header-container .user-controls {
        display: none;
    }
    
    .modal-content {
        flex-direction: column;
        width: 95%;
        margin: 10% auto;
        padding: 15px;
    }
    
    .modal-column:first-child {
        border-right: none;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    
    .footer-container {
        flex-direction: column;
    }
    
    .footer-section {
        margin-bottom: 25px;
    }
}

@media (max-width: 575px) {
    .section-title {
        font-size: 1.875rem;
    }
    
    .product-card {
        padding: 30px;
    }
}
@media (max-width: 480px) {
    #product-list {
        grid-template-columns: repeat(2, 50%); /* Keep 2 columns on mobile */
    }
    
    .product-card {
        padding: 10px; /* Minimal padding on mobile */
    }
    
    .product-card h3 {
        font-size: 1.1rem; /* Even smaller font on mobile */
        margin-top: 10px;
    }
    
    .product-slide img {
        height: 80px; /* Smaller images on mobile */
    }
}

.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 20px;
    color: #666;
}
</style>
</head>
<body>
<?php include 'header.php'; ?>

<div id="container_cart">
    <div id="sidebar">
        <h2>Фильтры</h2>
        <div class="filter-group">
            <label for="search">Поиск по названию:</label>
            <input type="text" id="search" placeholder="Введите название">
        </div>
        
        <div class="filter-group">
            <label>Цена:</label>
            <div class="price-inputs">
                <input type="number" id="minPrice" placeholder="От">
                <input type="number" id="maxPrice" placeholder="До">
            </div>
            <div id="slider"></div>
        </div>
        
        <div class="filter-group">
            <label for="zadoor-series">Серия:</label>
            <select id="zadoor-series" name="zadoor-series">
                <option value="">-- Все серии --</option>
                <option value="ART Lite">ART Lite</option>
                <option value="Classic Baguette">Classic Baguette</option>
                <option value="Classic S">Classic S</option>
                <option value="Gorizont">Gorizont</option>
                <option value="Kvalitet">Kvalitet</option>
                <option value="SP">SP</option>
                <option value="Zadoor-S">Zadoor-S</option>
                <option value="Art Vision">Art Vision</option>
                <option value="Butterfly">Butterfly</option>
                <option value="Neoclassic">Neoclassic</option>
                <option value="Elegance Line">Elegance Line</option>
            </select>
        </div>
        <button onclick="applyFilters()">Применить фильтры</button>
        <button onclick="resetFilters()">Сбросить фильтры</button>
    </div>
    
    <div id="main-content">
        <div id="product-list"></div>
        <div id="pagination">
            <button onclick="changePage('first')"><<</button>
            <button onclick="changePage('prev')"><</button>
            <span id="page-info"></span>
            <button onclick="changePage('next')">></button>
            <button onclick="changePage('last')">>></button>
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-column">
                <h2 id="modal-title"></h2>
                <div class="modal-color-name"></div>
                <img id="modal-image" src="" alt="Product Image">
                <div class="modal-breadcrumbs"></div>
                <h3 id="modal-price"></h3>
                <h3>Размеры:</h3>
                <div class="sizes-list" id="size-options"></div>
                <h3>Цвета:</h3>
                <div id="color-options" style="display: flex; flex-wrap: wrap;"></div>
            </div>
            <div class="modal-column">
                <h3>Характеристики:</h3> 
                <ul id="modal-features"></ul>
                <button class="favorite-button" id="add-to-favorites" data-id="0" onclick="toggleFavorite(this)">❤️</button>
                <button class="cart-button1" id="add-to-cart" onclick="event.stopPropagation(); toggleCartFromModal();">
                    <svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/>
                    </svg>
                </button>
            </div>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
    </div>

<?php include 'footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script>
// Глобальные переменные для данных и состояния
let rawData = {};
let filteredProducts = [];
const itemsPerPage = 8;
let currentPage = 1;
let minPriceFilter = 0;
let maxPriceFilter = 80000;

document.getElementById('maxPrice').addEventListener('change', function(e) {
    const value = Number(e.target.value) || 0;
    if (value < $("#slider").slider("values", 0)) {
        e.target.value = $("#slider").slider("values", 1);
        return;
    }
    $("#slider").slider("values", 1, value);
    maxPriceFilter = value;
    currentPage = 1;
    filterProducts();
});

$(function() {
    $("#slider").slider({
        range: true,
        min: 0,
        max: 80000,
        values: [0, 80000],
        slide: function(event, ui) {
            $("#minPrice").val(ui.values[0]);
            $("#maxPrice").val(ui.values[1]);
            minPriceFilter = ui.values[0];
            maxPriceFilter = ui.values[1];
        },
        stop: function(event, ui) {
            currentPage = 1;
            filterProducts();
        },
        create: function() {
            $('.ui-slider-handle').attr('aria-valuemin', 0)
                                 .attr('aria-valuemax', 80000)
                                 .attr('role', 'slider');
        }
    });
    
    $("#minPrice").val($("#slider").slider("values", 0));
    $("#maxPrice").val($("#slider").slider("values", 1));
    
    document.getElementById('minPrice').addEventListener('input', function(e) {
        const value = Number(e.target.value) || 0;
        const maxValue = $("#slider").slider("values", 1);
        const validValue = Math.min(value, maxValue);
        
        if (value !== validValue) {
            e.target.value = validValue;
        }
        
        $("#slider").slider("values", 0, validValue);
        minPriceFilter = validValue;
    });

    document.getElementById('maxPrice').addEventListener('input', function(e) {
        const value = Number(e.target.value) || 0;
        const minValue = $("#slider").slider("values", 0);
        const validValue = Math.max(value, minValue);
        
        if (value !== validValue) {
            e.target.value = validValue;
        }
        
        $("#slider").slider("values", 1, validValue);
        maxPriceFilter = validValue;
    });

    let priceTimeout;
    [document.getElementById('minPrice'), document.getElementById('maxPrice')].forEach(input => {
        input.addEventListener('change', function() {
            clearTimeout(priceTimeout);
            priceTimeout = setTimeout(() => {
                currentPage = 1;
                filterProducts();
            }, 500);
        });
    });
});

// Сохраняем выбранные фильтры
function saveFilterSelections() {
    const filterSelections = {
        series: document.getElementById('zadoor-series').value,
        currentPage: currentPage,
        minPrice: minPriceFilter,
        maxPrice: maxPriceFilter
    };
    
    localStorage.setItem('filterSelections', JSON.stringify(filterSelections));
}

// Восстанавливаем выбранные фильтры
async function restoreFilterSelections() {
    const savedSelections = localStorage.getItem('filterSelections');
    if (!savedSelections) return;
    
    try {
        const filterSelections = JSON.parse(savedSelections);
        
        // Восстанавливаем цены
        if (filterSelections.minPrice !== undefined && filterSelections.maxPrice !== undefined) {
            minPriceFilter = parseInt(filterSelections.minPrice);
            maxPriceFilter = parseInt(filterSelections.maxPrice);
            $("#slider").slider("values", [minPriceFilter, maxPriceFilter]);
            $("#minPrice").val(minPriceFilter);
            $("#maxPrice").val(maxPriceFilter);
        }
        
        // Восстанавливаем выбор серии
        const seriesSelect = document.getElementById('zadoor-series');
        if (filterSelections.series && seriesSelect) {
            seriesSelect.value = filterSelections.series;
        }
        
        // Применяем фильтры
        filterProductsWithoutPageReset();
        
        // Восстанавливаем номер страницы
        if (filterSelections.currentPage) {
            currentPage = parseInt(filterSelections.currentPage);
            renderProducts();
            renderPagination();
        }        
    } catch (error) {
        console.error('Ошибка восстановления выбранных фильтров:', error);
    }
}

// Фильтруем продукты без сброса номера страницы
function filterProductsWithoutPageReset() {
    const searchQuery = document.getElementById('search').value.toLowerCase();
    const selectedSeries = document.getElementById('zadoor-series').value;

    if (!rawData.products) {
        console.error('Данные о товарах не загружены');
        return;
    }

    filteredProducts = rawData.products.filter(product => {
        return (
            (product.name.toLowerCase().includes(searchQuery)) &&
            (product.price >= minPriceFilter && product.price <= maxPriceFilter) &&
            (!selectedSeries || product.series === selectedSeries)
        );
    });
    
    renderProducts();
    renderPagination();
}

document.addEventListener('DOMContentLoaded', function() {
    // Check if jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded');
        document.getElementById('product-list').innerHTML = '<div class="no-results">Error: jQuery not loaded</div>';
        return;
    }
    
    // Check if jQuery UI is loaded
    if (typeof $.ui === 'undefined') {
        console.error('jQuery UI is not loaded');
        document.getElementById('product-list').innerHTML = '<div class="no-results">Error: jQuery UI not loaded</div>';
        return;
    }
    
    // Rest of your initialization code
    fetchData()
        .then(() => {
            restoreFilterSelections();
        })
        .catch(error => {
            console.error('Error loading data:', error);
        });
});

async function fetchData() {
    try {        
        console.log("Attempting to fetch data from zador2.json");
        const response = await fetch('zador2.json');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        console.log("Data successfully loaded:", data);
        
        rawData = { products: [] };
        
        // Группируем товары по наименованию
        const groupedProducts = {};
        
        // Обрабатываем структуру данных из zador2.json
        for (const seriesName in data) {
            if (data.hasOwnProperty(seriesName)) {
                const seriesItems = data[seriesName];
                
                if (Array.isArray(seriesItems)) {
                    seriesItems.forEach(item => {
                        const productName = item.name;
                        
                        // Создаем группу если ее нет
                        if (!groupedProducts[productName]) {
                            groupedProducts[productName] = {
                                id: `${seriesName}-${productName}`,
                                name: productName,
                                series: seriesName,
                                category: item.category,
                                description: item.description,
                                price: item.price,
                                variants: []
                            };
                        }
                        
                        // Добавляем вариант в группу
                        groupedProducts[productName].variants.push({
                            model: item.model,
                            image: item.image,
                            color: item.attributes.color,
                            attributes: item.attributes,
                            quantity: item.quantity,
                            price: item.price
                        });
                    });
                }
            }
        }
        
        // Преобразуем сгруппированные товары в массив
        for (const productName in groupedProducts) {
            if (groupedProducts.hasOwnProperty(productName)) {
                const product = groupedProducts[productName];
                // Добавляем вспомогательные поля для совместимости с существующим кодом
                product.inStock = product.variants.some(variant => variant.quantity > 0);
                
                // Получаем все размеры и цвета из всех вариантов
                const sizes = new Set();
                const colors = [];
                
                product.variants.forEach(variant => {
                    if (variant.attributes.size && Array.isArray(variant.attributes.size)) {
                        variant.attributes.size.forEach(size => sizes.add(size));
                    }
                    
                    if (variant.attributes.color) {
                        colors.push(variant.attributes.color);
                    }
                });
                
                product.sizes = Array.from(sizes);
                product.colors = colors;
                
                rawData.products.push(product);
            }
        }
        
        filterProducts();
    } catch (error) {
        console.error('Ошибка загрузки данных:', error);
        document.getElementById('product-list').innerHTML = `
            <div class="no-results">
                Не удалось загрузить данные. Пожалуйста, попробуйте позже.
            </div>
        `;
    }
}

function filterProducts() {
    const searchQuery = document.getElementById('search').value.toLowerCase();
    const selectedSeries = document.getElementById('zadoor-series').value;

    if (!rawData.products) {
        console.error('Данные о товарах не загружены');
        return;
    }

    filteredProducts = rawData.products.filter(product => {
        return (
            (product.name.toLowerCase().includes(searchQuery)) &&
            (product.price >= minPriceFilter && product.price <= maxPriceFilter) &&
            (!selectedSeries || product.series === selectedSeries)
        );
    });

    currentPage = 1;
    renderProducts();
    renderPagination();
    saveFilterSelections();
}

function renderProducts() {
    const productList = document.getElementById('product-list');
    if (!productList) {
        console.error('Элемент product-list не найден');
        return;
    }
    
    productList.innerHTML = '';

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const productsToDisplay = filteredProducts.slice(startIndex, endIndex);

    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const cart = JSON.parse(localStorage.getItem('cart')) || {};

    if (productsToDisplay.length === 0) {
        productList.innerHTML = '<div class="no-results">Нет товаров, соответствующих заданным критериям</div>';
        return;
    }

    productsToDisplay.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        
        const isFavoriteProduct = favorites.some(fav => fav.id === product.id);
        const isInCart = cart[product.id] > 0;
        
        // Создаем слайдер для изображений
        const variants = product.variants;
        const sliderHtml = `
            <div class="product-image-container">
                <div class="product-slider">
                    ${variants.map((variant, index) => `
                        <div class="product-slide ${index === 0 ? 'active' : ''}" data-color="${variant.color}">
                            <img src="${variant.image}" alt="${product.name} - ${variant.color}">
                            <div class="slide-color">${variant.color}</div>
                        </div>
                    `).join('')}
                </div>
                ${variants.length > 1 ? `
                <div class="slider-controls">
                    <button class="slider-prev" onclick="event.stopPropagation(); changeSlide(this, -1)">❮</button>
                    <button class="slider-next" onclick="event.stopPropagation(); changeSlide(this, 1)">❯</button>
                </div>
                <div class="slider-indicator">
                    ${variants.map((_, index) => `
                        <span class="slider-dot ${index === 0 ? 'active' : ''}" 
                              onclick="event.stopPropagation(); setActiveSlide(this, ${index})"></span>
                    `).join('')}
                </div>
                ` : ''}
            </div>
        `;
        
        const sizeElements = product.sizes && product.sizes.length > 0
            ? `<div class="size-preview">${product.sizes.slice(0, 3).join(', ')}${product.sizes.length > 3 ? '...' : ''}</div>`
            : '';
        
        card.innerHTML = `
            <div class="product-card-inner">
                <button class="favorite-btn ${isFavoriteProduct ? 'active' : ''}"
                        onclick="event.stopPropagation(); toggleFavorite(this)" data-id="${product.id}">
                    ♥
                </button>
                
                <button class="cart-button ${isInCart ? 'in-cart' : ''}" 
                        onclick="event.stopPropagation(); toggleCart('${product.id}');"
                        ${!product.inStock ? 'disabled' : ''}>
                    ${isInCart ? 
                        '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#000000" fill-rule="evenodd" d="M9.612 6.084C9.16 6.711 9 7.494 9 8v1h6V8c0-.507-.16-1.289-.611-1.916C13.974 5.508 13.274 5 12 5c-1.274 0-1.974.508-2.388 1.084zM17 9V8c0-.827-.24-2.044-.988-3.084C15.226 3.825 13.926 3 12 3c-1.926 0-3.226.825-4.012 1.916C7.24 5.956 7 7.173 7 8v1H3a1 1 0 0 0 0 2h.095l.91 9.1A1 1 0 0 0 5 21h14a1 1 0 0 0 .995-.9l.91-9.1H21a1 1 0 1 0 0-2h-4zm-8 5a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2z" clip-rule="evenodd"/></svg>' : 
                        '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/></svg>'}
                </button>
                
                ${sliderHtml}
                <h3>${product.name}</h3>
                <p class="product-series">Серия: ${product.series}</p>
                <h3>Цена: ${product.price} руб.</h3>
                ${sizeElements}
            </div>
        `;
        
        const cardInner = card.querySelector('.product-card-inner');
        cardInner.addEventListener('click', function() {
            openModal(product.id);
        });
        
        productList.appendChild(card);
    });
    
    updateCartCount();
    renderPagination();
}

function setActiveSlide(dot, index) {
    const sliderContainer = dot.closest('.product-image-container');
    const slides = sliderContainer.querySelectorAll('.product-slide');
    const dots = sliderContainer.querySelectorAll('.slider-dot');
    
    // Убираем активный класс у всех слайдов и точек
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));
    
    // Добавляем активный класс выбранному слайду и точке
    slides[index].classList.add('active');
    dot.classList.add('active');
}

function changeSlide(button, direction) {
    const sliderContainer = button.closest('.product-image-container');
    const slides = sliderContainer.querySelectorAll('.product-slide');
    const dots = sliderContainer.querySelectorAll('.slider-dot');
    
    // Находим текущий активный слайд
    let currentIndex = 0;
    slides.forEach((slide, index) => {
        if (slide.classList.contains('active')) {
            currentIndex = index;
        }
    });
    
    // Вычисляем новый индекс
    let newIndex = currentIndex + direction;
    if (newIndex < 0) newIndex = slides.length - 1;
    if (newIndex >= slides.length) newIndex = 0;
    
    // Убираем активный класс у всех слайдов и точек
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    // Добавляем активный класс для нового слайда и точки
    slides[newIndex].classList.add('active');
    dots[newIndex].classList.add('active');
}
function updateCartCount() {
    const cartCountElements = document.querySelectorAll('.cart-count');
    if (!cartCountElements.length) return;
    
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    let totalItems = 0;
    
    for (const productId in cart) {
        totalItems += cart[productId];
    }
    
    cartCountElements.forEach(element => {
        element.textContent = totalItems;
        element.style.display = totalItems > 0 ? 'inline-block' : 'none';
    });
}

function toggleFavorite(button) {
    const productId = button.dataset.id;
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const productIndex = favorites.findIndex(prod => prod.id === productId);
    
    if (productIndex === -1) {
        const product = rawData.products.find(p => p.id === productId);
        if (product) {
            favorites.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.variants[0].image,
                inStock: product.inStock,
                category: product.category,
                series: product.series
            });
        }
    } else {
        favorites.splice(productIndex, 1);
    }
    
    localStorage.setItem('favorites', JSON.stringify(favorites));
    
    // Обновляем все кнопки избранного для этого продукта
    const favoriteButtons = document.querySelectorAll(`.favorite-btn[data-id="${productId}"], #add-to-favorites[data-id="${productId}"]`);
    const isFavorite = favorites.some(fav => fav.id === productId);
    
    favoriteButtons.forEach(btn => {
        btn.classList.toggle('active', isFavorite);
    });
}

function toggleCartFromModal() {
    const productId = document.getElementById('add-to-favorites').dataset.id;
    if (productId) {
        toggleCart(productId);
    }
}

function toggleCart(productId) {
    try {
        console.log("Переключение корзины для: ", productId);
        
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        
        if (cart[productId]) {
            delete cart[productId];
        } else {
            cart[productId] = 1;
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Обновляем все кнопки корзины для этого продукта
        const isInCart = cart[productId] > 0;
        const cartIcon = isInCart ? 
            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#000000" fill-rule="evenodd" d="M9.612 6.084C9.16 6.711 9 7.494 9 8v1h6V8c0-.507-.16-1.289-.611-1.916C13.974 5.508 13.274 5 12 5c-1.274 0-1.974.508-2.388 1.084zM17 9V8c0-.827-.24-2.044-.988-3.084C15.226 3.825 13.926 3 12 3c-1.926 0-3.226.825-4.012 1.916C7.24 5.956 7 7.173 7 8v1H3a1 1 0 0 0 0 2h.095l.91 9.1A1 1 0 0 0 5 21h14a1 1 0 0 0 .995-.9l.91-9.1H21a1 1 0 1 0 0-2h-4zm-8 5a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2z" clip-rule="evenodd"/></svg>' : 
            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/></svg>';
            
        // Обновляем кнопки в списке продуктов
        const cardButtons = document.querySelectorAll(`.cart-button[onclick*="${productId}"]`);
        cardButtons.forEach(button => {
            button.classList.toggle('in-cart', isInCart);
            button.innerHTML = cartIcon;
        });
        
        // Обновляем кнопку в модальном окне
        const modalButton = document.getElementById('add-to-cart');
        if (modalButton) {
            modalButton.classList.toggle('in-cart', isInCart);
            modalButton.innerHTML = cartIcon;
        }
        
        updateCartCount();
        console.log("Корзина успешно обновлена");
    } catch (error) {
        console.error("Ошибка переключения корзины:", error);
    }
}

function openModal(productId) {
    if (event) {
        event.stopPropagation();
    }
    
    const product = rawData.products.find(p => p.id === productId);
    if (!product) return;

    const modal = document.getElementById('modal');
    if (!modal) {
        console.error('Модальное окно не найдено');
        return;
    }

    document.getElementById('modal-title').textContent = product.name;
    document.getElementById('modal-price').textContent = `Цена: ${product.price} руб.`;
    
    // Создаем слайдер для модального окна
    const variantImages = product.variants.map((variant, index) => ({
        image: variant.image,
        color: variant.color,
        index: index
    }));
    
    const modalImage = document.getElementById('modal-image');
    modalImage.src = variantImages[0].image;
    modalImage.dataset.currentIndex = 0;
    
    // Добавляем название цвета
    const colorNameElem = document.querySelector('.modal-color-name');
    colorNameElem.textContent = variantImages[0].color;
    
    // Создаем хлебные крошки для модального окна
    const modalBreadcrumbs = document.querySelector('.modal-breadcrumbs');
    modalBreadcrumbs.innerHTML = '';
    
    variantImages.forEach((variant, index) => {
        const dot = document.createElement('span');
        dot.className = 'modal-breadcrumb-dot';
        dot.classList.toggle('active', index === 0);
        dot.dataset.index = index;
        dot.dataset.color = variant.color;
        
        dot.addEventListener('click', function() {
            // Обновляем активную крошку
            modalBreadcrumbs.querySelectorAll('.modal-breadcrumb-dot').forEach(d => d.classList.remove('active'));
            this.classList.add('active');
            
            // Обновляем изображение
            modalImage.src = variantImages[this.dataset.index].image;
            modalImage.dataset.currentIndex = this.dataset.index;
            
            // Обновляем название цвета
            colorNameElem.textContent = variant.color;
            
            // Обновляем выбранный цвет в списке цветов
            const colorOptions = document.querySelectorAll('#color-options .color-option');
            colorOptions.forEach(option => option.classList.remove('active'));
            colorOptions[this.dataset.index].classList.add('active');
            
            // Обновляем характеристики
            updateModalFeatures(product, parseInt(this.dataset.index));
        });
        
        modalBreadcrumbs.appendChild(dot);
    });
    
    // Обновляем слайдер вариантов цвета
    const colorOptions = document.getElementById('color-options');
    colorOptions.innerHTML = '';
    
    variantImages.forEach((variant, index) => {
        const colorBtn = document.createElement('div');
        colorBtn.className = 'color-option';
        colorBtn.classList.toggle('active', index === 0);
        colorBtn.dataset.index = index;
        colorBtn.dataset.image = variant.image;
        colorBtn.title = variant.color;
        colorBtn.textContent = variant.color;
        
        colorBtn.addEventListener('click', function() {
            // Обновляем активный цвет
            document.querySelectorAll('#color-options .color-option').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Обновляем изображение
            modalImage.src = this.dataset.image;
            modalImage.dataset.currentIndex = this.dataset.index;
            
            // Обновляем название цвета
            colorNameElem.textContent = variant.color;
            
            // Обновляем активную крошку
            const dots = modalBreadcrumbs.querySelectorAll('.modal-breadcrumb-dot');
            dots.forEach(dot => dot.classList.remove('active'));
            dots[this.dataset.index].classList.add('active');
            
            // Обновляем характеристики в соответствии с выбранным вариантом
            updateModalFeatures(product, parseInt(this.dataset.index));
        });
        
        colorOptions.appendChild(colorBtn);
    });
    
    // Обновляем размеры
    const sizeOptions = document.getElementById('size-options');
    sizeOptions.innerHTML = '';
    
    if (product.sizes && product.sizes.length > 0) {
        product.sizes.forEach(size => {
            if (size) {
                const sizeButton = document.createElement('button');
                sizeButton.className = 'size-button';
                sizeButton.textContent = size;
                sizeOptions.appendChild(sizeButton);
            }
        });
    } else {
        sizeOptions.innerHTML = '<p>Нет доступных размеров</p>';
    }
    
    // Обновляем характеристики товара для первого варианта
    updateModalFeatures(product, 0);
    
    // Настраиваем кнопку избранного
    const addToFavoritesBtn = document.getElementById('add-to-favorites');
    addToFavoritesBtn.dataset.id = product.id;
    
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const isFavorite = favorites.some(fav => fav.id === product.id);
    addToFavoritesBtn.classList.toggle('active', isFavorite);
    
    // Настраиваем кнопку корзины
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const addToCartButton = document.getElementById('add-to-cart');
    
    if (addToCartButton) {
        addToCartButton.classList.toggle('in-cart', cart[product.id] > 0);
        
        addToCartButton.innerHTML = cart[product.id] > 0 ? 
            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#000000" fill-rule="evenodd" d="M9.612 6.084C9.16 6.711 9 7.494 9 8v1h6V8c0-.507-.16-1.289-.611-1.916C13.974 5.508 13.274 5 12 5c-1.274 0-1.974.508-2.388 1.084zM17 9V8c0-.827-.24-2.044-.988-3.084C15.226 3.825 13.926 3 12 3c-1.926 0-3.226.825-4.012 1.916C7.24 5.956 7 7.173 7 8v1H3a1 1 0 0 0 0 2h.095l.91 9.1A1 1 0 0 0 5 21h14a1 1 0 0 0 .995-.9l.91-9.1H21a1 1 0 1 0 0-2h-4zm-8 5a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2zm4 0a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2z" clip-rule="evenodd"/></svg>' : 
            '<svg width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1m17 0h-1m0 0-1 10H5L4 10m16 0h-4M4 10h4m4 4v2m3-2v2m-6-2v2m-1-6h8m-8 0V8c0-1.333.8-4 4-4s4 2.667 4 4v2"/></svg>';

        addToCartButton.onclick = function(e) {
            e.stopPropagation();
            toggleCartFromModal();
        };
    }
    
    modal.style.display = 'block';
}

// Функция для обновления характеристик в модальном окне
function updateModalFeatures(product, variantIndex) {
    if (!product || !product.variants[variantIndex]) return;
    
    const variant = product.variants[variantIndex];
    const featuresElement = document.getElementById('modal-features');
    featuresElement.innerHTML = '';
    
    // Добавляем базовую информацию
    const baseInfo = [
        { name: 'Серия', value: product.series },
        { name: 'Категория', value: product.category },
        { name: 'Модель', value: variant.model },
        { name: 'Цвет', value: variant.color }
    ];
    
    baseInfo.forEach(info => {
        if (info.value) {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${info.name}:</strong> ${info.value}`;
            featuresElement.appendChild(li);
        }
    });
    
    // Добавляем атрибуты из текущего варианта
    const attributes = variant.attributes;
    for (const key in attributes) {
        if (attributes.hasOwnProperty(key) && key !== 'color' && key !== 'size') {
            const value = attributes[key];
            const li = document.createElement('li');
            
            // Форматируем значение в зависимости от типа
            let formattedValue = value;
            if (Array.isArray(value)) {
                formattedValue = value.join(', ');
            }
            
            // Преобразуем ключ для отображения
            const displayKey = key.charAt(0).toUpperCase() + key.slice(1);
            li.innerHTML = `<strong>${displayKey}:</strong> ${formattedValue}`;
            featuresElement.appendChild(li);
        }
    }
}

function closeModal() {
    const modal = document.getElementById('modal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function renderPagination() {
    const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
    const pageInfo = document.getElementById('page-info');
    
    if (pageInfo) {
        pageInfo.textContent = totalPages > 0 
            ? `Страница ${currentPage} из ${totalPages}` 
            : 'Нет результатов';
    }
}

function changePage(action) {
    const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
    
    switch(action) {
        case 'first':
            currentPage = 1;
            break;
        case 'prev':
            if (currentPage > 1) currentPage--;
            break;
        case 'next':
            if (currentPage < totalPages) currentPage++;
            break;
        case 'last':
            currentPage = totalPages;
            break;
    }
    
    renderProducts();
    saveFilterSelections();
}

function applyFilters() {
    filterProducts();
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('zadoor-series').value = '';
    
    // Сбрасываем цену
    minPriceFilter = 0;
    maxPriceFilter = 80000;
    $("#slider").slider("values", [0, 80000]);
    $("#minPrice").val(0);
    $("#maxPrice").val(80000);
    
    // Сбрасываем страницу
    currentPage = 1;
    
    // Применяем сброшенные фильтры
    filterProducts();
    
    // Сбрасываем сохраненные настройки
    localStorage.removeItem('filterSelections');
}

function setupBurgerMenu() {
    const burgerBtn = document.querySelector('.burger-menu');
    const nav = document.querySelector('nav');
    
    if (burgerBtn && nav) {
        burgerBtn.addEventListener('click', function() {
            nav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
}
</script>
</body>
</html>