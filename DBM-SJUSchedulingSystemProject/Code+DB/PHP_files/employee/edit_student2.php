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
			<li class ="dropdown"><a href="" class="dropbtn"> Search </a>
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
			<li class ="dropdown"><a  class="active" href="" class="dropbtn"> Edit </a>
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

			<h1>Edit Student Information</h1>
			<div class= "formdiv">
		<?php
			$edit= $_REQUEST['edit'];
			if(isset($_REQUEST['submit']))
			{
				$StdFName = mysqli_real_escape_string($conn, $_REQUEST['StdFName']);
				$StdLName = mysqli_real_escape_string($conn, $_REQUEST['StdLName']);
				$StdPhone = mysqli_real_escape_string($conn, $_REQUEST['StdPhone']);
				$StdEmail = mysqli_real_escape_string($conn, $_REQUEST['StdEmail']);
				$StdAddress = mysqli_real_escape_string($conn, $_REQUEST['StdAddress']);
						
				if($_FILES['StdPicture']['tmp_name'] == null)
				{
					$query = "UPDATE student SET StdFName='$StdFName', StdLName='$StdLName', StdPhone='$StdPhone', StdEmail='$StdEmail', StdAddress='$StdAddress' WHERE StdID='$edit'";
					if(mysqli_query($conn, $query))
					{
						echo "<p class='notice'>* Student information was updated successfully.</p>";
					}	 
					else
					{
						echo "<p class='errors'>* The system could not updated the student information</p>";
					}	
				
				}
				else
				{
					$tmpName = $_FILES['StdPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					$query = "UPDATE student SET StdFName='$StdFName', StdLName='$StdLName', StdPhone='$StdPhone', StdEmail='$StdEmail', StdAddress='$StdAddress', StdPicture='$data' WHERE StdID='$edit'";
					if(mysqli_query($conn, $query))
					{
						echo "<p class='notice'>* Student information was updated successfully.</p>";
					}	 
					else
					{
						echo "<p class='errors'>* The system could not updated student information</p>";
					}		
				}	
			}

		?>

		<?php
			$ses_sql=mysqli_query($conn, "SELECT * FROM student WHERE StdID='$edit'");
			$row_sql=mysqli_fetch_array($ses_sql);
			$count_sql = mysqli_num_rows($ses_sql);

		?>
				<form method="post" enctype="multipart/form-data" >  
					<br></br>
						<label for="StdFName"><b>  First Name: </b> </label>
						<input type="text" name="StdFName" id="StdFName" value=<?php echo($row_sql['StdFName']);?>>
					<br></br>
						<label for="StdLName"><b> Last Name: </b></label>
						<input type="text" name="StdLName" id="StdLName" value=<?php echo($row_sql['StdLName']);?>>
					<br></br>
						<label for="StdPhone"><b>  Phone Number: </b></label>
						<input type="text" name="StdPhone" id="StdPhone" value=<?php echo($row_sql['StdPhone']);?>>
					<br></br>
						<label for="StdEmail"><b>  Email: </b></label>
						<input type="text" name="StdEmail" id="StdEmail" value=<?php echo($row_sql['StdEmail']);?>>    
						<label id="emailError"> </label>
					<br></br>
						<label for="StdAddress"><b>  Address: </b></label>
						<input type="text" name="StdAddress" id="StdAddress" value=<?php echo($row_sql['StdAddress']);?>>    
					<br></br>
						<label for="StdPicture"><b>  Picture: </b></label>
						<input type="file" name="StdPicture" id="StdPicture">
						<small><label> Picture maximum size is 25KB</label></small>
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