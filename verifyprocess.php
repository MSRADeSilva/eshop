<?php
session_start();
require "connection.php";

if (isset($_GET["v"])) {

    $v = $_GET["v"];
    $adminrs = Database::search("SELECT * FROM `admin` WHERE `verification` = '" . $v . "'");
    $an = $adminrs->num_rows;

    if ($an == 1) {

        $ar = $adminrs->fetch_assoc();
        $_SESSION["a"] = $ar;

        echo "Success";
    } else {
        echo "You Must enter a valid verification code to Log In";
    }
} else {

    echo "Please add the verification code first.";
}
