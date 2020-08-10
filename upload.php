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
<h3>UPLOAD</h3>
<br><br>
	<section class="message">
	<p id="message" align="center">
<?php
include 'config.php';

$uid = $_POST['uid'];
$target_dir = "uploaded_files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$changename = $target_dir . $uid . '.pdf';
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
	unlink($target_file);
    echo "File already exists, Overwriting<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 30000000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $changename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded and renamed to ".$uid.".pdf<br>";


		$newtopic = $_POST['topic'];
		echo "Title: ".$newtopic;
		$dbc = mysqli_connect($host, $user, $password, $db) or die('Error connecting to MySQL server.');	
		$query = "UPDATE ndg1051 SET topic='$newtopic', file='$changename' WHERE uid='$uid'";
		$result = mysqli_query($dbc, $query) or die('Error querying database.');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
		mysqli_close($dbc);
?>
	</p></section>
</div>
<p>&nbsp;</p>
</body>
</html>
