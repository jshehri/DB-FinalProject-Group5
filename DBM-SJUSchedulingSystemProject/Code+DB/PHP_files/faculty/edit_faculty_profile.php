<?php
		session_start(); 
		include_once '../connection.php';
		$FID = $_SESSION['Faculty'];
		if(!isset($FID))
		{
			header("Location: ../home/index.php");
		}
		$FFName = $_SESSION['FFName'];
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
			<li><a href="../faculty/faculty.php"> Home </a></li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Search </a>
				<div class="dropdown-content">
					<a href= "../faculty/faculty_view_college.php"> College Information </a>
					<a href= "../faculty/faculty_view_program.php"> Program Information </a>
					<a href= "../faculty/faculty_view_course.php"> Course Description</a>
					<a href= "../faculty/faculty_view_offered.php"> Offered Courses </a>
					<a href= "../faculty/faculty_view_schedule.php"> Schedule </a>
					<a href= "../faculty/faculty_view_student.php"> Student Information </a>
					<a href= "../faculty/view_faculty_by_name1.php"> Faculty Information</a>
				</div>
			</li>
			<li style = "float:right"><a href="../home/logout.php"> Logout</a></li>
			<li style = "float:right"><a class="active" href="../faculty/edit_faculty_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $FFName ; ?></a></li>
		</ul>  

			<h1>Edit Profile</h1>
			<div class= "formdiv">

		

<?php
		if(isset($_REQUEST['submit']))
		{
			$FFName = mysqli_real_escape_string($conn, $_REQUEST['FFName']);
			$FLName = mysqli_real_escape_string($conn, $_REQUEST['FLName']);
			$FPhone = mysqli_real_escape_string($conn, $_REQUEST['FPhone']);
			$FEmail = mysqli_real_escape_string($conn, $_REQUEST['FEmail']);
			$Pass = $_REQUEST['fPass'];
			
			
			if ($Pass == null)
			{
				if ($_FILES['FPicture']['tmp_name'] == null)
				{
					$query = "UPDATE faculty SET 
									 FFName='$FFName', 
									 FLName='$FLName', 
									 FPhone='$FPhone', 
									 FEmail='$FEmail'
									 WHERE FID='$FID'";
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
					$tmpName = $_FILES['FPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					
					$query = "UPDATE faculty SET 
									 FFName='$FFName', 
									 FLName='$FLName', 
									 FPhone='$FPhone', 
									 FEmail='$FEmail',
									 FPicture = '$data'
									 WHERE FID = '$FID'";
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
				if ($_FILES['FPicture']['tmp_name'] == null)
				{
					$query = "UPDATE login l, faculty f
							SET l.Pass='$newPass',
							f.FFName='$FFName', 
							f.FLName='$FLName', 
							f.FPhone='$FPhone', 
							f.FEmail='$FEmail'
							WHERE f.FID = l.UName AND
								  l.UName ='$FID'";
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
					$tmpName = $_FILES['FPicture']['tmp_name'];
					// Read the file
					$fp = fopen($tmpName, 'r');
					$data = fread($fp, filesize($tmpName));
					$data = addslashes($data);
					fclose($fp);
					
					$query = "UPDATE login l, faculty f
								SET l.Pass='$newPass',
								f.FFName='$FFName', 
								f.FLName='$FLName', 
								f.FPhone='$FPhone', 
								f.FEmail='$FEmail',
								f.FPicture = '$data'
								WHERE f.FID = l.UName AND
									l.UName ='$FID'";
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
		
			$ses_sql=mysqli_query($conn, "SELECT * FROM faculty WHERE FID='$FID';");
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
						<label for="FPhone"><b>  Phone Number: </b></label>
						<input type="text" name="FPhone" id="FPhone" value=<?php echo($row_sql['FPhone']);?>>
					<br></br>
						<label for="FEmail"><b>  Email: </b></label>
						<input type="text" name="FEmail" id="FEmail" value=<?php echo($row_sql['FEmail']);?>>    
						<label id="emailError"> </label>
					<br></br>
						<label for="fPass"><b>  Password: </b></label>
						<input type="password" name="fPass" id="fPass">
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