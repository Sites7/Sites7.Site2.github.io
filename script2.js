// Глобальные переменные для данных и состояния
let rawData = {};
let filteredProducts = [];
const itemsPerPage = 8;
let currentPage = 1;

// Структура категорий, брендов и серий
const doorData = {
    "brands": [
        {
        "name": "ZADOOR",
        "categories": [
            {
            "type": "Межкомнатные двери",
            "series": [
                "ART Lite", "Classic Baguette", "Classic S", "Gorizont", "Kvalitet",
                "SP", "Zadoor-S", "Art Vision", "Butterfly", "Neoclassic", "Elegance Line"
            ]
            },
            {
            "type": "Входные двери",
            "series": [
                "Gorizont ALU", "Horizon", "Modern Pro", "Premium Glass", "Loft Industrial"
            ]
            },
            {
            "type": "Фурнитура",
            "series": [
                "Петли", "Для раздвижных дверей"
            ]
            },
            {
            "type": "Дверные ручки",
            "series": [
                "Ручки (круглая)", "Ручки (квадратная)", "Ручки (Classic)"
            ]
            },
            {
            "type": "Завертки",
            "series": [
                "Завертки (круглая)", "Завертки (квадратная)", "Завертки (Classic)"
            ]
            },
            {
            "type": "Цилиндры",
            "series": [
                "Ключ/ключ", "Ключ/фиксатор"
            ]
            },
            {
            "type": "Накладки",
            "series": [
                "Накладки (круглая)", "Накладки (квадратная)", "Накладки (Classic)"
            ]
            },
            {
            "type": "Замки и защелки",
            "series": [
                "Торцевые шпингалеты", "Стальной язычок", "Бесшумные", "Магнитные"
            ]
            }
        ]
        },
        {
        "name": "VFD",
        "categories": [
            {
            "type": "Межкомнатные двери",
            "series": [
                "Atum", "Urban", "Emalex", "Classic Art", "Winter",
                "Stockholm", "Classic Luxe", "Nordic", "Style Line", "Trend"
            ]
            },
            {
            "type": "Входные двери",
            "series": [
                "Atum Pro", "Bavaria", "Original", "Duplex", "Compact", "Premium Wood"
            ]
            },
            {
            "type": "Фурнитура",
            "series": [
                "Петли", "Для раздвижных дверей"
            ]
            },
            {
            "type": "Дверные ручки",
            "series": [
                "Ручки (круглая)", "Ручки (квадратная)", "Ручки (Classic)"
            ]
            },
            {
            "type": "Завертки",
            "series": [
                "Завертки (круглая)", "Завертки (квадратная)", "Завертки (Classic)"
            ]
            },
            {
            "type": "Цилиндры",
            "series": [
                "Ключ/ключ", "Ключ/фиксатор"
            ]
            },
            {
            "type": "Накладки",
            "series": [
                "Накладки (круглая)", "Накладки (квадратная)", "Накладки (Classic)"
            ]
            },
            {
            "type": "Замки и защелки",
            "series": [
                "Торцевые шпингалеты", "Стальной язычок", "Бесшумные", "Магнитные"
            ]
            }
        ]
        },
        {
        "name": "Luxor",
        "categories": [
            {
            "type": "Межкомнатные двери",
            "series": [
                "Nova", "Stella", "Milano", "Quadro", "Laura", "Neo Classic", "Modern"
            ]
            },
            {
            "type": "Входные двери",
            "series": [
                "Concept", "Grand", "Premier"
            ]
            },
            {
            "type": "Фурнитура",
            "series": [
                "Петли", "Для раздвижных дверей"
            ]
            },
            {
            "type": "Дверные ручки",
            "series": [
                "Ручки (круглая)", "Ручки (квадратная)", "Ручки (Classic)"
            ]
            },
            {
            "type": "Завертки",
            "series": [
                "Завертки (круглая)", "Завертки (квадратная)", "Завертки (Classic)"
            ]
            },
            {
            "type": "Цилиндры",
            "series": [
                "Ключ/ключ", "Ключ/фиксатор"
            ]
            },
            {
            "type": "Накладки",
            "series": [
                "Накладки (круглая)", "Накладки (квадратная)", "Накладки (Classic)"
            ]
            },
            {
            "type": "Замки и защелки",
            "series": [
                "Торцевые шпингалеты", "Стальной язычок", "Бесшумные", "Магнитные"
            ]
            }
        ]
        },
        {
        "name": "AlberoDoors",
        "categories": [
            {
            "type": "Межкомнатные двери",
            "series": [
                "Loft", "Velvet", "Cosmo", "Style", "Glass", "Neo", "Elegance", "Modern Art"
            ]
            },
            {
            "type": "Входные двери",
            "series": [
                "Titanium", "Premium"
            ]
            },
            {
            "type": "Фурнитура",
            "series": [
                "Петли", "Для раздвижных дверей"
            ]
            },
            {
            "type": "Дверные ручки",
            "series": [
                "Ручки (круглая)", "Ручки (квадратная)", "Ручки (Classic)"
            ]
            },
            {
            "type": "Завертки",
            "series": [
                "Завертки (круглая)", "Завертки (квадратная)", "Завертки (Classic)"
            ]
            },
            {
            "type": "Цилиндры",
            "series": [
                "Ключ/ключ", "Ключ/фиксатор"
            ]
            },
            {
            "type": "Накладки",
            "series": [
                "Накладки (круглая)", "Накладки (квадратная)", "Накладки (Classic)"
            ]
            },
            {
            "type": "Замки и защелки",
            "series": [
                "Торцевые шпингалеты", "Стальной язычок", "Бесшумные", "Магнитные"
            ]
            }
        ]
        },
        {
        "name": "Van Mark",
        "categories": [
            {
            "type": "Межкомнатные двери",
            "series": [
                "Loft Stone", "Vector", "Wood Style", "Slim Line",
                "Fusion", "Classic Elite", "Rondo"
            ]
            },
            {
            "type": "Входные двери",
            "series": [
                "Techno", "Porta X", "Urban Plus"
            ]
            },
            {
            "type": "Фурнитура",
            "series": [
                "Петли", "Для раздвижных дверей"
            ]
            },
            {
            "type": "Дверные ручки",
            "series": [
                "Ручки (круглая)", "Ручки (квадратная)", "Ручки (Classic)"
            ]
            },
            {
            "type": "Завертки",
            "series": [
                "Завертки (круглая)", "Завертки (квадратная)", "Завертки (Classic)"
            ]
            },
            {
            "type": "Цилиндры",
            "series": [
                "Ключ/ключ", "Ключ/фиксатор"
            ]
            },
            {
            "type": "Накладки",
            "series": [
                "Накладки (круглая)", "Накладки (квадратная)", "Накладки (Classic)"
            ]
            },
            {
            "type": "Замки и защелки",
            "series": [
                "Торцевые шпингалеты", "Стальной язычок", "Бесшумные", "Магнитные"
            ]
            }
        ]
        }
    ]
    }

