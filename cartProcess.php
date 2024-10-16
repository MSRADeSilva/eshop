<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $id = $_GET["id"];
    $qtytxt = $_GET["txt"];
    $umail = $_SESSION["u"]["email"];
    // echo $id;
    // echo $qtytxt;
    if ($qtytxt == 0) {
        echo "Please Add a Quantity";
    } else {


        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`= '" . $umail . "' AND `product_id`= '" . $id . "' ");
        $cn = $cartrs->num_rows;
        if ($cn == 1) {

            echo "The product is a already exists in your cart";
        } else {
            $productrs = Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $id . "' ");
            $pr = $productrs->fetch_assoc();

            if ($pr["qty"] >= $qtytxt) {
                Database::iud("INSERT INTO `cart`(`qty`,`user_email`,`product_id`) VALUES('" . $qtytxt . "','" . $umail . "','" . $id . "')");
                echo "success";
            } else {
                echo "Please enter a valid Quantity below" . $pr['qty'] . ".";
            }
        }
    }
}
