<?php
session_start();

include("db_con/database_con.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //somthing was posted
if( isset($_POST['m_name']) && isset($_POST['indication']) && isset($_POST['usage']) && isset($_POST['comment']))
   {
    
    $med_name = $_POST['m_name'];
    $indication = $_POST['indication'];
    $indication1 = $_POST['indication1'];
    $usage = $_POST['usage'];
    $comment = $_POST['comment'];
    
    
        if(!empty($med_name) && !empty($indication) && !empty($usage) && !empty($comment))
        {
                //save to database
                
            $query1 = "INSERT INTO medicine(med_name, indication, indication1, usages, instruction) 
            VALUES ('$med_name','$indication','$indication1','$usage','$comment')";
                    
            $result1 = mysqli_query($conn, $query1);
            if($result1 == true)
            {
                $wrng_pass = "New Medicine Added.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Registation</title>
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
                 
                <?php 
                    if(isset($wrng_pass))
                    {
                        echo '<h4 class= "wrng_pass" >' .$wrng_pass. '</h4>' ;
                    }
                ?>
                <div class="patient-reg">
                    <form  method="POST" >
                        <div class="fill_box col-lg-3">
                            <h4>Medicine Name*: </h4>
                            <input type="text" name="m_name" placeholder="Medicine Name" required>
                        </div>
                        <!-- <div class="fill_box col-lg-3">
                            <h4>Indications*: </h4>
                            <input type="text" name="indication" placeholder="Indications" required>
                        </div> -->
                        
                        <div class="fill_box col-lg-3">
                            <h4>Indications: </h4>
                            <select name="indication" id="prblm" require>
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
                        <div class="fill_box col-lg-3">
                            <h4>Indications-2: </h4>
                            <select name="indication1" id="prblm" require>
                                <option value="">Select a problem</option>
                                <?php
                                    $prbl_query1 = "SELECT * FROM problems WHERE 1 ";
                                    $result1 = mysqli_query($conn, $prbl_query1);
                                    $i=0;
                                    while($data1= mysqli_fetch_array($result1))
                                  {
                                ?>
                                <option value="<?php echo $data1['pid']; ?>"><?php echo $data1['indications']; ?></option>
                                <?php
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="fill_box col-lg-3">
                            <h4>Usage*: </h4>
                            <input type="text" name="usage" placeholder="Usage" required>
                        </div>
                        <div class="fill_box col-lg-12">
                            <h4>Instructions: </h4>
                            <input type="text" name="comment" ></input>
                        </div>
                        <br>
                        <div class="fill_box col-lg-12">
                            <input type="submit" class="btn btn-success" value="Add Medicine" >
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
                                <td>Indications</td>
                                <td>Usage</td>
                                <td>Instructions</td>
                            </tr>
                            <?php
                                $t_query = "SELECT * FROM medicine WHERE 1 ";
                                $t_result = mysqli_query($conn, $t_query);
                                $i=0;
                                 while($data= mysqli_fetch_array($t_result))
                                  {
                            ?>
                             <tr>
                                <td><?php echo $data['mid']; ?></td>
                                <td><?php echo $data['med_name']; ?></td>
                                <?php 
                                    $pid_val = $data['indication'];
                                    $ind_query = "SELECT indications FROM problems WHERE pid ='$pid_val' ";
                                    $ind_result = mysqli_query($conn, $ind_query);
                                    $ind_data = mysqli_fetch_array($ind_result);

                                    $pid_val1 = $data['indication1'];
                                    $ind_query1 = "SELECT indications FROM problems WHERE pid ='$pid_val1' ";
                                    $ind_result1 = mysqli_query($conn, $ind_query1);
                                    $ind_data1 = mysqli_fetch_array($ind_result1);

                                ?>
                                <td><?php echo $ind_data['indications'].', '.$ind_data1['indications']; ?></td>
                               
                                <td><?php echo $data['usages']; ?></td>
                                <td><?php echo $data['instruction']; ?></td>
                            </tr>
                            <?php
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