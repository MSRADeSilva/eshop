<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $pageno;
?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>eShop|Seller's Product View</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- head -->

                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-5">
                            <div class="row">

                                <div class="col-12 col-lg-4 mt-1  mb-1">

                                    <?php

                                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $user["email"] . "' ");
                                    $pn = $profileimg->num_rows;

                                    if ($pn == 1) {
                                        $pr = $profileimg->fetch_assoc();

                                    ?>

                                        <img class="rounded-circle" src="<?php echo $pr["code"]; ?>" width="90px" height="90px">

                                    <?php

                                    } else {

                                    ?>

                                        <img class="rounded-circle" src="resources/demoProfileImg.jpg" width="90px" height="90px">

                                    <?php

                                    }

                                    ?>

                                </div>

                                <div class="col-12  col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <span class="text-white"><?php echo $user["email"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <h1 class="text-white fw-bold fs-1 offset-4 offset-lg-1 title3">My Products</h1>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- head -->

                <div class="col-12">
                    <div class="row">

                        <!-- sorting -->

                        <div class="col-12 col-lg-2 mx-0 mx-lg-3 my-3  rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input class="form-control" id="s" type="text" placeholder="Search..." />
                                                </div>
                                                <div class="col-1">
                                                    <label class="form-label fs-4 bi bi-search"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="n">
                                                    <label class="form-check-label" for="n">
                                                        Newer To Oldest
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="o">
                                                    <label class="form-check-label" for="o">
                                                        Oldest To Newer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="h">
                                                    <label class="form-check-label" for="h">
                                                        High To Low
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="l">
                                                    <label class="form-check-label" for="l">
                                                        Low To High
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="b">
                                                    <label class="form-check-label" for="b">
                                                        Brand New
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="u">
                                                    <label class="form-check-label" for="u">
                                                        Used
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-11 col-lg-8 ms-1 ms-lg-4 mb-4 d-grid mt-4">
                                                <button class=" col-12 btn btn-success mb-2" onclick="addFilters(1);">Search</button>
                                                <button class=" col-12 btn btn-primary" onclick="clearfilter();">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sorting -->


                        <!-- product -->

                        <div class="col-12 col-lg-9  mt-3 mb-3 bg-white border border-primary">
                            <div class="row">

                                <div class="offset-1 col-10 text-center">

                                    <div class="row " id="product_view_div">

                                        <?php

                                        if (!isset($_GET["page"])) {
                                            $pageno = 1;
                                        } else {
                                            $pageno = $_GET["page"];
                                        }

                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ");
                                        $d = $products->num_rows;
                                        $row = $products->fetch_assoc();

                                        $results_per_page = 6;

                                        $number_of_pages = ceil($d / $results_per_page);

                                        // echo $d;

                                        // echo $d;
                                        // echo "<br/>";
                                        // echo $number_of_pages;



                                        $page_first_results = ((int)$pageno - 1) * $results_per_page;

                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE
                                         `user_email` = '" . $user["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_results . "  ");
                                        $srn = $selectedrs->num_rows;

                                        while ($srow = $selectedrs->fetch_assoc()) {

                                            // for ($i =/ 0; $i < $srn; $i++) {
                                            // $srn = $selectedrs->fetch_assoc();

                                        ?>

                                            <div class="card mb-3  col-lg-6 col-12 mt-3 ">
                                                <div class="row g-0">

                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $srow["id"] . "' ");
                                                    $pir = $pimgrs->fetch_assoc();

                                                    ?>

                                                    <div class="col-md-4 mt-4">
                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" style="height: 140px;width: auto;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $srow["price"]; ?> .00</span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $srow["qty"]; ?> Item Left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" onclick="changeStatus(<?php echo $srow['id']; ?>);" role="switch" id="check" <?php if ($srow["status_id"] == 2) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?> />
                                                                <label class="form-check-label fw-bold text-info" id="checklabel<?php echo $srow['id']; ?>" for="check"><?php if ($srow["status_id"] == 2) {
                                                                                                                                                                            echo "Make Your Product Active";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "Make Your Product Deactive";
                                                                                                                                                                        } ?></label>
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6">
                                                                        <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $srow['id'] ?>);">Update </a>
                                                                    </div>
                                                                    <div class=" col-12 col-lg-6 mt-1 mt-lg-0">
                                                                        <a href="#" class="btn btn-danger d-grid" onclick="deleteModel(<?php echo $srow['id']; ?>);">Dalete</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="deleteModel<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title fw-bolder text-warning" id="exampleModalLabel">Warning....</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are You sure You Want To Delete This Product?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                            <button type="button" class="btn btn-primary" onclick="deleteproduct(<?php echo $srow['id']; ?>);">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>

                                </div>

                                <!-- pagination -->

                                <div class="col-12 mb-3" id="pro_view">
                                    <div class="row">
                                        <div class="justify-content-center d-flex">
                                            <div class="pagination">
                                                <a href="<?php
                                                            if ($pageno <= 1) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);
                                                            }

                                                            ?>">&laquo;</a>

                                                <?php

                                                for ($page = 1; $page <= $number_of_pages; $page++) {
                                                    if ($page == $pageno) {
                                                ?>
                                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a>

                                                    <?php

                                                    } else {
                                                    ?>
                                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1"><?php echo $page; ?></a>

                                                <?php
                                                    }
                                                }

                                                ?>


                                                <a href="<?php
                                                            if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno + 1);
                                                            }
                                                            ?>">&raquo;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- pagination -->

                            </div>
                        </div>



                        <!-- product -->
                    </div>
                </div>
                <!-- footer -->

                <?php require "footer.php"; ?>

                <!-- footer -->


            </div>

        </div>

        <script src="script.js"></script>
        <script src="bootstrap.min.js"></script>

    </body>

    </html>

<?php

} else {

?>

    <script>
        alert("You have to Signin or Signout First");
        window.location = "index.php";
    </script>

<?php

}


?>