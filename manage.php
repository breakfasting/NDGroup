<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NEUROSCIENCE DISCUSSION GROUP 105-1 | NTNU Life Science</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>


<body>
<div id="maincolumn">
<header class="shadow">
	<section id="title">
    <h2>NTNU Department of Life Science | Semester 105-1</h2>
	<h1>NEUROSCIENCE<br>DISCUSSION GROUP</h1>
    </section>
    <section>
    <ul id="nav">
        <li><a href="logout.php">LOGOUT</a></li><p>  |  </p>
        <li><a href="manage.php">UPLOAD</a></li><p>  |  </p>
        <li><a href="member.php">MEMBERS</a></li><p>  |  </p>
    	<li><a href="main.php">SCHEDULE</a></li>
    </ul>
	</section>
</header>

<?php
	include 'config.php';
	
	session_start();
	if (!empty($_SESSION['useremail'])){
		$email = $_SESSION['useremail'];
		echo '<p id="welcome">Welcome '.$_SESSION['username'].'</p>';
		$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');	
		$query = "SELECT * FROM ndg1051 WHERE email='$email'";
		$result = mysqli_query($dbc, $query) or die('Error querying 2');
		$row = mysqli_fetch_array($result);
		$uid = $row['UID'];
		$name = $row['name'];
		$topic = $row['topic'];
		$file = $row['file'];
		$date = $row['predate']; 
		$date2 = explode("-", $date);
		$datetime = $date2[1].'/'.$date2[2];
		mysqli_close($dbc);
		
		$loginsuccess = 1;
	}
	else{
	echo'
	<br>
	<section class="message">
	<p id="message" align="center">Access Failed, Please <a href="index.html">Log-in</a></p>
	</section>';	
	$loginsuccess = 0;		
	}

	if ($loginsuccess == 1){
	echo '<h3>UPLOAD</h3>';
	echo'
	<br><br>
	<section class="message">
			<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
			<table width="900" border="0" cellpadding="0">
			  <tr>
				<td width="140" id="row"><p>Date</p></td>
				<td id="date">'.$datetime.'</td>
			  </tr>
			  <tr>
				<td id="row">Title</td>
				<td id="context"><input type="text" name="topic" size="90" maxlength="300" value="'.$topic.'" required/></td>
			  </tr>
			  <tr>
				<td id="row">Current File</td>
				<td id="context"><a href="'.$file.'">'.$topic.'</a></td>
			  </tr>
			  <tr>
				<td id="row">Upload</td>
				<td id="context"><input type="file" name="fileToUpload" required/><br><small id="greentext">only PDF files are allowed, MAX file size 30MB</small></td>
			  </tr>
			 </table>
			 
			 <input type="hidden" name="uid" value="'.$uid.'">
			<input id="button" type="submit" value="Submit" name="btn-upload"/>
			</form>
		</section>';	
	}
?>

</div>
<p>&nbsp;</p>
</body>
</html>
