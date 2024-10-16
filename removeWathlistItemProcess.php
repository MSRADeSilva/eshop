<?php

require "connection.php";
$id = $_GET["id"];
// echo $id;

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id` = '" . $id . "'");
$watchrow  = $watchrs->fetch_assoc();

$pid = $watchrow["product_id"];
$mail = $watchrow["user_email"];

Database::iud("INSERT INTO `resent`(`product_id`,`user_email`) VALUES('" . $pid . "','" . $mail . "')");
// echo "PRODUCT ADDED TO THE RECENT";

Database::iud("DELETE FROM `watchlist` WHERE `id` = '" . $id . "'");
echo "success";
