<?php

	include_once("db_con/database_con.php");   
    if(isset($_POST['reset'])){

      $user = $_POST["user_id"];
      $password = $_POST['newpassword'];
      $hash = password_hash($password,PASSWORD_DEFAULT);

      $query1 = "SELECT doc_id FROM users WHERE doc_id = '$user' limit 1 ";
  
      $result1 = mysqli_query($conn, $query1);

      if($result1 && mysqli_num_rows($result1) > 0){

        $setpass = "UPDATE users SET password ='$hash' WHERE doc_id = '$user'";
        $set_result= mysqli_query($conn, $setpass);
  
        if($set_result){
          $wrng_pass= " Password Updated.";
        }
        else {
          $wrng_pass = "Password Not Updated.";
        }
      }
      else {
        $wrng_pass = "Enter Valied Username.";
      }
      
    } 


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Prescription</title>


    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
 </head>
<body>
	<!-- Navbar -->
	<?php //include_once("./templates/header.php"); ?>
	<br/><br/>
  <div class="container">
    <div class="overlay">
      <div id="mini_window">
          <form  method="POST" class="text-center">
                <h2 class=" mb-3 mt-3">Reset Your Password</h2>
                <?php 
                          if(isset($wrng_pass))
                          {
                              echo '<h4 class= "wrng_pass" style="Color: red" >' .$wrng_pass. '</h4>' ;
                          }
                      ?>
                <div class="fill_box" >
                    <h4>User ID: </h4>
                    <input type="text" name="user_id" placeholder="Your User id." required>
                </div>
                <div class="fill_box">
                <h4>New password: </h4>
                    <input type="password" name="newpassword" placeholder="New Password" required>
                </div>
                <div class="fill_box">
                    <input type="submit" name="reset" class="btn btn-primary " value="change password">
                </div>
          </form>
          <div class="new_user">
              <a href="login.php" class="btn btn-success">Login Here!</a>
          </div>
      </div>
    </div>

   
	</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  <script src="script.js"></script>
	
</body>
</html>