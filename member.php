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
		$currentpassword = $row['password'];
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
	echo '<h3>ACCOUNT INFORMATION</h3>';
	echo'
	<br><br>
	<section class="message">
			<form class="upload" action="" method="post" enctype="multipart/form-data">
			<table width="800" border="0" cellpadding="0">
			  <tr>
				<td width="200" id="row">Name</td>
				<td id="context">'.$name.'</td>
			  </tr>
			  <tr>
				<td id="row">E-Mail</td>
				<td id="context">'.$email.'</td>
			  </tr>
			  <tr>
				<td id="row">New Password</td>
				<td id="context"><input type="password" name="allnewpass" maxlength="16"/></td>
			  </tr>
			  <tr>
				<td id="row">Confirm New Password</td>
				<td id="context"><input type="password" name="confirmnewpass" maxlength="16"/><small id="greentext"> Max 16 Charachers, Letters and Numbers</small></td>
			  </tr>			  
			  <tr>
				<td id="row"><br>Current Password</td>
				<td id="context"><br><input type="password" name="currentpassword" maxlength="16" required/></td>
				<input type="hidden" name="uid" value="'.$uid.'">
			  </tr>
			 </table>
				<input id="button" type="submit" value="Submit" name="btn-upload" align="middle"/><small id="greentext"> ';
	
	if(isset($_POST['btn-upload']))
	{
		if ($currentpassword == $_POST['currentpassword']){
			$newpass = $_POST['allnewpass'];
			$uid = $_POST['uid'];
			if (ctype_alnum($newpass)){
				if ($_POST['allnewpass']==$_POST['confirmnewpass']){
					$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');	
					$query = "UPDATE ndg1051 SET password='$newpass' WHERE uid='$uid'";
					$result = mysqli_query($dbc, $query) or die('Error querying database.');
					echo 'Password Changed';
				}
				else{
					echo "Confirm New Password Must Match Your New Password";	
				}
			}
			else{
				echo "Password should be Letters and Numbers";					
			}
		}
		else {
			echo 'Current Password Incorrect';	
		}
	}		
				
			echo '</small></form>
		</section>';	
	}
	

?>
</div>
<p>&nbsp;</p>
</body>
</html>
