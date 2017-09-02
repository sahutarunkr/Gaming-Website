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

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="format.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>
<body>
<div>
 <?php 
echo "<p style='margin-left: 5.4cm'>Welcome ".$_SESSION['login_user'].", <a href='logout.php'>Logout</a></p>";?>
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
      <form class="navbar-form navbar-right" method="post" role="search">
        <div class="form-group">
          <input type="text" name="searching" class="form-control" placeholder="Search">
          <select name="taskOption" id="category">
			<option value=""> Category </option>
        	<option value="Action"> Action </option>
        	<option value="Adventure"> Adventure </option>
        	<option value="FPS"> FPS </option>
        	<option value="Puzzle"> Puzzle </option>
        	<option value="RPG"> RPG </option>
        	<option value="Strategy"> Strategy </option>
        	<option value="Simulator"> Simulator </option>
          </select>
        </div>
        <button id="srchBTN" type="submit" class="btn btn-default" formaction="search.php">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right hidden-sm">
        <li><a href="cart.php">Shopping Cart</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
  <?php 
	$con = mysqli_connect("localhost", "root", "root", "project");
	
	$productString = $_POST['searching'];
	$selectOption = $_POST['taskOption'];
	if(!empty($productString) && $selectOption != ""){ //both set
		$sql = "SELECT productID, productName, price, description, image FROM product WHERE productName LIKE '%".$productString."%' AND category ='".$selectOption."' ORDER BY productId Desc";
	}
	else if(empty($productString) && $selectOption != ""){ # just category is set
		$sql = "SELECT productID, productName, price, description, image FROM product WHERE category ='".$selectOption."' ORDER BY productId Desc";
	}else if($selectOption == "" && !empty($productString)){ # just text in search is set. Category is empty.
		$sql = "SELECT productID, productName, price, description, image FROM product WHERE productName LIKE '%".$productString."%' ORDER BY productId Desc";
	}else{ //both not set
		$sql = "SELECT productID, productName, price, description, image FROM product ORDER BY productId Desc";
	}
	
	$result = mysqli_query($con, $sql); 
	$counter = 0;
	$b = true;
	
	foreach($result as $row){
		if($counter % 3 == 0){
			echo "<div class='row text-center'>";//////
			$b = true;
		}
		echo "<div class='col-sm-4 col-md-4 col-lg-4 col-xs-6'>";/////
		echo "<div class='thumbnail'> <img src='data:image/jpeg;base64,".base64_encode($row['image'])."' class='img-responsive'>";////
		echo "<div class='caption'>";///
		echo "<form method='post'>";//
		$sqlA = "SELECT * FROM library WHERE productID =".$row['productID']." AND username = '".$_SESSION['login_user']."'";
		$resultA = mysqli_query($con, $sqlA);
		$prodID = $row['productID'];
		echo "<h3>".$row['productName']."</h3>"; 
		echo "<h5>$".$row['price']."</h5>"; 
        echo "<p>".$row['description']."</p>";
		echo "<input type='hidden' name='productID' value=$prodID />";
        if(mysqli_num_rows($resultA) == 0){
			echo "<p><button type='submit' class='btn btn-primary' formaction='cart.php'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Add to Cart</button></p>";
		}
		else{
			echo "<p><button type='button' class='btn btn-primary'> Already Own </button></p>";
		}
		echo "</form>";//
		echo "</div>";///
		echo "</div>";////
		echo "</div>";/////
		
		if($counter % 3 == 2){
			echo "</div>";//////
			$b = false;	
		}
			
		$counter++;
	}
	if($b){
		echo "</div>";//////
	}
	
	?>
</div>
<hr>
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>