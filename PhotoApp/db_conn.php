<?php  

$sname = "localhost";
$uname = "uname";
$password = "password";

$db_name = "dbname";

$conn = mysqli_connect($sname, $uname, $password, $db_name);
global $conn;

if (!$conn) {
	echo "Connection failed!";
	exit();
}