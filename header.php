<!DOCTYPE html>
<html>

<head>
    <title>eShop</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- header -->

    <div class="col-12 justify-content-center">

        <div class="row">


            <div class="offset-lg-1 col-12 col-lg-5 align-self-start mt-2">
                <span class="text-start lable1"><b>Welcome </b>

                    <?php

                    if (isset($_SESSION["u"])) {

                        $user = $_SESSION["u"]["fname"];
                        echo $user;
                    } else {
                    ?>

                        <a href="index.php" class="lable3">Sign In or Register</a>

                    <?php
                    }

                    ?>

                </span>|
                <span class="text-start lable2">Help and Contact </span>|
                <span class="text-start lable3" onclick="signout();">Sign Out</span>
            </div>

            <div class="offset-lg-3 col-12 col-lg-3 align-self-end">

                <div class="row mt-1 mb-1">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start lable2 " onclick="goToAddProduct();">Sell</span>
                    </div>

                    <div class="col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="home.php">Home</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Wishlist</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="messages.php?email=<?php echo $_SESSION["u"]["email"]; ?>">Message</a></li>
                            <li><a class="dropdown-item" href="sellerproductview.php">My Products</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="adminsignin.php">My Sellings</a></li>
                        </ul>
                    </div>

                    <a href="cart.php" class="col-1 col-lg-3 carticon mt-1 ms-5 ms-lg-0"></a>

                </div>

            </div>

        </div>

    </div>

    <!-- header -->

</body>

</html>