<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
  include_once("title.php");
  ?>

  <link href="/css/app.css" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico">
  <link href="/js/jquery-ui/jquery-ui.css" rel="stylesheet">
  <script type="text/javascript" src="/js/jquery.min.js"></script>
  <script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">

        <a class="navbar-brand" href="/">Spa</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav pull-right">


          <li><a href="/user/logout">se déconnecter</a></li>


          <li><a href="/user/register">Inscription</a></li>
          <li><a href="/user/login">Connection</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
    include_once("bread.php");
    ?>