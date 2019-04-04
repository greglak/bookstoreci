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
              <input type="text" name="search" ' placeholder="Search" class="form-control">
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
        <h4>Basket</h4>
        <?php if((!empty($items))||(!isset($items))){ ?>
        <ul class="list-group">
        <?php foreach($items as $rows) { ?>
          <h2><?php echo $rows->title ?></h2>
            <tr><td><img src="<?php echo base_url();?>assets/images/<?php echo $rows->picture ?>" width="150" /></td></tr>
            <tr><td><p>Author: <?php echo $rows->author ?></p></td><br>
            <tr><td><p>Price: <?php echo $rows->price ?></p></td><br>
            <tr><td><p>Category: <?php echo $rows->category ?></p></td></tr>
            <tr><td><a href="<?php echo base_url();?>index.php/BookstoreController/deletefrombasket/<?php echo $rows->bookId ?>">Remove from basket</a></td></tr>
            <br>
            <br>
        <?php } ?>
    </ul>
    <?php } else { echo "Your basket is empty!"; echo "";} ?>
        
        </div>
      </div>
    </div>
  </div>
</main>

</body>
</html>