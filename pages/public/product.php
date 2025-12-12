<?php include '../../includes/meta.php'; ?>
<?php include '../../includes/header.php'; ?>
<?php include '../../config/koneksi.php'; ?>




    <main id="product" class="container-product">
        <section class="hero-section">
            <div class="banner"></div>

            <div class="search">
                <input type="search" placeholder="Cari barang...">
            
                <div class="categories">
                    <a href="#keyboard-list" class="list-category">Keyboard</a>
                    <a href="#mouse-list" class="list-category">Mouse</a>
                    <a href="#monitor-list" class="list-category">Monitor</a>
                    <a href="#headphone-list" class="list-category">Headphone</a>
                    <a href="#desk-list" class="list-category">Meja</a>
                    <a href="#chair-list" class="list-category">Kursi</a>
                    <a href="#accessories-list" class="list-category">Lainnya</a>
                </div>
                <div class="icon-category">
                    <i class="fa-solid fa-chevron-down openCategory"></i>
                    <i class="fa-solid fa-chevron-up closeCategory"></i>
                </div>
            </div>
            
        </section>

        
        <?php include '../../controllers/getProducts.php'; ?>
        
    </main>
    
    <?php include '../../includes/footer.php'; ?>
