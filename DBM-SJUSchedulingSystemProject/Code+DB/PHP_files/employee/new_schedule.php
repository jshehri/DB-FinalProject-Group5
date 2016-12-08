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
		
		//Get all buliding data
		$query = $conn->query("SELECT * FROM building");

		//Count total number of rows
		$rowCount = $query->num_rows;
		
		//Get CourseID and Course Name
		$cquery = " SELECT CID,CName FROM course";
		$cresult = mysqli_query($conn,$cquery);
		$coptions ="";
		while ($row = mysqli_fetch_array($cresult))
		{
			$coptions = $coptions."<option value = $row[0]>$row[1]</option>";
		}
		
		//Get all semester data
		$squery = $conn->query("SELECT * FROM semester");

		//Count total number of rows
		$srowCount = $squery->num_rows;
		
		//Get CourseID and Course Name
		$squery = " SELECT * FROM semester ORDER BY SID DESC";
		$sresult = mysqli_query($conn,$squery);
		$soptions ="";
		while ($row = mysqli_fetch_array($sresult))
		{
			$soptions = $soptions."<option value = $row[0]>$row[1]</option>";
		}
		
		
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#building').on('change',function(){
					var BulID = $(this).val();
					if(BulID){
						$.ajax({
							type:'POST',
							url:'../employee/ajaxDataBuilClassSemesterCourse.php',
							data:'BID='+ BulID,
							success:function(html){
							$('#classroom').html(html); 
							}
						}); 
					}else{
						$('#classroom').html('<option value="">Select Building First</option>');
					}
				});
			});
			
			$(document).ready(function(){
				$('#semester').on('change',function(){
					var SID = $(this).val();
					if(SID){
						$.ajax({
							type:'POST',
							url:'../employee/ajaxDataBuilClassSemesterCourse.php',
							data:'SID='+ SID,
							success:function(html){
							$('#course').html(html); 
							}
						}); 
					}else{
						$('#course').html('<option value="">Select semster First</option>');
					}
				});
			});

		</script>
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
			<h1>Schedule a Class</h1>
			<div class= "formdiv">
				<form action="../employee/new_schedule2.php" method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="semester"><b>  Semester: </b></label>
						<select name="semester" id="semester">
							<option selected disabled>choose a semester</option>
							<?php echo $soptions; ?>
						</select>
					<br></br>
						<label for="course"><b>  Course: </b></label>
						<select name="course" id="course">
							<option value="">select a semester first</option>
						</select>
					<br></br>
						<label for="bid"><b> Building: </b></label>
						<select name="building" id="building">
							<option value="">Select Building</option>
								<?php
									if($rowCount > 0){
										while($row = $query->fetch_assoc()){ 
											echo '<option value="'.$row['BID'].'">'.$row['BName'].'</option>';
										}
									}else{
										echo '<option value="">Building not available</option>';
									}
								?>
						</select>		
					<br></br>
						<label for="cid"><b> Classroom: </b></label>
						<select name="classroom" id="classroom">
							<option value="">select Building First</option>
						</select>
					<br></br>
						<label for="time"><b>  Time: </b></label>
						<select name="time" id="time">
							<option selected disabled>Choose Time</option>
							<option value= "090000">09:00 AM</option>
							<option value= "100000">10:00 AM</option>
							<option value= "110000">11:00 AM</option>
							<option value= "120000">12:00 PM</option>
							<option value= "130000">01:00 PM</option>
							<option value= "140000">02:00 PM</option>
							<option value= "150000">03:00 PM</option>
							<option value= "160000">04:00 PM</option>
							<option value= "170000">05:00 PM</option>
						</select>
					<br></br>
						<label for="day"><b>  Day: </b></label>
							<input type="radio" name="day" value="Monday" > Monday <t></t>
							<input type="radio" name="day" value="Tuesday" > Tuesday <t></t>
							<input type="radio" name="day" value="Wednesday" > Wednesday <t></t>
							<input type="radio" name="day" value="Thursday" > Thursday <t></t>
							<input type="radio" name="day" value="Friday" > Friday <t></t>
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