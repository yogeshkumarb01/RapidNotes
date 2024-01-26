<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
if (!isset($_SESSION['Uname']) || $_SESSION['Uname'] == '')
{
	echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
}else{
$user=$_SESSION['Uname'];
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
        <a class="navbar-brand" href="#"><span style="font-size: 35px;color: #FFF;line-height: 1em;font-weight: bold;">Rapid Notes</span></a>
      </div>

      <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav">
          <li class="scroll"><a href="#home">Home</a></li>
          <li class="scroll"><a href="#about">Search</a></li>
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
<div id="home" style="background-image: url('img/student_notes.png'); background-repeat: no-repeat; background-position: center bottom; background-size: 50% 75%; height:600px;">
    <br />
     <center><h1 style="color:#016485;">Welcome </h1><br />
		<?php 
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($user)){
			$user_name=mysqli_query($con, "SELECT name FROM student WHERE usn='$user'");
			$row = mysqli_fetch_assoc($user_name);
		}
		?>
		<h1 style="color:#016485;"><?php echo $row['name']; ?></h1>
	 </center><br /><br />
      
</div>
<div class="pg-size" id="about" style="height:600px;">
     <center><center><h1 style="color:#016485;">Search Notes</h1></center>
	 <form action="" method="post" name="student_search">
		<table class="serchtab"><tr><td>Enter Notes ID </td> <td>
			<input type="text" name="notesid"></td>
			<td>Enter Notes Password </td>
			<td><input type="text" name="notespass"></td>
			<td colspan="1"><button class="button" name="ss_submit" style="vertical-align:middle"><span>Search </span></button></td></tr>
		</table>
		
		<?php
		if(isset($_POST['ss_submit'])){
			$con = mysqli_connect('localhost','root','');
			mysqli_select_db($con, "notes_repository");
			if($_POST['notesid']=="")
			{
				echo '<h6 style="color:red;margin-left:60px;margin-top:60px;">*Notes ID Cannot be Empty.</h6>';
			}
			else
			{
			$gsn_id=isset($_POST['notesid']) ? $_POST['notesid'] : '';
			
				$check=mysqli_query($con, "SELECT * FROM notes WHERE notes_id='$gsn_id'");
				if(mysqli_num_rows($check) > 0){
			$check = mysqli_fetch_array($check);
			if ($check['notes_pass']!="")
			{ 
			if(isset($_POST['notespass']))
			{
				if ($check['notes_pass']==$_POST['notespass']) { 					
            ?>
			<table id="srfields"  cellpadding="10px">
			<tr>
				<th style="background-color: #4CAF50; width:100px; color: white;">Notes</th><th style="background-color: #4CAF50; color: white;" colspan="2">Action</th>
			</tr>
                <tr>
                    <td><?php echo $check['title']?></td>
                    <td><a href="download.php?sfile_id=<?php echo $check['notes_id']?>">Download</a></td>
                </tr>
			</table>
            <?php
            
			} else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Sorry Does not Exist</h6>	
		<?php } 
      		}
			else{
				echo '<h6 style="color:red;margin-left:60px;margin-top:60px;">*You must enter password for this Document to Download</h6>';
			}
			}
			else{
			if ($results=mysqli_query($con, "SELECT * FROM notes WHERE notes_id='$gsn_id'")) { 
						$row = mysqli_fetch_array($results); 							
            ?>
			<table id="srfields"  cellpadding="10px">
			<tr>
				<th style="background-color: #4CAF50; width:100px; color: white;">Notes</th><th style="background-color: #4CAF50; color: white;" colspan="2">Action</th>
			</tr>
                <tr>
                    <td><?php echo $row['title']?></td>
                    <td><a href="download.php?sfile_id=<?php echo $row['notes_id']?>">Download</a></td>
                </tr>

            <?php
            
			} else { ?>
			<h6 style="color:red;margin-left:60px;margin-top:60px;">*Sorry Does not Exist</h6>	
		<?php }
		}
		}
		else {
			echo '<h6 style="color:red;margin-left:60px;margin-top:60px;">*Invalid Notes ID</h6>';
		}
		}
		}
		?>
		</table>
		</form>
     </center>
</div>
<div class="pg-size" id="teacher" style="background-image: url('img/profile.png'); background-repeat: no-repeat; background-position: center right; background-size: 300px 300px;height:600px;">
    <center><center><h1 style="color:#016485;">Profile</h1></center></center>
    <br /><br />
    <div class="register">
	<?php 
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($user)){
			$user_details=mysqli_query($con, "SELECT * FROM student WHERE usn='$user'");
			$user_details = mysqli_fetch_assoc($user_details);
			$depart_num=$user_details['depart_id'];
			$depart_details=mysqli_query($con, "SELECT * FROM department WHERE depart_id='$depart_num'");
			$depart_details = mysqli_fetch_assoc($depart_details);
		}
	?>
        <table id="srfields" cellpadding="10px" style="display: inline-block;">
            <tr>
                <tr><td>USN </td><td><label type="text" name="usn"><?php echo $user_details['usn']; ?></td></tr>
                <tr><td>Name </td><td><label type="text" name="name"><?php echo $user_details['name']; ?></td></tr>
                <tr><td>Department </td><td><label type="text" name="depart"><?php echo $depart_details['depart_name']; ?></td>
					
            </tr>
            <tr>

            </tr>
        </table>    
		<form action="" method="post" name="pass_change">
		<table id="srfields" cellpadding="10px" style="float:left">
			<tr><td><h3 style="color:#016485;">Change Password</h3></td></tr>
            <tr>
                <tr><td>Previous Password </td><td><input type="password" name="ppass"></td></tr>
                <tr><td>New Password </td><td><input type="password" name="npass"></td></tr>
                <tr><td>Confirm Password </td><td><input type="password" name="cpass"></td>
					<td colspan="1"><button class="button" name="cp_submit" style="vertical-align:middle"><span>Change </span></button></td></tr>
            </tr>
            <tr>

            </tr>
            
		<?php	
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($_POST['cp_submit'])){
			$ppass = isset($_POST['ppass']) ? $_POST['ppass'] : '';
			$npass = isset($_POST['npass']) ? $_POST['npass'] : '';
			$cpass = isset($_POST['cpass']) ? $_POST['cpass'] : '';
			$ppass = stripslashes($ppass);
			$npass = stripslashes($npass);
			$cpass = stripslashes($cpass); 
			if ($npass == $cpass)
			{
			if (mysqli_query($con, "SELECT * FROM student WHERE usn='$user' and pass='$ppass'")) { 
				mysqli_query($con, "UPDATE student SET pass='$npass' WHERE usn='$user'");
				session_destroy();
				echo '<meta http-equiv="refresh" content="0; URL=pass_redirect.html" />';
			exit;
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
