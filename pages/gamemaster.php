<?php 

$getPlayers = $conn->prepare('SELECT * FROM JoinedAdventures WHERE Adventure = :adv');
$getPlayers->bindParam(':adv', $adventure["ID"], PDO::PARAM_INT);
$getPlayers->execute();
$players = $getPlayers->fetchAll();

$getHero = $conn->prepare('SELECT * FROM Heroes WHERE ID = :id');
if(isset($_GET["h"])) {
    $getHero->bindParam(':id', $_GET["h"], PDO::PARAM_INT);
    $getHero->execute();
    $hero = $getHero->fetch();
}

$getAttributes = $conn->prepare('SELECT * FROM AttributeOwnership WHERE Hero = :hero');
$getAttributes->bindParam(':hero', $hero["ID"], PDO::PARAM_INT);
$getAttributes->execute();
$attributes = $getAttributes->fetchAll();

$getItems = $conn->prepare('SELECT * FROM Items WHERE Hero = :hero ORDER BY Type, Name ASC');
$getItems->bindParam(':hero', $hero["ID"], PDO::PARAM_INT);
$getItems->execute();
$items = $getItems->fetchAll();

$getPlayerUsername = $conn->prepare('SELECT Username FROM Users WHERE ID = :id');

$getPlayerHeroname = $conn->prepare('SELECT Name FROM Heroes WHERE ID = :id');

if(isset($_POST["update"])) {
    
    if($_POST["update"] == "desc") {
        $updateDesc = $conn->prepare('UPDATE Heroes SET Description = :desc WHERE ID = :id');
        $updateDesc->bindParam(':desc', $_POST["heroDesc"], PDO::PARAM_STR);
        $updateDesc->bindParam(':id', $_GET["h"]);
        $updateDesc->execute();
    }
    
    if($_POST["update"] == "attr") {
        $updateAttribute = $conn->prepare('UPDATE AttributeOwnership SET Val = :val WHERE (Hero = :hero AND Attribute = :attr)');
        $updateAttribute->bindParam(':hero', $_GET["h"], PDO::PARAM_INT);
        foreach($attributes as $a) {
            $updateAttribute->bindParam(':attr', $a["Attribute"], PDO::PARAM_STR);
            $updateAttribute->bindParam(':val', $_POST[$a["Attribute"]], PDO::PARAM_INT);
            $updateAttribute->execute();
            $getAttributes->execute();
            $attributes = $getAttributes->fetchAll();
        }
    }
    
    if($_POST["update"] == "item") {
        
        $updateItem = $conn->prepare('UPDATE Items SET Name = :name, Type = :type, Count = :count WHERE ID = :id');
        
        foreach($items as $i) {
            $updateItem->bindParam(':id', $i["ID"], PDO::PARAM_INT);
            $updateItem->bindParam(':name', $_POST["name-".$i["ID"]], PDO::PARAM_STR);
            $updateItem->bindParam(':type', $_POST["type-".$i["ID"]], PDO::PARAM_STR);
            $updateItem->bindParam(':count', intval($_POST["count-".$i["ID"]]), PDO::PARAM_INT);
            $updateItem->execute();
        }
        
        if(isset($_POST["newname"])) {
            $addNewItem = $conn->prepare('INSERT INTO Items (Hero, Name, Type, Count) VALUES (:hero, :name, :type, :count)');
            $addNewItem->bindParam(':hero', $_GET["h"], PDO::PARAM_INT);

            $new = max(count($_POST["newtype"]), count($_POST["newname"]), count($_POST["newcount"]));
            for($i = 0; $i < $new; $i++) {
                if($_POST["newtype"][$i] != "" && $_POST["newname"][$i] != "" && $_POST["newcount"][$i] != "") {
                    $addNewItem->bindParam(':name', $_POST["newname"][$i], PDO::PARAM_STR);
                    $addNewItem->bindParam(':type', $_POST["newtype"][$i], PDO::PARAM_STR);
                    $addNewItem->bindParam(':count', $_POST["newcount"][$i], PDO::PARAM_INT);
                    $addNewItem->execute();
                }
            }
        }
        
        $getItems->execute();
        $items = $getItems->fetchAll();
        
    }
}

?>

