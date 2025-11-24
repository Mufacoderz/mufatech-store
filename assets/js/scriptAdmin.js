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
