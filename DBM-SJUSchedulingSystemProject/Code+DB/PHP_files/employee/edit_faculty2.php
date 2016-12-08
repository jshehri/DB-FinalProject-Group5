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
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Edit </a>
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

			<h1>Edit Faculty Member Information</h1>
			<div class= "formdiv">
		<?php
			$edit= $_REQUEST['edit'];
			if(isset($_REQUEST['submit']))
			{
				$FFName = mysqli_real_escape_string($conn, $_REQUEST['FFName']);
				$FLName = mysqli_real_escape_string($conn, $_REQUEST['FLName']);
				$FMajor = mysqli_real_escape_string($conn, $_REQUEST['FMajor']);
				$FPhone = mysqli_real_escape_string($conn, $_REQUEST['FPhone']);
				$FEmail = mysqli_real_escape_string($conn, $_REQUEST['FEmail']);
						
				if($_FILES['FPicture']['tmp_name'] == null)
				{
					$query = "UPDATE faculty SET FFName='$FFName', FLName='$FLName', FPhone='$FPhone', FEmail = '$FEmail' WHERE FID='$edit'";
					if(mysqli_query($conn, $query))
					{
						echo "<p class='notice'>* The faculty member information was updated successfully.</p>";
					}	 
					else
					{
						echo "<p class='errors'>* The system could not updated the faculty member information</p>";
					}	
				
				}
				else
				{
					$tmpName = $_FILES['FPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					$query = "UPDATE faculty SET FFName='$FFName', FLName='$FLName', FPhone='$FPhone', FEmail = '$FEmail', FPicture='$data' WHERE FID='$edit'";
					if(mysqli_query($conn, $query))
					{
						echo "<p class='notice'>* The faculty member information was updated successfully.</p>";
					}	 
					else
					{
						echo "<p class='errors'>* The system could not updated the faculty member information</p>";
					}		
				}	
			}

		?>

		<?php
			$ses_sql=mysqli_query($conn, "SELECT * FROM faculty WHERE FID='$edit'");
			$row_sql=mysqli_fetch_array($ses_sql);
			$count_sql = mysqli_num_rows($ses_sql);

		?>
				<form method="post" enctype="multipart/form-data" >  
					<br></br>
						<label for="FFName"><b>  First Name: </b> </label>
						<input type="text" name="FFName" id="FFName" value=<?php echo($row_sql['FFName']);?>>
					<br></br>
						<label for="FLName"><b> Last Name: </b></label>
						<input type="text" name="FLName" id="FLName" value=<?php echo($row_sql['FLName']);?>>
					<br></br>
						<label for="FMajor"><b>  Major: </b></label>
						<select name="FMajor" id="FMajor" >
							<option value="Computer Science" selected> Computer Science </option>
							<option value="Database"> Database </option>
							<option value= "Cypersecurity">Cypersecurity</option>
							<option value= "Computer Vision">Computer Vision</option>
							<option value= "Computer Engineering">Computer Engineering</option>
							<option value= "Software Engineering">Software Engineering</option>
							<option value= "Electrical Engineering">Electrical Engineering</option>
							<option value= "Information Science">Information Science</option>
							<option value= "Neuroscience">Neuroscience</option>
							<option value= "Business Intellegence">Business Intelligence</option>
						</select>
					<br></br>
						<label for="FPhone"><b>  Phone Number: </b></label>
						<input type="text" name="FPhone" id="FPhone" value=<?php echo($row_sql['FPhone']);?>>
					<br></br>
						<label for="FEmail"><b>  Email: </b></label>
						<input type="text" name="FEmail" id="FEmail" value=<?php echo($row_sql['FEmail']);?>>    
						<label id="emailError"> </label>
					<br></br>
						<label for="FPicture"><b>  Picture: </b></label>
						<input type="file" name="FPicture" id="FPicture">
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