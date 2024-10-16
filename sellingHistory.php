<?php

session_start();

require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eShop | Product Selling History </title>
    <link rel="icon" href="resouses/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded ">
                <label for="" class="form-label fs-2 fw-bold text-primary">Product Selling History</label>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">

                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">Order ID</span>
                    </div>

                    <div class="col-5 col-lg-3 bg-light pt-2 pb-2 ">
                        <span class="fs-4 fw-bold">Product</span>
                    </div>

                    <div class="col-3 bg-primary pt-2 pb-2  d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Buyer</span>
                    </div>

                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>

                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                        <span class="fs-4 fw-bold">Quantity</span>
                    </div>


                </div>
            </div>
            <?php
            if (!empty($from) && empty($to)) {
                $fromrs = Database::search("SELECT * FROM `invoice`");
                $fn = $fromrs->num_rows;

                for ($x = 0; $x < $fn; $x++) {
                    $fr = $fromrs->fetch_assoc();
                    $fromdate = $fr["date"];

                    $splitdate = explode(" ", $fromdate);
                    $date = $splitdate[0];

                    if ($from <= $date) {
            ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <?php
                                $prodate =  Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'");
                                $n = $prodate->num_rows;
                                for ($y = 0; $y < $n; $y++) {
                                    $pp = $prodate->fetch_assoc();
                                ?>


                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"]; ?></span>
                                    </div>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["title"] ?></span>
                                    </div>
                                    <?php
                                    $userinvoice = Database::search("SELECT * FROM `user` WHERE `email` ='" . $fr["user_email"] . "'");
                                    $un = $userinvoice->num_rows;
                                    for ($i = 0; $i < $un; $i++) {
                                        $uu = $userinvoice->fetch_assoc();
                                    ?>
                                        <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                            <span class="fs-5 fw-bold text-white"><?php echo $uu["fname"] . " " . $uu["lname"]; ?></span>
                                        </div>

                                    <?php
                                    }

                                    ?>



                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["price"] ?></span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $pp["qty"] ?></span>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>


                    <?php
                    }
                }
            } else if (!empty($from) && !empty($to)) {
                $betweenrs = Database::search("SELECT * FROM `invoice`");
                $bn = $betweenrs->num_rows;

                for ($x = 0; $x < $bn; $x++) {
                    $br = $betweenrs->fetch_assoc();

                    $betweendate = $br["date"];

                    $splitdate = explode(" ", $betweendate);
                    $date = $splitdate[0];

                    if ($from <= $date && $to >= $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <?php
                                $prodate =  Database::search("SELECT * FROM `product` WHERE `id`='" . $br["product_id"] . "'");
                                $n = $prodate->num_rows;
                                for ($y = 0; $y < $n; $y++) {
                                    $pp = $prodate->fetch_assoc();
                                ?>


                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $br["order_id"]; ?></span>
                                    </div>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["title"] ?></span>
                                    </div>
                                    <?php
                                    $userinvoice = Database::search("SELECT * FROM `user` WHERE `email` ='" . $br["user_email"] . "'");
                                    $un = $userinvoice->num_rows;
                                    for ($i = 0; $i < $un; $i++) {
                                        $uu = $userinvoice->fetch_assoc();
                                    ?>
                                        <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                            <span class="fs-5 fw-bold text-white"><?php echo $uu["fname"] . " " . $uu["lname"]; ?></span>
                                        </div>

                                    <?php
                                    }

                                    ?>



                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["price"] ?></span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $pp["qty"] ?></span>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>

                    <?php

                    }
                }
            }
            if (empty($from) && !empty($to)) {
                $tors = Database::search("SELECT * FROM `invoice`");
                $fn = $tors->num_rows;

                for ($x = 0; $x < $fn; $x++) {
                    $fr = $tors->fetch_assoc();
                    $todate = $fr["date"];

                    $splitdate = explode(" ", $todate);
                    $date = $splitdate[0];

                    if ($to >= $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <?php
                                $prodate =  Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'");
                                $n = $prodate->num_rows;
                                for ($y = 0; $y < $n; $y++) {
                                    $pp = $prodate->fetch_assoc();
                                ?>


                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"]; ?></span>
                                    </div>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["title"] ?></span>
                                    </div>
                                    <?php
                                    $userinvoice = Database::search("SELECT * FROM `user` WHERE `email` ='" . $fr["user_email"] . "'");
                                    $un = $userinvoice->num_rows;
                                    for ($i = 0; $i < $un; $i++) {
                                        $uu = $userinvoice->fetch_assoc();
                                    ?>
                                        <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                            <span class="fs-5 fw-bold text-white"><?php echo $uu["fname"] . " " . $uu["lname"]; ?></span>
                                        </div>

                                    <?php
                                    }

                                    ?>



                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pp["price"] ?></span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $pp["qty"] ?></span>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>


                    <?php
                    }
                }
            }
            if (!empty($from) && empty($to)) {
                $fromrs = Database::search("SELECT * FROM `invoice`");
                $fn = $fromrs->num_rows;
                $date;
                for ($x = 0; $x < $fn; $x++) {
                    $fr = $fromrs->fetch_assoc();
                    $fromdate = $fr["date"];

                    $splitdate = explode(" ", $fromdate);
                    $date = $splitdate[0];
                }
                if ($from >= $date) {
                    ?>
                    <div class="col-12 justify-content-center  d-flex ">
                        <label class="text-danger fs-3 text-center  mb-5 mt-3">You haven't sell anything </label>
                    </div>

                <?php

                }
            } else {
                ?>
                <div class="col-12 justify-content-center d-flex ">
                    <label class="text-danger fs-3 text-center  mb-5 mt-3">You haven't sell anything </label>
                </div>


            <?php
            }

            ?>






            <?php require "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>