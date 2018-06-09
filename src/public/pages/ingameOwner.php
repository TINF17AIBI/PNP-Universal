<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>PNP Universal</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/stylesheet.css" type="text/css">
    <script defer src="assets/fa/fontawesome-all.js"></script>
  </head>
  <body class="text-light">
  
    <div class="container-fluid sticky-top bg-darker">
      <div class="container">
        <div class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="index.html"><i class="far fa-pencil mr-1"></i> PNP Universal</a>
          <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    	    <span class="navbar-toggler-icon"></span>
    	  </button>
  	  <div class="collapse navbar-collapse" id="navbar">
  	    <ul class="navbar-nav navbar-dark ml-auto mt-2 mt-lg-0">
	      <li class="nav-item">
	        <a class="nav-link" href="#">Main Page <img src="assets/img/icon.png" width=50px height=24px /></a>
	      </li>
  	      <li class="nav-item">
	        <a class="nav-link" href="#">Account Options</a>
	      </li>
  	      <li class="nav-item ml-3">
  		<a class="nav-link" href="#">Log Out <i class="far fa-xs fa-sign-out"></i></a>
  	      </li>
  	    </ul>
  	  </div>
        </div>
      </div>
    </div>
    
    <div class="container">
      <h1 class="display-4 mb-3">$AdventureName</h1>
      <div class="card bg-dark text-light">
        <div class="card-body"> <!-- php: foreach -->
          <h4 class="card-title">$CharacterName</h4>
	  <p class="card-text">$CharacterDescription</p>
	  <div class="card-body">
	    <h5 class="card-title">Items</h5>		
	    <table class="table table-striped table-dark">
	      <thead>
	        <tr>
		  <th scope="col">Type</th>
                  <th scope="col">Name</th>
                  <th scope="col">Amount</th>
		  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="col"><form><input type="text" name="ItemType$ID" value=$ItemType></form></td>
                  <td scope="col"><form><input type="text" name="ItemName$ID" value=$ItemName></form></td>
                  <td scope="col"><form><input type="text" name="ItemCount$ID" value=$ItemCount></form></td>
		  <td scope="col"><button class="btn btn-xs">Save</button></td> <!-- Keine Ahnung wie mit HTML, ich glaub man braucht JS dafür -->
                </tr>
              </tbody>
            </table>
	    <!-- JavaScript: Add new Item -->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>