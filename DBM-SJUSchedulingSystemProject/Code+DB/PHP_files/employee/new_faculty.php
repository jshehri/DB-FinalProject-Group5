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
		$query = "SELECT DeptId,DeptName FROM department";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = $row[0]>$row[1]</option>";
		}
?>

<!DOCTYPE html>
<html>
<div class = "pagediv">


	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

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
			<h1>Add new Faculty Member</h1>
			<div class= "formdiv">
				<form action="../employee/new_faculty2.php"" method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="fmid"><b> Faculty ID: </b> </label>
						<input type="text" name="fmid" id="fmid" maxlength="10" placeholder="fm000">
					<br></br>
						<label for="fmfn"><b>  First Name: </b> </label>
						<input type="text" name="fmfn" id="fmfn" maxlength="30">
					<br></br>
						<label for="fmln"><b> Last Name: </b></label>
						<input type="text" name="fmln" id="fmln" maxlength="30">
					<br></br>
						<label for="fmtitle"><b>  Title: </b></label>
						<select name="fmtitle" id="fmtitle">
							<option selected disabled>Choose one title</option>
							<option value="Professor"> Professor</option>
							<option value="Associate Professor"> Associate Professor</option>
							<option value= "Assistent Professor"> Assistent Professor</option>
						</select>
					<br></br>
						<label for="fmmajor"><b>  Major: </b></label>
						<select name="fmmajor" id="fmmajor">
							<option selected disabled>Choose one Major</option>
							<option value="Computer Science"> Computer Science </option>
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
						<label for="pnum"><b>  Phone Number: </b></label>
						<input type="text" name="pnum" id="pnum" placeholder="0000000000" maxlength="10">
					<br></br>
						<label for="email"><b>  Email: </b></label>
						<input type="email" name="email" id="email" placeholder="example@example.com">
						<label id="emailError"> </label>
					<br></br>
						<label for="fmpic"><b>  Picture: </b></label>
						<input type="file" name="fmpic" id="fmpic">
						<small><label> Picture maximum size is 25KB</label></small>
					<br></br>
						<label for="deptid"><b>  Department: </b></label>
						<select name="deptid" id="deptid">
							<option selected disabled>Choose one department</option>
							<?php echo $options; ?>
						</select>
					<br></br>
					<label for="pass"><b>  Password: </b></label>
						<input type="password" name="pass" id="pass">
						<small><label> Password should be between 6-15 characters</label></small>
					<br></br>
						<label for="utype"><b>  User Type: </b></label>
							<input type="radio" name="utype" value="Student" disabled> Student<t></t>
							<input type="radio" name="utype" value="Faculty" checked> Faculty Member<br>
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