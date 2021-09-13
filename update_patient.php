<?php
session_start();

	include("db_con/database_con.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $v_query = "SELECT * FROM patient WHERE upi ='$id'";
        $result = mysqli_query($conn,$v_query);
        $data= mysqli_fetch_array($result);
        
        $upi = $data['upi'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $age = $data['age'];
        $address = $data['address'];
        $phone = $data['phone'];
        $email = $data['email'];
        $bp = $data['bp'];
        $temp = $data['temparature'];
        $weight = $data['weight'];
        $sex = $data['sex'];  
    }

    if(isset($_POST['submit'])){
            
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $age1 = $_POST['age'];
        $address1 = $_POST['address'];
        $phone1 = $_POST['phone'];
        $email1 = $_POST['email'];
        $bp1 = $_POST['bp'];
        $temp1 = $_POST['temarature'];
        $weight1 = $_POST['weight'];
        $sex1 = $_POST['sex'];

        $update_query = "UPDATE patient SET fname='$f_name',lname='$l_name',age='$age1',address='$address1',phone='$phone1',email='$email1',bp='$bp1',temparature='$temp1',weight='$weight1',sex='$sex1' WHERE upi = '$id'";
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
    <title>Patient</title>
    <link rel="stylesheet" href="css/all.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
 	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>Medicine Registation</h1>
        <a href="dashboard.php" class="btn btn-info">Home</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="patient-reg">
                    <form  method="POST" >
                        <div class="fill_box col-lg-3">
                            <h4>First Name*: </h4>
                            <input type="text" name="f_name"  value="<?php echo $fname;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Last Name*: </h4>
                            <input type="text" name="l_name" value="<?php echo $lname;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Age*: </h4>
                            <input type="text" name="age" value="<?php echo $age;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Address*: </h4>
                            <input type="text" name="address" value="<?php echo $address;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Phone*: </h4>
                            <input type="text" name="phone" value="<?php echo $phone;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Email: </h4>
                            <input type="email" name="email" value="<?php echo $email;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>BP*: </h4>
                            <input type="text" name="bp" value="<?php echo $bp;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Temarature*: </h4>
                            <input type="text" name="temarature" value="<?php echo $temp;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Weight*: </h4>
                            <input type="text" name="weight" value="<?php echo $weight;?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Sex*: </h4>
                            <select name="sex" id="prblm" value= "<?php echo $sex;?>">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="fill_box col-lg-12">
                            <input type="submit" class="btn btn-success" name="submit" value="Update Patient" >
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