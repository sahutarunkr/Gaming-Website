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
      
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<?php 
$con = mysqli_connect("localhost", "root", "root", "project");
if(!isset($_SESSION['Cart'])){
	$_SESSION['Cart'] = array();
}
else if($_POST['delete'] == true){
		foreach ($_POST['todelete'] as $Services) {
			$var = 0;
			foreach($_SESSION['Cart'] as $row){
				//print_r(array_keys($_SESSION['Cart'])[$var]);
				$holder = array_keys($_SESSION['Cart'])[$var];
				if($row["productID"] == $Services){
					//print_r($_SESSION['Cart']);
					unset($_SESSION['Cart'][$holder]);
				}
				$var = $var + 1;
			}
		}

	}
?>
<div class="container"> 
<h1>Previous Purchases</h1>  
    <table> 
        <tr> <th>Item Name</th> <th>Date</th> <th>Transaction ID</th> </tr>
		
		<?php
			$con = mysqli_connect("localhost", "root", "root", "project");
			$sql = "SELECT product.productName, transaction.date, transaction.transactionID FROM transaction, product, itemspurchased WHERE transaction.transactionID = itemspurchased.transactionID AND product.productID = itemspurchased.productID AND transaction.username = '".$_SESSION['login_user']."' ORDER BY date ASC, transactionID ASC";
			$results = mysqli_query($con, $sql);
			
			foreach($results as $row){
				echo "<tr>";
				echo "<td>" . $row["productName"] . "</td>";
				echo "<td>" . $row["date"] . "</td>";
				echo "<td>".$row['transactionID']."</td>";  
				echo "</tr>";
			}
		?>
		     
    </table> 
<br />
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