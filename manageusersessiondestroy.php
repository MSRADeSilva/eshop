<?php
session_start();

if (isset($_SESSION["k"])) {
    $_SESSION["k"] = null;
    session_destroy();
    echo "success";
}
