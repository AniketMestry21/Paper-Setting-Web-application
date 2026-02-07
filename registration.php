<?php

require('Connection.php');
if(!$conn){
    die("failed to connect to database");
}
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO user_registration(Name, Email, password) VALUES('$name', '$email', '$password')";

    if(!mysqli_query($conn, $query)){
        echo "failed to insert data please try again!";
    }
    else{
        echo "registraion successfull!";
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact </a></li>
                <li><a href="#">Sign up</a></li>
            </ul>
        </div>
    </div>


    <div id="registration">
        <div class="login-container">
            <h2>Register</h2>

            <form action="registration.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                
                <button type="submit" name="register">Register</button>
            </form>
            
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>