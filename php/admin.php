<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
if (!isset($_SESSION['aname']) || $_SESSION['aname'] == '')
{
	echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
}else{
$user=$_SESSION['aname'];
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Shushmitha M">
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
          <li class="scroll"><a href="#home">Department</a></li>
          <li class="scroll"><a href="#about">Notes</a></li>
          <li class="scroll"><a href="view.php">View Feedback</a></li>
          <li class="scroll"><a href="#student">Change Password</a></li>
          <li class="scroll"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header>
<!--/header-->
<div id="home" style="background-image: url('img/depart.png'); background-repeat: no-repeat; background-position: center right; background-size: 500px 500px;height:600px;">
<form action="" method="post" name="admin_department">
    <br />
     <center><h1 style="color:#016485;">Department</h1></center><br /><br />
     <h4 style="color:#016485;">&emsp;Add or Remove Department</h4>
    <div class="register" style="float:left; margin-top:50px">
        <table id="srfields" cellpadding="10px" style="display: inline-block;">
            <tr>
                <td>Department Name </td><td><td><input type="text" name="dep_name"><br></td></td>
				<td colspan="1"><button class="button" name = "da_submit" style="vertical-align:middle"><span>Add </span></button></td>
            </tr>
            
            <tr><td><br /><br /></td></tr>
             <tr>
                <td>Department ID </td><td><td><input type="text" name="dep_id"><br></td></td>
				<td colspan="1"><button class="button" name="da_remove" style="vertical-align:middle"><span>Remove </span></button></td>
            </tr>
            <tr>
                
                
            </tr>
		</table>
		<table id="srfields"  cellpadding="10px" style="float:right; margin-left:200px;" border="2">
			<tr>
				<th style="background-color: #4CAF50; width:100px; color: white;">ID</th><th style="background-color: #4CAF50; color: white;">Department</th>
			</tr>
			<?php
            $con = mysqli_connect('localhost','root','');
			mysqli_select_db($con, "notes_repository");
            $results = mysqli_query($con,"SELECT * FROM department LIMIT 10");
            while($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td><?php echo $row['depart_id']?></td>
                    <td><?php echo $row['depart_name']?></td>
                </tr>

            <?php
            }
            ?>
		</table>
<?php
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, "notes_repository");
if(isset($_POST['da_submit'])){
	$d_name=isset($_POST['dep_name']) ? $_POST['dep_name'] : '';
	if($query=mysqli_query($con, "INSERT INTO `department`(`depart_name`) VALUES ('{$d_name}')"))
		{
			 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
		}
		else{
			echo "Errr";
		}
}

if(isset($_POST['da_remove'])){
	$d_id=isset($_POST['dep_id']) ? $_POST['dep_id'] : '';
	if($query=mysqli_query($con, "DELETE FROM `department` WHERE depart_id='$d_id'"))
		{
			mysqli_query($con, "DELETE FROM `notes` WHERE depart_id='$d_id'");
			mysqli_query($con, "DELETE FROM `teacher` WHERE depart_id='$d_id'");
			 echo '<meta http-equiv="refresh" content="0.5; URL=admin.php" />';
		}
		else{
			echo "Errr";
		}
}
?>
            
    </div> 
</form>	
</div>
<div class="pg-size" id="about" style="height:600px;">
<form action="" method="post" name="search" enctype="multipart/form-data">
	<?php	
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		?>
     <center><center><h1 style="color:#016485;">Admin</h1></center>
		<table class="serchtab"><tr><td>Select Department </td> 
			<td>
					<select name="adepart">
					<option disabled selected value> -- select an option -- </option>
					<?php
						$result=mysqli_query($con,"SELECT * from department");
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['depart_id'] ."'>" . $row['depart_name'] ."</option>";
						}
					?>
					</select>
                </td>
			<td colspan="1"><button class="button" name="sn_submit" style="vertical-align:middle"><span>Search </span></button></td></tr>
		</table>
		<table id="srfields"  cellpadding="10px" style="height:220px; display: block; width:350px; overflow-y:scroll;">
			<tr>
				<th style="background-color: #4CAF50; width:100px; color: white;">Notes</th><th style="background-color: #4CAF50; color: white;" colspan="2">Action</th>
			</tr>
		<?php
		if(isset($_POST['sn_submit'])){
			$depart = isset($_POST['adepart']) ? $_POST['adepart'] : '';
			if ($depart != "")
			{
			if ($results=mysqli_query($con, "SELECT * FROM notes WHERE depart_id='$depart'")) { 
						while($row = mysqli_fetch_array($results)) {							
            ?>
                <tr>
                    <td><?php echo $row['title']?></td>
                    <td><a href="download.php?file_id=<?php echo $row['notes_id']?>">Download</a></td>
					<td><a href="delete.php?afile_id=<?php echo $row['notes_id']?>">Delete</a></td>
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
     </center>
	 </form>
</div>
<div class="pg-size" id="student" style="background-image: url('img/admin.png'); background-repeat: no-repeat; background-position: center Bottom; background-size: 300px 300px;height:600px;">
    <center><center><h1 style="color:#016485;">Change Password</h1></center></center>
    <br /><br />
    <div class="register">
	<form action="" method="post" name="Login">
        <table id="srfields" cellpadding="10px">
            <tr>
                <td>Admin ID </td><td><input type="text" name="admin_id"></td></tr>
                <tr><td>Previous Password </td><td><input type="password" name="aapass"></td></tr>
                <tr><td>New Password </td><td><input type="password" name="aanpass"></td></tr>
                <tr><td>Confirm Password </td><td><input type="password" name="aacpass"></td>
					<td colspan="1"><button class="button" name="ap_submit" style="vertical-align:middle"><span>Change </span></button></td></tr>
            </tr>
            <tr>

            </tr>
			<?php	
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($_POST['ap_submit'])){
			$apass = isset($_POST['aapass']) ? $_POST['aapass'] : '';
			$anpass = isset($_POST['aanpass']) ? $_POST['aanpass'] : '';
			$acpass = isset($_POST['aacpass']) ? $_POST['aacpass'] : '';
			$apass = stripslashes($apass);
			$anpass = stripslashes($anpass);
			$acpass = stripslashes($acpass); 
			if ($anpass == $acpass)
			{
			if (mysqli_query($con, "SELECT * FROM admin WHERE username='$user' and pass='$apass'")) { 
				if(mysqli_query($con, "UPDATE admin SET pass='$anpass' WHERE username='$user'")){
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
