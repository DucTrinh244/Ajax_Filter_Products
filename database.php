        <?php
        class DB
        {
            private static $db = NULL;

            public static function connection()
            {
                if (!isset(self::$db)) {
                    try {
                        self::$db = new PDO("mysql:host=localhost;dbname=db_Ajax", "root", "");
                        self::$db->exec("SET NAMES 'utf8'");
                    } catch (PDOException $ex) {
                        echo "Lỗi trong quá trình kết nối CSDL: " . $ex->getMessage();
                    }
                }
                return self::$db;
            }

            public static function getBrandFromProduct()
            {
                $db = self::connection();
                $sql = "SELECT DISTINCT(product_brand) FROM products WHERE product_status = 1 ORDER BY product_id DESC";
                $stmt = $db->prepare($sql);
                try {
                    $stmt->execute();
                    $record = array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $record[] = $row;
                    }
                    return $record;
                } catch (PDOException $ex) {
                    echo "Lỗi khi thực hiện truy vấn: " . $ex->getMessage();
                    return [];
                }
            }
            public static function getRAMFromProduct()
            {
                $db = self::connection();
                $sql = "SELECT DISTINCT(product_ram) FROM products WHERE product_status = 1 ORDER BY product_ram DESC";
                $stmt = $db->prepare($sql);
                try {
                    $stmt->execute();
                    $record = array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $record[] = $row;
                    }
                    return $record;
                } catch (PDOException $ex) {
                    echo "Lỗi khi thực hiện truy vấn: " . $ex->getMessage();
                    return [];
                }
            }
            public static function getStorageFromProduct()
            {
                $db = self::connection();
                $sql = "SELECT DISTINCT(product_storage) FROM products WHERE product_status = 1 ORDER BY product_storage DESC";
                $stmt = $db->prepare($sql);
                try {
                    $stmt->execute();
                    $record = array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $record[] = $row;
                    }
                    return $record;
                } catch (PDOException $ex) {
                    echo "Lỗi khi thực hiện truy vấn: " . $ex->getMessage();
                    return [];
                }
            }
        }
