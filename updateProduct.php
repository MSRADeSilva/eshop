<!DOCTYPE html>
<?php

session_start();
require "connection.php";
$product = $_SESSION["p"];
if (isset($product)) {
?>
    <html>

    <head>
        <title>Update||Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resouses/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body>
        <div class="container-fluid">
            <div class="row">


                <div class="" id="updateproductbox">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-primary">Update Product</h3>

                    </div>

                    <!-- heading -->

                    <!-- serch field -->
                    <div class="col-12 mb-2 mt-4">
                        <div class="row">
                            <div class="offset-0 offset-lg-1 col-12 col-lg-6">
                                <input class="form-control text-center" type="text" placeholder="Search Product You want to Upadate" id="search" />
                            </div>
                            <div class="col-12 col-lg-4 d-grid mt-2 mt-lg-0">
                                <button class="btn btn-primary  mt-sm-2 mt-lg-0 searchbtn" style="height: 40px;" onclick="searchproduct();">Search Product</button>
                            </div>
                        </div>

                    </div>

                    <!-- serch field -->

                    <!-- category,brand,model -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="ca" disabled>
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product["category_id"] . "'");
                                            $cd = $category->fetch_assoc();


                                            ?>
                                            <option value="0"><?php echo $cd["name"]; ?></option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="br" disabled>
                                            <?php
                                            $modelbrand = Database::search("SELECT * FROM `model_has_brand` WHERE `id` = '" . $product["model_has_brand_id"] . "'");
                                            $mb = $modelbrand->fetch_assoc();
                                            $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $mb["brand_id"] . "'");
                                            $br = $brand->fetch_assoc();

                                            ?>
                                            <option value="0"><?php echo $br["name"]; ?></option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="mo" disabled>
                                            <?php
                                            $modelbrand = Database::search("SELECT * FROM `model_has_brand` WHERE `id` = '" . $product["model_has_brand_id"] . "'");
                                            $mb = $modelbrand->fetch_assoc();
                                            $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $mb["model_id"] . "'");
                                            $mo = $model->fetch_assoc();

                                            ?>
                                            <option value="0"><?php echo $mo["name"]; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- category,brand,model -->

                    <hr class="hrbreak1" />

                    <!-- title -->

                    <div class="col-12 mt-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add a title to your product</label>
                            </div>
                            <div class="offset-lg-2 col-12 col-lg-8">
                                <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]; ?>" />

                            </div>
                        </div>

                    </div>

                    <!-- title -->

                    <hr class="hrbreak1" />

                    <!-- condition,color,qty -->

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select product condiion</label>
                                    </div>
                                    <?php
                                    $con = $product["condition_id"];
                                    if ($con == 1) {
                                    ?>
                                        <div class="offset-1 offset-lg-1 col-10 col-lg-3 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked disabled />
                                            <label class="form-check-label" for="bn">
                                                Brandnew
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-1 col-10 col-lg-3 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" disabled />
                                            <label class="form-check-label" for="us">
                                                Used
                                            </label>
                                        </div>
                                    <?php

                                    } else if ($con == 2) {
                                    ?>
                                        <div class="offset-1 offset-lg-1 col-10 col-lg-3 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" disabled />
                                            <label class="form-check-label" for="bn">
                                                Brandnew
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-1 col-10 col-lg-3 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" checked disabled />
                                            <label class="form-check-label" for="us">
                                                Used
                                            </label>
                                        </div>

                                    <?php
                                    }



                                    ?>



                                </div>
                            </div>


                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select product color</label>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $color = $product["color_id"];
                                            if ($color == 1) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>
                                            <?php

                                            } else if ($color == 2) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>

                                            <?php
                                            } else if ($color == 3) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>

                                            <?php
                                            } else if ($color == 4) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>

                                            <?php
                                            } else if ($color == 5) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>

                                            <?php
                                            } else if ($color == 6) {
                                            ?>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr1" name="clr" disabled>
                                                    <label class="from-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr2" name="clr" disabled>
                                                    <label class="from-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr3" name="clr" disabled>
                                                    <label class="from-check-label" for="clr3">
                                                        Pacific Blue
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr4" name="clr" disabled>
                                                    <label class="from-check-label" for="clr4">
                                                        Jet Black
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr5" name="clr" disabled>
                                                    <label class="from-check-label" for="clr5">
                                                        Rose Gold
                                                    </label>
                                                </div>
                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" id="clr6" name="clr" checked disabled>
                                                    <label class="from-check-label" for="clr6">
                                                        Red
                                                    </label>
                                                </div>

                                            <?php
                                            }

                                            ?>



                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add product quantity</label>
                                        <input class="form-control" type="number" value="<?php echo $product["qty"];  ?>" min="0" id="qty">
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>

                    <!-- condition,color,qty -->
                    <hr class="hrbreak1" />

                    <!-- cost,payment method -->


                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Cost per item</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input id="cost" type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"]; ?>" disabled />
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Approved payment methods</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-2 col-2 pm1"></div>
                                            <div class="col-2 pm2"></div>
                                            <div class="col-2 pm3"></div>
                                            <div class="col-2 pm4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hrbreak1" />
                    <!-- cost,payment method -->

                    <!-- delivery cost -->
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Delivery cost</label>
                                        </div>
                                        <div class="offset-lg-1 col-12 col-lg-3">
                                            <label class="form-label">Delivery cost within colombo</label>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-lg-6 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1"></label>
                                        </div>
                                        <div class="offset-lg-1 col-12 col-lg-3 mt-3">
                                            <label class="form-label">Delivery cost out of colombo</label>
                                        </div>
                                        <div class="col-12 col-lg-7 mt-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





                    <hr class="hrbreak1" />
                    <!-- delivery cost -->

                    <!-- description -->

                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Product description</label>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control ta" cols="100" rows="10" id="desc"><?php echo $product["description"]; ?></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- description -->
                    <hr class="hrbreak1" />

                    <!-- product image -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add product image</label>
                            </div>
                            <?php
                            $img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "'");
                            $uimg = $img->fetch_assoc();

                            ?>
                            <img class="col-5 col-lg-2 ms-2 img-thumbnail" src="<?php echo $uimg["code"]; ?> " id="prev" />

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <input class="d-none" type="file" accept="image/*" id="imguploder" />
                                                <label class="btn btn-primary col-5 col-lg-8" for="imguploder" onclick="changeImg();">Upload</label>
                                            </div>
                                            <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-primary">Upload</button>
                                    </div> -->
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <!-- product image -->
                    <hr class="hrbreak1" />

                    <!-- notice -->

                    <div class="col-12">
                        <label class="form-label lbl1">Notice...</label><br />
                        <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>

                    </div>

                    <!-- notice -->

                    <!-- save button -->


                    <div class="col-12">
                        <div class="row mb-4">

                            <div class="col-12 col-lg-4 offset-0 offset-lg-4 d-grid mt-2 mt-lg-0 mb-4">
                                <button class="btn btn-warning searchbtn" onclick="changeProduct(<?php echo $product['id'] ?>);">Update Product</button>
                            </div>

                        </div>
                    </div>

                    <!-- save button -->
                </div>



                <!-- footer -->
                <?php

                require "footer.php";
                ?>


                <!-- footer -->

            </div>
        </div>

        </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>

<?php

}
?>