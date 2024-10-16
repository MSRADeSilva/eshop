<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $umeil = $_SESSION["u"]["email"];
    $oid = $_GET["id"];


?>
    <!DOCTYPE html>

    <html>

    <head>

        <title>eShop|User Profile</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>

    <body class="mt-2" style="background-color: #f7f7ff;">

        <div class="container-fluid">
            <div class="row">

                <?php require "header.php"; ?>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" type="button" value="click" onclick="printDiv()"><i class="bi bi-printer"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button>
                </div>

                <div id="GFG">

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="invoiceheaderimg"></div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 text-primary text-end h2 text-decoration-underline ">
                                        eShop
                                    </div>
                                    <div class="col-12 text-end fw-bold ">
                                        <span>Maradana,Colombo 10,Sri Lanka.</span><br />
                                        <span>+94715446141</span><br />
                                        <span>eshop@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-2 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5>INVOICE TO :</h5>
                                    <?php


                                    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umeil . "' ");
                                    $ar = $addressrs->fetch_assoc();

                                    ?>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span class="fw-bold"><?php echo $ar["line1"] . "," . $ar["line2"]; ?></span><br />
                                    <span class="fw-bold text-decoration-underline text-primary"><?php echo $umeil; ?></span>
                                </div>

                                <?php

                                $invoicers = Database::search("SELECT * FROM invoice WHERE order_id = '" . $oid . "' ");
                                $in = $invoicers->num_rows;
                                $ir = $invoicers->fetch_assoc();


                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE 0<?php echo $ir["id"]; ?> </h1>
                                    <span class="fw-bold">Date and Time of Invoice :</span>&nbsp;
                                    <span class="fw-bold"><?php echo $ir["date"]; ?></span>
                                </div>



                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <table class="table">

                            </table>
                        </div>
                    </div>

                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order Id & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $invoicers2 = Database::search("SELECT * FROM invoice WHERE order_id = '" . $oid . "' ");
                                $in2 = $invoicers2->num_rows;

                                $subtotal = "0";

                                for ($i = 0; $i < $in2; $i++) {
                                    $irs = $invoicers2->fetch_assoc();
                                    $pid = $irs["product_id"];

                                    $subtotal = $subtotal + $irs["total"];

                                    $productrs = Database::search("SELECT * FROM product WHERE id='" . $pid . "' ");
                                    $pr = $productrs->fetch_assoc();
                                ?>
                                    <tr class="border-0" style="height: 70px;">
                                        <td class="bg-primary text-white fs-3 text-center"><?php echo $irs["id"]; ?></td>
                                        <td class="text-center">
                                            <a href="#" class="fs-6 fw-bold p-2"><?php echo $irs["order_id"]; ?></a><br />
                                            <a href="#" class="fs-6 fw-bold p-2"><?php echo $pr["title"]; ?></a>
                                        </td>
                                        <td class="fs-6 text-center pt-3 " style="background-color: rgb(222, 219, 224);">Rs.<?php echo $pr["price"]; ?>.00</td>
                                        <td class="fs-6 text-center pt-3"><?php echo $irs["qty"]; ?></td>
                                        <td class="fs-6 text-end pt-3 bg-primary text-white">Rs.<?php echo $irs["total"]; ?>.00</td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end ">SUBTOTAL</td>
                                    <td class="fs-5 text-end">Rs. <?php echo $subtotal; ?> .00</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end  border-primary">Discount</td>
                                    <td class="fs-5 text-end border-primary">Rs. 00 .00</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end border-0 border-primary">GRAND TOTAL</td>
                                    <td class="fs-5 text-end border-0">Rs. <?php echo $subtotal; ?> .00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-4 text-center" style="margin-top: -100px;margin-bottom: 50px;">
                        <span class="fs-1">Thank You!</span>
                    </div>

                    <div style="background-color: #e7f2ff;" class="col-12 offset-lg-1 col-lg-10 mt-3 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary rounded">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3 ps-4">
                                <label class="form-label fs-5 fw-bold">Notice :</label>
                                <label class="form-label fs-5 ">Purchased item can be returned before 7 days of delivery.</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-2 border-primary" />
                    </div>

                    <div class="col-12 mb-3 text-center">
                        <label class="form-label fs-6 text-black-50">Invoice was created on a computer and is valid without the Signature and Seal</label>
                    </div>
                </div>
                <?php require "footer.php"; ?>

            </div>
        </div>


        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>


    </html>

<?php
}
?>