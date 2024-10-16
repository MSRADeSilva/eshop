<?php
session_start();
require "connection.php";
// $s = $_SESSION["u"]["status_id"];

// if ($s == "1") {

?>
<!DOCTYPE html>

<html>

<head>
    <title>eShop Home</title>
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
            <!--  header -->

            <?php
            require "header.php";
            ?>

            <!--  header -->
            <hr class="hrbreake1">
            <!-- search bar -->
            <div class="col-12 mt-2 justify-content-center">
                <div class="row mb-3">
                    <div class="offset-lg-1  col-lg-1 col-12  logoimg" style="background-position: center;">

                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group input-group-lg  mt-3 mb-0 mb-lg-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <!-- <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Category</button> -->
                            <select class="btn btn-outline-primary" id="basic_search_select">
                                <option value="0">Select Category</option>
                                <?php

                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($i = 1; $i <= $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="offset-3 offset-lg-0 col-4 col-lg-2 d-grid gap-2">
                        <button class="btn btn-primary searchbtn mt-3" onclick="basicsearch(1);">Search</button>
                    </div>

                    <div class="col-3 col-lg-1 mt-4 offset-lg-0  text-center">
                        <a class="link-secondary link1" href="advancedSearch.php">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- search bar -->
            <hr class="hrbreal1">

            <!-- slide-->

            <div class="col-12 d-none d-lg-block my-3" id="slideid">

                <div class="row">

                    <div id="carouselExampleCaptions" class=" offset-2 col-8 carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/posterimg.jpg" class="d-block posterimg1">
                                <div class="carousel-caption d-none d-md-block  postercaption">
                                    <h5 class="postertitle">Welcome to eShop</h5>
                                    <p class="postertxt">The World's Best Online Store By One Click.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg2.jpg" class="d-block posterimg1">
                                <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div> -->
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg3.jpg" class="d-block posterimg1">
                                <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be Free ......</h5>
                                    <p class="postertxt">Experience the Lowest Delevery Cost With Us</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>

            </div>
            <!-- slide-->

            <div class="col-12" id="searchdetails"></div>

            <!-- product tittle view -->

            <?php

            $rs = Database::search("SELECT * FROM `category`");
            $n = $rs->num_rows;



            for ($x = 0; $x < $n; $x++) {
                $c = $rs->fetch_assoc();
            ?>
                <div class="col-12 mb-3">
                    <a class="link-dark link2" id="pcat" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                    <a class="link-dark link3 " href="#">See All &rightarrow; </a>
                </div>
                <?php

                $resultset = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c["id"] . "' ORDER BY `datetime_added`DESC LIMIT 5 OFFSET 0 ");

                ?>

                <!-- product title view -->

                <!-- product view -->

                <div class="col-12" id="pdiv ">
                    <div class="row border border-primary">
                        <div class="col-12">
                            <div class="row justify-content-center align-content-center" id="pdetails" style="margin-left: auto;margin-right: auto;">
                                <?php

                                $nr = $resultset->num_rows;
                                for ($y = 0; $y < $nr; $y++) {
                                    $prod = $resultset->fetch_assoc();
                                ?>

                                    <div class="card col-6 col-lg-2 mt-1 mb-1" style="width: 18rem;">

                                        <?php
                                        $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod["id"] . "'");
                                        $imgrow = $pimage->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $imgrow["code"]  ?>" class="card-img-top cardTopImg ">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $prod["title"]; ?> <span class="badge bg-info" style="font-size: 12px;">New</span> </h5>
                                            <span class="card-text text-primary">Rs.<?php echo $prod["price"];   ?>.00</span>
                                            <br />
                                            <?php
                                            if ((int)$prod["qty"] > 0) {
                                            ?>
                                                <span class="card-text text-warning">In Stock</span>
                                                <input type="number" min="0" class="form-control mb-1" value="1" id="qtytxt<?php echo $prod['id']; ?>" />
                                                <a href="<?php echo "singleproductview.php?id=" . ($prod['id']); ?>" class="btn btn-success ">Buy Now</a>
                                                <a class="btn btn-danger " onclick="addToCart(<?php echo $prod['id']; ?>)">Add Cart</a>
                                                <a onclick="addToWatchList(<?php echo $prod['id']; ?>)" class="btn btn-secondary"><i class="bi bi-heart-fill" style="font-size: 10px;"></i></a>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="card-text text-danger">Out Of Stock</span>
                                                <input type="number" min="0" class="form-control mb-1" value="1" disabled id="qtytxt" />
                                                <a href="#" class="btn btn-success disabled mt-1">By Now</a>
                                                <a href="#" class="btn btn-danger disabled  mt-1">Add To Cart</a>
                                                <a class="btn btn-secondary "><i class="bi bi-heart-fill "></i></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                <?php
                                }

                                ?>


                            </div>

                        </div>
                    </div>
                </div>





            <?php

            }

            ?>




            <!-- product view -->
            <?php

            require "footer.php"

            ?>

        </div>

        <!-- footer-->



    </div>



    <!-- footer-->
    <!-- </div> -->

    <script src="script.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
// } else {

?>
<script>
    //         alert("Your account is blocked");
    //         window.location = "index.php";
    //     
</script>
<?php
// }

?>