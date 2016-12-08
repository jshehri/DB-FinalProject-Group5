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

<?php
		include_once '../connection.php';
		
		//get all Semsters
		$squery = "SELECT * FROM semester ORDER BY SID DESC";
		$sresult = mysqli_query($conn,$squery);
		$soptions ="";
		while ($row = mysqli_fetch_array($sresult))
		{
			$soptions = $soptions."<option value = ".$row['SID'].">".$row['SName']."</option>";
		}
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
		
		
	
			<br></br>
			<h1>Search for Offered Courses</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="semester"><b> Please Select a Semester: </b> </label>
					<br></br>
						<select name="semester" id="semester">
							<option selected disabled>choose a semester</option>
							<?php echo $soptions; ?>
						</select>
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['semester']))
	{
		$semester = mysql_real_escape_string($_REQUEST['semester']);

	
        	$query="SELECT * 
					FROM  runs r, semester s, course c
					WHERE r.CID = c.CID and
						  r.SID = s.SID and
						  s.SID = '$semester'";
			$result = mysqli_query($conn,$query);
			
			$rowCount = $result->num_rows;

			if ($rowCount === 0)
			{
				echo "<p class='errors'>There is no classes offered for the selected semester</p>";
				echo "<br></br>";
			}
			else
			{
    	
?>

		<br></br>
			<table>
				<tr>
					<th><b>Course ID</b></th>
					<th><b>Course Name</b></th>

				</tr>
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				$pr = $row['SName'];
				echo '<tr>';
					echo '<td>' . $row['CID'] . '</td>';
					echo '<td>' . $row['CName'] . '</td>';
				echo '</tr>';
			}}
			echo'</table>';
	}
		?>
		
		<br></br>
			<a  class='singlelink2' href='../student/student.php'> Back </a>
		<br></br>
		
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