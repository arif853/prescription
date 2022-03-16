<?php
	session_start();

	include("db_con/database_con.php");
	if(!empty($_SESSION["logged_in"])){

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
		$hospital = $user_data['hospital'];

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
<div class="header">
					<h2>Welcome to Online Prescription System.</h2>
					<h4>Hello <?php echo $full_name ?></h4>
					<a href="logout.php" class="btn btn-secondary">Logout</a><br>
				</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="doc-info">
					<h4>Doctor Information</h4>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>User ID: </th>
						<td> <?php echo $user;?> </td>
					</tr>
					<tr>
						<th>Name: </th>
						<td> <p><?php echo $full_name;?></p> </td>
					</tr>
					<tr>
						<th>Titles: </th>
						<td> <p><?php echo $designation.' , '.$designation2;?></p> </td>
					</tr>
					<tr>
						<th>Email: </th>
						<td> <p><?php echo $email;?></p> </td>
					</tr>
					<tr>
						<th>Date of Birth: </th>
						<td> <p><?php echo $DOB;?></p> </td>
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
						<th>Gender: </th>
						<td> <p><?php echo $gender;?></p> </td>
					</tr>
					<tr>
						<th>Hospital: </th>
						<td> <p><?php echo $hospital;?></p> </td>
					</tr>
					<tr>
						<td colspan='2'><a href="updatedoc.php?did=<?php echo $doc_id1;?>" class="btn btn-info ">Update</a> </td>
					</tr>
				</table>
			</div>
			<div class="col-lg-6">
				<div class="patient">
					<table class="table table-bordered">
						<tr>
							<td>Add New Patient</td>
							<td>Add Medicine</td>
						</tr>
						<tr>
							<td>
								<a href="patient.php" class="btn btn-success">Add Patient</a>
							</td>
							<td>
							<a href="medicine.php" class="btn btn-success">Add Medicine</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="doc-info">
					<h4>Patient Information</h4>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>#UPI </th>
						<th>Name </th>
						<th colspan='2'>Action</th>
					</tr>
					<?php
						$patient_query = "SELECT * FROM patient WHERE 1 ";
						$data = mysqli_query($conn, $patient_query);
						$i=0;
						while($row = mysqli_fetch_array($data)) {
							//if($_SESSION["doc_id"] == $row['doc_id']){
						?>
					<tr>
						<td><?php echo $row['upi']; ?></td>
						<td><?php echo $row['fname'].' '.$row["lname"]; ?></td>
						<td><a href="view_patient.php?id=<?php echo $row['upi']; ?>" class="btn btn-info" >View</a></td>
						<td><a href="prescription.php?id=<?php echo $row['upi']; ?>" class="btn btn-warning" >Prescribe</a></td>
					</tr>
					<?php
							
						$i++;
						}
					?>
				</table>
			</div>
		</div>
		
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>