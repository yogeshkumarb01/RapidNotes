<?php
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch notes to delete from database
    if($sql = mysqli_query($con, "DELETE FROM `notes` WHERE notes_id='$id'"))
	{
		if($sql = mysqli_query($con, "SELECT * FROM `guest` WHERE notes_id='$id'"))
		{
			mysqli_query($con, "DELETE FROM `guest` WHERE notes_id='$id'");
		}
		 echo '<meta http-equiv="refresh" content="0.5; URL=teacher.php" />';
        exit;	
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=teacher.php" />';
}

}


if (isset($_GET['afile_id'])) {
    $id = $_GET['afile_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch notes to delete from database
    if($sql = mysqli_query($con, "DELETE FROM `notes` WHERE notes_id='$id'"))
	{
		if($sql = mysqli_query($con, "SELECT * FROM `guest` WHERE notes_id='$id'"))
		{
			mysqli_query($con, "DELETE FROM `guest` WHERE notes_id='$id'");
		}
		 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
        exit;	
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
}

}
?>