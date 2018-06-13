<?php

    session_start();

    require_once("../config.php");

    if(!isset($_POST["old"]) || !isset($_POST["new"]) || !isset($_POST["repeat"])) { ?>

    <p>Please fill in all fields. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $old = $_POST["old"];
    $new = $_POST["new"];
    $repeat = $_POST["repeat"];

    if($new != $repeat) { ?>

    <p>Passwords do not match. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $getUser = $conn->prepare('SELECT * FROM Users WHERE ID = :id');
    $getUser->bindParam(':id', $_SESSION["userid"], PDO::PARAM_INT);
    $getUser->execute();
    $user = $getUser->fetch();

    if(!password_verify($old, $user["Password"])) { ?>

    <p>Old password incorrect. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $hash = password_hash($new, PASSWORD_DEFAULT);

    $changepw = $conn->prepare('UPDATE Users SET Password = :pw WHERE ID = :id');
    $changepw->bindParam(':id', $_SESSION["userid"], PDO::PARAM_INT);
    $changepw->bindParam(':pw', $hash, PDO::PARAM_STR);
    $changepw->execute();

?>

<p>Password updated successfully. <a href="../index.php">Return to home page</a></p>
