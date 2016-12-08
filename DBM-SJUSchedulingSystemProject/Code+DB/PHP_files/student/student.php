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


<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<html>
<div class = "pagediv">

	<body>
		<ul>
			<li><a class="active"  href="../student/student.php"> Home </a></li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Search </a>
				<div class="dropdown-content">
					<a href= "../student/view_college.php"> College Information </a>
					<a href= "../student/student_view_program.php"> Program Information </a>
					<a href= "../student/student_view_course.php"> Course Description </a>
					<a href= "../student/view_offered_classes.php"> Offered Courses </a>
					<a href= "../student/view_schedule.php"> Schedule </a>
					<a href= "../student/student_view_student_by_name.php"> Student Information </a>
					<a href= "../student/student_view_faculty_by_name.php"> Faculty Information </a>
				</div>
			</li>
			<li style = "float:right"><a href="../home/logout.php"> Logout</a></li>
			<li style = "float:right"><a href="../student/edit_student_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $StdFName ; ?></a></li>
		</ul> 
	
		<div class = "formdiv">
			<h1>Student's Portal</h1>
			<br></br>
				<center><img src="../images/img7.jpg" alt="SJU" width="600" height="400"></center>
			<br></br>
		</div>

	</body>
	
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
</div>
</html>