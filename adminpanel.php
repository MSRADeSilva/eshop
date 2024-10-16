<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>eShop | Adimn | Dashboard</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resouses/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body style="background-color: #74EBD5;background-image:linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100vh;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-3">
                    <div class="row">
                        <div class="align-items-start bg-dark col-12 text-center">
                            <div class="row g-1">

                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active fs-5" aria-current="page" href="#">Dashbord</a>
                                        <a class="nav-link fs-5" href="manageusers.php?email=<?php echo $_SESSION["a"]["email"]; ?>">Manage Users</a>
                                        <a class="nav-link fs-5" href="manageproducts.php">Manage Products</a>
                                    </nav>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />

                                    <h4 class="text-white">Selling History</h4>

                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-12 mt-3 d-grid">
                                    <label class="form-label text-white fw-bold">Form Date</label>
                                    <input type="date" class="form-control" id="fromdate" />
                                    <label class="form-label text-white fw-bold mt-3">To Date</label>
                                    <input type="date" class="form-control" id="todate" />
                                    <a href="" id="historylink" class="btn btn-primary mt-2" onclick="dailyselling();"> View Selling</a>

                                    <!-- <hr class="border border-1 border-white" />
                                    <h4 class="text-white" ">View Selling</h4> -->

                                    <hr class="border border-1 border-white" />
                                    <hr class="border border-1 border-white" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="row">

                        <div class="col-12 mt-3 mb-3 text-white">
                            <h2 class="fw-bold">Dashbord</h2>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Daliy Earnings</span>
                                            <br />

                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoicers = Database::search("SELECT * FROM `invoice`");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {

                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];

                                                $splitedate = explode(" ", $d);
                                                $pdate = $splitedate[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $ir["total"];
                                                    $c = $c + $ir["qty"];
                                                }

                                                $splitemonth = explode("-", $pdate);
                                                $pyear = $splitemonth[0];
                                                $pmonth = $splitemonth[1];

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $ir["total"];
                                                        $e = $e + $ir["qty"];
                                                    }
                                                }
                                            }

                                            ?>

                                            <span class="fs-5 fw-bold">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5 fw-bold">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Today Selling</span>
                                            <br />
                                            <span class="fs-5 fw-bold"><?php echo $c; ?> Item</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Selling</span>
                                            <br />
                                            <span class="fs-5 fw-bold"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5 fw-bold"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">

                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagement</span>
                                            <br />
                                            <?php

                                            $usersrs = Database::search("SELECT * FROM `user`");
                                            $un = $usersrs->num_rows;

                                            ?>
                                            <span class="fs-5 fw-bold"><?php echo $un; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-xl-3 text-center my-xl-auto mt-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>

                                <?php

                                $startdate = new DateTime("2022-06-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");

                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $endDate->diff($startdate);

                                ?>

                                <div class="col-12 col-xl-9 text-center mt-2 mb-2">
                                    <label class="form-label fs-4 fw-bold text-success">
                                        <?php
                                        echo $difference->format('%Y') . "Years" . " " . $difference->format('%m') . "Months" . " " . $difference->format('%d') . "Days" . " " . $difference->format('%H') . "Hours" . " " . $difference->format('%i') . "Minutes" . " " . $difference->format('%s') . "Seconds"; ?>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <?php

                        $productrow;


                        $freq = Database::search("SELECT `user_email`,`qty`,`product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");
                        $maiil;
                        if ($freq->num_rows == 1) {

                            $freqrow = $freq->fetch_assoc();
                            $maiil = $freqrow["user_email"];



                        ?>
                            <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-light">
                                <div class="row g-1">
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                    </div>


                                    <div class="col-12 text-center">
                                        <?php
                                        $imgrow = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $freqrow["product_id"] . "' LIMIT 1");
                                        $img = $imgrow->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $img["code"]; ?>" class="img-fluid rounded-top" style="height: 200px;margin-left: auto;">
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">
                                        <?php
                                        $product = Database::search("SELECT * FROM `product` WHERE `id`='" . $freqrow["product_id"] . "'");
                                        $productrow = $product->fetch_assoc();
                                        ?>
                                        <span class="fs-5 fw-bold"><?php echo $productrow["title"] ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $freqrow["qty"]; ?> Items</span>
                                        <br />
                                        <span class="fs-6 fw-bold">Rs. <?php echo $productrow["price"] ?> . 00</span>
                                    </div>
                                    <div class="col-12 text-center ">
                                        <div class=" col-4 offset-5 me-1 firstplace"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-light">
                                <div class="row g-1 text-center">

                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                                    </div>
                                    <?php
                                    $userRs = Database::search("SELECT * FROM `user` WHERE  `email` = '" . $maiil . "'");
                                    $userfa = $userRs->fetch_assoc();


                                    ?>
                                    <div class="col-12 text-center">
                                        <?php
                                        $imguserrow = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $maiil . "' ");
                                        $imguser = $imguserrow->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $imguser["code"]; ?>" class="img-fluid rounded-top" style="height: 200px;margin-left: auto;">
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo $userfa["fname"] . " " . $userfa["lname"]; ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $maiil; ?></span>
                                        <br />
                                        <span class="fs-6 fw-bold"><?php echo $userfa["mobile"]; ?></span>
                                    </div>

                                    <div class="col-12">
                                        <div class=" col-4 offset-5 me-1 firstplace"></div>
                                    </div>

                                </div>
                            </div>



                        <?php
                        } else {

                        ?>
                            <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-light">
                                <div class="row g-1">
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                    </div>


                                    <div class="col-12 text-center">
                                        <img src="resouses/7581526_product_searching_preview_view_analysis_icon.svg" class="img-fluid rounded-top" style="height: 200px;margin-left: auto;">
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold text-danger">No Items</span>
                                        <br />
                                        <span class="fs-6 fw-bold text-danger">No Items</span>
                                        <br />
                                        <span class="fs-6 fw-bold text-danger">No Items</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstplace"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-light">
                                <div class="row g-1">

                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <img src="resouses/demoProfileImg.jpg" class="img-fluid rounded-top" style="height: 200px;margin-left: auto;">
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold">No details</span>
                                        <br />
                                        <span class="fs-6 fw-bold">No details</span>
                                        <br />
                                        <span class="fs-6 fw-bold">No details</span>
                                    </div>

                                    <div class="col-12">
                                        <div class="firstplace"></div>
                                    </div>

                                </div>
                            </div>



                        <?php

                        }
                        ?>


                    </div>
                </div>
                <?php require "footer.php"; ?>
            </div>
        </div>



        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <script>
        window.location = "adminsignin.php";
    </script>

<?php
}
?>