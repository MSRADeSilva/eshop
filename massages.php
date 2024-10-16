<?php

session_start();

if (isset($_SESSION["u"])) {

    $customer = $_SESSION["u"]["email"];
    $email = $_GET["email"];

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

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

        <div class="container-fluid">
            <div class="row">

                <?php require "header.php"; ?>

                <div class="row">
                    <hr>
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row rounded overflow-hidden shadow">
                        <div class="col-5 px-0">
                            <div class="bg-white">

                                <div class="bg-light px-4 py-2">
                                    <h5 class="mb-0 py-1">Resent</h5>
                                </div>

                                <div class="massage-box">
                                    <div class="list-group rounded-0 ">
                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">
                                            <div class="media">
                                                <img src="resources/demoProfileImg.jpg" width="50px" class="rounded-circle">
                                                <div class="me-4">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <h6 class="mb-0">Kamal</h6>
                                                        <small class="small fw-bold">01-10</small>
                                                    </div>
                                                    <p class="mb-0">Got the Product.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-7 px-0">
                            <div class="row px-4 py-5 text-white chatbox">

                                <!-- sender's massaage -->

                                <div class="media mb-3 w-50">
                                    <img src="resources/demoProfileImg.jpg" width="50px" class="rounded-circle mb-1">
                                    <div class="media-body  me-3">
                                        <div class="bg-light rounded py-2 px-3 md-2">
                                            <p class="mb-0 text-black-50">Got it. Thankyou!</p>
                                        </div>
                                        <p class="small text-black-50 text-end">12:00 | 10.10.2021</p>
                                    </div>
                                </div>

                                <!-- sender's massaage -->

                                <!-- resiver's massaage -->

                                <div class="media w-50 mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="mb-0 text-white">Have You Got the Product?</p>
                                        </div>
                                        <p class="small text-black-50">12:00 | 10.10.2021</p>

                                    </div>
                                </div>

                                <!-- resiver's massaage -->

                                <!-- text -->

                                <div class="col-12">
                                    <div class="row">
                                        <div class="input-group">
                                            <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                            <div class="input-group-append">
                                                <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- text -->

                            </div>
                        </div>

                    </div>
                </div>

                <?php require "footer.php"; ?>

            </div>
        </div>


        <script src="script.js"></script>


    </body>


    </html>

<?php

}

?>