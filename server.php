<?php
session_start();
$email    = "";
$date     = "";
$password = "";
$errors   = array();
$pass_stats= array();

$db = mysqli_connect('localhost', 'root', '', 'registration');

if (isset($_POST['register'])) {
    $email    = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $date     = mysqli_real_escape_string($db, $_POST['date']);
    
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($date)) {
        array_push($errors, "Date is required");
    }
    
	$score          = 0;
    $conditionsMeet = 0;
    
    if (strlen($password) < 6) {
        array_push($errors, "Password must be at least 6 characters");
    } else {
        $score += (strlen($password) / 2);
        $conditionsMeet++;
    }
    
    str_replace(range('A', 'Z'), '', $password, $num_caps);
    if ($num_caps == 0) {
        array_push($errors, "Password must have at least 1 capital letter");
    } else {
        $score += 6;
        $conditionsMeet++;
    }
    
    str_replace(range('0', '9'), '', $password, $num_numb);
    if ($num_numb == 0) {
        array_push($errors, "Password must have at least 1 number");
    } else {
        $score += 8;
        $conditionsMeet++;
    }
    
    str_replace(range(' ', '/'), '', $password, $num_spec);
    if ($num_spec == 0) {
        array_push($errors, "Password must have at least 1 special sign");
    } else {
        $score += 13;
        $conditionsMeet++;
    }
    
    if ($conditionsMeet > 0) {
        $score += ($conditionsMeet * 4);
    }
    
    $password_sec = ($score / 50) * 100;
    if ($password_sec > 100) {
        $password_sec = 100;
    }
	/*
	<?php
	echo "Password strength: " . $password_sec . "%";
	echo "<br>";
	echo "Conditions: " . $conditionsMeet . "/4";
    ?>
	*/
	if (!empty($password)) {
        array_push($pass_stats,"Password strength: " . $password_sec . "%");
		array_push($pass_stats,"Conditions: " . $conditionsMeet . "/4");
    }
    
    if (count($errors) == 0) {
        $passwordMD5 = md5($password);
        $sql         = "INSERT INTO user (email,password,date) 
    VALUES ('$email','$passwordMD5','$date')";
        mysqli_query($db, $sql);
        $_SESSION['email']   = $email;
        $_SESSION['success'] = "You are now logged";
        header('location: index.php');
    }
}

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $passwordMD5 = md5($password);
        $query       = "SELECT * FROM user WHERE email='$email' AND password='$passwordMD5'";
        $result      = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email']   = $email;
            $_SESSION['success'] = "You are now logged";
            header('location: index.php');
        } else {
            array_push($errors, "Email/password is wrong");       
        }
    }
    
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('location: login.php');
}
?>