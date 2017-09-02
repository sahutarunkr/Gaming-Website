<?php 
include("config.php");
session_start();
		
$username= $_POST["username"];

$password= $_POST["password"];

$con=mysqli_connect("localhost","root","root","project"); 
$query = "SELECT * FROM newusers where username= '".$username."'"; 
$result = mysqli_query($con,$query);

$_SESSION['login_user'] = $username;
 
 if(mysqli_num_rows($result) > 0){ 
	while($row = mysqli_fetch_assoc($result)){
		if ($row["password"]==hash('sha256', $password)){
			header('Location: Homepage.php');
			exit();
		}
		else{	
			header('Location: login.html');
			exit();
		}
	}
}
else{
	header('Location: login.html');
	exit();
}  
?>