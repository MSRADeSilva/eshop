<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $cid = $_POST["cid"];
    $cqty = $_POST["cqty"];

    Database::iud("UPDATE `cart` SET `qty`='" . $cqty . "' WHERE `product_id`='" .  $cid . "'  ");
    echo "Success";
}
