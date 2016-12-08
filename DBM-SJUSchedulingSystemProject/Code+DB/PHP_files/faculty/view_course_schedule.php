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

<?php
		
		//get all semsters
		$query = "SELECT * FROM semester ORDER BY SID DESC";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = ".$row['SID'].">".$row['SName']."</option>";
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
				$('#semester').on('change',function(){
					var SID = $(this).val();
					if(SID){
						$.ajax({
							type:'POST',
							url:'../faculty/ajaxDataBuilClassSemesterCourse.php',
							data:'SID='+ SID,
							success:function(html){
							$('#course').html(html); 
							}
						}); 
					}else{
						$('#course').html('<option value="">select semster first</option>');
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
			<h1>View a Course Schedule</h1>
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="semester"><b> Please Select a Semester: </b> </label>
					<br></br>
						<select name="semester" id="semester">
							<option value="">choose a semester</option>
							<?php echo $options; ?>
						</select>
					<br></br>
						<label for="course"><b> Please Select a Course: </b> </label>
					<br></br>
						<select name="course" id="course">
							<option selected disabled>select semester first</option>
						</select>
					<br></br>
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['course']))
	{
		$course = mysql_real_escape_string($_REQUEST['course']);

	
        	$query= " SELECT *
					  FROM schedule s, building b, course c, classroom cr
					  WHERE s.BID = b.BID AND
							s.CRNum = cr.CRNum AND
							s.CID = c.CID AND
							b.BID = cr.BID AND
							s.CID = '$course'
					  ORDER BY s.Day, s.Time ASC";
			
			$result = mysqli_query($conn,$query);
			
			$rowCount = $result->num_rows;

			if ($rowCount === 0)
			{
				echo "<p class='errors'>This course is not scheduled yet!</p>";
				echo "<br></br>";
			}
			else
			{
    	
?>

			<br></br>
			<h1>Your Search Result is:</h1>
			<table>
				<tr>
					<th><b>Day</b></th>
					<th><b>Time</b></th>
					<th><b>Course ID</b></th>
					<th><b>Course Name</b></th>
					<th><b>Building</b></th>
					<th><b>Classroom</b></th>
				</tr>
				
		<?php
			
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr>';
						echo '<td>' . $row['Day'] . '</td>';
						echo '<td>' . $row['Time'] . '</td>';
						echo '<td>' . $row['CID'] . '</td>';
						echo '<td>' . $row['CName'] . '</td>';
						echo '<td>' . $row['BName'] . '</td>';
						echo '<td>' . $row['CRName'] . '</td>';
					echo '</tr>';
				}
			}
			echo'</table>';
	}
	
		?>
			<br>
				<a  class='singlelink2' href='../faculty/faculty_view_schedule.php'> Back </a>
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