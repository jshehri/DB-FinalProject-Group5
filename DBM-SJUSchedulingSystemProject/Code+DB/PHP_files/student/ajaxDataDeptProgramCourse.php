<?php
//Include database configuration file
include_once('../connection.php');

if(isset($_POST["DeptID"]) && !empty($_POST["DeptID"])){
    //Get all colleges data
    $query = $conn->query("SELECT * FROM program WHERE DeptID='".$_POST['DeptID']."' ORDER BY ProgName ASC");
    
	//Count total number of rows
    $rowCount = $query->num_rows;

    
    //Display courses list
    if($rowCount > 0)
	{
        echo "<option value=''>Select a program</option>";
        while($row = $query->fetch_assoc())
		{ 
            echo "<option value='".$row['ProgID']."'>".$row['ProgName']." </option>";
		}
    }
	else
	{
        echo '<option value="">Program not Available</option>';
    }
}

if(isset($_POST["ProgID"]) && !empty($_POST["ProgID"])){
	//Get all programs data
    $query = $conn->query("SELECT * FROM course WHERE ProgID='".$_POST['ProgID']."' ");
    
	//Count total number of rows
    $rowCount = $query->num_rows;

    
    //Display courses list
    if($rowCount > 0)
	{
        echo "<option value=''>Select a Course</option>";
        while($row = $query->fetch_assoc())
		{ 
            echo "<option value='".$row['CID']."'>".$row['CName']." </option>";
		}
    }
	else
	{
        echo '<option value="">Course not Available</option>';
    }
}



?>