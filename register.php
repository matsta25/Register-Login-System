<?php include('server.php'); ?>
<!DOCTYPE HTML>  
<html>
   <head>
      <title>User registration</title>
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
      <div class="header">
         <h2>Register</h2>
      </div>
      <form method="post" action="register.php">
         <?php include('errors.php'); ?>
         <div class="input-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
         </div>
         <div class="input-group">
            <label>Password:</label>
            <input type="password" name="password" >
         </div>
         <?php include('pass_stats.php'); ?>
         <div class="input-group">
            <label>Date of birth: </label>
            <input type="date" name="date" value="<?php echo $date; ?>">
         </div>
         <div class="input-group">
            <button type="submit" name="register" class="btn">Register</button>
         </div>
         <p>
            Do you alredy have an account? <a href="login.php">Sign in</a>
         </p>
      </form>
   </body>
</html>