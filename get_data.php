<?php
require_once("database.php");
if (isset($_POST['action'])) {
    $query = "SELECT * FROM products WHERE product_status = 1";

    if (
        isset($_POST['minimum_price'], $_POST['maximum_price'])
        && !empty($_POST['minimum_price'])
        && !empty($_POST['maximum_price'])
    ) {
        $query .= " AND product_price BETWEEN " . $_POST['minimum_price'] . " AND " . $_POST['maximum_price'];
    }
    if (isset($_POST['brand'])) {
        $brand_filter = implode("','", $_POST['brand']);
        $query .= " AND product_brand IN('" . $brand_filter . "')";
    }
    if (isset($_POST['ram'])) {
        $ram_filter = implode("','", $_POST['ram']);
        $query .= " AND product_ram IN('" . $ram_filter . "')";
    }
    if (isset($_POST['storage'])) {
        $storage_filter = implode("','", $_POST['storage']);
        $query .= " AND product_storage IN('" . $storage_filter . "')";
    }

    $db = DB::connection();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $count = $stmt->rowCount();
    $output = '';

    if ($count > 0) {
        foreach ($result as $key => $value) {
            $output .= '
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div style="border:1px solid #ccc; border-radius:5px; padding: 16px; margin-bottom: 16px; height:420px">
                        <img src="images/' . $value['product_image'] . '" class="img-fluid" />
                        <p align="center"><b><a href="#" style=" text-decoration:none;">' . $value['product_name'] . '</a></b></p>
                        <h4 style="text-align:center;" class="text-danger">' . number_format($value['product_price']) . ' VND</h4>
                        Thương hiệu: ' . $value['product_brand'] . ' <br>
                        RAM: ' . $value['product_ram'] . ' GB<br> 
                        Bộ nhớ trong: ' . $value['product_storage'] . ' GB<br>
                    </div>
                </div>';
        }
    } else {
        $output = '<h3>Không tìm thấy sản phẩm nào </h3>';
    }
    echo $output;
}
