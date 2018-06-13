<?php

session_start();

require_once("../config.php");

$name = $_POST["templateName"];
$desc = $_POST["templateDesc"];
$attr = $_POST["a"];
$creator = $_SESSION["userid"];

$insert = $conn->prepare('INSERT INTO Templates (Creator, Name, Description) VALUES (:creator, :name, :desc)');
$insert->bindParam(':creator', $creator, PDO::PARAM_INT);
$insert->bindParam(':name', $name, PDO::PARAM_STR);
$insert->bindParam(':desc', $desc, PDO::PARAM_STR);
$insert->execute();

$id = $conn->lastInsertId();

$inserta = $conn->prepare('INSERT INTO attributes (Name, Template) VALUES (:name, :template)');
$inserta->bindParam(':template', $id, PDO::PARAM_INT);

foreach($attr as $a) {
    $inserta->bindParam(':name', $a, PDO::PARAM_STR);
    $inserta->execute();
}

?>

<p>Template created successfully. You can <a href="../index.php">go back to the dashboard</a> or <a href="../newadventure.php?t=<?php echo $id ?>">create a new adventure with this template right away.</a></p>