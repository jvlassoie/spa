<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title></title>

  <link href="/css/app.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">

        <a class="navbar-brand" href="/">Spa</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">


          <li><a href="#">se déconnecter</a></li>


          <li><a href="#">Inscription</a></li>
          <li><a href="#">Connection</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <ul class="breadcrumb">
      <li><a href="/">Home</a></li>

      <?php
      if ($GLOBALS['requestGlobal']!= null) {
       $controller = $GLOBALS['requestGlobal']->getController();
       $action = $GLOBALS['requestGlobal']->getAction();
       echo '<li><a href="/'.$controller.'/view" title="'.$controller.'">';
       echo $controller;         
       echo '</a></li>';  
       echo '<li class="active">';
       echo $action;         
       echo '</a></li>';  
     }
     ?>
   </ul>