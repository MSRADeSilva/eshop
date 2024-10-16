<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $umail = $_SESSION["u"]["email"];


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Watchlist</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php require "header.php"; ?>
        <div class="container-fluid">
            <div class="row gx-2 gy-2">

                <div class="cok-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreake1 ">
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
                        <div class="col-12">
                            <hr class="hrbreake1 ">
                        </div>
                        <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb" class="ms-3 mt-2">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="purchasehistory.php">Recently Viewed</a>
                            </nav>
                        </div>

                        <?php

                        $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $umail . "' ");
                        $wn = $watchlistrs->num_rows;

                        if ($wn <= 0) {

                        ?>

                            <!-- Without item -->
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12 emptyview"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 mb-3 fw-bolder">You have no items in your Watchlist</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Without item -->

                        <?php

                        } else {

                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row g-2">
                                    <?php

                                    for ($i = 0; $i < $wn; $i++) {
                                        $wr = $watchlistrs->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $wid . "' ");
                                        $pn = $productrs->num_rows;

                                        if ($pn == 1) {
                                            $pr = $productrs->fetch_assoc();
                                            $prodid = $pr["id"];


                                    ?>


                                            <div class="card mb-3 mx-0 mx-lg-5 col-12">
                                                <div class=" row g-0">
                                                    <div class="col-md-4">
                                                        <?php
                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $wid . "'");
                                                        $in = $imagers->num_rows;

                                                        $arr;

                                                        for ($x = 0; $x < $in; $x++) {
                                                            $ir = $imagers->fetch_assoc();
                                                            $arr[$x] = $ir["code"];
                                                        }

                                                        ?>
                                                        <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start" style="height: 220px; width: auto;">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pr["title"] ?></h5>
                                                            <?php

                                                            $col = Database::search("SELECT * FROM `color` WHERE `id` = '" . $pr["color_id"] . "'");
                                                            $colf = $col->fetch_assoc();

                                                            ?>
                                                            <span class="fw-bold text-black-50 ">Colour : <?php echo $colf["name"]; ?></span>&nbsp; |

                                                            <?php
                                                            $conrs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $pr["condition_id"] . "'");
                                                            // $condition = $conrs->num_rows;

                                                            $co = $conrs->fetch_assoc();
                                                            ?>

                                                            &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $co["name"]; ?></span>

                                                            <br />
                                                            <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                            <span class="fw-bold text-black fs-5">Rs. <?php echo $pr["price"]; ?> .00</span>
                                                            <br />
                                                            <span class="fw-bold text-black-50 fs-5">Seller : </span>
                                                            <br />
                                                            <span class="fw-bold text-black fs-5"><?php echo  $_SESSION["u"]["fname"] . " " .  $_SESSION["u"]["lname"];  ?></span>
                                                            <br />
                                                            <span class="fw-bold text-black fs-5"><?php echo $_SESSION["u"]["email"] ?></span>
                                                            <input type="number" class="d-none" value="1" id="qtytxt<?php echo $wid; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <div class="card-body d-grid">
                                                            <a href="<?php echo "singleproductview.php?id=" . ($wid); ?>" class="btn btn-outline-success mb-2">Buy Now</a>
                                                            <a onclick="addToCart(<?php echo $wid; ?>)" class="btn btn-outline-warning mb-2">Add Cart</a>
                                                            <a href="#" class="btn btn-outline-danger mb-2" onclick="deletefromwatchlist(<?php echo $wr['id']; ?>);">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                <?php
                                        }
                                    }
                                }

                                ?>
                                </div>
                            </div>

                    </div>
                </div>

            </div>
        </div>
        <?php require "footer.php"; ?>


        <script src="script.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

}

?>