const sidebar = document.querySelector('.sidebar');
const open = document.querySelector('.open');
const close = document.querySelector('.close');

if (open && close && sidebar) {
    function handlerHamburger() {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
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



//bagian render

function renderProducts(data, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = data.map(item => `
        <div class="admin-product-card">
            <div class="button">
                <button><i class="fa-solid fa-xmark delete"></i></button>
                <button><i class="fa-regular fa-pen-to-square edit"></i></i></button>
            </div>
            <img src="${item.image}" alt="${item.product_name}">
            <div class="admin-product-info">
                <h3>${item.product_name}</h3>
                <p class="price">Rp ${Number(item.price).toLocaleString('id-ID')}</p>
            </div>
        </div>
    `).join("");
}


//bagian load data product dri db

async function loadProductsByCategory(category, containerId) {
    const response = await fetch(`/projek-uas/getProducts.php?category=${category}`);
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
