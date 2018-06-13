<?php require_once("pages/navbar.php");
require_once("config.php");

$getAdventure = $conn->prepare('SELECT * FROM Adventures WHERE InviteCode = :invite');
$getAdventure->bindParam(':invite', $_POST["invitecode"], PDO::PARAM_STR);
$getAdventure->execute();
$adventure = $getAdventure->fetch();

if(empty($adventure)) {
    echo "Adventure not found. <a href=\"/PNP-Universal/index.php\">Return to dashboard.</a>";
    die();
}

if($adventure["GameMaster"] == $_SESSION["userid"]) {
    echo "Can't join own adventure. <a href=\"/PNP-Universal/index.php\">Return to dashboard.</a>";
    die();
}

$checkIfJoined = $conn->prepare('SELECT * FROM joinedadventures WHERE User = :user AND Adventure = :adventure');
$checkIfJoined->bindParam(':user', $_SESSION["userid"], PDO::PARAM_INT);
$checkIfJoined->bindParam(':adventure', $adventure["ID"], PDO::PARAM_INT);
$checkIfJoined->execute();
$joined = $checkIfJoined->fetch();

if(!empty($joined)) {
    echo "Already joined. <a href=\"/PNP-Universal/index.php\">Return to dashboard.</a>";
    die();
}

$getGM = $conn->prepare('SELECT Username FROM Users WHERE id = :id');
$getGM->bindParam(':id', $adventure["GameMaster"], PDO::PARAM_INT);
$getGM->execute();
$gameMaster = $getGM->fetch();

$getTemplate = $conn->prepare('SELECT * FROM Templates WHERE id = :id');
$getTemplate->bindParam(':id', $adventure["Template"], PDO::PARAM_INT);
$getTemplate->execute();
$template = $getTemplate->fetch();

$getAttributes = $conn->prepare('SELECT * FROM Attributes WHERE Template = :template');
$getAttributes->bindParam(':template', $template["ID"], PDO::PARAM_INT);
$getAttributes->execute();
$attributes = $getAttributes->fetchAll();

?>

<div class="container">
    <h1 class="display-4 my-3">Create Hero</h1>

    <p>Joining adventure: <strong><?php echo $adventure["Name"]; ?></strong> by <?php echo $gameMaster[0]; ?></p>

    <div class="row">

    <div class="col">
        <form action="pages/createhero.php" method="post">
            <div class="form-group">
                <label for="heroName">Name</label>
                <input type="text" class="form-control" id="heroName" name="heroName" required>
            </div>
            <div class="form-group">
                <label for="heroDesc">Description</label>
                <textarea class="form-control" id="heroDesc" name="heroDesc" rows="3"></textarea>
            </div>

            <?php foreach($attributes as $a) { ?>
                <div class="form-group row">
                    <label class="col col-form-label"><?php echo $a["Name"]; ?></label>
                    <div class="col">
                      <input type="number" class="form-control" name="<?php echo $a["Name"]; ?>" required>
                    </div>
                  </div>
            <?php } ?>

            <input type="hidden" name="template" value="<?php echo $adventure["Template"]; ?>">
            <input type="hidden" name="adventure" value="<?php echo $adventure["ID"]; ?>">

           <button type="submit" class="btn btn-success my-3">Create</button>
        </form>
    </div>

    <div class="col">
        <h3>Adventure description:</h3>
        <p><?php echo $adventure["Description"]; ?></p>

        <h3 class="mt-3">Template description:</h3>
        <p><?php echo $template["Description"]; ?></p>
    </div>

    </div>


  </body>
</html>
