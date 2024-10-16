<?php

require "connection.php";

if (isset($_POST["email"])) {

    $email = $_POST["email"];
    if (empty($email)) {
        echo "Please enter your Email address.";
    } else {

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
        $an = $adminrs->num_rows;

        if ($an == 1) {
            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification` = '" . $code . "' WHERE `email` = '" . $email . "' ");

            echo 'Success';
        } else {
            echo "Your are not a admin....";
        }
    }
}
