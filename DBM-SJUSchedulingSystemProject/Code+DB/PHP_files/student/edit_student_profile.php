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
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<html>
<div class = "pagediv">

	<body>
		<ul>
			<li><a  href="../student/student.php"> Home </a></li>
			<li class ="dropdown"><a href="" class="dropbtn"> Search </a>
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
			<li style = "float:right"><a class="active" href="../student/edit_student_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $StdFName ; ?></a></li>
		</ul> 

			<h1>Edit Profile</h1>
			<div class= "formdiv">

<?php						

?>
		

<?php
		if(isset($_REQUEST['submit']))
		{
			$StdFName = mysqli_real_escape_string($conn, $_REQUEST['StdFName']);
			$StdLName = mysqli_real_escape_string($conn, $_REQUEST['StdLName']);
			$StdPhone = mysqli_real_escape_string($conn, $_REQUEST['StdPhone']);
			$StdEmail = mysqli_real_escape_string($conn, $_REQUEST['StdEmail']);
			$StdAddress = mysqli_real_escape_string($conn, $_REQUEST['StdAddress']);
			//$Pass = md5(mysqli_real_escape_string($conn, $_REQUEST['Pass']));
			$Pass = $_REQUEST['fPass'];
			
			//echo($Pass);
			
			if ($Pass == null)
			{
				if ($_FILES['StdPicture']['tmp_name'] == null)
				{
					$query = "UPDATE student SET 
									 StdFName='$StdFName', 
									 StdLName='$StdLName', 
									 StdPhone='$StdPhone', 
									 StdEmail='$StdEmail', 
									 StdAddress='$StdAddress' 
									 WHERE StdID='$StdID'";
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
				else
				{
					$tmpName = $_FILES['StdPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					
					$query = "UPDATE student SET 
									 StdFName='$StdFName', 
									 StdLName='$StdLName', 
									 StdPhone='$StdPhone', 
									 StdEmail='$StdEmail',
									 StdAddress='$StdAddress',
									 StdPicture = '$data'
									 WHERE StdID = '$StdID'";
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
			
			else if ($Pass != null)
			{
				$newPass = md5(mysqli_real_escape_string($conn, $_REQUEST['fPass']));
				if ($_FILES['StdPicture']['tmp_name'] == null)
				{
					$query = "UPDATE login l, student s
							SET l.Pass='$newPass',
							s.StdFName='$StdFName', 
							s.StdLName='$StdLName', 
							s.StdPhone='$StdPhone', 
							s.StdEmail='$StdEmail',
							s.StdAddress='$StdAddress'
							WHERE s.StdID = l.UName AND
								  l.UName ='$StdID'";
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
				else
				{
					$tmpName = $_FILES['StdPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					
					$query = "UPDATE login l, student s
								SET l.Pass='$newPass',
								s.StdFName='$StdFName', 
								s.StdLName='$StdLName', 
								s.StdPhone='$StdPhone', 
								s.StdEmail='$StdEmail',
								s.StdAddress='$StdAddress',
								s.StdPicture = '$data'
								WHERE s.StdID = l.UName AND
									l.UName ='$StdID'";
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
		}



?>

<?php
		
			$ses_sql=mysqli_query($conn, "SELECT * FROM student WHERE StdID='$StdID';");
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
						<label for="fPass"><b>  Password: </b></label>
						<input type="password" name="fPass" id="fPass">
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