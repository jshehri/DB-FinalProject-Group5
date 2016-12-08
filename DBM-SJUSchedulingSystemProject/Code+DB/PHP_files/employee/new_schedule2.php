<!DOCTYPE html>
<html lang="en">
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

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<html>
<div class = "pagediv">

	<body>
		<ul>
			<li><a  href="../employee/employee.php"> Home </a></li>
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Add </a>
				<div class="dropdown-content">
					<a href= "../employee/new_student.php"> New Student </a>
					<a href= "../employee/new_faculty.php"> New Faculty </a>
					<a href= "../employee/new_schedule.php"> Schedule a Class </a>
					<a href= "../employee/offer_class.php"> Offer a Course </a>
				</div>
			</li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Search </a>
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
		
		
	
			<br></br>
			<h1>Schedule a Course</h1>
			<div class= "formdiv">

			<?php
				if (isset($_POST['submit']))
				{
					echo "<h3>System Response:</h3>";
					$ok = true;
					$test = true;
					if(!isset($_POST['semester']) || $_POST['semester'] === '')
					{
						echo "<p class='errors'>* Semester field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['course']) || $_POST['course'] === '')
					{
						echo "<p class='errors'>* Course Name field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['building']) || $_POST['building'] === '')
					{
						echo "<p class='errors'>* Building field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['classroom']) || $_POST['classroom'] === '')
					{
						echo "<p class='errors'>* Classroom  field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['time']) || $_POST['time'] === '')
					{
						echo "<p class='errors'>* Time field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['day']) || $_POST['day'] === '')
					{
						echo "<p class='errors'>* Day field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					
					if ($ok)
					{			
						$building = mysqli_real_escape_string($conn, $_POST['building']);
						$classroom = mysqli_real_escape_string($conn, $_POST['classroom']);
						$course = mysqli_real_escape_string($conn, $_POST['course']);
						$time = mysqli_real_escape_string($conn, $_POST['time']);
						$day = mysqli_real_escape_string($conn, $_POST['day']);
						
						$query = "INSERT INTO schedule (BID, CRNum, CID, Time, Day) 
									VALUES ('$building', '$classroom', '$course', '$time', '$day');";
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "* The record was added successfully.";
							$test = true;
						}	 
						else
						{
							//echo "ERROR: Could not able to execute $insert1 \n $insert2 " . mysqli_error($conn);
							echo "<p class='errors'>* This course or class is already taken at that day and time, please reschedule!</p>";
							$test = false;
						}
						
					}
					
					if ($test === true)
					{
						echo "<br></br>";
						echo "<a class='singlelink2' href='../employee/employee.php'><b>Back</b></a>";
						echo "  ";
						echo "<a class='singlelink2' href='../employee/new_schedule.php'><b>Schedule Another Course</b></a>";
					}
					else if ($test === false)
					{
						echo "<br></br>";
						echo "<a  class='singlelink2' href='../employee/new_schedule.php'> Back </a>";
					}
					//close connection
					mysqli_close($conn);
				}
				
			
			?>
				
			
			</div>
	</body>
			
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
</div>
</html>