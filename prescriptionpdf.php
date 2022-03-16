<?php
	session_start();
	include("db_con/database_con.php");
	// $pres_no = $_SESSION['pno'];
	if(isset($_SESSION["doc_id"]) == true){

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
	if(isset($_SESSION['pid'])){
        $id = $_SESSION['pid'];
        $v_query = "SELECT * FROM patient WHERE upi ='$id'";
        $result = mysqli_query($conn,$v_query);
        $data= mysqli_fetch_array($result);

        $fname = $data['fname'];
        $lname = $data['lname'];
        $age = $data['age'];
        $phone1 = $data['phone'];
        $bp = $data['bp'];
        $temp = $data['temparature'];
        $weight = $data['weight'];
        $sex = $data['sex'];  
		
    }	

	$p_query = "SELECT * FROM prescription WHERE pid = $id";
	$p_result = mysqli_query($conn, $p_query);
	$pdata= mysqli_fetch_array($p_result);

	$p_no = $pdata['prescriptionID'];


	$date =date("Y-m-d") ;

	require_once('fpdf/fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->Cell(100,15,"",0,1);

	$pdf->setFont("Arial","B",16);
	$pdf->Cell(190,10,$full_name,0,1,"C");
	$pdf->setFont("Arial",NULL,10);
	$pdf->Cell(190,5,$designation.", ".$designation2,0,1,"C");
	$pdf->Cell(190,5,$hospital,0,1,"C");
	$pdf->Cell(65,5,"",0,0,"R");
	$pdf->Cell(25,5,"".$email,0,0,"C");
	$pdf->Cell(14,5,"",0,0,"R");
	$pdf->Cell(22,5,"".$phone,0,1,"C");

	$pdf->Cell(50,10,"",0,1);

	$pdf->Cell(70,8,"Name: ".$fname." ".$lname,1,0);
	$pdf->Cell(40,8,"Age: ".$age,1,0);
	$pdf->Cell(40,8,"Gender: ".$sex,1,0);
	$pdf->Cell(40,8,"Date: ".$date,1,1);

	$pdf->Cell(100,15,"",0,1);

	$pdf->setFont("Arial","B",12);
	$pdf->Cell(100,10,"Rx: ",0,1);

	$t_query = "SELECT * FROM select_med WHERE 1";
	$t_result = mysqli_query($conn, $t_query);
	$i=0;
	$pdf->setFont("Arial",NULL,10);
	
	while($tdata= mysqli_fetch_array($t_result))
	{
		if($id == $tdata['patient_id'] && $date == $tdata['added_date']){

			$mid = $tdata['med'];
			$query = "SELECT * FROM medicine WHERE mid='$mid'";
			$data1 = mysqli_query($conn, $query);
			$med1 = mysqli_fetch_array($data1);
			$med_name= $med1['med_name'];

		$usage = $tdata['useage'];
		$duration = $tdata['duration'];
		$pdf->cell(1,70,"",0,0);
		$pdf->Cell(100,8,$med_name,1,0);
		$pdf->Cell(50,8,$usage,1,0);
		$pdf->Cell(40,8,$duration,1,1);
		
		}
		$i++;
	}

	$pdf->Cell(100,20,"",0,1);
	$pdf->setFont("Arial",NULL,12);
	$pdf->Cell(100,10,"Signature ",0,1);

	

	
	$pdf->Output("PDF/Pres_".$fname."_".$date.".pdf", "F");
	$pdf->output('I');
?>