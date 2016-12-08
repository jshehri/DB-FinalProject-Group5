<?php
		include_once '../connection.php';
		
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
							url:'../student/ajaxDataDeptProgramCourse.php',
							data:'DeptID='+ DeptID,
							success:function(html){
								$('#program').html(html);
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
			<li><a href="../student/guest.php"> Home </a></li>
		</ul> 
		
				
			<br></br>
			<h1>Search for Programs Requirements</h1>
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
							<option value="">Select department First</option>
						</select>
					<br></br>
						
					<input type="submit" name="submit" value="Submit">  
					<br></br>
					
				</form>
	
		
<?php

  if(isset($_POST['program']))
	{
		$program = mysql_real_escape_string($_REQUEST['program']);

	
        	$query="SELECT * 
					FROM  program
					WHERE ProgID = '$program'";
			$result = mysqli_query($conn,$query);
    	
?>

			<br></br>
			<?php 
				
			?>
			<table>
				<tr>
					<th><b>Program Name</b></th>
					<th><b>Program Type</b></th>
					<th><b>GPA </b></th>
					<th><b>SAT </b></th>
					<th><b>GRE </b></th>
				</tr>
						
				
		<?php
			while ($row = mysqli_fetch_array($result)) {
				$pr = $row['ProgName'];
				echo '<tr>';
					echo '<td>' . $row['ProgName'] . '</td>';
					echo '<td>' . $row['ProgType'] . '</td>';
					if (($row['MinGPA'] == null) || ($row['MinGPA'] == ""))
					{
						echo '<td> - </td>';
					}
					else
					{
						echo '<td>' . $row['MinGPA'] . '</td>';
					}
					if (($row['SATMinScore'] == null) || ($row['SATMinScore'] == ""))
					{
						echo '<td> - </td>';
					}
					else
					{
						echo '<td>' . $row['SATMinScore'] . '</td>';
					}
					if (($row['GREMinScore'] == null) || ($row['GREMinScore'] == ""))
					{
						echo '<td> - </td>';
					}
					else
					{
						echo '<td>' . $row['GREMinScore'] . '</td>';
					}
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
		