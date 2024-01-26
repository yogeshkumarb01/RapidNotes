<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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

    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header>
<!--/header-->
<div id="home" style="height:600px;">
    <br />
     <center><h1 style="color:#016485;">Notes Details </h1><br />
		<?php 
		if (isset($_GET['notes_id'])) {
		$id = $_GET['notes_id'];
		$con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, "notes_repository");
		if(isset($id)){
			$notes_details=mysqli_query($con, "SELECT * FROM notes WHERE notes_id='$id'");
			$row = mysqli_fetch_assoc($notes_details);
			$ntitle=$row['title'];
			$npass=$row['notes_pass'];
			?>
			<table id="srfields" cellpadding="10px">
            <tr>
				
                <td>Notes Title </td><td>
                <label><?php echo $ntitle; ?></label><br>
                </td>
			</tr>
			<tr>
                <td>Password&nbsp; </td>
                <td><label><?php echo $npass; ?></label></td>
				<td><a href="teacher.php">Take Me Back</a></td>
            </tr>
			
		<?php }
		}
		else{
			echo '<meta http-equiv="refresh" content="2; URL=teacher.php" />';
		}
		?>
	 </center><br /><br />      
</div>

</body>
</html>
