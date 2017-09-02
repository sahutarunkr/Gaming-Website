<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nebula</title>


<link rel="stylesheet" href="css/bootstrap.css">
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="format.css">
<link rel="stylesheet" type="text/css" href="format2.css">
<style>
	nav{
		margin-left: .21cm;
		margin-right: 4cm;
	}
</style>
<script>
	<?php
		if(!isset($_SESSION['login_user'])){
			header('Location: login.html');
		}
	?>
</script>
</head>
<body>
<div>
 <?php 
echo "<p style='margin-left: 5.4cm; font-family: Arial;'>Welcome ".$_SESSION['login_user'].", <a href='logout.php'>Logout</a></p>";?>
</div>
<nav>
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="Homepage.php">Nebula</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Homepage.php">Store<span class="sr-only">(current)</span></a> </li>
        <li><a href="Library.php">Library</a> </li>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
        <li><a href="purchases.php">Previous Purchases</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- Main Container -->
<div class="container">
  <!-- Starts Gallery Section -->
  <?php
	$con = mysqli_connect("localhost", "root", "root", "project");
	$sql = "SELECT product.productName, product.description, product.image FROM library, product WHERE library.productID = product.productID AND library.username = '".$_SESSION['login_user']."'";
	$results = mysqli_query($con, $sql);
	$count = 0;
	$b = true;
	foreach($results as $row){
		if($count % 4 == 0){
			echo "<div class='gallery'>";
			$b = true;
		}
		echo "<div class='thumbnail'> <a href='#'><img src='data:image/jpeg;base64,".base64_encode($row['image'])."' class='img-responsive'></a>";
		echo "<h4>".$row['productName']."</h4>";
		echo "<p class='text_column'>".$row['description']."</p>";
		echo "</div>";
		if($count % 4 == 3){
			echo "</div>";
			$b = false;
		}
		$count++;
	}
	if($b){
		echo "</div>";
	}
	echo "</div>";
  ?>
</div>
<hr/>
<div class="container well">
	<div class="row">
	  <div> 
		<address>
		<strong>MyStoreFront, Inc.</strong><br>
		Indian Treasure Link<br>
		Quitman, WA, 99110-0219<br>
		<abbr title="Phone">P:</abbr> (123) 456-7890
		  </address>
	  </div>
	</div>
</div>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © MyWebsite. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- Main Container Ends -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
