<?php  

$sname = "localhost";
$uname = "root";
$password = "PepitoMySql@59138";

$db_name = "dbtest";

$conn = mysqli_connect($sname, $uname, $password, $db_name);
global $conn;

if (!$conn) {
	echo "Connection failed!";
	exit();
}