// Функция загрузки данных из JSON-файла
async function fetchData(seriesName = 'ART Lite') {
    try {
        // Форматируем имя файла
        const fileName = `${seriesName}.json`;
        
        const response = await fetch(fileName);
        const data = await response.json();
        
        // Преобразование данных в формат, подходящий для работы
        rawData = {
            products: data.map((item, index) => {
                // Парсинг атрибутов из строки
                const attributes = {};
                const attrLines = item._ATTRIBUTES_.split('\n');
                const features = [];
                
                attrLines.forEach(line => {
                    const [category, key, value] = line.split('|');
                    if (key && value) {
                        features.push(`${key}: ${value}`);
                        if (!attributes[key]) {
                            attributes[key] = value;
                        }
                    }
                });
                
                // Извлечение размеров из атрибутов
                let sizes = [];
                if (attributes['Размер']) {
                    sizes = attributes['Размер'].split(', ').map(size => size.trim());
                }
                
                // Извлечение цветов из атрибутов
                let colors = [];
                if (attributes['Цвет']) {
                    // Преобразуем названия цветов в их CSS-представление
                    const colorMap = {
                        'Грей': '#808080',
                        'Оливковый': '#808000',
                        'Темно-серый': '#696969',
                        'Белый': '#FFFFFF',
                        'Черный': '#000000'
                    };
                    
                    const colorName = attributes['Цвет'];
                    colors.push(colorMap[colorName] || colorName);
                }
                
                return {
                    id: index + 1,
                    title: item._NAME_,
                    brand: 'ZADOOR',
                    category: document.getElementById('category').value || 'Межкомнатные двери',
                    series: seriesName,
                    price: item._PRICE_,
                    images: [{ thumbnail: item._IMAGE_ }],
                    features: features,
                    sizes: sizes,
                    colors: colors,
                    description: item._DESCRIPTION_
                };
            })
        };
        
        // После загрузки данных настраиваем фильтры и отображаем товары
        populateFilterOptions();
        filterProducts();
    } catch (error) {
        console.error(`Ошибка загрузки данных для серии ${seriesName}:`, error);
    }
}

