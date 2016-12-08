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

<?php		
		//get all building
		$query = "SELECT * FROM building";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = ".$row['BID'].">".$row['BName']."</option>";
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
			<h1>Search for Classrooms Information</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="building"><b> Please Select a Building: </b> </label>
					<br></br>
						<select name="building" id="building">
							<option selected disabled>choose a building</option>
							<?php echo $options; ?>
						</select>
					<br></br>
						<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['building']))
	{
		$building = mysql_real_escape_string($_REQUEST['building']);

        	$query="SELECT * 
					FROM  classroom c , building b
					WHERE c.BID = b.BID and
						  c.BID LIKE '$building'
					ORDER BY Floor, CRNum, Capacity ASC";
			$result = mysqli_query($conn,$query);
    	
?>

			<br></br>
			<?php 
				
			?>
			<table>
				<tr>
					<th><b>Building</b></th>
					<th><b>Classroom</b></th>
					<th><b>Floor</b></th>
					<th><b>Classroom Type</b></th>
					<th><b>Capacity</b></th>
				</tr>
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				echo '<tr>';
					echo '<td>' . $row['BName'] . '</td>';
					echo '<td>' . $row['CRName'] . '</td>';
					echo '<td>' . $row['Floor'] . '</td>';
					echo '<td>' . $row['CRType'] . '</td>';
					echo '<td>' . $row['Capacity'] . '</td>';
				echo '</tr>';
			}}
			echo'</table>';
		?>
		
		<br></br>
			<a  class='singlelink2' href='../employee/employee.php'> Back </a>
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
		