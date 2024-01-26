<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
if (!isset($_SESSION['tname']) || $_SESSION['tname'] == '')
{
	echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
}else{
$user=$_SESSION['tname'];
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Sandhya A">
  <title>Rapid Notes</title> 	
  <!-- core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/controls.css" rel="stylesheet">
</head>

<body id="home">
<header id="header">
  <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#home"><span style="font-size: 35px;color: #FFF;line-height: 1em;font-weight: bold;">Rapid Notes</span></a>
      </div>

      <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav">
          <li class="scroll"><a href="#home">Notes</a></li>
          <li class="scroll"><a href="#about">Upload</a></li>
          <li class="scroll"><a href="#teacher">Profile</a></li>
		  <li class="scroll"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header>
<!--/header-->
<div id="home" style="background-image: url('img/19.jpg'); background-repeat: no-repeat; background-position: center bottom; background-size: 100% 100%; height:700px;">
    <br />
     <center><h1 style="color:#fff;">Notes Uploaded </h1>
		<table id="srfields"  cellpadding="10px" width="325px" style="background-color: #f9f9f9; height:220px; display: block; overflow-y:scroll;">
			<tr>
				<th style="background-color: #4CAF50; width:100px; color: white;">Notes</th><th style="background-color: #4CAF50; color: white;" colspan="3">Action</th>
			</tr>
		<?php
		if(isset($user)){
			$con = mysqli_connect('localhost','root','');
			mysqli_select_db($con, "notes_repository");
			$tchr_id=mysqli_query($con, "SELECT * FROM teacher WHERE email='$user'");
			$tchr_id = mysqli_fetch_array($tchr_id);
			$tchr_id=$tchr_id['teacher_id'];
			if ($tchr_id != "")
			{
			if ($results=mysqli_query($con, "SELECT * FROM notes WHERE teacher_id=$tchr_id")) { 
						while($row = mysqli_fetch_array($results)) {							
            ?>
                <tr>
                    <td><?php echo $row['title']?></td>
                    <td><a href="download.php?tfile_id=<?php echo $row['notes_id']?>">Download</a></td>
					<td><a href="showpass.php?notes_id=<?php echo $row['notes_id']?>">Password</a></td>
					<td><a href="delete.php?file_id=<?php echo $row['notes_id']?>">Delete</a></td>
                </tr>

            <?php
            }
			} else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Does not Exist</h6>	
		<?php }
		} 
			else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Invalid Option</h6>	
			<?php }
		}
		?>
		</table>
	 </center><br /><br />
      
</div>
<div class="pg-size" id="about" style="background-image: url('img/upload.png'); background-repeat: no-repeat; background-position: bottom right; background-size: 350px 250px; height:600px;">
	<form action="" method="post" name="notes_upload" enctype="multipart/form-data">
     <center><center><h1 style="color:#016485;">Upload Notes</h1></center></center>
	 <div class="register">
		<table id="srfields" cellpadding="10px" style=" float:left">
			
            <tr>
                <tr><td>Notes Title </td><td><input type="text" name="ntitle"></td></tr>
                <tr><td>Protect Notes </td><td><input type="radio" name="nprotected" value="yes" checked> Yes</td>
					<td><input type="radio" name="nprotected" value="no"> No</td>
				</tr>
                <tr><td>Give Guest Access </td><td><input type="radio" name="nguest" value="yes"> Yes</td>
					<td><input type="radio" name="nguest" value="no"> No</td></td>
				</tr>
				<tr><td>Select File </td><td> <input type="file" name="notes_file" accept=".pdf"></td>
					<td colspan="1"><button class="button" name="n_submit" style="vertical-align:middle"><span>Upload </span></button></td></tr>
            </tr>
            <tr>

            </tr>
        </table>

	</div>
