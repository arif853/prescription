<?php
session_start();

    include("../db_con/database_con.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        //somthing was posted
        $user_id = $_POST['user_id'];
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if(isset($_POST['full_name'])){
            $fullname = $_POST['full_name'];
        }
        $email = $_POST['email'];
        $designation = $_POST['designation'];

        $hash = password_hash($password,PASSWORD_DEFAULT);
        
        if(!empty($user_id) && !empty($password))
        {
            if (preg_match($pattern, $email) === 1) 
            {
                if (strlen($password) >= 5 && strlen($password) <= 8){ 
                    
                    //save to database
                    $query = "INSERT INTO manager(user_id, name, email, designation, password) 
                    VALUES ('$user_id','$fullname','$email','$designation','$hash')";
                    
                    if ($conn->query($query) === TRUE) {
                        
                        header("Location: login.php");
                        die;
                      } 
                      else {
                        $wrng_pass = "User already Registered.";
                      }

                }
                else
                    $wrng_pass = "Use bigger password.";
            }
            else
                $wrng_pass = "Enter valid email address.";
        }
        else
            $wrng_pass = "Please fill all information.";
    }

?>

<html lang="en">
<head>
   
    <title>Manager Registration</title>
	<link rel="stylesheet" href="../css/all.min.css" >
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
 	<link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="login_home">
        <div id="signup_window" class="signup_window">
            <h3>Online Prescription</h3>
            <?php 
                if(isset($wrng_pass))
                {
                    echo '<h4 class= "wrng_pass" >' .$wrng_pass. '</h4>' ;
                }
            ?>
            <form  method="POST">
                <div class="fill_box">
                    <h4>User ID(5 Digit)*: </h4>
                    <input type="text" name="user_id" placeholder="Enter 5 Digit User ID" required>
                </div>
                
                <div class="fill_box">
                    <h4>Full Name*: </h4>
                    <input type="text" name="full_name" placeholder="Full Name" required>
                </div>
                <div class="fill_box">
                    <h4>Email*: </h4>
                    <input type="Email" name="email" placeholder="Email" required>
                </div>
                <div class="fill_box">
                    <h4>Designation*: </h4>
                    <input type="text" name="designation" id="designation" placeholder="Designation" required>
                </div>
                <div class="fill_box">
                    <h4>Password (5-8 digit)*: </h4>
                    <input type="password" name="password" placeholder="Password 5-8 digit" title="Enter your Password!!" required>
                </div>
                <div class="submit">
                    <input type="submit" value="Register">
                </div>
                
            </form>
            <div class="new_user">
                <p>Already users? <span><a href="../login.php">Login Here!</a></span></p>
            </div>
            
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
</body>
</html>