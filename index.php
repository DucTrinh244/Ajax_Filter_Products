<?php require_once("database.php") ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax nâng cao </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <p>
        <h2 align="center"> Sử dụng Ajax để lọc dữ liệu trong php </h2>
        </p>
        <div class="row">
            <div class="col-md-3">
                <h3>Khoảng Giá</h3>
                <div class="list-group">
                    <input type="hidden_minimum_price" value="0">
                    <input type="hidden_maximum_price" value="1000000000">
                    <p id="price_show"> từ 500 Nghìn - 100 Triệu</p>
                    <div id="price_range"></div>
                </div>

                <h3>Thương hiệu</h3>
                <?php
                $brand = DB::getBrandFromProduct();
                foreach ($brand as  $brand_item => $value) {
                ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <input type="checkbox" class="common_selector brand"
                                value="<?php echo  $value['product_brand']; ?>">
                            <?php echo  $value['product_brand']; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
                <h3>RAM</h3>
                <?php
                $ram = DB::getRamFromProduct();
                foreach ($ram as  $ram_item => $value) {
                ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <input type="checkbox" class="common_selector ram"
                                value="<?php echo  $value['product_ram']; ?>">
                            <?php echo  $value['product_ram']; ?> GB
                        </div>
                    </div>
                <?php
                } ?>

                <h3>Bộ nhớ trong</h3>
                <?php
                $Storage = DB::getStorageFromProduct();
                foreach ($Storage as  $Storage_item => $value) {
                ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <input type="checkbox" class="common_selector storage"
                                value="<?php echo  $value['product_storage']; ?>">
                            <?php echo  $value['product_storage']; ?> GB
                        </div>
                    </div>
                <?php
                } ?>


            </div>
            <div class="col-md-9">
                <div class="row filter_data">

                </div>
            </div>
        </div>
    </div>
</body>

</html>