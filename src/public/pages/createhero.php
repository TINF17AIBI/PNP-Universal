<?php 

session_start();

require_once("../../config.php");

$adventure = $_POST["adventure"];
$name = $_POST["heroName"];
$desc = $_POST["heroDesc"];
$template = $_POST["template"];
$user = $_SESSION["userid"];

$getTemplateAttributes = $conn->prepare('SELECT Name FROM Attributes WHERE Template = :template');
$getTemplateAttributes->bindParam(':template', $template, PDO::PARAM_INT);
$getTemplateAttributes->execute();
$templateAttributes = $getTemplateAttributes->fetchAll();

$attributes = [];

foreach($templateAttributes as $t) {
    $attributes[] = ["name" => $t[0], "val" => $_POST[$t[0]]];
}

$createHero = $conn->prepare('INSERT INTO Heroes (Name, Adventure, Template, Owner, Description) VALUES (:name, :adventure, :template, :owner, :description)');
$createHero->bindParam(':name', $name, PDO::PARAM_STR);
$createHero->bindParam(':description', $desc, PDO::PARAM_STR);
$createHero->bindParam(':adventure', $adventure, PDO::PARAM_INT);
$createHero->bindParam(':template', $template, PDO::PARAM_INT);
$createHero->bindParam(':owner', $user, PDO::PARAM_INT);
$createHero->execute();

$heroId = $conn->lastInsertId();

$insertValues = $conn->prepare('INSERT INTO attributeownership (Attribute, Hero, Val) VALUES (:attr, :hero, :val)');
$insertValues->bindParam(':hero', $heroId, PDO::PARAM_INT);

foreach($attributes as $a) {
    $insertValues->bindParam(':attr', $a["name"], PDO::PARAM_STR);
    $insertValues->bindParam(':val', $a["val"], PDO::PARAM_INT);
    $insertValues->execute();
}

$joinAdventure = $conn->prepare('INSERT INTO joinedadventures (Adventure, User, Hero) VALUES (:adventure, :user, :hero)');
$joinAdventure->bindParam(':adventure', $adventure, PDO::PARAM_INT);
$joinAdventure->bindParam(':user', $user, PDO::PARAM_INT);
$joinAdventure->bindParam(':hero', $heroId, PDO::PARAM_INT);
$joinAdventure->execute();

?>

<p>Hero created successfully. <a href="../index.php">Return to dashboard</a></p>