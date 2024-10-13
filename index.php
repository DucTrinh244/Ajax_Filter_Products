<?php require_once("database.php") ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax nâng cao </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.3/themes/smoothness/jquery-ui.css">
    <!-- slider -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- đặt trước -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>
    <!-- thao tác người dùng thì jquery ui  -->
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
                    <input type="hidden" id="hidden_minimum_price" value="0">
                    <input type="hidden" id="hidden_maximum_price" value="1000000000">
                    <p id="price_show"> Từ: 500.000 VND - 100.000.000 VND</p>
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
    <script>
        $(document).ready(function() {
            filter_data();

            function filter_data() {
                var action = 'get_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var brand = get_filter('brand');
                var ram = get_filter('ram');
                var storage = get_filter('storage');

                $.ajax({
                    url: "get_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        ram: ram,
                        storage: storage
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });

            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                })
                return filter;
            }

            $('.common_selector').click(function() {
                filter_data();
            })

            $("#price_range").slider({
                range: true,
                min: 500000,
                max: 100000000,
                values: [500000, 100000000],
                step: 500000,
                stop: function(event, ui) {
                    $('#price_show').html('Từ: ' + ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            })
        });
    </script>
</body>

</html>