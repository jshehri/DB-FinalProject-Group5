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
			<h1>Add new Student</h1>
			<div class= "formdiv">

			<?php

				if (isset($_POST['submit']))
				{
					echo "<h3>System Response:</h3>";
					$ok = true;
					$test = true;
					$pass2 = trim($_POST['pass']);
					if(!isset($_POST['pass']) || $_POST['pass'] === '')
					{
						echo "<p class='errors'>* Password field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if((strlen($pass2)) < 6 || (strlen($pass2) > 15))
					{
						echo "<p class='errors'>* Password should be between 6-15 charactures</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['stdid']) || $_POST['stdid'] === '')
					{
						echo "<p class='errors'>* Student ID  field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['stdfn']) || $_POST['stdfn'] === '')
					{
						echo "<p class='errors'>* Student First Name field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['stdln']) || $_POST['stdln'] === '')
					{
						echo "<p class='errors'>* Student Last Name field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['pnum']) || $_POST['pnum'] === '')
					{
						echo "<p class='errors'>* Student Phone Number field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['email']) || $_POST['email'] === '')
					{
						echo "<p class='errors'>* Email field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['stdadd']) || $_POST['stdadd'] === '')
					{
						echo "<p class='errors'>* Student Address field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['progid']) || $_POST['progid'] === '')
					{
						echo "<p class='errors'>* Program Name field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['utype']) || $_POST['utype'] === '')
					{
						echo "<p class='errors'>* User Type field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if ($ok)
					{			
						$pass = md5(mysqli_real_escape_string($conn, $_POST['pass']));
						$utype = mysqli_real_escape_string($conn, $_POST['utype']);
						$stdid = mysqli_real_escape_string($conn, $_POST['stdid']);
						$stdfn = mysqli_real_escape_string($conn, $_POST['stdfn']);
						$stdln = mysqli_real_escape_string($conn, $_POST['stdln']);
						$pnum = mysqli_real_escape_string($conn, $_POST['pnum']);
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						$stdadd = mysqli_real_escape_string($conn, $_POST['stdadd']);
						$progid = mysqli_real_escape_string($conn, $_POST['progid']);						
						$tmpName = $_FILES['stdpic']['tmp_name'];
						
						if ($tmpName === 0 || $tmpName == "")
						{
							$data = null;
						}
						else
						{
							//Read the file
							$fp = fopen($tmpName, 'r');
							$data = fread($fp, filesize($tmpName));
							$data = addslashes($data);
							fclose($fp);
						}
				
						$query = "INSERT INTO login (UName, Pass, UType) 
									VALUES ('$stdid', '$pass', '$utype');
								INSERT INTO student(StdID, StdFName, StdLName, StdPhone, StdEmail, StdAddress, StdPicture, ProgID, UName)
									VALUES ('$stdid', '$stdfn', '$stdln', '$pnum', '$email', '$stdadd', '$data', '$progid','$stdid');";
						
						
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "* The record was added successfully.";
							$test = true;
						}	 
						else
						{
							//echo "ERROR: Could not able to execute $insert1 \n $insert2 " . mysqli_error($conn);
							echo "<p class='errors'>* This username is already taken, please choose another one</p>";
							$test = false;
						}
						
					}
					
					if ($test === true)
					{
						echo "<br></br>";
						echo "<a class='singlelink2' href='../employee/employee.php'><b>Back</b></a>";
						echo "  ";
						echo "<a class='singlelink2' href='../employee/new_student.php'><b>Add Another Student</b></a>";
					}
					else if ($test === false)
					{
						echo "<br></br>";
						echo "<a  class='singlelink2' href='../employee/new_student.php'> Back </a>";
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