// Заполнение выпадающих списков для фильтрации
function populateFilterOptions() {
    // Заполнение списка брендов
    const brandSelect = document.getElementById('brand');
    brandSelect.innerHTML = '<option value="">-- Выберите бренд --</option>';
    
    doorData.brands.forEach(brand => {
        const option = document.createElement('option');
        option.value = brand.name;
        option.textContent = brand.name;
        brandSelect.appendChild(option);
    });
    
    // Добавление обработчиков событий для каскадных списков
    document.getElementById('brand').addEventListener('change', updateCategoryOptions);
    document.getElementById('category').addEventListener('change', updateSeriesOptions);
    document.getElementById('series').addEventListener('change', handleSeriesChange);
    
    // Добавление обработчиков для слайдеров цен
    document.getElementById('price-min').addEventListener('input', updatePriceMinValue);
    document.getElementById('price-max').addEventListener('input', updatePriceMaxValue);
}

// Обработчик изменения серии
function handleSeriesChange() {
    const selectedSeries = document.getElementById('series').value;
    if (selectedSeries) {
        fetchData(selectedSeries);
    }
}

// Обновление списка категорий при выборе бренда
function updateCategoryOptions() {
    const brandSelect = document.getElementById('brand');
    const categorySelect = document.getElementById('category');
    const selectedBrand = brandSelect.value;
    
    // Очистка текущих опций
    categorySelect.innerHTML = '<option value="">-- Выберите категорию --</option>';
    
    // Если бренд не выбран, деактивируем выпадающий список категорий
    if (!selectedBrand) {
        categorySelect.disabled = true;
        document.getElementById('series').disabled = true;
        document.getElementById('series').innerHTML = '<option value="">-- Сначала выберите категорию --</option>';
        return;
    }
    
    // Находим выбранный бренд в данных
    const brand = doorData.brands.find(b => b.name === selectedBrand);
    if (brand) {
        // Активируем выпадающий список категорий и заполняем его
        categorySelect.disabled = false;
        
        brand.categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.type;
            option.textContent = category.type;
            categorySelect.appendChild(option);
        });
    }
    
    // Сбрасываем выпадающий список серий
    document.getElementById('series').disabled = true;
    document.getElementById('series').innerHTML = '<option value="">-- Сначала выберите категорию --</option>';
}

// Обновление списка серий при выборе категории
function updateSeriesOptions() {
    const brandSelect = document.getElementById('brand');
    const categorySelect = document.getElementById('category');
    const seriesSelect = document.getElementById('series');
    const selectedBrand = brandSelect.value;
    const selectedCategory = categorySelect.value;
    
    // Очистка текущих опций
    seriesSelect.innerHTML = '<option value="">-- Выберите серию --</option>';
    
    // Если категория не выбрана, деактивируем выпадающий список серий
    if (!selectedCategory) {
        seriesSelect.disabled = true;
        return;
    }
    
    // Находим выбранный бренд и категорию в данных
    const brand = doorData.brands.find(b => b.name === selectedBrand);
    if (brand) {
        const category = brand.categories.find(c => c.type === selectedCategory);
        if (category) {
            // Активируем выпадающий список серий и заполняем его
            seriesSelect.disabled = false;
            
            category.series.forEach(series => {
                const option = document.createElement('option');
                option.value = series;
                option.textContent = series;
                seriesSelect.appendChild(option);
            });
        }
    }
}

// Обновление отображаемого значения минимальной цены
function updatePriceMinValue() {
    const minValue = document.getElementById('price-min').value;
    document.getElementById('price-min-value').textContent = minValue;
}

// Обновление отображаемого значения максимальной цены
function updatePriceMaxValue() {
    const maxValue = document.getElementById('price-max').value;
    document.getElementById('price-max-value').textContent = maxValue;
}

