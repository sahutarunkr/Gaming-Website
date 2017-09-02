<?php 
session_start();

$username = $_POST["username"];
$password= $_POST["password"];
$hashpassword = hash('sha256', $password);
$con=mysqli_connect("localhost","root","root","project"); 
$query = "INSERT INTO `newusers`(`username`, `password`) VALUES ('".$username."','".$hashpassword."')"; 
$result = mysqli_query($con,$query);
if($result->num_rows == 0){ // User not found. So, redirect to login_form again. 
	$_SESSION['login_user']=$username;
	header('Location: Homepage.php');
	exit();
}
?>