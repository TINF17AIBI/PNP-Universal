<?php require_once("navbar.php"); 
require_once("../config.php");

$getOwnAdventures = $conn->prepare('SELECT * FROM Adventures WHERE GameMaster = :id');
$getOwnAdventures->bindParam(':id', $_SESSION["userid"], PDO::PARAM_INT);
$getOwnAdventures->execute();
$ownAdventures = $getOwnAdventures->fetchAll();

$getJoinedAdventures = $conn->prepare('SELECT * FROM joinedadventures WHERE User = :user');
$getJoinedAdventures->bindParam(':user', $_SESSION["userid"], PDO::PARAM_INT);
$getJoinedAdventures->execute();
$joinedAdventures = $getJoinedAdventures->fetchAll();

$joined = [];

$getAdventure = $conn->prepare('SELECT * FROM Adventures WHERE ID = :id');
$getHero = $conn->prepare('SELECT * FROM Heroes WHERE Adventure = :adventure');

foreach($joinedAdventures as $j) {
    $getAdventure->bindParam(':id', $j["Adventure"], PDO::PARAM_INT);
    $getAdventure->execute();
    $adv = $getAdventure->fetch();
    $getHero->bindParam(':adventure', $j["Adventure"], PDO::PARAM_INT);
    $getHero->execute();
    $hero = $getHero->fetch();
    $joined[] = ["adv" => $adv, "hero" => $hero];
}

?>
    
    <div class="container">
      <h1 class="display-4 my-3">My Adventures</h1>
      <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#newAdventureModal"><i class="fas fa-plus"></i> Join/Create Adventure</button>
        
        <h3 class="mt-3">Created Adventures</h3>
        
        <?php foreach($ownAdventures as $a) { ?>
        
        <a href="play.php?a=<?php echo $a["ID"] ?>"><div class="card bg-dark text-light my-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $a["Name"]; ?></h5>
                <p class="card-text"><?php echo $a["Description"]; ?></p>
            </div>
        </div></a>
        
        <?php } ?>
        
        <h3 class="mt-3">Joined Adventures</h3>

        <?php foreach($joined as $a) { ?>
        <a href="play.php?a=<?php echo $a["adv"]["ID"] ?>"><div class="card bg-dark text-light my-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $a["adv"]["Name"]; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Hero: <?php echo $a["hero"]["Name"]; ?></h6>
                <p class="card-text"><?php echo $a["adv"]["Description"]; ?></p>
            </div>
        </div></a>
        <?php } ?>

    <div class="modal fade" id="newAdventureModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header">
            <h5 class="modal-title">New Adventure</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="join.php" method="post">
                   <div class="form-group">
                    <label for="invitecode">Invite Code</label>
                    <input type="text" class="form-control" id="invitecode" name="invitecode">
                  </div>
                    <button type="submit" class="btn btn-secondary ">Join Adventure</button>
              </form>
              <p class="text-center">- or -<br>
                <a href="newadventure.php" class="btn btn-secondary mt-3">Create New Adventure</a></p>
              <p class="text-center">- or -<br>
                <a href="newtemplate.php" class="btn btn-secondary mt-3">Create New Template</a></p>
          </div>
        </div>
      </div>
    </div>
    
  </body>
</html>