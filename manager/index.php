<?php
	session_start();
	include("../db_con/database_con.php");
	if(!empty($_SESSION["logged_in"])){

		$manager = $_SESSION["user_id"];
		$query = "SELECT * FROM users  ";

		$result = mysqli_query($conn, $query);
	}	
	 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Prescription Admin</title>

    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="header">
        <h2>Welcome to Online Prescription admin Section.</h2>
        <h4>Hello </h4>
        <a href="../logout.php" class="btn btn-secondary">Logout</a><br>
    </div>
    <div class="container">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Education</th>
      <th scope="col">Gender</th>
      <th scope="col">Speciality</th>
      <th scope="col">Appointment Days</th>
      <th scope="col">Appointment date</th>
      <th scope="col">Available Time </th>
      <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $data){ ?>
    <tr>
      <th><?php echo $data['fullname']; ?></th>
      <td><?php echo $data['designation']; ?></td>
      <td><?php echo $data['gender']; ?></td>
      <td><?php echo $data['gender']; ?></td>
      <td><?php echo $data['gender']; ?></td>
      <td><?php echo $data['gender']; ?></td>
      <td><?php echo $data['gender']; ?></td>
      <td><a href="" class="btn btn-primary">Get Appointment</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>