// Фильтрация товаров по заданным критериям
function filterProducts() {
    const searchQuery = document.getElementById('search').value.toLowerCase();
    const priceMin = parseInt(document.getElementById('price-min').value);
    const priceMax = parseInt(document.getElementById('price-max').value);
    const selectedBrand = document.getElementById('brand').value;
    const selectedCategory = document.getElementById('category').value;
    const selectedSeries = document.getElementById('series').value;

    // Проверяем, что данные загружены
    if (!rawData.products) {
        console.error('Данные о товарах не загружены');
        return;
    }

    // Применяем фильтры
    filteredProducts = rawData.products.filter(product => {
        return (
            (product.title.toLowerCase().includes(searchQuery)) &&
            (product.price >= priceMin && product.price <= priceMax) &&
            (!selectedBrand || product.brand === selectedBrand) &&
            (!selectedCategory || product.category === selectedCategory) &&
            (!selectedSeries || product.series === selectedSeries)
        );
    });

    // Сбрасываем на первую страницу и обновляем отображение
    currentPage = 1;
    renderProducts();
    renderPagination();
}

function groupProductsByBaseName(products) {
    const groupedProducts = {};
    products.forEach(product => {
        const baseName = product.title.split(' ').slice(0, -1).join(' ');
        if (!groupedProducts[baseName]) {
            groupedProducts[baseName] = [];
        }
        groupedProducts[baseName].push(product);
    });
    return groupedProducts;
}

function createProductCard(product, variants) {
    const productCard = document.createElement('div');
    productCard.className = 'product-card';
    
    // Создаем контейнер для изображения
    const imageContainer = document.createElement('div');
    imageContainer.className = 'product-image-container';
    
    // Создаем основное изображение
    const mainImage = document.createElement('img');
    mainImage.className = 'product-image';
    mainImage.src = product.images[0]?.thumbnail || 'placeholder.jpg';
    mainImage.alt = product.title;
    imageContainer.appendChild(mainImage);
    
    // Создаем название цвета
    const colorName = document.createElement('div');
    colorName.className = 'color-name';
    colorName.textContent = product.colors && product.colors.length > 0 ? product.colors[0] : 'Базовый цвет';
    imageContainer.appendChild(colorName);
    
    // Создаем индикатор слайдера
    const sliderIndicator = document.createElement('div');
    sliderIndicator.className = 'slider-indicator';
    
    // Добавляем точки для каждого варианта
    const allVariants = [product, ...variants];
    allVariants.forEach((variant, index) => {
        const dot = document.createElement('div');
        dot.className = 'slider-dot';
        if (index === 0) dot.classList.add('active');
        
        dot.addEventListener('click', () => {
            // Обновляем активную точку
            sliderIndicator.querySelectorAll('.slider-dot').forEach(d => d.classList.remove('active'));
            dot.classList.add('active');
            
            // Обновляем изображение и название цвета
            mainImage.src = variant.images[0]?.thumbnail || 'placeholder.jpg';
            colorName.textContent = variant.colors && variant.colors.length > 0 ? variant.colors[0] : 'Базовый цвет';
        });
        
        sliderIndicator.appendChild(dot);
    });
    
    imageContainer.appendChild(sliderIndicator);
    productCard.appendChild(imageContainer);
    
    // Добавляем информацию о товаре
    const productInfo = document.createElement('div');
    productInfo.className = 'product-info';
    
    const title = document.createElement('h3');
    title.textContent = product.title;
    productInfo.appendChild(title);
    
    const price = document.createElement('div');
    price.className = 'price';
    price.textContent = `${product.price} ₽`;
    productInfo.appendChild(price);
    
    const availability = document.createElement('div');
    availability.className = 'availability';
    availability.textContent = 'В наличии';
    productInfo.appendChild(availability);
    
    const cartButton = document.createElement('button');
    cartButton.className = 'cart-button';
    cartButton.innerHTML = '<img src="cart-icon.png" alt="Добавить в корзину">';
    cartButton.onclick = () => addToCart(product.id);
    productInfo.appendChild(cartButton);
    
    productCard.appendChild(productInfo);
    return productCard;
}

function renderProducts() {
    const productList = document.getElementById('product-list');
    productList.innerHTML = '';
    
    const groupedProducts = groupProductsByBaseName(filteredProducts);
    
    Object.entries(groupedProducts).forEach(([baseName, variants]) => {
        const productCard = createProductCard(variants[0], variants.slice(1));
        productList.appendChild(productCard);
    });
    
    renderPagination();
}

