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
		
		//get all Semsters
		$squery = "SELECT * FROM semester ORDER BY SID DESC";
		$sresult = mysqli_query($conn,$squery);
		$soptions ="";
		while ($row = mysqli_fetch_array($sresult))
		{
			$soptions = $soptions."<option value = ".$row['SID'].">".$row['SName']."</option>";
		}
		
		
		//Get all Programs data
		$query = $conn->query("SELECT * FROM program");
		//Count total number of rows
		$rowCount = $query->num_rows;

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
				$('#program').on('change',function(){
					var ProgID = $(this).val();
					if(ProgID){
						$.ajax({
							type:'POST',
							url:'../employee/ajaxDataProgramCourse.php',
							data:'ProgID='+ ProgID,
							success:function(html){
							$('#course').html(html); 
							}
						}); 
					}else{
						$('#course').html('<option value="">Select Program First</option>');
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
			<h1>Offer a Course</h1>
			<div class= "formdiv">
				<form action="../employee/offer_class2.php" method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="sid"><b> Semester: </b></label>
						<select name="sid" id="sid">
							<option selected disabled>choose a semester</option>
							<?php echo $soptions; ?>
						</select>		
					<br></br>
						<label for="program"><b> Program: </b></label>
						<select name="program" id="program">
							<option value="" >Select a Program</option>
								<?php
									if($rowCount > 0){
										while($row = $query->fetch_assoc()){ 
											echo '<option value="'.$row['ProgID'].'">'.$row['ProgName'].'</option>';
										}
									}else{
										echo '<option value="">Program not available</option>';
									}
								?>
						</select>		
					<br></br>
						<label for="course"><b> Course: </b></label>
						<select name="course" id="course">
							<option value="">Select Program First</option>
						</select>		
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