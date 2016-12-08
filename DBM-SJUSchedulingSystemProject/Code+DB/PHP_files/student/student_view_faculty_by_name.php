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
			<li><a  href="../student/student.php"> Home </a></li>
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Search </a>
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
			<h1>Search for Faculty Member</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="fname"><b> Please Enter Faculty Name : </b> </label>
					<br></br>
						<input type="text" name="fname" id="fname"  placeholder="enter the name here">
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['fname']))
	{
		$fname = mysql_real_escape_string($_REQUEST['fname']);

	
        	$query="SELECT * 
					FROM faculty f, department d 
					WHERE f.DeptID = d.DeptID and
						  (FLName like'$fname' or
						   FFName like '$fname')";
			$result = mysqli_query($conn,$query);
    	
?>

			<br></br>
			<h1>Your Search Result is:</h1>
			<table>
				<tr>
					<th><b>First Name</b></th>
					<th><b>Last Name</b></th>
					<th><b>Title</b></th>
					<th><b>Major</b></th>
					<th><b>Email</b></th>
					<th><b>Department</b></th>
					<th><b>Picture</b></th>
				</tr>
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				$pr = $row['FLName'];
				echo '<tr>';
					echo '<td>' . $row['FFName'] . '</td>';
					echo '<td>' . $row['FLName'] . '</td>';
					echo '<td>' . $row['FTitle'] . '</td>';
					echo '<td>' . $row['FMajor'] . '</td>';
					echo '<td>' . $row['FEmail'] . '</td>';
					echo '<td>' . $row['DeptName'] . '</td>';
					echo '<td><img src ="data:image/png;base64,'.base64_encode($row['FPicture']).'"style="width: 100px;height: 100px;margin:0 auto; display:block;"></td>';
				echo '</tr>';
			}}
			echo'</table>';
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