<?php 

session_start();

require_once("../../config.php");

$name = $_POST["adventureName"];
$desc = $_POST["adventureDesc"];
$template = $_POST["templateId"];
$creator = $_SESSION["userid"];
$invite = $_POST["inviteCode"];

$checkInvite = $conn->prepare('SELECT * FROM Adventures WHERE InviteCode = :invite');
$checkInvite->bindParam(':invite', $invite, PDO::PARAM_STR);
$checkInvite->execute();
if(!empty($checkInvite->fetch())) {
    echo "Invite code already exists. Please hit \"back\" on your browser and enter another one.";
    die();
}

$insert = $conn->prepare('INSERT INTO Adventures (Name, Template, GameMaster, InviteCode, Description) VALUES (:name, :template, :gm, :invite, :desc)');
$insert->bindParam(':name', $name, PDO::PARAM_STR);
$insert->bindParam(':desc', $desc, PDO::PARAM_STR);
$insert->bindParam(':invite', $invite, PDO::PARAM_STR);
$insert->bindParam(':template', $template, PDO::PARAM_INT);
$insert->bindParam(':gm', $creator, PDO::PARAM_INT);
$insert->execute();

?>

<p>Adventure created successfully. <a href="../index.php">Return to dashboard.</a></p>