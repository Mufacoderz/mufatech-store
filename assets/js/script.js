// NAVBAR (Global)
const nav = document.querySelector('.nav-list');
const open = document.querySelector('.open');
const close = document.querySelector('.close');

if (open && close && nav) {
    function handlerHamburger() {
        nav.classList.toggle('active');
        if (nav.classList.contains('active')) {
            open.style.display = 'none';
            close.style.display = 'block';
        } else {
            open.style.display = 'block';
            close.style.display = 'none';
        }
    }

    open.addEventListener('click', handlerHamburger);
    close.addEventListener('click', handlerHamburger);
}


// FOOTER (Global)
const yearSpan = document.querySelector('#year');
if (yearSpan) {
    yearSpan.textContent = new Date().getFullYear();
}



if (document.querySelector('.categories')) {

        AOS.init();


    const category = document.querySelector('.categories');
    const openCategory = document.querySelector('.openCategory');
    const closeCategory = document.querySelector('.closeCategory');
    const categoryItems = document.querySelectorAll('.list-category');

    function handlerCategory() {
        category.classList.toggle('active');
        if (category.classList.contains('active')) {
            openCategory.style.display = 'none';
            closeCategory.style.display = 'block';
        } else {
            openCategory.style.display = 'block';
            closeCategory.style.display = 'none';
        }
    }

    categoryItems.forEach(item => {
        item.addEventListener('click', () => {
            category.classList.remove('active');
            openCategory.style.display = 'block';
            closeCategory.style.display = 'none';
        });
    });

    openCategory.addEventListener('click', handlerCategory);
    closeCategory.addEventListener('click', handlerCategory);
}



// render produk

function renderProducts(data, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = data.map(item => `
        <div class="product-card" data-aos="fade-up" data-aos-offset="300">
            <img src="${item.image}" alt="${item.product_name}" width="150">
            <h3>${item.product_name}</h3>
            <p>Rp ${Number(item.price).toLocaleString('id-ID')}</p>
            <div>
                <button class="cart-btn">
                    Add to cart <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div>
        </div>
    `).join("");
}


//bagian load data product dri api / db

async function loadProductsByCategory(category, containerId) {
    const response = await fetch(`/projek-uas/controller/getProducts.php?category=${category}`);
    const data = await response.json();
    renderProducts(data, containerId);
}


loadProductsByCategory("Keyboard", "keyboard-list");
loadProductsByCategory("Mouse", "mouse-list");
loadProductsByCategory("Monitor", "monitor-list");
loadProductsByCategory("Headphone", "headphone-list");
loadProductsByCategory("Desk", "desk-list");
loadProductsByCategory("Chair", "chair-list");
loadProductsByCategory("other", "accessories-list");
