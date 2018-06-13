<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    require_once("pages/dashboard.php");
} else {
    require_once("pages/landing.php");
}

?>