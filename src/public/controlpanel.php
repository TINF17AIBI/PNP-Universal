<?php require_once("pages/navbar.php"); 
?>

<div class="container">
    
        <h1 class="display-4 my-3">Account Settings</h1>

		<form action="pages/changepw.php" method="post">
		  <div class="form-group">
			<label for="InputPasswordOld">Old Password</label>
			<input type="password" name="old" class="form-control bg-dark border-dark text-light" placeholder="Enter your old Password" required>
	      </div>
		  <div class="form-group">
			<label for="InputPasswordNew">New Password</label>
			<input type="password" name="new" class="form-control bg-dark border-dark text-light" placeholder="Enter your new Password" required>
	      </div>
		  <div class="form-group">
			<label for="InputPasswordNewAgain">New Password</label>
			<input type="password" name="repeat" class="form-control bg-dark border-dark text-light" placeholder="Enter your new Password (again, we know it's annoying)" required>
	      </div>
        <button type="submit" class="btn btn-success">Save</button>
		</form>


</div>

</body>
</html>