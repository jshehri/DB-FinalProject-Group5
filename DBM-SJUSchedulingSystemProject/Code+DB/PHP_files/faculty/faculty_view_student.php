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
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

	<div class = "pagediv">

	<body>
		<ul>
			<li><a href="../faculty/faculty.php"> Home </a></li>
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Search </a>
				<div class="dropdown-content">
					<a href= "../faculty/faculty_view_college.php"> College Information </a>
					<a href= "../faculty/faculty_view_program.php"> Program Information </a>
					<a href= "../faculty/faculty_view_course.php"> Course Description</a>
					<a href= "../faculty/faculty_view_offered.php"> Offered Courses </a>
					<a href= "../faculty/faculty_view_schedule.php"> Schedule </a>
					<a href= "../faculty/faculty_view_student.php"> Student Information </a>
					<a href= "../faculty/view_faculty_by_name.php"> Faculty Information</a>
				</div>
			</li>
			<li style = "float:right"><a href="../home/logout.php"> Logout</a></li>
			<li style = "float:right"><a href="../faculty/edit_faculty_profile.php"> Edit Profile </a></li>
			<li style = "float:right"><a href="" class="welcome"> Welcome,   <?php echo $FFName ; ?></a></li>
		</ul>  
		
	
			<br></br>
			<h1>Search for Student</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="stdname"><b> Please Enter Student Name : </b> </label>
					<br></br>
						<input type="text" name="stdname" id="stdname" placeholder="enter the name here">
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['stdname']))
	{
		$stdname = mysqli_real_escape_string($conn, $_REQUEST['stdname']);

	
        	$query="SELECT * 
					FROM student s, program p 
					WHERE s.ProgID = p.ProgID and
						  (StdLName like'$stdname' or
						   StdFName like '$stdname')";
			$result = mysqli_query($conn,$query);
    	
?>

			<br></br>
			<h1>Your Search Result is:</h1>
			<table>
				<tr>
					<th><b>First Name</b></th>
					<th><b>Last Name</b></th>
					<th><b>Email</b></th>
					<th><b>Program</b></th>
					<th><b>Picture</b></th>
				</tr>
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				echo '<tr>';
					echo '<td>' . $row['StdFName'] . '</td>';
					echo '<td>' . $row['StdLName'] . '</td>';
					echo '<td>' . $row['StdEmail'] . '</td>';
					echo '<td>' . $row['ProgName'] . '</td>';
					echo '<td><img src ="data:image/png;base64,'.base64_encode($row['StdPicture']).'"style="width: 100px;height: 100px;margin:0 auto; display:block;"></td>';
				echo '</tr>';
			}}
			echo'</table>';
		?>
		
			<br></br>
				<a  class='singlelink2' href='../faculty/faculty.php'> Back </a>
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