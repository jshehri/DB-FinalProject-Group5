<?php
		include_once '../connection.php';
	
		//get all colleges
		$query = "SELECT * FROM college";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = ".$row['ColgID'].">".$row['ColgName']."</option>";
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
							url:'../student/ajaxDataDeptProgramCourse.php',
							data:'DeptID='+ DeptID,
							success:function(html){
                                //change
								$('#college').html(html);
							}
						}); 
					}else{
						$('#program').html('<option value="">Select Department First</option>');
					}
				});
				
			});
		</script>
	</head>

	
	<div class = "pagediv">

	<body>
		<ul>
			<li><a href="../home/index.php"> Home </a></li>
		</ul> 
		
				
			<br></br>
			<h1>Search for College </h1> 
			<div class= "formdiv">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="college"><b> Please Select a College : </b> </label>
					<br></br>
						<select name="college" id="college">
							<option selected disabled>choose a college</option>
							<?php echo $options; ?>
						
					<br></br>
						
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['college']))
	{
		$college = mysqli_real_escape_string($conn, $_REQUEST['college']);

	
        	$query="SELECT c.*, COUNT(d.DeptID) AS Num_of_depts
					FROM  college c, department d
					WHERE c.ColgID = d.ColgID AND
						  c.ColgID = '$college'";
			$result = mysqli_query($conn,$query);
						
?>

			<br></br>

			<table>
				<tr>
					<th><b>College Name</b></th>
					<th><b>College Description</b></th>
					<th><b>Number of Departments</b></th>
				</tr>
						
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				//$pr = $row['ColgName'];
				echo '<tr>';
					echo '<td>' . $row['ColgName'] . '</td>';
					echo '<td>' . $row['ColgDesc'] . '</td>';
					echo '<td>' . $row['Num_of_depts'] . '</td>';
				echo '</tr>';
			}}
			echo'</table>';
		?>
		
		<br></br>
			<a  class='singlelink2' href='../student/guest.php'> Back </a>
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
		