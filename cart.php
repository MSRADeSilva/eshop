<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop cart</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php require "header.php"; ?>

                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Basket</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Basket <i class="bi bi-cart2"></i></label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreake1">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <hr class="hrbreake1">
                        </div>

                        <?php

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $umail . "' ");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {

                        ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 fw-bolder">You have no items in your Basket.</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                        <?php

                        } else {

                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row g-2">

                                    <?php
                                    for ($i = 0; $i < $cn; $i++) {
                                        $cr = $cartrs->fetch_assoc();

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cr["product_id"] . "'  ");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umail . "'  ");
                                        $ar = $addressrs->fetch_assoc();
                                        $cityid = $ar["city_id"];

                                        $districtrs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $cityid . "'  ");
                                        $xr = $districtrs->fetch_assoc();
                                        $districtid = $xr["district_id"];

                                        $ship = "0";
                                        if ($cityid == "2") {
                                            $ship = $pr["delivery_fee_colombo"];
                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $pr["user_email"] . "'  ");
                                        $sn = $sellerrs->fetch_assoc();

                                    ?>
                                        <div class="card mb-3  col-12">
                                            <div class=" row g-0">

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller : </span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $sn["fname"] . " " . $sn["lname"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="col-md-4">

                                                    <?php

                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pr["id"] . "' ");
                                                    $in = $imagers->num_rows;

                                                    $arr;

                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr[$x] = $ir["code"];
                                                    }

                                                    ?>

                                                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"]; ?>" data-bs-content="<?php echo $pr["description"]; ?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $pr["title"]; ?></h5>

                                                        <?php

                                                        $colourrs = Database::search("SELECT `name` FROM `color` WHERE `id` = '" . $pr["color_id"] . "' ");
                                                        $clr = $colourrs->fetch_assoc();
                                                        ?>

                                                        <span class="fw-bold text-black-50 ">Colour : <?php echo $clr["name"] ?></span>&nbsp;|

                                                        <?php

                                                        $conditionrs = Database::search("SELECT `name` FROM `condition` WHERE `id` = '" . $pr["condition_id"] . "'  ");
                                                        $con = $conditionrs->fetch_assoc();

                                                        ?>

                                                        <span class="fw-bold text-black-50 "> Condition : <?php echo $con["name"] ?></span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $pr["price"]; ?> .00</span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Quantity : </span>
                                                        <input type="number" value="<?php echo $cr["qty"]; ?>" class=" border rounded rounded-4 border-2 fs-5 fw-bold cartqtytxt" id="cartqtytxt<?php echo $pr['id']; ?> ">
                                                        <button class="btn btn-secondary fw-bold mb-2" onclick="qtychange(<?php echo $pr['id']; ?>);">QTY Change</button><br />
                                                        <span class="fw-bold text-black-50 fs-5 ">Dilivery fee : </span>
                                                        <span class="fw-bolder text-black fs-5">Rs. <?php echo $ship; ?> .00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a href="<?php echo "singleproductview.php?id=" . ($pr["id"]); ?>" class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick='deletefromcart(<?php echo $pr["id"]; ?>);'>Remove</a>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-12 mt-1 mb-4">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($pr["price"] * $cr["qty"] + $ship) ?> .00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Items (<?php echo $cn; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Total</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>
                                </div>
                            </div>


                    </div>
                </div>

                <div class="modal model-dialog-centred" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                        }

            ?>





            <?php require "footer.php"; ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>

<?php
}
?>