<?php require_once("pages/navbar.php"); 
?>

<div class="container">
    <h1 class="display-4 my-3">Create Template</h1>
      
    <form action="pages/createtemplate.php" method="post">
        <div class="form-group">
            <label for="templateName">Template Name</label>
            <input type="text" class="form-control" id="templateName" name="templateName" required>
        </div>
        <div class="form-group">
            <label for="templateDesc">Description</label>
            <textarea class="form-control" id="templateDesc" name="templateDesc" rows="3"></textarea>
        </div>  
        
        <h3>Attributes</h3>
        <div id="attributes"></div>
        <button type="button" onclick="addRow();" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i></button>
        <br>
       <button type="submit" class="btn btn-success my-3">Create</button>
    </form>
    
    <script>
        let attrCount = 0;
        let attr = document.querySelector("#attributes");

        function addRow() {
            let row = document.createElement("div");
            row.innerHTML = "<input type='text' class='form-control my-3' id='a-" + attrCount + "' name='a[]'>";
            attr.appendChild(row);
            attrCount += 1;
        }
    </script>
    
  </body>
</html>