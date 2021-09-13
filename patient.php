<?php
session_start();

	include("db_con/database_con.php");

    $six_digit_random_number = random_int(100000, 999999);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //somthing was posted
    if( isset($_POST['sex']) && isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['age']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['bp'])  && isset($_POST['temarature']) && isset($_POST['weight']))
       {
        $uid = $six_digit_random_number;
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $bp = $_POST['bp'];
        $temp = $_POST['temarature'];
        $weight = $_POST['weight'];
        $sex = $_POST['sex'];
        $pid = $_POST['problem'];
        
        if(isset($_SESSION["doc_id"]) == true){

            $user = $_SESSION["doc_id"];
            $u_query = "SELECT doc_id FROM users WHERE doc_id = '$user' limit 1 ";
            $u_result = mysqli_query($conn, $u_query);
            $user_data = mysqli_fetch_array($u_result);

            $doc_id = $user_data['doc_id'];
        }
            if(!empty($f_name) && !empty($l_name) && !empty($age) && !empty($phone))
            {
                    //save to database
                $query = "INSERT INTO patient(pid, upi, fname, lname, age, address, phone, email, bp, temparature, weight, sex, doc_id) 
                            VALUES ('$pid','$uid','$f_name','$l_name','$age','$address','$phone','$email','$bp','$temp','$weight','$sex','$doc_id')";
                $result = mysqli_query($conn,$query);
                if($result == true)
                {
                    $wrng_pass = "New Patient Added.";
                }
                else
                $wrng_pass = "Wrong Query";
            }
            else
                $wrng_pass = "Please fill all information.";
       } 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registation</title>
    <link rel="stylesheet" href="css/all.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
 	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>Patient Registation</h1>
        <a href="dashboard.php" class="btn btn-info">Home</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a><br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                 
                <?php 
                    if(isset($wrng_pass))
                    {
                        echo '<h5 class= "wrng_pass" >' .$wrng_pass. '</h5>' ;
                    }
                ?>
                <div class="patient-reg">
                    <form  method="POST" >
                        <div class="fill_box col-lg-3">
                            <h4>UPI*: </h4>
                            <input name="upi" disabled  placeholder="<?php echo $six_digit_random_number; ?>" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>First Name*: </h4>
                            <input type="text" name="f_name" placeholder="First Name" required>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Last Name*: </h4>
                            <input type="text" name="l_name" placeholder="Last Name" required>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Age*: </h4>
                            <input type="text" name="age" placeholder="Age" required>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Address*: </h4>
                            <input type="text" name="address" placeholder="Address" required>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Phone*: </h4>
                            <input type="text" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Email: </h4>
                            <input type="email" name="email" placeholder="Email" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>BP*: </h4>
                            <input type="text" name="bp" placeholder="Blood Pressure" require>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Temarature*: </h4>
                            <input type="text" name="temarature" placeholder="Temarature" require>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Weight*: </h4>
                            <input type="text" name="weight" placeholder="Weight" >
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Sex*: </h4>
                            <select name="sex" id="prblm" require>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        
                        <div class="fill_box col-lg-3">
                            <h4>Problems*: </h4>
                            <select name="problem" id="prblm" require>
                            <option value="">Select a problem</option>
                                <?php
                                    $prbl_query = "SELECT * FROM problems WHERE 1 ";
                                    $result = mysqli_query($conn, $prbl_query);
                                    $i=0;
                                    while($data= mysqli_fetch_array($result))
                                  {
                                ?>
                                <option value="<?php echo $data['pid']; ?>"><?php echo $data['indications']; ?></option>
                                <?php
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="fill_box col-lg-12">
                            <input type="submit" class="btn btn-success" value="Add Patient" >
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="view_patient">
                        <table class="table table-bordered">
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Age</td>
                                <td>Address</td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td>Sex</td>
                                <td>Problems</td>
                            </tr>
                           
                            <?php
                                $v_query = "SELECT * FROM patient WHERE 1 ";
                                $v_result = mysqli_query($conn, $v_query);
                                $i=0;
                                 while($data= mysqli_fetch_array($v_result))
                                  {
                                      if($_SESSION["doc_id"] == $data['doc_id']){
                            ?>
                             <tr>
                                <td ><?php echo $data['upi']; ?></td>
                                <td><?php echo $data['fname'].' '.$data['lname']; ?></td>
                                <td ><?php echo $data['age']; ?></td>
                                <td><?php echo $data['address']; ?></td>
                                <td><?php echo $data['phone']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['sex']; ?></td>
                                <?php
                                $pid= $data['pid'];
                                    $p_query = "SELECT * FROM problems WHERE pid ='$pid' ";
                                    $p_result = mysqli_query($conn, $p_query);
                                    $pdata= mysqli_fetch_array($p_result)
                                ?>
                                <td><?php echo $pdata['indications']; ?></td>
                            </tr>
                            <?php
                                      }
                                    $i++;
                                }
                                ?>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>