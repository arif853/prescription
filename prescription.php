<?php
	session_start();	
	include("db_con/database_con.php");
	$date =date("Y-m-d") ;
	$prescription_no = random_int(100000, 999999);
	if(isset($_SESSION["doc_id"])){

		$user = $_SESSION["doc_id"];
		$query = "SELECT * FROM users WHERE doc_id = '$user' limit 1 ";

		$result = mysqli_query($conn, $query);
		$user_data = mysqli_fetch_array($result);
		
		$doc_id1 = $user_data['doc_id'];
		$full_name = $user_data['fullname'];
		$email = $user_data['email'];
		$designation = $user_data['designation'];
		$designation2 = $user_data['desig_other'];
		$DOB = $user_data['DOB'];
		$address = $user_data['address'];
		$phone = $user_data['phone'];
		$gender = $user_data['gender'];
		$hospital= $user_data['hospital'];
	}
	if(isset($_GET['id'])){
        $id = $_GET['id'];
        $v_query = "SELECT * FROM patient WHERE upi ='$id'";
        $results = mysqli_query($conn,$v_query);
        $data= mysqli_fetch_array($results);

        $fname = $data['fname'];
        $lname = $data['lname'];
        $age = $data['age'];
        $phone1 = $data['phone'];
        $bp = $data['bp'];
        $temp = $data['temparature'];
        $weight = $data['weight'];
        $sex = $data['sex'];  
    }	
	
	$_SESSION['pid'] = $id;
	$_SESSION['pno'] = $prescription_no;
	if(isset($_POST['submit'])){


		$prescription_query = "INSERT INTO prescription(prescriptionID, did, pid, added_date) 
		VALUES ('$prescription_no', '$user','$id','$date')";
		$p_results = mysqli_query($conn, $prescription_query);

		if($p_results){
			echo "<script> alert('Prescription Saved.')</script>";
		}
		else{
			echo "save again";
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
<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="header">
					<h2>Prescription</h2>
                    <a href="dashboard.php" class="btn btn-info">Home</a>
					<a href="logout.php" class="btn btn-secondary">Logout</a><br>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form  method="post">
					<div class="prescription">
						<table class="tab" >
							<tr >
								<td class="doc_info" colspan='4'>
									<?php echo '<h3>'.$full_name.'</h3><h5>'.$designation.', '.$designation2.'</h5><h6>'.$hospital.'</h6>Email: '.$email.' Phone: '.$phone ; ?>
								</td>
							</tr>
							<tr>
								<td >
									<?php echo 'Name: '.$fname.' '.$lname ; ?>
								</td>
								<td >
									<?php echo ' Age: '.$age; ?>
								</td>
								<td >
									<?php echo ' Gendar: '.$sex ; ?>
								</td>
								<td >
									<?php echo ' Date: '.$date; ?>
								</td>
							</tr>
							<tr>
								<!-- <td colspan='1'>
									<div class="problems">
										<h4>Chief Complaints:</h4>
										<textarea name="complaint" id="complaint" class="complaint"></textarea>
									</div>
								</td> -->
								<td colspan='4'>
									<?php 
									include("template/select_med.php");
									?>
								</td>
							</tr>
							
						</table>
						<div class="fill_box">
							<input type="hidden" name="date" value="<?php echo $date;?>">
							<input type="submit" name="submit" class="btn btn-info" value="Save">
							<a href="prescriptionpdf.php" target="_blank" class="btn btn-info">Print</a>
							<p></p>
							<p></p>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>

    <script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>