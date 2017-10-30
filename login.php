<?php include('server.php'); ?>
<!DOCTYPE HTML>  
<html>
    <head>
        <title>User login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <h2>Login</h2>
        </div>
        <form method="post" action="login.php">
            <?php include('errors.php'); ?>
                <div class="input-group">
                    <label>Email:</label>
                    <input type="email" name="email">
                </div>
                <div class="input-group">
                    <label>Password:</label>
                    <input type="password" name="password">
                </div>
                <div class="input-group">
                    <button type="submit" name="login" class="btn">Login</button>
                </div>
            <p>
            Dont have an account? <a href="register.php">Sing up</a>
            </p>
        </form>
    </body>
</html>