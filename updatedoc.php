<?php
session_start();

	include("db_con/database_con.php");
    
    if(isset($_GET['did'])){
        $id = $_GET['did'];
        $v_query = "SELECT * FROM users WHERE doc_id ='$id' ";
        $result = mysqli_query($conn, $v_query);
        $user_data= mysqli_fetch_array($result);
		
		$full_name = $user_data['fullname'];
		$email = $user_data['email'];
		$designation = $user_data['designation'];
		$designation2 = $user_data['desig_other'];
		$DOB = $user_data['DOB'];
		$address = $user_data['address'];
		$phone = $user_data['phone'];
		$gender = $user_data['gender'];
        $hospital = $user_data['hospital'];
    }
    else{
        echo "Not set";
    }

    if(isset($_POST['submit'])){

        $full_name = $_POST['f_name'];
		$email = $_POST['email'];
		$designation = $_POST['designation'];
		$designation2 = $_POST['designation1'];
		$DOB = $_POST['dob'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$gender = $_POST['sex'];
        $hospital = $_POST['hospital'];

         $update_query = "UPDATE users SET fullname='$full_name',email='$email',designation='$designation',desig_other='$designation2',DOB='$DOB',address='$address',phone='$phone',gender='$gender',hospital='$hospital' WHERE doc_id ='$id'";
         $up_result = mysqli_query($conn,$update_query);

        if($up_result){
            echo "<script> alert('Record Updated.') </script>";
        }
        else{
            echo "Fail to update.";
        }

    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Prescription</title>
    <link rel="stylesheet" href="css/all.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
 	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>Doctor Profile Update</h1>
        <a href="dashboard.php" class="btn btn-info">Home</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="patient-reg">
                    <form  method="POST" >
                        <div class="fill_box col-lg-3">
                            <h4>Full Name: </h4>
                            <input type="text" name="f_name"  value="<?php echo $full_name;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Email: </h4>
                            <input type="email" name="email" value="<?php echo $email;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Designation: </h4>
                            <input type="text" name="designation" value="<?php echo $designation;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Designation Others: </h4>
                            <input type="text" name="designation1" value="<?php echo $designation2;?>" >
                        </div>
                        
                        <div class="fill_box col-lg-3">
                            <h4>DOB: </h4>
                            <input type="date" name="dob" value="<?php echo $DOB;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Address: </h4>
                            <input type="text" name="address" value="<?php echo $address;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Phone: </h4>
                            <input type="text" name="phone" value="<?php echo $phone;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Hospital: </h4>
                            <input type="text" name="hospital"  value="<?php echo $hospital;?>">
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Sex*: </h4>
                            <select name="sex" id="prblm" >
                                <option value="<?php echo $gender;?>">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="fill_box col-lg-12">
                            <input type="submit" class="btn btn-success" name="submit" value="Update" >
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>