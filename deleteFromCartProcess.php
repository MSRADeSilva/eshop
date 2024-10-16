<?php

require "connection.php";
$id = $_GET["id"];
// echo $id;

$cartrs = Database::search("SELECT * FROM `cart` WHERE `product_id` = '" . $id . "'");
$cartow  = $cartrs->fetch_assoc();

$pid = $cartow["product_id"];
$mail = $cartow["user_id"];

$recentrs = Database::search("SELECT * FROM `resent` WHERE `product_id` = '" . $pid . "' AND `user_email`='" . $mail . "'");
$rn = $recentrs->num_rows;
if ($rn == 1) {
    Database::iud("DELETE FROM `cart` WHERE `product_id` = '" . $id . "'");
    echo "success";
} else {
    Database::iud("INSERT INTO `resent`(`product_id`,`user_email`) VALUES('" . $pid . "','" . $mail . "')");
    Database::iud("DELETE FROM `cart` WHERE `product_id` = '" . $id . "'");
    echo "success";
}
