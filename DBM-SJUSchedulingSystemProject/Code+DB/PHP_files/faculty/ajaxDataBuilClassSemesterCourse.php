<?php
//Include database configuration file
include_once('../connection.php');

if(isset($_POST["BID"]) && !empty($_POST["BID"])){
    //Get all classrooms data
    $query = $conn->query("SELECT * FROM classroom WHERE BID='".$_POST['BID']."' ORDER BY CRNum ASC ");
    
	//Count total number of rows
    $rowCount = $query->num_rows;

    
    //Display classrooms list
    if($rowCount > 0)
	{
        echo "<option value=''>Select Classroom</option>";
        while($row = $query->fetch_assoc())
		{ 
            echo "<option value='".$row['CRNum']."'>".$row['CRName']."</option>";
		}
    }
	else
	{
        echo '<option value="">Classroom Not Avaliable</option>';
    }
}

if(isset($_POST["SID"]) && !empty($_POST["SID"])){
    //Get all classrooms data
    $query = $conn->query(" SELECT * 
							FROM course c, runs r
							WHERE c.CID = r.CID and
								  c.CID IN ( SELECT CID
											 FROM runs
											 WHERE SID ='".$_POST['SID']."') 
							ORDER BY c.CName ASC");
    
	//Count total number of rows
    $rowCount = $query->num_rows;

    
    //Display classrooms list
    if($rowCount > 0)
	{
        echo "<option value=''>Select Course</option>";
        while($row = $query->fetch_assoc())
		{ 
            echo "<option value='".$row['CID']."'>".$row['CName']." </option>";
		}
    }
	else
	{
        echo '<option value="">Course Not Avaliable</option>';
    }
}

?>