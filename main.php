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
		echo '<p id="welcome">Welcome '.$_SESSION['username'].'</p>';
		$loginsuccess = 1;
	}
	elseif (!empty($_POST["email"])&&!empty($_POST["password"])) {
	$loginemail = $_POST['email'];
	$loginpassword = $_POST['password'];

	$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');
	$query = "SELECT * FROM ndg1051 WHERE email='$loginemail' AND password='$loginpassword'";
	$result = mysqli_query($dbc, $query) or die('Error querying');

		if(mysqli_num_rows($result)==1){
		$loginsuccess = 1;
		$row2 = mysqli_fetch_array($result);
		$name = $row2['name'];	
		echo '<p id="welcome">Welcome '.$name.'</p>';	
		$_SESSION['useremail']=$loginemail;		
		$_SESSION['username']=$name;
		mysqli_close($dbc);
		}
		else {
		echo'
		<br>
		<section class="message">
		<p id="message" align="center">Access Failed, Please <a href="index.html">Log-in</a></p>
		</section>';	
		$loginsuccess = 0;				
		}
	}
	else{
	echo'
	<br>
	<section class="message">
	<p id="message" align="center">Access Failed, Please <a href="index.html">Log-in</a></p>
	</section>';	
	$loginsuccess = 0;		
	}

	
if($loginsuccess==1){
/*
	echo '<h3>NOTICE</h3>';
	$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');	
	$query3 = "SELECT * FROM ndg1051 WHERE teacher = 1 AND (file IS NOT NULL AND file != '')";
	$result3 = mysqli_query($dbc, $query3) or die('Error querying 3');

	
	while($row3 = mysqli_fetch_array($result3)){
	$name = $row3['name'];
	$topic = $row3['topic'];	
	$file = $row3['file'];	
	$date = $row3['predate']; 
	$date2 = explode("-", $date);
	$datetime = $date2[1].'/'.$date2[2];	
	echo '<br><br><section class="schedule'.rand(1,4).'">
		<table width="700" border="0" cellpadding="0">
		  <tr>
			<td width="140" id="row"><p>Date</p></td>
			<td id="date">'.$datetime.'</td>
		  </tr>
		  <tr>
			<td id="row">Title</td>
			<td id="context"><a href="'.$file.'">'.$topic.'</a></td>
		  </tr>
		  <tr>
			<td id="row">Posted By</td>
			<td id="context"> '.$name.'</td>
		  </tr>
		 </table>
		 </section>
		 ';
			
	}
	mysqli_close($dbc);
	*/
	echo '<h3>SCHEDULE</h3>';	
	$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');	
	$query2 = "SELECT * FROM ndg1051 WHERE teacher = 0";
	$result2 = mysqli_query($dbc, $query2) or die('Error querying 2');	
	while($row2 = mysqli_fetch_array($result2)){
		if ($date == $row2['predate']){
			//延續
		$name = $row2['name'];
		$topic = $row2['topic'];	
		$file = $row2['file'];
		echo '
		<table width="700" border="0" cellpadding="0">
		  <tr>
			<td width="140" id="row">Title</td>
			<td id="context"><a href="'.$file.'">'.$topic.'</a></td>
		  </tr>
		  <tr>
			<td id="row">Presenter</td>
			<td id="context"> '.$name.'</td>
		  </tr>
		 </table>';
				
		}
		else {
			//Start a new one
		$date = $row2['predate']; 
		$date2 = explode("-", $date);
		$datetime = $date2[1].'/'.$date2[2];
		$name = $row2['name'];
		$topic = $row2['topic'];
		$file = $row2['file'];
		echo '<br>';//$datetime,$name,$topic;	
		echo '
		</section>
		<br>
		<section class="schedule'.rand(1,4).'">
		<table width="700" border="0" cellpadding="0">
		  <tr>
			<td width="140" id="row"><p>Date</p></td>
			<td id="date">'.$datetime.'</td>
		  </tr>
		  <tr>
			<td id="row">Title</td>
			<td id="context"><a href="'.$file.'">'.$topic.'</a></td>
		  </tr>
		  <tr>
			<td id="row">Presenter</td>
			<td id="context"> '.$name.'</td>
		  </tr>
		 </table>';
			
		}
		
	}
	mysqli_close($dbc);
}



?>


</div>
<p>&nbsp;</p>
</body>
</html>
