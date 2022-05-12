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
								<div class="select_med">
										<h4 class="text-center">Select Medicine</h4>
										<form  method="POST" >
											<select class="form-control" id="select_med" name="select_med" required>
											<?php
												session_start();	
												include("db_con/database_con.php");
												$id = $_SESSION['pid'];
												if(isset($_POST['add_med'])){

													$select_med = $_POST['select_med'];
													$med_time = $_POST['m_time'];
													$med_use = $_POST['m_use'];

													$med_query = "INSERT INTO select_med(med, useage, duration, patient_id, ps_ID, added_date) 
																	VALUES ('$select_med','$med_time','$med_use','$id','$prescription_no' ,'$date')";
													$medresult = mysqli_query($conn, $med_query);
													if($medresult)
														echo 'added';
													else 
														echo 'Not added';
												}

												$query = "SELECT * FROM medicine ";
												$data = mysqli_query($conn, $query);
												
												while( $med = mysqli_fetch_array($data))
												{
												echo "<option value=".$med['mid'].">".$med['med_name']."</option>";
												}
												
											?>
											</select>
											<input type="text" class="form-control" name="m_time" placeholder="0+0+0" >
											<input type="text" class="form-control" name="m_use" placeholder="Days/weeks/Months" >
											<input type="submit" name="add_med" class="btn btn-success" value="Add Medicine" >

										</form>
									</div>
									<div class="add_med">
										<p class="rx">Rx: </p>
										<table class="table table-bordered">
											<?php
												$t_query = "SELECT * FROM select_med ";
												$t_result = mysqli_query($conn, $t_query);
												$i=0;
												while($data= mysqli_fetch_array($t_result))
												{
													if($id == $data['patient_id'] && $date == $data['added_date']){
											?>
												<tr>
													
													<td>
														<?php 
															$mid = $data['med'];
															$query = "SELECT * FROM medicine WHERE mid='$mid'";
															$data1 = mysqli_query($conn, $query);
															$med1 = mysqli_fetch_array($data1);
															echo $med1['med_name'];
														?>
													</td>
													<td><?php echo $data['useage'];?></td>
													<td><?php echo $data['duration'];?></td>
												</tr>
												<?php
													$i++;
													}
												}
												?>
												
										</table>
									</div>
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