// Отображение пагинации
function renderPagination() {
    const pagination = document.getElementById('pagination');
    const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

    // Обновляем кнопки и информацию о текущей странице
    pagination.innerHTML = `
        <button onclick="changePage('first')" ${currentPage === 1 ? 'disabled' : ''}><<</button>
        <button onclick="changePage('prev')" ${currentPage === 1 ? 'disabled' : ''}><</button>
        <span id="page-info">Страница ${currentPage} из ${totalPages || 1}</span>
        <button onclick="changePage('next')" ${currentPage >= totalPages || totalPages === 0 ? 'disabled' : ''}>></button>
        <button onclick="changePage('last')" ${currentPage >= totalPages || totalPages === 0 ? 'disabled' : ''}>>></button>
    `;
}

// Изменение текущей страницы
function changePage(direction) {
    const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
    if (totalPages === 0) return;

    switch (direction) {
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

    // Обновляем отображение товаров и пагинации
    renderProducts();
    renderPagination();
    
    // Прокручиваем к началу списка товаров
    document.getElementById('product-list').scrollIntoView({ behavior: 'smooth' });
}

// Открытие модального окна с подробной информацией о товаре
function openModal(productId) {
    const product = rawData.products.find(p => p.id === productId);
    if (!product) return;

    // Заполняем информацию в модальном окне
    document.getElementById('modal-title').textContent = product.title;
    document.getElementById('modal-image').src = product.images[0]?.thumbnail || 'placeholder.jpg';
    document.getElementById('modal-price').textContent = `Цена: ${product.price} руб.`;
    
    // Заполняем характеристики товара
    const featuresElement = document.getElementById('modal-features');
    featuresElement.innerHTML = '';
    product.features.forEach(feature => {
        const li = document.createElement('li');
        li.textContent = feature;
        featuresElement.appendChild(li);
    });
    
    // Устанавливаем ID товара для кнопки избранного
    document.getElementById('add-to-favorites').dataset.id = product.id;
    document.getElementById('add-to-favorites').classList.toggle('active', isFavorite(product.id));
    
    // Заполняем доступные размеры
    const sizeOptions = document.getElementById('size-options');
    sizeOptions.innerHTML = '';
    if (product.sizes && product.sizes.length > 0) {
        product.sizes.forEach(size => {
            const sizeButton = document.createElement('button');
            sizeButton.className = 'size-button';
            sizeButton.textContent = size;
            sizeOptions.appendChild(sizeButton);
        });
    } else {
        sizeOptions.innerHTML = '<p>Нет доступных размеров</p>';
    }
    
    // Заполняем доступные цвета
    const colorOptions = document.getElementById('color-options');
    colorOptions.innerHTML = '';
    if (product.colors && product.colors.length > 0) {
        product.colors.forEach(color => {
            const colorBtn = document.createElement('div');
            colorBtn.className = 'color-option';
            colorBtn.style.backgroundColor = color;
            colorBtn.title = color;
            colorOptions.appendChild(colorBtn);
        });
    } else {
        colorOptions.innerHTML = '<p>Нет доступных цветов</p>';
    }
    
    // Отображаем модальное окно
    document.getElementById('modal').style.display = 'block';
}

// Закрытие модального окна
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Добавление/удаление товара из избранного
function toggleFavorite(button) {
    const productId = parseInt(button.dataset.id);
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    if (favorites.includes(productId)) {
        favorites = favorites.filter(id => id !== productId);
    } else {
        favorites.push(productId);
    }

    localStorage.setItem('favorites', JSON.stringify(favorites));
    button.classList.toggle('active', isFavorite(productId));
}

// Проверка, находится ли товар в избранном
function isFavorite(productId) {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    return favorites.includes(productId);
}

// Добавление товара в корзину
function addToCart() {
    const productId = parseInt(document.getElementById('add-to-favorites').dataset.id);
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (!cart.includes(productId)) {
        cart.push(productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Товар добавлен в корзину');
    } else {
        alert('Товар уже в корзине');
    }
}

// Применение фильтров
function applyFilters() {
    filterProducts();
}

// Сброс всех фильтров
function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('price-min').value = 0;
    document.getElementById('price-max').value = 80000;
    updatePriceMinValue();
    updatePriceMaxValue();
    document.getElementById('brand').value = '';
    document.getElementById('category').value = '';
    document.getElementById('category').disabled = true;
    document.getElementById('series').value = '';
    document.getElementById('series').disabled = true;
    filterProducts();
}

// Инициализация при полной загрузке DOM
document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Загружаем данные по умолчанию (ART Lite)
});