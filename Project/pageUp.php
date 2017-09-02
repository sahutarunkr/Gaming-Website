<?php
	session_start();
	
	$con = mysqli_connect("localhost", "root", "root", "project");
	$sql = "SELECT productID, productName, price, description, image FROM product WHERE is_deleted = 0 ORDER BY productId Desc LIMIT ".($_SESSION['counter']*6).",6";
	$result = mysqli_query($con, $sql);
	
	$sql1 = "SELECT productID, productName, price, description, image FROM product WHERE is_deleted = 0 ORDER BY productId Desc LIMIT ".(($_SESSION['counter']+1)*6).",6";
	$result1 = mysqli_query($con, $sql1);
	
	if(mysqli_num_rows($result) == 6 && mysqli_num_rows($result1) > 0){
		$_SESSION['counter']++;
	}
	
	$b = true;
	$counter = 0;
	$con = mysqli_connect("localhost", "root", "root", "project");
	$sql = "SELECT productID, productName, price, description, image FROM product WHERE is_deleted = 0 ORDER BY productId Desc LIMIT ".($_SESSION['counter']*6).",6";
	$result = mysqli_query($con, $sql);
	
	foreach($result as $row){
		if($count % 3 == 0){
			echo "<div class='row text-center'>";
			$b = true;
		}
			echo "<div class='col-sm-4 col-md-4 col-lg-4 col-xs-6'>";
				echo "<div class='thumbnail'> <img src='data:image/jpeg;base64,".base64_encode($row['image'])."' class='img-responsive'>";
					echo "<div class='caption'>";
						echo "<form method='post'>";
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
						echo "</form>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		if($count % 3 == 2){
			echo "</div>";
			$b = false;
		}
		
		$count++;
	}
	if($b){
		echo "</div>";
	}
?>