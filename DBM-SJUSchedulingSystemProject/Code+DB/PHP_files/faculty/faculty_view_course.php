<?php
		session_start(); 
		include_once '../connection.php';
		$FID = $_SESSION['Faculty'];
		if(!isset($FID))
		{
			header("Location: ../home/index.php");
		}
		$FFName = $_SESSION['FFName'];
		
		
		
		//get all Semsters
		$query = "SELECT * FROM department";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = ".$row['DeptID'].">".$row['DeptName']."</option>";
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
				$('#department').on('change',function(){
					var DeptID = $(this).val();
					if(DeptID){
						$.ajax({
							type:'POST',
							url:'../faculty/ajaxDataDeptProgramCourse.php',
							data:'DeptID='+ DeptID,
							success:function(html){
								$('#program').html(html);
								$('#course').html('<option value="">Select Program First</option>');
							}
						}); 
					}else{
						$('#program').html('<option value="">Select Department First</option>');
						$('#course').html('<option value="">Select Program First</option>');
					}
				});
				
				$('#program').on('change',function(){
					var ProgID = $(this).val();
					if(ProgID){
						$.ajax({
							type:'POST',
							url:'../faculty/ajaxDataDeptProgramCourse.php',
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
			<h1>Search for Courses Description</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="department"><b> Please Select a Department: </b> </label>
					<br></br>
						<select name="department" id="department">
							<option selected disabled>choose a department</option>
							<?php echo $options; ?>
						</select>
					<br></br>
						<label for="program"><b> Please Select a Program: </b> </label>
					<br></br>
						<select name="program" id="program">
							<option value="">Select Department First</option>
						</select>
					<br></br>
						<label for="course"><b> Please Select a Course: </b> </label>
					<br></br>
						<select name="course" id="course">
							<option value="">Select Program First</option>
						</select>
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['course']))
	{
		$course = mysql_real_escape_string($_REQUEST['course']);

	
        	$query="SELECT * 
					FROM  course
					WHERE CID = '$course'";
			$result = mysqli_query($conn,$query);
    	
?>

			<br></br>
			<?php 
				
			?>
			<table>
				<tr>
					<th><b>Course ID</b></th>
					<th><b>Course Name</b></th>
					<th><b>Credit Hours</b></th>
					<th><b>Description</b></th>
				</tr>
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				$pr = $row['CName'];
				echo '<tr>';
					echo '<td>' . $row['CID'] . '</td>';
					echo '<td>' . $row['CName'] . '</td>';
					echo '<td>' . $row['NoOfCredits'] . '</td>';
					echo '<td>' . $row['CDesc'] . '</td>';
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