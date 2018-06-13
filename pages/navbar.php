<?php
if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
} ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PNP Universal</title>
  <link rel="stylesheet" href="/PNP-Universal/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/PNP-Universal/assets/css/stylesheet.css" type="text/css">
  <script defer src="/PNP-Universal/assets/fa/fontawesome-all.js"></script>
</head>
<body class="text-light">
    <script src="/PNP-Universal/assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/PNP-Universal/assets/js/popper.min.js"></script>
    <script src="/PNP-Universal/assets/js/bootstrap.min.js"></script>
  <div class="container-fluid sticky-top bg-darker">
    <div class="container">
      <div class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">
          <i class="far fa-pencil mr-1"></i> PNP Universal</a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav navbar-dark ml-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <span class="navbar-text text-light mr-3">Logged in as: <strong><?php echo $_SESSION["username"]; ?></strong></span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/PNP-Universal/index.php">Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/PNP-Universal/controlpanel.php">Account Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/PNP-Universal/pages/logout.php">Log Out
                <i class="far fa-xs fa-sign-out"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>