<?php
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, "notes_repository");
if(isset($_POST['n_submit'])){
$nname=isset($_POST['ntitle']) ? $_POST['ntitle'] : '';
$protected=isset($_POST['nprotected']) ? $_POST['nprotected'] : '';
$guest=isset($_POST['nguest']) ? $_POST['nguest'] : '';	
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$permitted_nums='0123456789';
echo $user;
$result=mysqli_query($con, "SELECT * FROM teacher WHERE email='$user'");
$result = mysqli_fetch_assoc($result);
$depart=$result['depart_id'];
$teacher_id=$result['teacher_id'];
//notes pass generate
$pass = substr(str_shuffle($permitted_chars), 0, 10);
$file = $_FILES['notes_file']['tmp_name'];
$file_name = $_FILES['notes_file']['name'];
$destination = 'upload/' . $file_name;
$ext= $_FILES['notes_file']['type'];
$nsize=$_FILES['notes_file']['size'];
//notes idgenerate
$notes_id = $nname."-".substr(str_shuffle($permitted_nums), 0, 4);
if($nname!="" && $protected!="" && $guest!="" && $file!="")
{
if($notes_id==mysqli_query($con, "SELECT notes_id FROM notes WHERE notes_id='$notes_id'"))
{
$notes_id=$nname.substr(str_shuffle($permitted_nums), 0, 5);
}
if($protected == "no")
{
	$pass="";
}
if($guest=="yes")
{
	$pass="";
	$id=$notes_id;
	if($query1=mysqli_query($con, "INSERT INTO `guest`(`notes_id`) VALUES ('{$id}')")){
	echo "<h6 style='color:Red; margin-left:80px;'>*Notes with Guest access will not be protected.</h6> ";
	}else{
		echo mysql_error();
	}	
}
$qry = mysqli_query($con,"SELECT * from `notes` where file_name = '$file_name' AND teacher_id = '$teacher_id' ");
if(mysqli_num_rows($qry)>0){
    echo "<script>alert('Notes is already been Uploaded');</script>";
    echo "<script>location.href='#';</script>";
}
else{
if (move_uploaded_file($file, $destination)) {
if($query=mysqli_query($con, "INSERT INTO `notes`(`notes_id`, `depart_id`, `title`, `size`, `teacher_id`, `file_name`, `notes_pass`, `file_type`)
VALUES
('{$notes_id}','{$depart}','{$nname}','{$nsize}','{$teacher_id}','{$file_name}','{$pass}','{$ext}')")){

echo "<h6 style='color:Blue; margin-left:80px;'>*Noted Uploaded Successfully</h6> ";
echo "<h6 style='color:Blue; margin-left:80px;'>*Notes ID :" . $notes_id . "</h6>";
if($pass!=""){
echo "<h6 style='color:Blue; margin-left:80px;'>*Noted Password :" . $pass . "</h6>";
}
mysqli_close($con);
}
else{
	echo mysql_error();
}
}

else
{ ?>
<h6 style="color:red; margin-left:80px;">*File is not Uploaded, please try agian now.</h6>
<meta http-equiv="refresh" content="2; URL=teacher.php" />
<?php }
}
}
else
{ ?>
<h6 style="color:red; margin-left:80px;">*All Fields are Mandatory</h6>
<?php }
}

?>
	
	
	</form>
     
</div>
<div class="pg-size" id="teacher" style="background-image: url('img/profile.png'); background-repeat: no-repeat; background-position: center right; background-size: 300px 300px;height:600px;">
    <center><center><h1 style="color:#016485;">Profile</h1></center></center>
    <br /><br />
    <div class="register">
	<?php
		$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, "notes_repository");
		$uresult=mysqli_query($con, "SELECT * FROM teacher WHERE email='$user'");
		$uresult = mysqli_fetch_assoc($uresult);
		$td_id=$uresult['depart_id'];
		$dresult=mysqli_query($con, "SELECT * FROM department WHERE depart_id='$td_id'");
		$dresult = mysqli_fetch_assoc($dresult);
		?>
		<form action="" method="post" name="pass_update">
        <table id="srfields" cellpadding="10px" style="display: inline-block;">
            <tr>
                <tr><td>Email </td><td><label name="usn" value=""><?php echo $uresult['email']; ?></td></tr>
                <tr><td>Name </td><td><label name="name" value=""><?php echo $uresult['name']; ?></td></tr>
                <tr><td>Department </td><td><label name="depart" value=""><?php echo $dresult['depart_name']; ?></td>
					
            </tr>
            <tr>

            </tr>
        </table>    
		<table id="srfields" cellpadding="10px" style=" float:left">
			<tr><td><h3 style="color:#016485;">Change Password</h3></td></tr>
            <tr>
                <tr><td>Previous Password </td><td><input type="password" name="tppass"></td></tr>
                <tr><td>New Password </td><td><input type="password" name="tnpass"></td></tr>
                <tr><td>Confirm Password </td><td><input type="password" name="tcpass"></td>
					<td colspan="1"><button class="button" name="tp_submit" style="vertical-align:middle"><span>Change </span></button></td></tr>
            </tr>
            <tr>

            </tr>
			<?php	
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($_POST['tp_submit'])){
			$tapass = isset($_POST['tppass']) ? $_POST['tppass'] : '';
			$tanpass = isset($_POST['tnpass']) ? $_POST['tnpass'] : '';
			$tacpass = isset($_POST['tcpass']) ? $_POST['tcpass'] : '';
			$tapass = stripslashes($tapass);
			$tanpass = stripslashes($tanpass);
			$tacpass = stripslashes($tacpass); 
			if ($tanpass == $tacpass)
			{
			if (mysqli_query($con, "SELECT * FROM teacher WHERE email='$user' and pass='$tapass'")) { 
				if(mysqli_query($con, "UPDATE teacher SET pass='$tanpass' WHERE email='$user'")){
				session_destroy();
				echo '<meta http-equiv="refresh" content="0; URL=pass_redirect.html" />';
				exit;} else { echo "errrr";}
			} else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Invalid password</h6>	
		<?php }
		} 
			else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Invalid password</h6>	
			<?php }
		}
		?>
        </table>    
		</form>
    </div>
</div>
</body>
</html>
