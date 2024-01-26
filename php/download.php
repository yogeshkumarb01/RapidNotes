<?php
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch file to download from database
    $sql = "SELECT * FROM notes WHERE notes_id='$id'";
    $result = mysqli_query($con, $sql);
    $file = mysqli_fetch_assoc($result);
    $filepath = 'upload/' . $file['file_name'];
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type:' .mime_content_type($filepath));
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['file_name']));
        readfile('upload/' . $file['file_name']);
		 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
        exit;
		
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
}

}

if (isset($_GET['tfile_id'])) {
    $id = $_GET['tfile_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch file to download from database
    $sql = "SELECT * FROM notes WHERE notes_id='$id'";
    $result = mysqli_query($con, $sql);
    $file = mysqli_fetch_assoc($result);
    $filepath = 'upload/' . $file['file_name'];
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type:' .mime_content_type($filepath));
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['file_name']));
        readfile('upload/' . $file['file_name']);
		 echo '<meta http-equiv="refresh" content="0.5; URL=teacher.php" />';
        exit;
		
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=teacher.php" />';
}

}


if (isset($_GET['adfile_id'])) {
    $id = $_GET['adfile_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch file to download from database
    $sql = "SELECT * FROM notes WHERE notes_id='$id'";
    $result = mysqli_query($con, $sql);
    $file = mysqli_fetch_assoc($result);
    $filepath = 'upload/' . $file['file_name'];
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type:' .mime_content_type($filepath));
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['file_name']));
        readfile('upload/' . $file['file_name']);
		 echo '<meta http-equiv="refresh" content="0.5; URL=index.php" />';
        exit;
		
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=index.php" />';
}

}


if (isset($_GET['sfile_id'])) {
    $id = $_GET['sfile_id'];
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con, "notes_repository");
    // fetch file to download from database
    $sql = "SELECT * FROM notes WHERE notes_id='$id'";
    $result = mysqli_query($con, $sql);
    $file = mysqli_fetch_assoc($result);
    $filepath = 'upload/' . $file['file_name'];
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type:' .mime_content_type($filepath));
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['file_name']));
        readfile('upload/' . $file['file_name']);
		 echo '<meta http-equiv="refresh" content="0.5; URL=student.php" />';
        exit;
		
    }
	else
	{echo "Not Found";
	 echo '<meta http-equiv="refresh" content="0.5; URL=student.php" />';
}

}
?>
