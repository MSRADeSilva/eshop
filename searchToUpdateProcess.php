<?php
require "connection.php";


if(isset($_GET["id"])){
    $id = $_GET["id"];

    if(empty($id)){
        echo "Please enter the Product id";
    }else{
        $prs = Database::search("SELECT * FROM `product` WHERE `id` = '".$id."'");
           $n = $prs->num_rows;

        if($n==1){
            $r = $prs->fetch_assoc();
            $array["id"] = $r["id"];
            $array["title"] = $r["title"];
            $array["qty"] = $r["qty"];

            $crs = Database::search("SELECT * FROM `category` WHERE `id` = '".$r["category_id"]."'");
            if($crs->num_rows == 1){
                $cr = $crs->fetch_assoc();
                $array["category"] = $cr["name"];
            }
            
           echo json_encode($array);

        }else{
            echo "Invalid product id";
        }
           
    }

}
