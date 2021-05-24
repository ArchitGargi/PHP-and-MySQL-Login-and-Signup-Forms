<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginsignupcss.css">
  <script src="loginsipgnupjs.js"></script>
</head>
<body>
<?php
$fnameerror = $lnameerror = $unameerror = $passworderror = "";
global $errormessage;
global $message;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($_POST["type"] == "sign up") {
$errorcode = 0;
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$uname = $_POST["username"];
$password = $_POST["password"];
$conn = mysqli_connect("localhost", "Username", "Password", "your database");
    if (!$conn) {
    die("Couldn't connect to server! Try Again Later." . "<br>");
    }
    
$passwordletters = str_split($_POST["password"]);
$passwordlength = count($passwordletters);
if ($fname == "") {
    $fnameerror = "First Name cannot be blank";
    $errorcode = 1;
    }
    
if ($lname == "") {
    $lnameerror = "Last Name cannot be blank";
    $errorcode = 1;
    }
        
if ($uname == "") {
    $unameerror = "Username cannot be blank";
    $errorcode = 1;
    }
else if ($uname != "") {
$n = "SELECT username FROM users WHERE username = '" . $uname . "';";
$rn = mysqli_query($conn, $n);
$rn1 = mysqli_num_rows($rn);
if ($rn1 != 0) {
    $unameerror = "Username not available";
    $errorcode = 1;
}
}

if ($passwordlength < 8) {
    $passworderror = "Password must be at least 8 letters long";
    $errorcode = 1;
    }
    
if ($errorcode == 0) {
senddata();
}
}
}

function senddata() {
    global $errormessage;
    global $message;
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $uname = $_POST["username"];
    $password = $_POST["password"];
    $conn = mysqli_connect("localhost", "Username", "Password", "your database");
    if (!$conn) {
    die("Couldn't connect to server! Try Again Later." . "<br>");
    }
    
    
    $userexists = "SELECT password1 FROM users
    WHERE firstN = '" . $_POST["firstname"] . "';
    ";
    $result = mysqli_query($conn, $userexists);
    $result1 = mysqli_num_rows($result);
    
    
    $userexists2 = "SELECT password1 FROM users
    WHERE username = '" . $_POST["username"] . "';
    ";
    $result2 = mysqli_query($conn, $userexists2);
    $result12 = mysqli_num_rows($result2);
    
    if ($result1 != 0 && $result12 != 0) {
    $errormessage = "Users exists!";
    }
    
    
    else {
        $a = getdate();
        $date = $a['year'] . "-" .$a['mon'] . "-" . $a['mday'] . "<br>";
        $send = "INSERT INTO users (firstN, lastN, username, password1)
        VALUES ('" . $fname ."', '" . $lname . "', '" . $uname . "', '" . $password . "');";
    if (mysqli_query($conn, $send) == "TRUE") {
    $message = "Account Created Succesfully";
    
    $userid1 = "SELECT useris FROM users
    WHERE username = '" . $_POST["username"] . "';
    ";
    $userid2 = mysqli_query($conn, $userid1); 
    while($row = mysqli_fetch_assoc($userid2)) {
        $userid = $row["useris"];
        }
    $_SESSION["userid"] = $userid;
    $_SESSION["firstname"] = $fname;
    $_SESSION["lastname"] = $lname;
    $_SESSION["username"] = $uname;
    $_SESSION["password"] = $password;
    }
    else {
    $errormessage = "Could not create account";
    }
}
}
?>


