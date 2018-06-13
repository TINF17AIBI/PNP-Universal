<?php 

$getHero = $conn->prepare('SELECT * FROM Heroes WHERE Adventure = :adventure AND Owner = :owner');
$getHero->bindParam(':adventure', $adventure["ID"], PDO::PARAM_INT);
$getHero->bindParam(':owner', $_SESSION["userid"], PDO::PARAM_INT);
$getHero->execute();
$hero = $getHero->fetch();

$getAttributes = $conn->prepare('SELECT * FROM AttributeOwnership WHERE Hero = :hero');
$getAttributes->bindParam(':hero', $hero["ID"], PDO::PARAM_INT);
$getAttributes->execute();
$attributes = $getAttributes->fetchAll();

$getItems = $conn->prepare('SELECT * FROM Items WHERE Hero = :hero ORDER BY Type DESC');
$getItems->bindParam(':hero', $hero["ID"], PDO::PARAM_INT);
$getItems->execute();
$items = $getItems->fetchAll();

$getGM = $conn->prepare('SELECT * FROM Users WHERE ID = :gm');
$getGM->bindParam(':gm', $adventure["GameMaster"], PDO::PARAM_INT);
$getGM->execute();
$gamemaster = $getGM->fetch();

$getPlayers = $conn->prepare('SELECT * FROM joinedadventures WHERE Adventure = :adv');
$getPlayers->bindParam(':adv', $adventure["ID"], PDO::PARAM_INT);
$getPlayers->execute();
$players = $getPlayers->fetchAll();

$getPlayerUsername = $conn->prepare('SELECT Username FROM Users WHERE ID = :id');

$getPlayerHeroname = $conn->prepare('SELECT Name FROM Heroes WHERE ID = :id');

?>

<div class="container">
    
    <h1 class="display-4 my-3">Play</h1>
    
    <div class="row">
        
        <div class="col">
        
        <h1><?php echo $hero["Name"]; ?></h1>
        <p><?php echo $hero["Description"]; ?></p>
            
        <h3>Attributes</h3>
        <table class="table table-sm table-dark table-hover">
            <thead>
                <th scope="col">Attribute</th>
                <th scope="col">Value</th>
            </thead>
            <tbody>
                <?php foreach($attributes as $a) { ?>
                <tr>
                    <td><?php echo $a["Attribute"]; ?></td>
                    <td><?php echo $a["Val"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            
        <h3>Inventory</h3>
        <table class="table table-sm table-dark table-hover">
            <thead>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">#</th>
            </thead>
            <tbody>
                <?php foreach($items as $i) { ?>
                <tr>
                    <td><?php echo $i["Type"]; ?></td>
                    <td><?php echo $i["Name"]; ?></td>
                    <td><?php echo $i["Count"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            
        </div>
        
        <div class="col">
            
            <h1>Dice</h1>
            
            <form>
                <div class="form-row">
                    <div class="col">
                        <label for="dicesides">Sides:</label>
                        <input type="number" class="form-control bg-dark border-dark text-light" id="dicesides" value="20">
                    </div>
                    <div class="col">
                        <label for="dicesides"># of dice:</label>
                        <input type="number" class="form-control bg-dark border-dark text-light" id="dicecount" value="1">
                    </div>
                </div>
            </form>
            
            <button type="button" class="btn btn-secondary mt-3" onclick="rolldice();">Roll</button>
            
            <p class="mt-3">You rolled: <span id="roll" class="font-weight-bold"></span></p>
            
            <script>   
                function rolldice() {
                    let sides = document.getElementById('dicesides').value;
                    let count = document.getElementById('dicecount').value;
                    let result = "";
                    
                    for(let i = 0; i < count; i++) {
                        let roll = Math.floor((Math.random() * sides) + 1);
                        if(result == "") {
                            result = roll.toString();
                        } else {
                            result = result.concat(" + " + roll.toString());
                        }
                    }
                    
                    document.getElementById('roll').innerHTML = result;
                }
            </script>
            
        
        </div>
        
    </div>
    
    <hr class="border-dark my-5">
    
    <div class="row">
        
        <div class="col">
            
            <h3><?php echo $adventure["Name"]; ?></h3>
            <p><?php echo $adventure["Description"]; ?></p>
            
        </div>
        
        <div class="col">
            
            <h3>Game Master</h3>
            <p><?php echo $gamemaster["Username"]; ?></p>
            
            <h3>Players</h3>
            <p>
            <?php foreach($players as $p) { 
                $getPlayerUsername->bindParam(':id', $p["User"], PDO::PARAM_INT);
                $getPlayerUsername->execute();
                $username = $getPlayerUsername->fetch();
                $getPlayerHeroname->bindParam(':id', $p["Hero"], PDO::PARAM_INT);
                $getPlayerHeroname->execute();
                $heroname = $getPlayerHeroname->fetch(); ?>
                
                <strong><?php echo $heroname[0]; ?></strong> (<?php echo $username[0]; ?>)
                
            <?php } ?>
            </p>
            
            <h3>Invite Code</h3>
            <p><?php echo $adventure["InviteCode"]; ?></p>
        </div>
        
    </div>
    
</div>