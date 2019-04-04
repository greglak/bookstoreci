<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Greg's Bookstore</title>
  <meta name="description" content="Greg's Bookstore">
  <link rel="icon" href="<?=base_url()?>/download.png" type="image/gif">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<header>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url();?>index.php/bookstoreController">Home</a></li>
        <li>
        <form class="navbar-form navbar-left" method="post" action="<?php echo base_url();?>index.php/bookstoreController/search">
            <div class="input-group">
              <input type="text" name="search" placeholder="Search" class="form-control">
              <div class="input-group-btn">
                  <button class="btn btn-default" type='submit' name='submit' value='Submit'>
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
            </div>
          </form>
          </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url();?>index.php/bookstoreController/loadBasket"><i class="glyphicon glyphicon-shopping-cart"></i></a></li>
      </ul> 
   
    </div>
  </nav>
</header>

<main>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="text-center">Bookstore Ltd</h1>      
    </div>
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <h4>Categories</h4>
        <ul class="nav nav-pills nav-stacked">
        <?php foreach($categories as $rows){ ?>
          <li><a href="<?php echo base_url();?>index.php/bookstoreController/category/<?php echo $rows->category?>"><?php echo $rows->category ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-sm-9">
        <div class="row">
          <h1>Main Page</h1>
          <p>They call him Flipper Flipper faster than lightning. No one you see is smarter than he. Goodbye gray sky hello blue. There's nothing can hold me when I hold you. Feels so right it cant be wrong. Rockin' and rollin' all week long.</p>
          <p>You wanna be where you can see our troubles are all the same. You wanna be where everybody knows Your name. Their house is a museum where people come to see ‘em. They really are a scream the Addams Family? black gold It's a beautiful day in this neighborhood a beautiful day for a neighbor.</p>
          <p> Would you be mine? Could you be mine? Its a neighborly day in this beautywood a neighborly day for a beauty. Would you be mine? Could you be mine.</p>
        </div>
      </div>
    </div>
  </div>
</main>

</body>
</html>