<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Greg's ---- ADMIN ---- Bookstore</title>
  <meta name="description" content="Greg's Bookstore">
  <link rel="icon" href="<?=base_url()?>/download.png" type="image/gif">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
      footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #555;
        color: white;
      }
  </style>
</head>

<body>
<header>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href='<?php echo base_url()."index.php/Admin/logout"; ?>'>Logout</a> </li>
        <li><a href='<?php echo base_url()."index.php/Admin/addcategory"; ?>'>Add a category</a> </li>
        <li><a href='<?php echo base_url()."index.php/Admin/addbook"; ?>'>Add a book</a> </li>
        <li>
        <form class="navbar-form navbar-left" method="post" action="<?php echo base_url();?>index.php/admin/adminsearch/">
              <div class="input-group">
                <input type="text" name="search" value='<? $search ?>' placeholder="Search" class="form-control">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="submit" value="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
      </ul>   
    </div>
  </nav>
</header>

<main>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="text-center">Admin for Bookstore Ltd</h1>      
    </div>
    <div class="row">
        <div class="jumbotron">
          <?php foreach($book as $rows) { ?>
            <h2><?php echo $rows->title ?></h2>
            <tr><td><img src="<?php echo base_url();?>assets/images/<?php echo $rows->picture ?>" width="150" /></td></tr>
            <tr><td><p>Author: <?php echo $rows->author ?></p></td><br>
            <tr><td><p>Author: <?php echo $rows->price ?></p></td><br>
            <tr><td><p>Category: <?php echo $rows->category ?></p></td></tr>
            <br>
            <p><?php echo $rows->description ?></p>
          <?php } ?>
        </div>
        <div class="jumbotron">
            <?php if((!empty($times))||(!isset($times))){ ?>
              <div class="">
                <h3>Info on the book: </h3>
                <h4>Viewed at: </h4>
                <?php foreach($times as $rows) { ?>
                  <tr><td>Viewed at:  <?php echo $rows['viewed_at'] ?> </td><br></tr>
                <?php } ?>
                  <tr>Total page views: <?= $views ?></tr><br>
              </div>
            <?php } else { echo "No traffic data on this book yet"; echo "";} ?>
        </div>
        
    </div>
  </div>
</main>

<footer class="footer">
  <p class="text-center">Greg Inc</p>
</footer>

</body>
</html>