<?php

session_start();

$user = $_SESSION["u"];

$array;

require "connection.php";

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$pageno = $_POST["p"];

$result_per_page = 6;


if (!empty($search) && $age != 0) {
    if ($age == 1) {

        $prs = Database::search("SELECT * FROM `product`
         WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC ");

        $ans = $prs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' 
        AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC 
         LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    } else if ($age == 2) {

        $prs = Database::search("SELECT * FROM `product`
        WHERE `user_email`='" . $user["email"] . "' AND `title` 
        LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC");

        $ans = $prs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' 
AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC 
LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    }
} else if (!empty($search)) {
    $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'
     AND `title` LIKE '%" . $search . "%'");


    $ans = $products->num_rows;

    $number_of_pages = ceil($ans / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;

    $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' 
    AND `title` LIKE '%" . $search . "%'  
    LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
} else if ($age != 0) {
    if ($age == 1) {
        $prs = Database::search("SELECT * FROM `product`WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC");

        $ans = $prs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' 
        ORDER BY `datetime_added` DESC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "  ");
    } else if ($age == 2) {
        $prs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC");

        $ans = $prs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '"  . $user["email"] . "' ORDER BY `datetime_added` ASC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    }
} else if (!empty($search) && $qty != 0) {
    if ($qty == 1) {
        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'  AND `title` LIKE '%" . $search . "%' ORDER BY `qty` DESC");

        $ans = $qtyrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "'  AND  `title` LIKE '%" . $search . "%'  ORDER BY `qty` DESC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
    } else if ($qty == 2) {

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'  AND  `title` LIKE '%" . $search . "%' ORDER BY `qty`  ASC;");
        $ans = $qtyrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' AND  `title` LIKE '%" . $search . "%'  ORDER BY `qty`  ASC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    } else {
        echo "No Result.....";
    }
} else if ($qty != 0) {
    if ($qty == 1) {
        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'   ORDER BY `qty` DESC");

        $ans = $qtyrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "'    ORDER BY `qty` DESC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
    } else if ($qty == 2) {

        $qtyrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'  ORDER BY `qty`  ASC;");
        $ans = $qtyrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "'   ORDER BY `qty`  ASC  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    } else {
        echo "No Result.....";
    }
} else if ($condition != 0) {
    if ($condition == 1) {
        $conrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id` = '" . $condition . "'  ");

        $ans = $conrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' AND `condition_id` = '" . $condition . "'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
    } else if ($condition == 2) {

        $conrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id` = '" . $condition . "'");
        $ans = $conrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "'   AND `condition_id` = '" . $condition . "'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    } else {
        echo "No Result.....";
    }
} else if (!empty($search) && $condition != 0) {
    if ($condition == 1) {
        $conrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id` = '" . $condition . "'  AND `title` LIKE '%" . $search . "%'  ");

        $ans = $conrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' AND `condition_id` = '" . $condition . "'  AND `title` LIKE '%" . $search . "%'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
    } else if ($condition == 2) {

        $conrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id` = '" . $condition . "'  AND `title` LIKE '%" . $search . "%'");
        $ans = $conrs->num_rows;

        $number_of_pages = ceil($ans / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;

        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "'   AND `condition_id` = '" . $condition . "'  AND `title` LIKE '%" . $search . "%'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    } else {
        echo "No Result.....";
    }
}

$srn = $selectedrs->num_rows;
for ($i = 0; $i < $srn; $i++) {
    $srow = $selectedrs->fetch_assoc();
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



<!-- pagination -->

<div class="col-12 mb-3" id="pro_view">
    <div class="row">
        <div class="justify-content-center d-flex">
            <div class="pagination">
                <a <?php

                    if ($pageno <= 1) {
                        echo "#";
                    } else {
                    ?> onclick="addFilters('<?php echo ($pageno - 1) ?>');" <?php
                                                                        }

                                                                            ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $number_of_pages; $page++) {

                    if ($page == $pageno) {
                ?>
                        <a onclick="addFilters('<?php echo $page ?>');" class="ms-1 active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>

                        <a onclick="addFilters('<?php echo $page ?>');" class="ms-1"><?php echo $page; ?></a>

                <?php
                    }
                }

                ?>
                <a <?php

                    if ($pageno >= $number_of_pages) {
                        echo "#";
                    } else {
                    ?> onclick="addFilters('<?php echo ($pageno + 1) ?>');" <?php
                                                                        }

                                                                            ?>>&raquo;</a>
            </div>
        </div>
    </div>
</div>

<!-- pagination -->

</div>
</div>