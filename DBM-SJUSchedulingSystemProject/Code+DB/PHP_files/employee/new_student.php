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
		
		$query = "SELECT ProgId,ProgName FROM program";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = $row[0]>$row[1]</option>";
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
			<li class ="dropdown"><a class="active" href="" class="dropbtn"> Add </a>
				<div class="dropdown-content">
					<a href= "../employee/new_student.php"> New Student </a>
					<a href= "../employee/new_faculty.php"> New Faculty </a>
					<a href= "../employee/new_schedule.php"> Schedule a Class </a>
					<a href= "../employee/offer_class.php"> Offer a Course </a>
				</div>
			</li>
			<li class ="dropdown"><a  href="" class="dropbtn"> Search </a>
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
			<h1>Add new Student</h1>
			<div class= "formdiv">
				<form action="../employee/new_student2.php" method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="stdid"><b> Student ID: </b> </label>
						<input type="text" name="stdid" id="stdid" maxlength="10" placeholder="std000">
					<br></br>
						<label for="stdfn"><b>  First Name: </b> </label>
						<input type="text" name="stdfn" id="stdfn" maxlength="30">
					<br></br>
						<label for="stdln"><b> Last Name: </b></label>
						<input type="text" name="stdln" id="stdln" maxlength="30">
					<br></br>
						<label for="pnum"><b>  Phone Number: </b></label>
						<input type="text" name="pnum" id="pnum" placeholder="0000000000" maxlength="10">
					<br></br>
						<label for="email"><b>  Email: </b></label>
						<input type="email" name="email" id="email" placeholder="example@example.com">
						<label id="emailError"> </label>
					<br></br>
						<label for="stdadd"><b>  Address: </b></label>
						<input type="text" name="stdadd" id="stdadd"  placeholder = "5600 City Ave. Philadelphia, PA ">
					<br></br>
						<label for="stdpic"><b>  Picture: </b></label>
						<input type="file" name="stdpic" id="stdpic">
						<small><label> Picture maximum size is 25KB</label></small>
					<br></br>
						<label for="progid"><b>  Program: </b></label>
						<select name="progid" id="progid">
							<option selected disabled>Choose one program</option>
							<?php echo $options; ?>
						</select>
					<br></br>
					<label for="pass"><b>  Password: </b></label>
						<input type="password" name="pass" id="pass">
						<small><label> Password should be between 6-15 characters</label></small>
					<br></br>
						<label for="utype"><b>  User Type: </b></label>
							<input type="radio" name="utype" value="Student" checked> Student<t></t>
							<input type="radio" name="utype" value="Faculty" disabled> Faculty Member<br>
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