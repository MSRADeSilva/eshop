<?php
session_start();

require "connection.php";

if (isset($_POST["p"])) {

    $proid = $_POST["p"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $proid . "'");
    $num = $productrs->num_rows;

    if ($num == 1) {
        $row = $productrs->fetch_assoc();
        $us = $row["status_id"];

        if ($us == "1") {

            Database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='" . $proid . "'");

            echo "success1";
        } else {

            Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='" . $proid . "'");

            echo "success2";
        }
    }
} else {
?>
    <script>
        window.location = "manageProduct.php";
    </script>
<?php
}
