<?php require_once("pages/navbar.php"); 
require_once("../config.php");

$getAdventure = $conn->prepare("SELECT * FROM Adventures WHERE ID = :id");
$getAdventure->bindParam(':id', $_GET["a"], PDO::PARAM_INT);
$getAdventure->execute();
$adventure = $getAdventure->fetch();

if($adventure["GameMaster"] == $_SESSION["userid"]) {
    require_once("pages/gamemaster.php");
} else {
    require_once("pages/player.php");
}

?>