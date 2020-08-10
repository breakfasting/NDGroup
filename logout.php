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
	session_start();
	if (!empty($_SESSION['useremail'])){
	session_destroy();
	echo'
	<br>
	<section class="message">
	<p id="message" align="center">You Have Logged out from '.$_SESSION['useremail'].', <a href="index.html">Log-in</a></p>
	</section>';
	}
	else {
	echo'
	<br>
	<section class="message">
	<p id="message" align="center">Access Failed, Please <a href="index.html">Log-in</a></p>
	</section>';		
	}
?>


</div>
<p>&nbsp;</p>
</body>
</html>
