<?php require_once("pages/navbar.php");
require_once("config.php");

$getAllTemplates = $conn->prepare('SELECT * FROM Templates');
$getAllTemplates->execute();
$templates = $getAllTemplates->fetchAll();

$getTemplateCreator = $conn->prepare('SELECT Username FROM Users WHERE id = :id');

foreach($templates as $t) {
    $getTemplateCreator->bindParam(':id', $t["Creator"], PDO::PARAM_INT);
    $getTemplateCreator->execute();
    $templateCreator = $getTemplateCreator->fetch();
    $t["CreatorName"] = $templateCreator[0];
    $templates2[] = $t;
}

if(isset($_GET["t"])) {
    $getTemplate = $conn->prepare('SELECT * FROM Templates WHERE ID = :id');
    $getTemplate->bindParam(':id', $_GET["t"], PDO::PARAM_INT);
    $getTemplate->execute();
    $template = $getTemplate->fetch();
}


?>

    <div class="container">
      <h1 class="display-4 my-3">New Adventure</h1>

        <form action="newadventure.php" method="get" class="form-inline mb-3">
            <select class="form-control" id="templateSelect" name="t" onchange="this.form.submit();">
              <?php foreach($templates2 as $t) { ?>
                <option value="<?php echo $t["ID"]; ?>"<?php if(isset($_GET["t"]) && $_GET["t"] == $t["ID"]) { echo " selected"; } ?>><?php echo $t["Name"]; ?> (by <?php echo $t["CreatorName"]; ?>)</option>
              <?php } ?>
            </select>
            <button type="submit" class="btn btn-secondary ml-3">Select</button>
        </form>

        <?php if(isset($_GET["t"])) { ?>

        <h3>Creating new adventure with template <?php echo $template["Name"]; ?></h3>

        <p><?php echo $template["Description"]; ?></p>

        <form action="pages/createadventure.php" method="post">
            <div class="form-group">
                <label for="adventureName">Adventure Name</label>
                <input type="text" class="form-control" id="adventureName" name="adventureName" required>
            </div>
            <div class="form-group">
                <label for="adventureDesc">Description</label>
                <textarea class="form-control" id="adventureDesc" name="adventureDesc" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="inviteCode">Invite Code</label>
                <input type="text" class="form-control" id="inviteCode" name="inviteCode" required>
            </div>
            <input type="hidden" name="templateId" value="<?php echo $_GET["t"]; ?>">

            <button type="submit" class="btn btn-success">Create</button>
        </form>

        <?php } ?>

    </div>

  </body>
</html>