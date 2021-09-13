<?php
include("db_con/database_con.php");
if(isset($_GET["id"])){

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
            $pid= $data['pid'];
            $p_query = "SELECT * FROM problems WHERE pid ='$pid' ";
            $p_result = mysqli_query($conn, $p_query);
            $pdata= mysqli_fetch_array($p_result);
        $problem = $pdata['indications'];

}

if(isset($_POST['delete'])){
        
    $upi = $data['upi'];
    $del_query = "DELETE FROM patient WHERE upi ='$upi'";
    $del_result = mysqli_query($conn, $del_query);

    if($del_result){
        echo "<script> alert('Record  Deleted.') </script>";
        header("Location: dashboard.php");
        die;
    }
    else{
        echo "<script> alert('Record not Deleted.') </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Online Prescription</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

	<link rel="stylesheet" href="css/all.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
 	<link rel="stylesheet" href="css/style.css">
 </head>
<body>
    <div class="header">
        <h1>Patients</h1>
        <a href="dashboard.php" class="btn btn-info">Home</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a><br>
    </div>
	<div class="container">
		<div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-bordered">
					<tr>
						<th>User ID: </th>
						<td> <?php echo $upi;?> </td>
					</tr>
					<tr>
						<th>Name: </th>
						<td> <p><?php echo $fname.' '.$lname;?></p> </td>
					</tr>
					<tr>
						<th>Age: </th>
						<td> <p><?php echo $age;?></p> </td>
					</tr>
					<tr>
						<th>Address: </th>
						<td> <p><?php echo $address;?></p> </td>
					</tr>
					<tr>
						<th>Phone: </th>
						<td> <p><?php echo $phone;?></p> </td>
					</tr>
					<tr>
						<th>Email: </th>
						<td> <p><?php echo $email;?></p> </td>
					</tr>
					<tr>
						<th>Phone: </th>
						<td> <p><?php echo $phone;?></p> </td>
					</tr>
					<tr>
						<th>Gender: </th>
						<td> <p><?php echo $sex;?></p> </td>
					</tr>
                    <tr>
						<th>Problems: </th>
						<td> <p><?php echo $problem;?></p> </td>
					</tr>
					<tr>
						<td colspan='2'>
                            <div class="fill_box col-lg-12">
                                <form  method="POST">
                                     <a href="update_patient.php?id=<?php echo $id;?>" class="btn btn-success ">Update</a>
                                     <input type="submit" class="btn btn-danger" name="delete" value="Delete Patient" >  
                                </form>
                            </div>
                        </td>
                    </tr>
				</table>
            </div>
        <!-- </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">History</h3>
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Patient Name</td>
                        <td>Problems</td>
                        <td>Last Prescription</td>
                    </tr>
                   
                    <?php 

                        $his_query="SELECT * FROM `prescription` WHERE pid='$id'";
                        $his_result =mysqli_query($conn, $his_query);
                        $i = 1;
                        while($his_data = mysqli_fetch_array($his_result)){
                    ?>
                     <tr>
                        <td><?php echo $his_data['prescriptionID'];?></td>
                        <td><?php echo $fname.' '.$lname;?></td>
                        <td><?php echo $problem;?></td>
                        <td><?php echo $his_data['prescriptionID'];?></td>
                    </tr>
                        <?php
                        $i++; 
                        }
                        ?>
                    
				</table>
            </div>
        </div> -->
	</div>
		

</body>
</html>