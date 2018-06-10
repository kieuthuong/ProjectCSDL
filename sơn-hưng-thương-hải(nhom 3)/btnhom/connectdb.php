<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sondb";
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($connect, "utf8");
?>