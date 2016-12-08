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
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

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
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Search </a>
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
			<h1>Search for Student</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="stdname"><b> Please Enter Student Name : </b> </label>
					<br></br>
						<input type="text" name="stdname" id="stdname"  placeholder="enter the name here">
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['stdname']))
	{
		$stdname = mysql_real_escape_string($_REQUEST['stdname']);

	
        	$query="SELECT * 
					FROM student s, program p 
					WHERE s.ProgID = p.ProgID and
						  (StdLName like'$stdname' or
						   StdFName like '$stdname')";
			$result = mysqli_query($conn,$query);
			
			$rowCount = $result->num_rows;
			if ($rowCount === 0)
			{
				echo "<p class='errors'>There is no student with this last name! please try again</p>";
				echo "<br></br>";
			}
			else
			{
    	
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
				$pr = $row['StdLName'];
				echo '<tr>';
					echo '<td>' . $row['StdFName'] . '</td>';
					echo '<td>' . $row['StdLName'] . '</td>';
					echo '<td>' . $row['StdEmail'] . '</td>';
					echo '<td>' . $row['ProgName'] . '</td>';
					echo '<td><img src ="data:image/png;base64,'.base64_encode($row['StdPicture']).'"style="width: 100px;height: 100px;margin:0 auto; display:block;"></td>';
				echo '</tr>';
			}}
			echo'</table>';
	}
		?>
			<br>
				<a  class='singlelink2' href='../employee/employee.php'> Back </a>
			<br>
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