<?php include('server.php'); ?>
<!DOCTYPE HTML>  
<html>
<head>
  <title>Home page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>  
<div class="header">
<h2>Home page</h2>
</div>
    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
           <div class="error success">
                <h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
               </h3>
            </div>
        <?php endif; ?>
   <?php if (isset($_SESSION["email"])): ?>
       <p> Welcome <strong><?php
    $email = $_SESSION['email'];
    echo $_SESSION['email']; ?>
	</strong></p>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'registration');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email  = $_SESSION['email'];
    $sql    = "SELECT date FROM user WHERE email='$email';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date1 = $row["date"];
        }
    } else {
        echo "0 results";
    }
	?>
<br>
<?php
    echo "You was born in ";
    echo $date1;
    $birthday = $date1;
    echo ".<br>";
?>
<br>
<?php
    $parts      = explode('-', $birthday, 2);
    $birth_date = new DateTime(date('Y') . '-' . $parts[1] . ' 00:00:00');
    $today      = new DateTime('midnight today');
    
    if ($birth_date < $today) {
        $birth_date->modify("+1 Year");
    }
    
    $diff = $birth_date->diff($today);
 
    if ($diff->days > 0) {
        echo "There are "; ?> 
		<strong> 
	<?php
			echo $diff->days;
	?> </strong> 
	<?php
        echo " days to your birthday.";
    } else {
        echo "Happy birthday.";
    }
	?>
       <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
    <?php endif; ?>
       </div>
</body>
</html>