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

<body class="bg-primary">

    <?php

    require "connection.php";
    session_start();
    if (isset($_SESSION["u"])) {


    ?>

        <div class="container-fluid bg-white rounded mt-5 mb-5">

            <div class="row">
                <div class="col-md-3 border-end">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php

                        $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
                        $pn = $profileimg->num_rows;

                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                        ?>

                            <img class="rounded-circle mt-5" src="<?php echo $p["code"] ?>" width="150px">

                        <?php
                        } else {
                        ?>

                            <img src="resources/demoProfileImg.jpg" width="150px" class="rounded mt-5">

                        <?php
                        }


                        ?>
                        <span class="font-weight-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                        <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input class="d-none" type="file" id="profileimg" accept="img/*">
                        <label class="btn btn-primary mt-3" for="profileimg">Update Profile Image</label>
                    </div>
                </div>

                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>

                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input id="fname" class="form-control" type="text" placeholder="first name" value="<?php echo $_SESSION["u"]["fname"]; ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input id="lname" class="form-control" type="text" placeholder="last name" value="<?php echo $_SESSION["u"]["lname"]; ?>" />
                            </div>

                        </div>

                        <div class="row mt-3">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input id="mobile" class="form-control" type="text" placeholder="Enter Phone Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <input id="password" class="form-control" type="text" placeholder="Enter Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input id="email" class="form-control" type="text" placeholder="Enter Email Id" readonly value="<?php echo $_SESSION["u"]["email"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date & Time</label>
                                <input id="register_date" class="form-control" type="text" placeholder="Registered Date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                            </div>

                            <?php

                            $username = $_SESSION["u"]["email"];
                            $saddressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $username . "' ");
                            $n = $saddressrs->num_rows;

                            if ($n == 1) {
                                $d = $saddressrs->fetch_assoc();


                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 1</label>
                                    <input id="line1" class="form-control" type="text" placeholder="Enter Address Line 1" value="<?php echo $d["line1"] ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 2</label>
                                    <input id="line2" class="form-control" type="text" placeholder="Enter Address Line 2" value="<?php echo $d["line2"] ?>" />
                                </div>

                        </div>

                        <div class="row mb-3">

                            <?php

                                $cityid = $d["city_id"];
                                $ucity = Database::search("SELECT * FROM `city` WHERE `id` = '" . $cityid . "' ");
                                $c = $ucity->fetch_assoc();

                                $districtid = $c["district_id"];
                                $udist = Database::search("SELECT * FROM `district` WHERE `id` = '" . $districtid . "' ");
                                $k = $udist->fetch_assoc();

                                $provinceid = $k["province_id"];
                                $uprovince = Database::search("SELECT * FROM `province` WHERE `id` = '" . $provinceid . "' ");
                                $l = $uprovince->fetch_assoc();

                            ?>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <select class="form-select " id="city">
                                    <option value="<?php echo $c["id"]; ?>"><?php echo $c["name"]; ?></option>
                                    <?php
                                    $citys = Database::search("SELECT * FROM `city` WHERE `id` !='" . $c["id"] . "' ");
                                    $cn = $citys->num_rows;
                                    for ($r = 0; $r < $cn; $r++) {
                                        $cr = $citys->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $cr["id"]; ?>"><?php echo $cr["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Province</label>
                                <select class="form-select " id="province">
                                    <option value="<?php echo $l["id"]; ?>"><?php echo $l["name"]; ?></option>
                                    <?php
                                    $provincers = Database::search("SELECT * FROM `province` WHERE `id` !='" . $l["id"] . "' ");
                                    $pn = $provincers->num_rows;
                                    for ($i = 0; $i < $pn; $i++) {
                                        $pr = $provincers->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $pr["id"]; ?>"><?php echo $pr["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">District</label>
                                <select class="form-select " id="district">
                                    <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>
                                    <?php
                                    $districts = Database::search("SELECT * FROM `district` WHERE `id` !='" . $k["id"] . "' ");
                                    $dn = $districts->num_rows;
                                    for ($j = 0; $j < $dn; $j++) {
                                        $dr = $districts->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal Code</label>
                                <input class="form-control" type="text" id="postalcode" value="<?php echo $c["postal_code"]; ?>" />
                            </div>


                        <?php
                            } else {

                        ?>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 01</label>
                                <input id="line1" type="text" class="form-control" placeholder="Enter address line 01" value="" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 02</label>
                                <input id="line2" type="text" class="form-control" placeholder="Enter address line 02" value="" />
                            </div>
                            <div class="row mt-3">

                                <div class="col-md-6">
                                    <label class="form-label">Province</label>

                                    <select class="form-select" id="province">
                                        <?php
                                        $newprovince = Database::search("SELECT * FROM `province`;");
                                        $newprovincerows = $newprovince->num_rows;
                                        for ($x = 0; $x < $newprovincerows; $x++) {
                                            $newprovincedata = $newprovince->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $newprovincedata["id"]; ?>"><?php echo $newprovincedata["name"]; ?></option>


                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">District</label>

                                    <select class="form-select" id="district">
                                        <?php
                                        $newdistrict = Database::search("SELECT * FROM `district`;");
                                        $newdistrictrows = $newdistrict->num_rows;
                                        for ($x = 0; $x < $newdistrictrows; $x++) {
                                            $newdistrictdata = $newdistrict->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $newdistrictdata["id"]; ?>"><?php echo $newdistrictdata["name"]; ?></option>


                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label class="form-label">City</label>

                                    <select class="form-select" id="city">
                                        <?php
                                        $newcity = Database::search("SELECT * FROM `city`;");
                                        $newcityrows = $newcity->num_rows;
                                        for ($x = 0; $x < $newcityrows; $x++) {
                                            $newcitydata = $newcity->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $newcitydata["id"]; ?>"><?php echo $newcitydata["name"]; ?></option>


                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label class="form-label">Postal Code</label>
                                    <input id="postalcode" type="text" class="form-control" placeholder="Enter Your Postal Code" />
                                </div>
                            </div>
                        <?php

                            }
                        ?>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <?php

                            $gender_id = $_SESSION["u"]["gender_id"];
                            $ugender = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gender_id . "' ");
                            $g = $ugender->fetch_assoc();

                            ?>

                            <input type="text" class="form-control" placeholder="Gender" value="<?php echo $g["name"] ?>" readonly />
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                        </div>


                        <!-- </div> -->
                        </div>
                    </div>
                </div>
            <?php

        } else {
            ?>
                <script>
                    window.location = "index.php";
                </script>
            <?php
        }

            ?>

            <div class="col-md-4">
                <div class="row">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="fw-bold">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-secondary"></span>
                            <p>4.1 average based on 254 reviews.</p>
                            <hr class="hrbreake1">
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="row">

                                <div class="col-12 col-md-12">
                                    <div class="side">
                                        <div>5 Star</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">150</div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="side">
                                        <div>4 Star</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">63</div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="side">
                                        <div>3 Star</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">15</div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="side">
                                        <div>2 Star</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 5%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">6</div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="side">
                                        <div>1 Star</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="text-end">20</div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>

            </div>


            </div>

        </div>

        <?php

        require "footer.php";

        ?>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>


</html>