# Register-Login-System

This is PHP Register/Login System which can also show you how many days remain to your birthday.

To run it, follow this steps:
  1. create database called "registration" and then import "registration.sql" from db directory
  2. edit lines in files:
    
    - index.php :
      $conn = mysqli_connect('localhost', 'root', '', 'registration');
    - server.php :
      $db = mysqli_connect('localhost', 'root', '', 'registration');
    
    to to match with your adress, username and password.

 Now it should work fine.
