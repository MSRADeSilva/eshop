<?php
session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    $text = $_GET["t"];

    if (empty($text)) {
        echo "You must enter a category";
    } else {
        $categorys = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%" . $text . "%' ");
        $n = $categorys->num_rows;

        if ($n == 1) {
            echo "The category allready exist.";
        } else {
            Database::iud("INSERT INTO `category` (`name`) VALUES ('" . $text . "')");
            echo "success";
        }
    }
}
