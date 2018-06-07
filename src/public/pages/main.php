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
      <h1 class="display-4 mb-3">DASHBOARD</h1>
      <button type="button" class="btn btn-primary btn-lg">New Adventure</button>
      <div class="card bg-dark text-light">
        <div class="card-body">
          <h5 class="card-title">$AdventureName</h5>
	  <h6 class="card-subtitle mb-2 text-muted">$GameMaster</h6>
          <p class="card-text">$AdventureDescription</p>
	  <a href="#" class="Card Link">Go to Adventure</a>
        </div>
      </div>
      <br/>
      <div class="card bg-dark text-light">
	<div class="card-body">
          <h5 class="card-title">$AdventureName</h5>
          <p class="card-text">$AdventureDescription</p>
	  <a href="#" class="Card Link">Go to Adventure</a>
        </div>
      </div>
    </div>
    
  </body>
</html>