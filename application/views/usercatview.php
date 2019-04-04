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
          <?php if((!empty($results))||(!isset($results))){ ?>
            <?php foreach($results as $rows){ ?>  
              <div class="col-md-4">
                <div class="thumbnail">
                  <a href="<?php echo base_url();?>index.php/BookstoreController/retrieveBook/<?php echo $rows['bookId'] ?>">
                    <img src="<?php echo base_url("assets/images/{$rows['picture']}"); ?>" width="150" />
                    <div class="caption text-center">
                      <p><?php echo $rows['title'] ?></p>
                      <p><?php echo $rows['author'] ?></p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> 
            <div class="col-md-12 text-center">
              <?= $pagination; ?>
            </div>
          <?php } else { echo "No books in this category!"; echo "";} ?>  
        </div>
      </div>
    </div>
  </div>
</main>

</body>
</html>