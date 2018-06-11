<?php 

session_start();

    require_once("../../config.php");

    $login = $_POST["username"];
    $password = $_POST["password"];

    $getUser = $conn->prepare('SELECT * FROM Users WHERE Username = :username');
    $getUser->bindParam(':username', $login, PDO::PARAM_STR);
    $getUser->execute();
    $user = $getUser->fetch();

    $verify = password_verify($password, $user["Password"]);
    if($verify) {
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $user["ID"];
        $_SESSION["username"] = $user["Username"];
    }



    if($_SESSION["loggedin"]) { ?>
        
    <p>Login successful. <a href="../index.php">Return to home page</a></p>

<?php } else { ?>
        
    <p>Login failed. <a href="../index.php">Return to home page</a></p>
        
<?php } 

?>