<?php

require "connection.php";

$searchText = $_POST["t"];
$searchSelect = $_POST["s"];
$pageno = $_POST["p"];

$result_per_page = 4;

if (!empty($searchText) && $searchSelect == 0) {

    $textSearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%'");
    $ans = $textSearch->num_rows;

    $number_of_pages = ceil($ans / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $selectedrs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n =  $selectedrs->num_rows;
} else if ($searchSelect != 0 && empty($searchText)) {

    $textSearch = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' ");
    $ans = $textSearch->num_rows;

    $number_of_pages = ceil($ans / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $selectedrs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "'   LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n =  $selectedrs->num_rows;
} else if (!empty($searchText) && $searchSelect != 0) {

    $textSearch = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' AND `title` LIKE '%" . $searchText . "%' ");
    $ans = $textSearch->num_rows;

    $number_of_pages = ceil($ans / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $selectedrs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchSelect . "' AND  `title` LIKE '%" . $searchText . "%'   LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n =  $selectedrs->num_rows;
} else {

    $n = 0;
}

if ($n >= 1) {

?>

    <div class="row border border-primary">
        <div class="col-12">
            <div class="row justify-content-center align-content-center" id="pdetails" style="margin-left: auto;margin-right: auto;">
                <?php
                while ($prod = $selectedrs->fetch_assoc()) {

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
    <div class="col-12 justify-content-center d-flex fs-5 fw-bold mt-2">
        <div class="pagination">

            <?php

            if ($pageno != 1) {
            ?>

                <button class="ms-1  btn btn-secondary" onclick="basicsearch(<?php echo $pageno - 1; ?>);">&laquo;</button>
                <?php


            }


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
                ?>
                    <button class="ms-1 btn btn-success active" onclick="basicsearch(<?php echo $page ?>);"><?php echo $page ?></button>

                <?php
                } else {
                ?>
                    <button class="ms-1 btn btn-secondary" onclick="basicsearch(<?php echo $page ?>);"><?php echo $page ?></button>

            <?php

                }
            }
            ?>
            <?php

            if ($pageno < $number_of_pages) {
            ?>
                <button class="ms-1  btn btn-secondary " onclick="basicsearch(<?php echo $pageno + 1; ?>);">&raquo;</button>
            <?php


            }
            ?>



        </div>
    </div>







<?php
} else {
?>
    <div class="col-12 bg-light ms-2 mt-5 mb-5" style="margin-left: auto; margin-right: auto;">
        <h3 class="text-center">No Results in your Searching...</h3>
    </div>
<?php

}
?>