<!-- index -->
<?php
session_start();
include_once '../connection.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home/logout.php?logout");
}

if(isset($_POST['login']))
{
	$UName = mysqli_real_escape_string($conn, $_POST['UName']);
	$UPass = md5(mysqli_real_escape_string($conn, $_POST['UPass']));
	$UName = trim($UName);
	$UPass = trim($UPass);
	$Name = $_POST['UName'];
	$query = "SELECT UName, Pass, UType FROM login WHERE UName='$UName'";
	$result = mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result);
	$count = mysqli_num_rows($result);

	if($count == 1 && $row['Pass']==$UPass && $row['UType']=="Student")
	{
		$StdID = $Name;
		$ses_sql=mysqli_query($conn,"select * from student where StdID='$StdID'");
		$row_sql=mysqli_fetch_array($ses_sql);
		$count_sql = mysqli_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['StdFName'] = $row_sql['StdFName'];
		}
	
		$_SESSION['Student'] = $StdID;
		header("Location: ../student/student.php");
	}
	else if($count == 1 && $row['Pass']==$UPass  && $row['UType']=="Faculty")
	{
		$FID = $Name;
		$ses_sql=mysqli_query($conn, "select * from faculty where FID='$FID'");
		$row_sql=mysqli_fetch_array($ses_sql);
		$count_sql = mysqli_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['FFName'] = $row_sql['FFName'];
		}
		
		$_SESSION['Faculty'] = $FID;
		header("Location: ../faculty/faculty.php");
	}
	else if($count == 1 && $row['Pass']==$UPass && $row['UType']=="Employee")
	{
		$EmpID = $Name;
		$ses_sql=mysqli_query($conn, "select * from employee where EmpID='$EmpID'");
		$row_sql=mysqli_fetch_array($ses_sql);
		$count_sql = mysqli_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['EmpFName'] = $row_sql['EmpFName'];
		}
		
		$_SESSION['Employee'] = $EmpID;
		header("Location: ../employee/employee.php");
	} 
	else
	{
		?>
			<script>alert('Username or Password is incorrect!');</script>
        <?php
	}

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<html>
<div class = "pagediv">

	<body>
	
			<br></br>
			<center><a href="https://www.sju.edu/"><img src="../images/img2.png" alt="SJU" width="500" height="150"></a></center>
			<h1>Welcome to SJU Scheduling System</h1>
			<div class= "formdiv">
				<form method="post">
					<fieldset><legend><h2> Please Log In </h2></legend>
					<br></br>
						<label for = "UName"><b> Username </b></label>
							<input type="text" id= "UName" name="UName" required>
						<label for = "UPass"><b> Password </b></label>
							<input type="password" id= "UPass" name="UPass" required>
						<button type="submit" name="login"> Login </button>
					</fieldset>
				</form> 
			
				<br></br>
				<a class="singlelink" href="../student/guest.php"><b>Continue as a guest</b></a>
			</div>
	</body>
	
	<footer>
		<small>
			<b>© Copyright 2016 - This application is a project for Database Management course, SJU</b>
		</small>
	</footer>
	
</div>
</html>