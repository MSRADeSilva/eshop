<?php

require "connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_GET["e"])) {

    $e = $_GET["e"];

    if (empty($e)) {
        echo "Please enter your email address";
    } else {

        $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $e . "' ");

        if ($rs->num_rows == 1) {

            $code = uniqid();

            Database::iud("UPDATE `user` SET `verification_code` = '" . $code . "' WHERE `email` = '" . $e . "' ");

            // email code

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'namiduwathsala@gmail.com';
            $mail->Password = 'jnwf20011125';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('namiduwathsala@gmail.com', 'eshop');
            $mail->addReplyTo('namiduwathsala@gmail.com', 'eshop');
            $mail->addAddress($e);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Frogot Password Verification Code';
            $bodyContent = '<h1 style="color:red;">Your Verification Code : ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail';
            } else {
                echo 'Success';
            }

            // email

        } else {
            echo "Email address not found";
        }
    }
} else {
    echo "Please enter your email address";
}
