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
                <input type="text" name="search" placeholder="Search" class="form-control">
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
    <div class="row content">
      <h1>Main Page</h1>
      <p>They call him Flipper Flipper faster than lightning. No one you see is smarter than he. Goodbye gray sky hello blue. There's nothing can hold me when I hold you. Feels so right it cant be wrong. Rockin' and rollin' all week long.</p>
      <p>You wanna be where you can see our troubles are all the same. You wanna be where everybody knows Your name. Their house is a museum where people come to see ‘em. They really are a scream the Addams Family? black gold It's a beautiful day in this neighborhood a beautiful day for a neighbor.</p>
      <p> Would you be mine? Could you be mine? Its a neighborly day in this beautywood a neighborly day for a beauty. Would you be mine? Could you be mine.</p>
    </div>
  </div>
</main>

<footer class="footer">
  <p class="text-center">Greg Inc</p>
</footer>

</body>
</html>