<?php 
		session_start(); 
		include_once '../connection.php';
		$StdID = $_SESSION['Student'];
		if(!isset($StdID))
		{
			header("Location: ../home/index.php");
		}
		$StdFName = $_SESSION['StdFName'];
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
			<li><a href="../student/student.php"> Home </a></li>
			<li class ="dropdown"><a class="active"  href="" class="dropbtn"> Search </a>
				<div class="dropdown-content">
					<a href= "../student/view_college.php"> College </a>
					<a href= "../student/student_view_program.php"> Program Information </a>
					<a href= "../student/student_view_course.php"> Course Description </a>
					<a href= "../student/view_offered_classes.php"> Offered Courses </a>
					<a href= "../student/view_schedule.php"> Schedule </a>
					<a href= "../student/student_view_student_by_name.php"> Student </a>
					<a href= "../student/student_view_faculty_by_name.php"> Faculty </a>
				</div>
			</li>
			<li style = "float:right"><a href="../home/logout.php"> Logout</a></li>
			<li style = "float:right"><a href="../student/edit_student_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $StdFName ; ?></a></li>
		</ul> 
		
		<div class ="formdiv">
			<br></br>
			<h1>Would you like to view:</h1>
			<br></br>
				<center><a  class='singlelink3 width-400px' href='../student/view_full_schedule.php'> Full Schedule</a>
				<a  class='singlelink3 width-400px' href='../student/view_course_schedule.php'> Course Schedule </a></center>
			
			<br></br>
			<br></br>
			
				<a  class='singlelink2' href='../student/student.php'> Back </a>

			
			
		</div>
	
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
	</div>
</html>