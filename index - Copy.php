<?php 
  require("Connection.php");
  if(!$conn){
    die("Failed to connect to server Please try again!");
  }

  if(isset($_POST['Lbtn'])){
    $E_email = $_POST['email'];
    $E_password = $_POST['password'];

    $q2 = "SELECT password FROM user_registration WHERE Email = '$E_email'";
    if(!mysqli_query($conn, $q2)){
      echo "enter correct email or password";
    }
    else{
      $result = mysqli_query($conn, $q2);
      $password = mysqli_fetch_assoc($result);
      if($E_password == $password['password']){
        header("Location: Dashboard.php");
      }
      else{
        echo "Enter correct email or password";
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Paper Setting Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="Navbar">
        <div id="Logo">
            <img src="images/Logo.png" alt="">
        </div>
        <div id="Name">
            <h3>Dr.Babasaheb Ambedkar Technological University <br> डॉ. बाबासाहेब आंबेडकर तंत्रशास्त्र विद्यापीठ <br> Lonere-402103 Tal.Mangaon Dist.Raigad</h3>
        </div>
        <div id="Menu">
            <ul>
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact </a></li>
                <li><a href="registration.php">Sign up</a></li>
            </ul>
        </div>
    </div>

    <div id="Body">
        <div class="login-container">
            <h1>University Paper Setter Login</h1>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" id="username" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="Lbtn">Login</button>
                <a href="#">Forgot Password?</a>
            </form>
        </div>
    </div>
    </body>
</html>