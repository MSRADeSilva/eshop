<?php

session_start();

require "connection.php";
$pageno;
if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];

    if (isset($_GET["email"])) {

        $msgemail = $_GET["email"];
    }


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Admin | Manage Users</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100vh;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light text-center rounded">
                    <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
                </div>

                <div class="col-12 bg-light rounded mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 my-3">
                            <div class="row">
                                <div class="col-9">
                                    <input id="searchtxt" type="text" class="form-control">
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-primary" onclick="searchUser();">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-2">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                            <span class="fs-4 fw-bold text-white">#</span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-dark">Profile Image</span>
                        </div>
                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Email</span>
                        </div>
                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 ">
                            <span class="fs-4 fw-bold text-Registered Date">User Name</span>
                        </div>
                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Mobile</span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-Registered Date">Registered Date</span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white pt-2 pb-2"></div>
                    </div>
                </div>

                <?php


                if (isset($_SESSION["k"])) {

                    $u = $_SESSION["k"];
                ?>
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end" onclick="viewmsgmodal('<?php echo $u['email'] ?>');">
                                <span class="fs-4 fw-bold text-white">1</span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block text-center" onclick="viewmsgmodal();">
                                <img src="resources/demoProfileImg.jpg" style="height: 70px;">
                            </div>
                            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-6 fw-bold text-white"><?php echo $u["email"]; ?></span>
                            </div>
                            <div class="col-6 col-lg-2 bg-light pt-2 pb-2 ">
                                <span class="fs-5 fw-bold text-Registered Date"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                            </div>
                            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold text-white"><?php echo $u["mobile"]; ?></span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold text-Registered Date"><?php
                                                                                $rd = $u["register_date"];
                                                                                $splitrd = explode(" ", $rd);
                                                                                echo $splitrd[0];
                                                                                ?></span>
                            </div>
                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">

                                <?php
                                $s = $u["status_id"];

                                if ($s == "1") {
                                ?>
                                    <button id="blockbtn<?php echo  $u['email']; ?>" class="btn btn-danger" onclick="blockuser('<?php echo  $u['email']; ?>');">Block</button>

                                <?php

                                } else {
                                ?>
                                    <button id="blockbtn<?php echo  $u['email']; ?>" class="btn btn-success" onclick="blockuser('<?php echo  $u['email']; ?>');">Unblock</button>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <?php

                } else {


                    if (!isset($_GET["page"])) {
                        $pageno = 1;
                    } else {
                        $pageno = $_GET["page"];
                    }

                    $usersrs = Database::search("SELECT * FROM `product` ");
                    $d = $usersrs->num_rows;
                    $row = $usersrs->fetch_assoc();

                    $results_per_page = 20;

                    $number_of_pages = ceil($d / $results_per_page);

                    // echo $d;

                    // echo $d;
                    // echo "<br/>";
                    // echo $number_of_pages;



                    $page_first_results = ((int)$pageno - 1) * $results_per_page;

                    $selectedrs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_first_results . "  ");
                    $srn = $selectedrs->num_rows;

                    $c = "0";

                    while ($srow = $selectedrs->fetch_assoc()) {


                        $c = $c + 1;

                    ?>

                        <div class="col-12 mb-2">
                            <div class="row" onclick="adminrefresher('<?php echo $srow['email']; ?>');">
                                <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end" onclick="viewmsgmodal('<?php echo $srow['email'] ?>');">
                                    <span class="fs-4 fw-bold text-white"><?php echo $c ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block text-center" onclick="viewmsgmodal('<?php echo $srow['email'] ?>');">
                                    <img src="resources/demoProfileImg.jpg" style="height: 70px;">
                                </div>
                                <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block" onclick="viewmsgmodal('<?php echo $srow['email'] ?>');">
                                    <span class="fs-6 fw-bold text-white"><?php echo $srow["email"]; ?></span>
                                </div>
                                <div class="col-6 col-lg-2 bg-light pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold text-Registered Date"><?php echo $srow["fname"] . " " . $srow["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"]; ?></span>
                                </div>
                                <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                    <span class="fs-5 fw-bold text-Registered Date"><?php
                                                                                    $rd = $srow["register_date"];
                                                                                    $splitrd = explode(" ", $rd);
                                                                                    echo $splitrd[0];
                                                                                    ?></span>
                                </div>
                                <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">

                                    <?php
                                    // $s = $srow["status_id"];

                                    // if ($s == "1") {
                                    ?>
                                    <button id="blockbtn<?php echo  $srow['email']; ?>" class="btn btn-danger" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>

                                    <?php

                                    // } else {
                                    ?>
                                    <button id="blockbtn<?php echo  $srow['email']; ?>" class="btn btn-success" onclick="blockuser('<?php echo  $srow['email']; ?>');">Unblock</button>

                                    <?php
                                    // }
                                    ?>

                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade modal-dialog-scrollable" id="msgmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- modal body -->

                                        <div class="col-12 py-5 px-4 ">
                                            <div class="row rounded-lg bg-white overflow-hidden shadow">
                                                <div class="col-12 px-0">
                                                    <div class="bg-white">

                                                        <div class="bg-gray px-4 py-2 bg-light">
                                                            <p class="h5 mb-0 py-1">Recent</p>
                                                        </div>

                                                        <div class="messages-box">
                                                            <div class="list-group rounded-0" id="rcv2<?php echo $srow["email"]; ?>">



                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- massage box -->
                                                <div class="col-12 px-0">
                                                    <div class="row px-4 py-5 chat-box bg-white" id="chatrow2<?php echo $srow["email"]; ?>" style="overflow-y: scroll; height: 400px;">
                                                        <!-- massage load venne methana -->


                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row bg-white">

                                                        <!-- text -->
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="input-group">
                                                                    <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded border-0 mb-3 py-3 bg-light">
                                                                    <div class="input-group-append">
                                                                        <button id="button-addon2" class="btn btn-link fs-1" onclick="adminsendmessage('<?php echo $srow['email']; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- text -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- modal body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->


                    <?php
                    }
                    ?>


                    <div class="col-12 text-center fs-5 fw-bold mt-3 mb-3">
                        <div class="pagination">
                            <a href="<?php
                                        if ($pageno <= 1) {
                                            echo '#';
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

                <?php
                }
                ?>

                <div class="col-12  btn-toolbar  justify-content-end mb-4 ">
                    <button class="btn btn-danger" onclick="clearallsearch();">Clear All</button>
                </div>




                <?php require "footer.php"; ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>