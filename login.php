<?php
session_start();
    include("db_con/database_con.php");
    if(isset($_POST['submit'])== true){
        //somthing read
        $user_id = $_POST['user_id'];
		$password = $_POST['password'];
        
        if(!empty($user_id) && !empty($password))
        {
            //fetch from database
            $query = "SELECT doc_id, password FROM users WHERE doc_id = '$user_id' limit 1 ";
            $result = mysqli_query($conn, $query);

            $m_query = "SELECT user_id, password FROM manager WHERE user_id = '$user_id' limit 1 ";
            $m_result = mysqli_query($conn, $m_query);
            
            if($result){
                if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if(password_verify($password, $user_data['password']))
					{
                            $_SESSION['logged_in'] = true;
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
            if($m_result){
                if($m_result && mysqli_num_rows($m_result) > 0)
				{
					$m_data = mysqli_fetch_assoc($m_result);
					if(password_verify($password, $m_data['password']))
					{
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_id'] = $m_data['user_id'];
                        $_SESSION['doc_id'] = $user_data['doc_id'];
                        header("Location: manager/index.php");
                        die;
                        
					}
                    else
                    $wrng_pass = "Wrong user_id or password!!!";
				}
                else
                $wrng_pass = "User does not exist!!!!!";
                # code...
                
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
            <h3>Login Here</h3>
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
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
            <div class="new_user">
                <p>Register as a Doctor! <span><a href="signup.php">SignUp Here!</a></span></p>
                <p>Register as a Manger! <span><a href="manager/manager.php">Click Here!</a></span></p>
                <p>Foget Password <span ><a href="forgetpassword.php">Click Here!</a></span></p>
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