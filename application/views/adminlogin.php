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
        <li><a href="<?php echo base_url();?>index.php/admin">Home</a></li>
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
      <h2>Login Form</h2>
      <hr/>
        <?php  
          echo form_open('Admin/login_action');  
          echo validation_errors();       
          echo "<p>Username: ";  
          echo form_input('username', $this->input->post('username'));  
          echo "</p>";     
          echo "<p>Password: ";  
          echo form_password('password');  
          echo "</p>";    
          echo "</p>";  
          echo form_submit('login_submit', 'Login');  
          echo "</p>";    
          echo form_close();        
        ?>       
    </div>
  </div>
</main>

<footer class="footer">
  <p class="text-center">Greg Inc</p>
</footer>

</body>
</html>