<?php
$lunameerror = $lpassworderror = "";
global $lerrormessage;
global $lmessage;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["type"] == "log in") {

$lerrorcode = 0;
$lname = $_POST["username"];
$lpassword = $_POST["password"];

if ($lname == "") {
$lunameerror = "Username cannot be blank";
$lerrorcode = 1;
}

if ($lpassword == "") {
$lpassworderror = "Password cannot be blank";
$lerrorcode = 1;
}
    
if ($lerrorcode == 0) {
askdata();
}
}
}
function askdata() {
    global $lerrormessage;
    global $lmessage;
    $name = $_POST["username"];
    $password = $_POST["password"];
        $conn = mysqli_connect("localhost", "root", "", "skewminds");
    if (!$conn) {
    die("Couldn't connect to server! Try Again Later." . "<br>");
    }
    $password1 = "SELECT password1 FROM users
    WHERE username = '" . $_POST["username"] . "';
    ";
    $result = mysqli_query($conn, $password1);
    $result1 = mysqli_num_rows($result);
    if ($result1 == 0) {
     $lerrormessage = "User doesn't exist";
    }
    else {
        $totalresult = $result->fetch_array()[0] ?? '';
    if ($password == $totalresult) {
        $userid1 = "SELECT useris FROM users
        WHERE username = '" . $_POST["username"] . "';
        ";
        $userid2 = mysqli_query($conn, $userid1); 
        while($row = mysqli_fetch_assoc($userid2)) {
            $userid = $row["useris"];
            }
        $firstname1 = "SELECT firstN FROM users
        WHERE username = '" . $_POST["username"] . "';
        ";
        $firstname2 = mysqli_query($conn, $firstname1);
        
        $lastname1 = "SELECT lastN FROM users
        WHERE username = '" . $_POST["username"] . "';
        ";
        $lastname2 = mysqli_query($conn, $lastname1); 
 while($row = mysqli_fetch_assoc($firstname2)) {
            $firstname = $row["firstN"];
            }
            while($row = $lastname2->fetch_assoc()) {
                $lastname = $row["lastN"];
                }
        $lmessage = "Welcome Back " . $firstname . " " . $lastname;
        $_SESSION["userid"] = $userid;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["username"] = $name;
        $_SESSION["password"] = $password;
    }
    else {
    $lerrormessage = "Password is incorrect";
    }
    }
}
?>


 <div id="id01" class="modal">
  
  <form class="modal-content animate" id ="one" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="img_avatar2.png" alt="Avatar" class="avatar">
      </div>
  
      <div class="container">
      <table style="width: 100%;">
      <tr>
       <td style="width: 20%;">
       <label for="uname"><b>Username</b></label>
  </td>
  <td style="width: 80%;">
        <input type="text" placeholder="Enter Username" name="username" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "log in") { echo $_POST["username"]; } }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
       <div id="placeholder1"><span id="errorm"><?php echo $lunameerror;?></span><br></div>
       </td>
      </tr>
      
      
      <tr>
       <td style="width: 20%;">
        <label for="psw"><b>Password</b></label>
  </td>
  <td style="width: 80%;">
        <input type="password" placeholder="Enter Password" name="password" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "log in") { echo $_POST["password"];} }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
        <div id="placeholder1"><span id="errorm"><?php echo $lpassworderror;?></span></div>
        </td>
      </tr>
        </table>
        <input type="password" value="log in" name="type" style="display: none;">
        <p id="errorm"><?php echo $lerrormessage; ?></p>
  <p><?php echo $lmessage; ?></p>
        <button type="submit">Log In</button>
      </div>
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>
  
  
  
  
  
  
  
  <div id="id02" class="modal">
    
    <form class="modal-content animate" id ="one" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="img_avatar2.png" alt="Avatar" class="avatar">
      </div>
  
      <div class="container">
      <table style="width: 100%;">
      <tr>
       <td style="width: 20%;">
       <label for="uname"><b>First Name</b></label>
  </td>
  <td style="width: 80%;">
        <input type="text" placeholder="Enter First Name" name="firstname" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "sign up") { echo $_POST["firstname"]; } }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
       <div id="placeholder1"><span id="errorm"><?php echo $fnameerror;?></span><br></div>
       </td>
      </tr>
      
      
       <tr>
       <td style="width: 20%;">
       <label for="uname"><b>Last Name</b></label>
  </td>
  <td style="width: 80%;">
        <input type="text" placeholder="Enter Last Name" name="lastname" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "sign up") { echo $_POST["lastname"]; } }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
       <div id="placeholder1"><span id="errorm"><?php echo $lnameerror;?></span><br></div>
       </td>
      </tr>
      
      <tr>
       <td style="width: 20%;">
       <label for="uname"><b>Username</b></label>
  </td>
  <td style="width: 80%;">
        <input type="text" placeholder="Enter username" name="username" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "sign up") { echo $_POST["username"]; } }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
       <div id="placeholder1"><span id="errorm"><?php echo $unameerror;?></span><br></div>
       </td>
      </tr>
      
      
      <tr>
       <td style="width: 20%;">
        <label for="psw"><b>Password</b></label>
  </td>
  <td style="width: 80%;">
        <input type="password" placeholder="Enter Password" name="password" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($_POST["type"] == "sign up") { echo $_POST["password"];} }?>"><br>
        </td>
        </tr>
        <tr>
        <td></td>
        <td style="text-align: left;">
        <div id="placeholder1"><span id="errorm"><?php echo $passworderror;?></span></div>
        </td>
      </tr>
        </table>
        <input type="password" value="sign up" name="type" style="display: none;">
        <p id="errorm"><?php echo $errormessage; ?></p>
  <p><?php echo $message; ?></p>
        <button type="submit">Sign Up</button>
      </div>
  
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>