<div class="container">
    
    <h1 class="display-4 my-3">Play</h1>
    
    <form class="form-inline mb-3" action="play.php" method="GET">
        <input type="hidden" name="a" value="<?php echo $_GET["a"]; ?>">
        <select name="h" class="form-control bg-dark border-dark text-light" id="heroselect">
            <?php foreach($players as $p) { 
            $getPlayerUsername->bindParam(':id', $p["User"], PDO::PARAM_INT);
            $getPlayerUsername->execute();
            $username = $getPlayerUsername->fetch();
            $getPlayerHeroname->bindParam(':id', $p["Hero"], PDO::PARAM_INT);
            $getPlayerHeroname->execute();
            $heroname = $getPlayerHeroname->fetch(); ?>

            <option value="<?php echo $p["Hero"]; ?>"><?php echo $heroname[0]; ?> (<?php echo $username[0]; ?>)</option>

        <?php } ?>
        </select>
        <button type="submit" class="btn btn-secondary ml-3">Select</button>
    </form>
    
    <div class="row">
        
        <div class="col">
            
        <?php if(isset($_GET["h"])) { ?>
        
        <form action="play.php?a=<?php echo $_GET["a"]; ?>&h=<?php echo $_GET["h"]; ?>" method="post" class="mb-3">
            <h1><?php echo $hero["Name"]; ?></h1>
            <input type="hidden" name="update" value="desc">
            <textarea class="form-control bg-dark border-dark text-light" id="heroDesc" name="heroDesc" rows="3"><?php echo $hero["Description"]; ?></textarea>
            <button type="submit" class="btn btn-sm btn-secondary mt-3">Save</button>
        </form>
            
        <h3>Attributes</h3>
        <form action="play.php?a=<?php echo $_GET["a"]; ?>&h=<?php echo $_GET["h"]; ?>" method="post" class="mb-3">
        <input type="hidden" name="update" value="attr">
        <table class="table table-sm table-dark table-hover">
            <thead>
                <th scope="col">Attribute</th>
                <th scope="col">Value</th>
            </thead>
            <tbody>
                <?php foreach($attributes as $a) { ?>
                <tr>
                    <td><?php echo $a["Attribute"]; ?></td>
                    <td><input type="number" name="<?php echo $a["Attribute"]; ?>" value="<?php echo $a["Val"]; ?>" class="form-control form-control-sm bg-dark border-dark text-light"></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-sm btn-secondary">Save</button>
        </form>
            
        <h3>Inventory</h3>
        <form action="play.php?a=<?php echo $_GET["a"]; ?>&h=<?php echo $_GET["h"]; ?>" method="post">
        <input type="hidden" name="update" value="item">
        <table class="table table-sm table-dark table-hover">
            <thead>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">#</th>
            </thead>
            <tbody id="items">
                <?php foreach($items as $i) { ?>
                <tr>
                    <td><input type="text" name="<?php echo "type-" . $i["ID"]; ?>" value="<?php echo $i["Type"]; ?>" class="form-control form-control-sm bg-dark border-dark text-light"></td>
                    <td><input type="text" name="<?php echo "name-" . $i["ID"]; ?>" value="<?php echo $i["Name"]; ?>" class="form-control form-control-sm bg-dark border-dark text-light"></td>
                    <td><input type="number" name="<?php echo "count-" . $i["ID"]; ?>" value="<?php echo $i["Count"]; ?>" class="form-control form-control-sm bg-dark border-dark text-light"></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="button" onclick="addRow();" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></button> <button type="submit" class="btn btn-sm btn-secondary">Save</button>
        </form>
            
        <script>
            let items = document.querySelector("#items");

            function addRow() {
                let row = document.createElement("tr");
                row.innerHTML = '<td><input type="text" name="newtype[]" class="form-control form-control-sm bg-dark border-dark text-light"></td><td><input type="text" name="newname[]" class="form-control form-control-sm bg-dark border-dark text-light"></td><td><input type="number" name="newcount[]" class="form-control form-control-sm bg-dark border-dark text-light"></td>';
                items.appendChild(row);
            }
        </script>
            
        <?php } ?>
            
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
            <p><?php echo $_SESSION["username"]; ?></p>
            
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