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



function renderProducts(data, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = data.map(item => `
        <div class="product-card">
            <img src="${item.image}" alt="${item.name}" width="150">
            <h3>${item.name}</h3>
            <p>Rp ${item.price.toLocaleString('id-ID')}</p>
            <div>
                <button class="cart-btn">
                    Add to cart <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div>
        </div>
    `).join("");
}


if (typeof keyboards !== "undefined") {
    renderProducts(keyboards, "keyboard-list");
    renderProducts(mouses, "mouse-list");
    renderProducts(monitors, "monitor-list");
    renderProducts(desks, "desk-list");
    renderProducts(headphones, "headphone-list");
    renderProducts(chairs, "chair-list");
    renderProducts(accessories, "accessories-list");
}
