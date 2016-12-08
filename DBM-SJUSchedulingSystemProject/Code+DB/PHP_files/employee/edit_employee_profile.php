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

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<html>
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
			<li class ="dropdown"><a  class="active" href="" class="dropbtn"> Search </a>
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

		<?php
		
			$ses_sql=mysqli_query($conn, "SELECT * FROM employee e , login l WHERE l.UName='$EmpID'");
			$row_sql=mysqli_fetch_array($ses_sql);
			$count_sql = mysqli_num_rows($ses_sql);

		?>
			<h1>Edit Profile</h1>
			<div class= "formdiv">
<?php
		
		if(isset($_REQUEST['submit']))
		{
			$EmpFName = mysqli_real_escape_string($conn, $_REQUEST['EmpFName']);
			$EmpLName = mysqli_real_escape_string($conn, $_REQUEST['EmpLName']);
			$EmpPhone = mysqli_real_escape_string($conn, $_REQUEST['EmpPhone']);
			$EmpEmail = mysqli_real_escape_string($conn, $_REQUEST['EmpEmail']);
			$Pass = $_REQUEST['fPass'];
			
			if($Pass == null)
			{
				$query = "UPDATE employee SET EmpFName='$EmpFName', EmpLName='$EmpLName', EmpPhone='$EmpPhone', EmpEmail='$EmpEmail' WHERE EmpID='$EmpID'";
				if(mysqli_query($conn, $query))
				{
					echo "<p class='notice'>* Your profile was updated successfully.</p>";
				}	 
				else
				{
					echo "<p class='errors'>* System could not updated your profile.</p>";
				}	
				
			}
			else
			{
				$newPass = md5(mysqli_real_escape_string($conn, $_REQUEST['fPass']));
				$query = "  UPDATE login l, employee e
							SET l.Pass='$newPass',
							e.EmpFName='$EmpFName', 
							e.EmpLName='$EmpLName', 
							e.EmpPhone='$EmpPhone', 
							e.EmpEmail='$EmpEmail' 
							WHERE e.EmpID = l.UName AND
								  l.UName ='$EmpID';";
				if(mysqli_query($conn, $query))
				{
					echo "<p class='notice'>* Your profile was updated successfully.</p>";
				}	 
				else
				{
					echo "ERROR: Could not able to execute " . mysqli_error($conn);
					echo "<p class='errors'>* System could not updated your profile.</p>";
				}		
			}	
		}
?>
				<form method="post" enctype="multipart/form-data" >  
					<br></br>
						<label for="EmpFName"><b>  First Name: </b> </label>
						<input type="text" name="EmpFName" id="EmpFName" value=<?php echo($row_sql['EmpFName']);?>>
					<br></br>
						<label for="EmpLName"><b> Last Name: </b></label>
						<input type="text" name="EmpLName" id="EmpLName" value=<?php echo($row_sql['EmpLName']);?>>
					<br></br>
						<label for="EmpPhone"><b>  Phone Number: </b></label>
						<input type="text" name="EmpPhone" id="EmpPhone" value=<?php echo($row_sql['EmpPhone']);?>>
					<br></br>
						<label for="EmpEmail"><b>  Email: </b></label>
						<input type="text" name="EmpEmail" id="EmpEmail" value=<?php echo($row_sql['EmpEmail']);?>>    
						<label id="emailError"> </label>
					<br></br>
						<label for="fPass"><b>  Password: </b></label>
						<input type="password" name="fPass" id="fPass">
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
			</div>
		</body>

<!-- Close Connection -->
<?php mysqli_close($conn); ?>
		
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
	</div>
</html>