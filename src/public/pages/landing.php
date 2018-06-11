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
  			        <a class="nav-link" href="#register-form">Sign Up</a>
  			      </li>
  						<li class="nav-item ml-3">
  			        <a class="nav-link" href="#" data-toggle="modal" data-target="#login-modal">Log in <i class="far fa-xs fa-sign-in"></i></a>
  			      </li>
  			    </ul>
  			  </div>
        </div>
      </div>
    </div>

    <div class="container-fluid px-0 mb-3">
      <div class="jumbotron jumbotron-fluid landingpage-header d-flex flex-column align-items-center justify-content-center">
        <h1 class="display-4 mb-3">Pen and paper <i>revolutionized.</i></h1>
        <p class="lead mb-5">
          PNP Universal is a digital solution for language-based roleplaying games, offering a rich experience for new and old players alike.
        </p>
        <p class="text-center font-weight-bold px-2 mb-2">
          Try it now:
        </p>
    		<a href="#register-form" class="btn btn-success py-2 px-4 align-center">Sign up</a>
      </div>
    </div>

    <div class="container">

      <div class="row mb-3">
        <div class="col-sm text-center">
          <h2 class="display-4">Features</h1>
        </div>
      </div>

      <div class="row align-items-center bg-darker py-5 mb-3">
        <div class="col-sm-2 text-center">
          <i class="fal fa-file-alt" style="font-size:120px"></i>
        </div>
        <div class="col-sm-10">
          <h3>No More Clutter</h3>
          <p>
            PNPU does away with the messy stacks of paper you're used to from pen & paper games. No more worrying about forgetting your character
            sheets at home - all you need is your smartphone or laptop, and PNPU holds all you need to play.
          </p>
        </div>
      </div>

      <div class="row align-items-center bg-darker py-5 mb-3">
        <div class="col-sm-10 text-right">
          <h3>Beginner Friendly</h3>
          <p>
            The days when pen & paper games used to be a niche hobby for nerds are long gone. More and more people want to try it out,
            but getting into all the mechanics can seem daunting. PNPU makes this easy for you: new players can jump in and just play,
            the software takes care of the complicated stuff.
          </p>
        </div>
        <div class="col-sm-2 text-center">
          <i class="fal fa-book-heart" style="font-size:120px"></i>
        </div>
      </div>

      <div class="row align-items-center bg-darker py-5 mb-3">
        <div class="col-sm-2 text-center">
          <i class="fal fa-chess" style="font-size:120px"></i>
        </div>
        <div class="col-sm-10">
          <h3>Interactive & Automated</h3>
          <p>
            PNPU handles all random events, combat and dice rolls, leaving more time for what really matters - role playing.
          </p>
        </div>
      </div>

      <div class="row align-items-center bg-darker py-5 mb-3">
        <div class="col-sm-10 text-right">
          <h3>Boost Your Creativity</h3>
          <p>
            Don't like any of the available games or want to try your hand at designing your own? PNPU offers all the tools you need to easily create your very own adventures - the only limit is your creativity.
          </p>
        </div>
        <div class="col-sm-2 text-center">
          <i class="fal fa-paint-brush" style="font-size:120px"></i>
        </div>
      </div>
        
        <div id="register-form" class="row align-items-center bg-darker py-5 mb-3">
        <div class="col text-center">
          <h3>Get started now!</h3>
            <form action="pages/register.php" method="post">
                <div class="form-group">
                    <label for="reg-username">Username</label>
                    <input type="text" name="reg-username" id="reg-username" class="register-form form-control bg-dark text-light border-dark">
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" name="reg-password" id="reg-password" class="register-form form-control bg-dark text-light border-dark">
                </div>
                <div class="form-group">
                    <label for="reg-repeat">Repeat password</label>
                    <input type="password" name="reg-repeat" id="reg-repeat" class="register-form form-control bg-dark text-light border-dark">
                </div>
                <input type="submit" class="btn btn-success py-2 px-4 align-center" value="Sign up">
            </form>
        </div>
      </div>
        
        
        
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-darker text-light">
              <div class="modal-header">
                <h5 class="modal-title" id="login-modal-label">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="pages/login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="login-form form-control bg-dark text-light border-dark">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="login-form form-control bg-dark text-light border-dark">
                    </div>
                    <input type="submit" class="btn btn-success" value="Login">
                </form>
              </div>
            </div>
          </div>
        </div>
        
        

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
