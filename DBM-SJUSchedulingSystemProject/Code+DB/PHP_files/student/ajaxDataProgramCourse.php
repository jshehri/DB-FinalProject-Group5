<?php
//Include database configuration file
include_once('../connection.php');

if(isset($_POST["ProgID"]) && !empty($_POST["ProgID"])){
    //Get all courses data
    $query = $conn->query("SELECT * FROM course WHERE ProgID='".$_POST['ProgID']."' ORDER BY CName ASC");
    
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
        echo '<option value="">Courses are not Available</option>';
    }
}
?>