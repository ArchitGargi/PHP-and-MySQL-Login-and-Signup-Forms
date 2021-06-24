# PHP-and-MySQL-Login-and-Signup-Forms
READ THE INSTRUCTIONS TO RUN THIS CODE

This is the login and signup forms for your website made with PHP, MySQL, JavaScript, HTML and CSS. To use this include the php file. You will need to make two buttons which are sign up and login and use the onclick event on them. Use login() and signup() functions for them to work. Below are the lines of code you will have to add in your main file where you have to add the login signup forms after you extract the files or unzip them.

      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
        <?php include 'loginsignupmaincode.php';?>
      </head>
      <body>
      <button onclick="login()" id="login">Log In</button>
      <button onclick="signup()" id="signup">Sign Up</button>
      </body>
      </html>

Replace the "username", "password", "your database" at line 72 and 23 in the login signup main php file. 

This code will create four session variables which are password, username, userid, first name and password. Below are the variables in PHP.

    $_SESSION["userid"]; //user id
    $_SESSION["firstname"]; //first name
    $_SESSION["lastname"]; //last name
    $_SESSION["username"]; //username
    $_SESSION["password"]; //password
    
    
If you want to hide the buttons of login and signup on sign up or login when the user is logged in then use the code below.

      <?php
      if ($_SESSION && $_SESSION["username"] != "") {
      echo "<script>document.getElementById('login').style.display='none'; document.getElementById('signup').style.display='none';</script>";
      }
      ?>
      
If you want the sign up and log in forms to appear when the page reloades because of php then use the code below.

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if ($_POST["type"] == "sign up") {
              echo "<script>document.getElementById('id02').style.display='block';</script>";
              }
              else if ($_POST["type"] == "log in") {
                  echo "<script>document.getElementById('id01').style.display='block';</script>";
                  }
      }
      ?>
You need to make a table too in mysql to store user's data. Copy paste the follwoing mysql query to make a table for it.

      CREATE TABLE users (
      username longtext,
      password1 longtext,
      firstN longtext,
      lastN longtext,
      useris int(11) NOT NULL AUTO_INCREMENT,
      PRIMARY KEY (`useris`)
      );
Thank You for using it.
