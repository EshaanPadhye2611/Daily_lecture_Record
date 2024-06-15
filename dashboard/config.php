<?php
session_start();
// Database connection or other configuration settings...
?>

<?php
$server = "localhost";
$username= "root";
$password ="";
$database ="work_reporting";
$conn =  mysqli_connect($server,$username,$password,$database);
if($conn){
	//echo "success";
}
else{
	die("Error". mysqli_connect_error());
}
