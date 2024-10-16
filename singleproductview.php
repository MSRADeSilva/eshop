<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "' ");
    $pn = $productrs->num_rows;
    if ($pn == 1) {

        $pd = $productrs->fetch_assoc();
        $mhb = $pd["model_has_brand_id"];

?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>eShop | Single product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="resources/logo.svg">
            <link rel="stylesheet" href="bootstrap.css">

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

            <link rel="stylesheet" href="style.css">

        </head>

        <body onload="refresher(<?php echo $_SESSION['u']['email'] ?>)">

            <div class="container-fluid">
                <div class="row">
                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>
                                            <?php
                                            $imagesrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                            $in = $imagesrs->num_rows;

                                            $img1;

                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagesrs->fetch_assoc();


                                                    if ($x == 0) {
                                                        $img1 = $d["code"];
                                                    }


                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" style=" cursor:pointer;" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondery">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondery p-3">
                                            <div style="background-image: url('<?php echo $img1; ?>'); background-repeat:no-repeat; background-size:contain; height:450px;" id="mainimg"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12 pe-0">
                                                <nav>
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item"><a class="text-black-50 text-decoration-none" href="#">Single View</a></li>
                                                    </ol>
                                                </nav>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold mt-1"><?php echo $pd["title"]; ?></label>
                                            </div>

                                            <div class="col-12">
                                                <span class="badge badge-success">
                                                    <i class="fa fa-star mt-1 text-warning"></i>
                                                    <label class="text-dark fs-6"> 4.5 Star </label>
                                                    <label class="text-dark fs-6">| 35 Rating & 45 Reviews</label>
                                                </span>
                                            </div>

                                            <div class="d-inline-block col-12 mb-2">
                                                <label class="fw-bold mt-1 fs-4">Rs. <?php echo $pd["price"]; ?>.00 </label>&nbsp;
                                                <label class="fw-bold mt-1 fs-6 text-danger"><del> Rs. <?php $a = $pd["price"];
                                                                                                        $newval = ($a / 100) * 5;
                                                                                                        $val = $a + $newval;
                                                                                                        echo $val; ?></del></label>
                                            </div>

                                            <hr class="hrbreake1" />

                                            <div class="col-12 col-lg-6 mt-2">
                                                <label class="text-primary fs-6"><b>Warrenty : </b>06 month warrenty</label><br />
                                                <label class="text-primary fs-6"><b>Return Policy : </b>01 month return policy</label><br />
                                                <label class="text-primary fs-6"><b>In Stock : </b>10 item left</label>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <label class="text-dark fs-5 fw-bold">Seller Details</label><br />
                                                <?php
                                                $userrs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $pd["user_email"] . "'");
                                                $userrd = $userrs->fetch_assoc();
                                                ?>
                                                <label class="text-success fs-6"><b>Name : </b><?php echo $userrd["fname"] . " " . $userrd["lname"]; ?></label><br />
                                                <label class="text-success fs-6"><b>Email : </b><?php echo $userrd["email"]  ?></label><br />
                                                <label class="text-success fs-6"><b>Contact : </b><?php echo $userrd["mobile"]  ?></label><br />
                                                <a href="messages.php?email=<?php echo $userrd["email"] ?>" class="text-decoration-none btn-sm btn-success">Contact</a>
                                            </div>

                                            <div class="col-12  mt-2">
                                                <div class="row px-2">
                                                    <div class="col-12 rounded border border-1 border-success mt-1">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-lg-1">
                                                                <img src="resources/singleview/pricetag.png" />
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 col-lg-11 mt-1 pe-4">
                                                                <label class="text-black-50">Stand a chanse to get instatn 5% discount by using VISA</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <div class="row" style="margin-top: 15px;">
                                                    <div class="col-md-6">
                                                        <label class="fs-6 mt-1">Colour Options : </label><br />
                                                        <button class="btn btn-primary btn-sm">Black</button>
                                                        <button class="btn btn-primary btn-sm">Gold</button>
                                                        <button class="btn btn-primary btn-sm">Blue</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="hrbreake1" />

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                        <div class="row">
                                                            <div class="border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block">
                                                                <span class="mt-2">QTY :</span>
                                                                <input type="text" class="border-0 fs-6 fw-bold text-start mt-2" value="1" pattern="[0-9]*" id="qtyinput">
                                                                <div style="margin-top: -30px; margin-left: 250px;" class="qty-button">
                                                                    <div class="d-flex flex-column align-items-right border border-1 border-secondary qty-inc" onclick="qty_ink(<?php echo $pd['qty']; ?>)">
                                                                        <i class="fas fa-chevron-up ms-1"></i>
                                                                    </div>
                                                                    <div style="cursor: pointer;" class="d-flex flex-column align-items-right border border-1 border-secondary qty-des" onclick="qty_dec();">
                                                                        <i class=" fas fa-chevron-down ms-1"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-4 col-lg-3 d-grid">
                                                            <button onclick="addToCart2(<?php echo $pid; ?>)" class="btn btn-primary">Add to cart</button>
                                                        </div>
                                                        <div class="col-4 col-lg-3 d-grid">
                                                            <button class="btn btn-success" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid ?>);">Buy now</button>
                                                        </div>
                                                        <div style="cursor: pointer;" onclick="addToWatchList(<?php echo $pid; ?>)" class="col-4 col-lg-3 d-grid">
                                                            <i class="fas fa-heart mt-2 fs-4 text-black-50"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="row bg-white">
                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fw-bold fs-3">Related Items</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 bg-white">
                                    <div class="row">
                                        <div class="col-9 offset-2 col-lg-11 offset-lg-1">
                                            <div class="row p-2 bg-white">
                                                <?php

                                                $model_has_brand = Database::search("SELECT * FROM `model_has_brand` WHERE `id` = '" . $mhb . "' ");
                                                $mmbb = $model_has_brand->fetch_assoc();
                                                $brandsid = Database::search("SELECT * FROM `product` INNER JOIN model_has_brand 
                                     ON product.model_has_brand_id = model_has_brand.id  WHERE brand_id = '" . $mmbb["brand_id"] . "' ORDER BY `datetime_added` DESC LIMIT 5 ");

                                                $bds = $brandsid->num_rows;
                                                for ($g = 0; $g < $bds; $g++) {
                                                    $bdf = $brandsid->fetch_assoc();
                                                    // echo $bdf["id"];
                                                    $pro = Database::search("SELECT * FROM `product` WHERE `model_has_brand_id` = '" . $bdf["id"] . "'");
                                                    $profs = $pro->fetch_assoc();
                                                    //   echo $profs["id"];


                                                ?>
                                                    <div class="card me-1" style="width: 19rem;">
                                                        <?php
                                                        $img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $profs["id"] . "' ");
                                                        $im = $img->num_rows;

                                                        $arr;

                                                        for ($x = 0; $x < $im; $x++) {
                                                            $ir = $img->fetch_assoc();
                                                            $arr[$x] = $ir["code"];
                                                        }
                                                        ?>


                                                        <img src="<?php echo $arr[0]; ?>" class="card-img-top">


                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $bdf["title"]; ?></h5>
                                                            <p class="card-text"><?php echo $bdf["price"]; ?></p>
                                                            <a href="#" class="btn btn-primary">Add to cart</a>
                                                            <a href="#" class="btn btn-primary">Buy Now</a>
                                                            <a href="#" class="me-1 mt-1 fs-5"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                                        </div>
                                                    </div>

                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fw-bold fs-3">product Details</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <lable class="form-label fs-5 fw-bold">Brand</lable>
                                                </div>
                                                <div class="col-10">
                                                    <lable class="form-label fs-5 fw-bold">Apple</lable>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <lable class="form-label fs-5 fw-bold">Model</lable>
                                                </div>
                                                <div class="col-10">
                                                    <lable class="form-label fs-5 fw-bold">iPhone 12</lable>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-4 col-lg-2">
                                                    <lable class="form-label fs-5 fw-bold">Description</lable>
                                                </div>
                                                <div class="col-10 col-lg-10">
                                                    <textarea class="form-control" cols="60" rows="10" disabled></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 mb-3 border border-primary border-1 border-start-0 border-end-0 border-top-0">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold">Feedbacks...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row g-1">

                                        <?php
                                        $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pid . "' ");
                                        $feed = $feedbackrs->num_rows;

                                        if ($feed == 0) {
                                        ?>
                                            <div class="col-12">
                                                <label class="form-label fs-3 text-center text-black-50">There are no feedbacks to view.</label>
                                            </div>
                                            <?php
                                        } else {

                                            for ($a = 0; $a < $feed; $a++) {
                                                $feedrow = $feedbackrs->fetch_assoc();


                                            ?>

                                                <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fs-5 fw-bold text-primary">Shehan De Silva</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5 text-dark">Qualit Product. Thankyou For Your services.</span>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <span class="fs-6 text-black-50">2021-10-19 21:21:14</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fs-5 fw-bold text-primary">Shehan De Silva</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5 text-dark">Qualit Product. Thankyou For Your services.</span>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <span class="fs-6 text-black-50">2021-10-19 21:21:14</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fs-5 fw-bold text-primary">Shehan De Silva</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5 text-dark">Qualit Product. Thankyou For Your services.</span>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <span class="fs-6 text-black-50">2021-10-19 21:21:14</span>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
                require "footer.php";

                ?>

            </div>
            </div>
            <script src="script.js"></script>
            <script src="bootstrap.min.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php
    }
}
?>