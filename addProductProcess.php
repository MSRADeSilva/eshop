<?php

require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$colour = $_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["dese"];

if (isset($_FILES["img"])) {
    $imgefile = $_FILES["img"];
}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail = "shehan@gmail.com";

if ($category == "0") {
    echo "Please Select a Category";
} else if ($brand == "0") {
    echo "Please Select a Brand";
} else if ($model == "0") {
    echo "Please Select a Model";
} else if (empty($title)) {
    echo "Please Add a Title";
} else if (strlen($title) > 100) {
    echo "Title Must Contain 100 or Less than 100 Characteres ";
} else if ($qty == "0" || $qty == "e") {
    echo "Please add the Quantity of Your Product";
} else if (!is_int($qty)) {
    echo "Please Add a Valid Quantity";
} else if (empty($qty)) {
    echo "Please Add the Quantity of Your Product";
} else if ($qty < 0) {
    echo "Please Add a Valid Quantity";
} else if (empty($price)) {
    echo "Please insert the price of your product.";
} else if (!is_int($price)) {
    echo "Please insert a valid price";
} else if (empty($dwc)) {
    echo "Please insert the delivery cost inside Colombo District.";
} else if (!is_int($dwc)) {
    echo "Please insert a valid price";
} else if (empty($doc)) {
    echo "Please insert the delivery cost outside Colombo District.";
} else if (!is_int($doc)) {
    echo "Please insert a valid price";
} else if (empty($description)) {
    echo "Please enter the description of your product.";
} else {

    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");

    if ($modelHasBrand->num_rows == 0) {

        echo "The product doesn't exists";
    } else {

        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];


        Database::iud("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`title`,
    `color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,
    `datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) 
    VALUES ('" . $category . "','" . $modelHasBrandId . "','" . $title . "','" . $colour . "',
    '" . $price . "','" . $qty . "','" . $description . "','" . $condition . "','" . $state . "',
    '" . $useremail . "','" . $date . "','" . $dwc . "','" . $doc . "')");

        echo "Product added successfully || ";

        $last_id = Database::$connection->insert_id;

        $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg");

        if (isset($_FILES["img"])) {
            $image = $_FILES["img"];
        }

        if (isset($image)) {
            $file_extension = $image["type"];

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Please select a valid image.";
            } else {

                $fileName = "resources//products//" . uniqid() . $image["name"];
                move_uploaded_file($image["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('" . $fileName . "','" . $last_id . "')");
                echo "Image added successfully";
            }
        } else {
            echo "Please select an image";
        }
    }
}
