<?php
$username= $_GET["username"];
$con=mysqli_connect("localhost","root","root","project"); 
$query = "SELECT * FROM newusers where username= '".$username."'"; 
$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) != 0){
	echo " USERNAME ALREADY EXIST";
}
?> 

 

