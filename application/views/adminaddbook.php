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
    <div class="row content"> 
      <?php /* echo $this->session->flashdata('success_msg'); ?>
      <?php echo $this->session->flashdata('error_msg'); */ ?> 
      <form role="form" action="<?php echo base_url();?>index.php/Admin/adminaddbook" method="post" enctype="multipart/form-data">
        <div class="form-group">    
          title
          <input type="text" name="title" required>
        </div> 
        <div class="form-group">
          author
          <input type="text" name="author" required>
        </div> 
        <div class="form-group">
          picture
          <input type="file" name="picture" required>
        </div>     
        <div class="form-group">
          description 
          <input type="text" name="description" required>
        </div> 
        <div class="form-group">
          price
          <input type="text" name="price" required>
        </div> 
        <div class="form-group"> 
            category
            <input type="text" name="category" required>
        </div> 
        <div class="form-group">
            <input type="submit" name="fileSubmit" value="UPLOAD"/>  
        </div>    
      </form> 
    </div>
  </div>
</main>

</body>
</html>