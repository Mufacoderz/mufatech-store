<?php
session_start(); 
?>
<body>
<header>
    <nav>
        <h1>
            <a href="index.php">
                <span class="tech">Mufatech</span><span class="gear"> Gear</span>
            </a>
        </h1>

        <ul class="nav-list">
            <li><a href="/projek-uas/index.php">Beranda</a></li>
            <li><a href="/projek-uas/pages/product.php">Produk</a></li>
            <li><a href="/projek-uas/pages/ideas.php">Ide Setup</a></li>
            <li><a href="/projek-uas/pages/contact.php">Kontak</a></li>
        </ul>

        <div class="nav-right">
            <div class="hamburger-btn">
                <i class="fa-solid fa-bars open"></i>
                <i class="fa-solid fa-xmark close"></i>
            </div>
            <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>
    </nav>
</header>
