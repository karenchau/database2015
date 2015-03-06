<!DOCTYPE html>
<html>
  <head>
    <link type='text/css' rel='stylesheet' href='style.css'/>
    <title>Learning Platform</title>
  </head>
  <body>
    <img src="http://i1061.photobucket.com/albums/t480/ericqweinstein/php-logo_zps408c82d7.png"/>
    <div class="header"><h1>
      <?php
<<<<<<< HEAD
      $welcome = "Welcome to the Learning Platform!";
=======
      $welcome = "Welcome to Virtual Learning Place";
>>>>>>> FETCH_HEAD
      echo $welcome;
      ?>
    </h1></div>

    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">This Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-default">Login</button>
      <button type="register" class="btn btn-default">Register</button>
    </form>
  </body>
</html>