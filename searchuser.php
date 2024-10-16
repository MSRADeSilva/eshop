<?php

session_start();

require "connection.php";

if (isset($_GET["s"])) {

    $text = $_GET["s"];

    if (!empty($text)) {

        $userrs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%'");
        $row = $userrs->fetch_assoc();

        $_SESSION["k"] = $row;

        echo "success";
    } else {
        echo "Please add name to search";
    }
}
