<?php
session_start();
    include("db_con/database_con.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //somthing read
        $user_id = $_POST['user_id'];
		$password = $_POST['password'];
        
        if(!empty($user_id) && !empty($password))
        {
            //fetch from database
            $query = "SELECT doc_id, password FROM users WHERE doc_id = '$user_id' limit 1 ";
            $result = mysqli_query($conn, $query);

            if($result){
                if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if(password_verify($password, $user_data['password']))
					{
                        $_SESSION['doc_id'] = $user_data['doc_id'];
						header("Location: dashboard.php");
						die;
					}
                    else
                    $wrng_pass = "Wrong user_id or password!";
				}
                else
                $wrng_pass = "User does not exist!!";
            }
        }
        else
        $wrng_pass = "Wrong inputs!";
    }
?>

<html lang="en">
<head>
   
    <title>Login</title>
	<link rel="stylesheet" href="css/all.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
 	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login_home">
        <div id="login_window" class="login_window">
            <h3>Online Prescription</h3>
            <?php 
                if(isset($wrng_pass))
                {
                    echo '<h4 class= "wrng_pass" >' .$wrng_pass. '</h4>' ;
                }
            ?>
            <form method="POST">
                <div class="fill_box">
                    <h4>User ID: </h4>
                    <input type="text" name="user_id" placeholder="User ID">
                </div>
                <div class="fill_box">
                <h4>Password: </h4>
                    <input type="password" name="password" id="" placeholder="Password">
                </div>
                <div class="submit">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="new_user">
                <p>Register as a Doctor! <span><a href="signup.php">SignUp Here!</a></span></p>
            </div>
            <p></p>
            <!-- <div class="frgt_pswd">
                <a href="#">Forget Password?</a>
            
            </div> -->
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    
</body>
</html>