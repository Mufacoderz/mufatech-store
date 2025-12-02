<?php
include 'metaAdmin.php';
?>

<body>

    <?php
    include 'sidebar.php';
    ?>

    <div class="main-content">

        <div class="form-container">
            <h2>Tambah Produk</h2>

            <form action="../../controller/saveProduct.php" method="POST" enctype="multipart/form-data" class="product-form">

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" placeholder="Masukkan nama produk" required>
                </div>

                <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="number" name="price" placeholder="Masukkan harga (tanpa titik)" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="Keyboard">Keyboard</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Monitor">Monitor</option>
                        <option value="Headphone">Headphone</option>
                        <option value="Desk">Desk</option>
                        <option value="Chair">Chair</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn-submit">Tambah Produk</button>
            </form>
        </div>


    </div>

        <script src="/projek-uas/assets/js/scriptAdmin.js"></script>


</body>

</html>


