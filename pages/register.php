<?php

    require_once("../config.php");

    if(!isset($_POST["reg-username"]) || !isset($_POST["reg-password"]) || !isset($_POST["reg-repeat"])) { ?>

    <p>Please fill in all fields. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $login = $_POST["reg-username"];
    $password = $_POST["reg-password"];
    $repeat = $_POST["reg-repeat"];

    if($password != $repeat) { ?>

    <p>Passwords do not match. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $lookupUser = $conn->prepare('SELECT * FROM Users WHERE Username = :username');
    $lookupUser->bindParam(':username', $login, PDO::PARAM_STR);
    $lookupUser->execute();
    $existingUser = $lookupUser->fetchAll();

    if(count($existingUser) != 0) { ?>

    <p>User already exists. <a href="../index.php">Return to home page</a></p>

<?php die(); }

    $createUser = $conn->prepare('INSERT INTO Users (Username, Password) VALUES (:login, :password)');
    $createUser->bindParam(':login', $login, PDO::PARAM_STR);
    $createUser->bindParam(':password', $hash, PDO::PARAM_STR);
    $createUser->execute();

?>

<p>User created. <a href="../index.php">Return to home page</a></p>
