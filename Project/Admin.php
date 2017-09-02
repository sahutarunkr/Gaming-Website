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
	<style>
		#recent{
			margin-left: 5.4cm;
		}
		
		#top{
			margin-left: 5.4cm;
		}
		
		text.fieldset{
			text-align : right;
			width : 200 px;
			padding : 10x;
		}
		.inputType{
			width: 500px;
		}
		label.fieldset{
			text-align : left;
			width : 120px;
			float : left;
		}
	</style>
</head>
<body>
<div>
 <?php 
echo "<p id='top'>Welcome ".$_SESSION['login_user'].", <a href='logout.php'>Logout</a></p>";?>
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
		<?php
		if( $username != "admin"){	
			echo '<li><a href="Admin.php" id = admin_button >Admin</a></li>';
		}
		?>
		
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
<?php 
$con = mysqli_connect("localhost", "root", "root", "project");

if($_POST['delete'] == true){
	$rowToDelete = $_POST['todelete'][0];
	$sql = "UPDATE product SET is_deleted=1 WHERE productID=".$rowToDelete;
	$result = mysqli_query($con,$sql);	
	unset($_POST['todelete'][0]);
}
?>
<div class="container"> 
<h1>All Items </h1>
<form method="post">
    <table> 
        <tr> <th>Item Name</th> <th>Product ID</th> <th>Price</th> <th>Remove from Listing?</th> <th>Listed in Store</th></tr>
		
		<?php
		
		# Get input
		$productID = $_POST['productID'];
		$sql = "SELECT * FROM product";
		$result = mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($result)) {
			$productArr = array("productID" => $row['productID'], "productName" => $row['productName'], "quantity" => 1, "price" => $row['price'], "is_deleted" => $row['is_deleted']);
			echo "<tr>";
			echo "<td>" . $row["productName"] . "</td>";
			echo "<td>" . $row["productID"] . "</td>";
			echo "<td>" . $row["price"] . "</td>";
			echo '<td><input name="todelete[]" type="radio" value = '.$row["productID"].' class = "radio" /> ' . '</td>';  
			if($row['is_deleted'] == 0){
				echo "<td> Yes </td>";
			}
			else{
				echo "<td> No </td>";
			}
			echo "</tr>";
		}
		?>      
    </table> 
    <br />
	<?php
		echo "<input type='hidden' name='delete' value = 'true'/>";
		echo "<a class = 'btn btn-primary' href = '#Insert'>Insert</a>";
		echo "<a class = 'btn btn-primary' href = '#Update'>Update</a>";
		echo "<button class='btn btn-primary' formaction='admin.php'>Delete Items</button>";
	?>
</form> 
<br />
</div>
<div class = "container" id = "Insert">
	<h2>Add Item</h2>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<p style="color: red"> Required* </p>
		<p><label class ="fieldset" >Product Name*: </label> <input type="text" class = "inputType" name="ProductName" value="" required><p>
		<p><label class ="fieldset" >Price*: </label><input type="text" class = "inputType" name="Price" value="" required><p>
		<p><label class ="fieldset" >Category*: </label><input type="text" class = "inputType" name="Category" value="" required><p>
		<p><label class ="fieldset" > Description*:</label><textarea class = "inputType" rows="4" cols="50" name="Description" value="" required></textarea><p>
		<p><label class ="fieldset" >Select Image to Upload*:</label><p>
		<p><input type="file" name="fileToUpload" id="fileToUpload" required><p>
		<p><input class ="fieldset" type="submit" value="Add" name="submit"><p>
	</form>
</div>
<div class = "container" id = "Update">
	<h2>Update Item</h2>
	<form action="update.php" method="post" enctype="multipart/form-data">
		<p style="color: red"> Required* </p>
		<p><label class ="fieldset" >Product ID*: </label> <input type="text" class = "inputType" name="ProductID" required></p>
		<p><label class ="fieldset" >Product Name: </label> <input type="text" class = "inputType" name="ProductName"></p>
		<p><label class ="fieldset" >Price: </label><input type="text" class = "inputType" name="Price"></p>
		<p><label class ="fieldset" >Category: </label><input type="text" class = "inputType" name="Category"></p>
		<p><label class ="fieldset" > Description:</label><textarea class = "inputType" rows="4" cols="50" name="Description"></textarea></p>
		<p><label class ="fieldset" >Select Image to Upload:</label></p>
		<p><input type="file" name="fileToUpload" id="fileToUpload"></p><br/>
		<p><label class ="fieldset" >Add back to Listing: </label></p>
		<p><input class="fieldset" name="addBack" type="checkbox"></p>
		<p><input class ="fieldset" type="submit" value="Update" name="submit"></p>
	</form>
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