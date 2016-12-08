<?php 
		session_start(); 
		include_once '../connection.php';
		$EmpID = $_SESSION['Employee'];
		if(!isset($EmpID))
		{
			header("Location: ../home/index.php");
		}
		$EmpFName = $_SESSION['EmpFName'];
		
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

	<div class = "pagediv">

	<body>
		<ul>
			<li><a  href="../employee/employee.php"> Home </a></li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Add </a>
				<div class="dropdown-content">
					<a href= "../employee/new_student.php"> New Student </a>
					<a href= "../employee/new_faculty.php"> New Faculty </a>
					<a href= "../employee/new_schedule.php"> Schedule a Class </a>
					<a href= "../employee/offer_class.php"> Offer a Course </a>
				</div>
			</li>
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Search </a>
				<div class="dropdown-content">
					<a href= "../employee/view_college.php"> College Information </a>
					<a href= "../employee/view_course.php"> Course Information </a>
					<a href= "../employee/view_classroom.php"> Classroom Information</a>
					<a href= "../employee/view_offered_classes.php"> Offered Classes </a>
					<a href= "../employee/view_schedule.php"> Schedule </a>
					<a href= "../employee/view_student_by_name.php"> Student Information</a>
					<a href= "../employee/view_faculty_by_name.php"> Faculty Information </a>
				</div>
			</li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Edit </a>
				<div class="dropdown-content">
					<a href= "../employee/edit_faculty.php"> Faculty Information </a>
					<a href= "../employee/edit_student.php"> Student Information </a>
					<a href= ""> Schedule <small>- comming soon</small></a>
					<a href= ""> Offered Classes <small>- comming soon</small> </a>
				</div>
			</li>
			<li style = "float:right"><a href="../home/logout.php"> Logout</a></li>
			<li style = "float:right"><a href="../employee/edit_employee_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $EmpFName ; ?></a></li>
		</ul> 
		
		<div class ="formdiv">
			<br></br>
			<h1>Would you like to view:</h1>
			<br></br>
				<center><a  class='singlelink3 width-400px' href='../employee/view_full_schedule.php'> Full Schedule</a> 
				<a  class='singlelink3 width-400px' href='../employee/view_course_schedule.php'> Course Schedule </a> </center>
			
			<br></br>
			<br></br>
			
				<a  class='singlelink2' href='../employee/employee.php'> Back </a>

			
			
		</div>
	
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
	</div>
</html>