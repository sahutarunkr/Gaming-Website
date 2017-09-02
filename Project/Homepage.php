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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		<?php
			if(!isset($_SESSION['login_user'])){
				header('Location: login.html');
			}
		?>
	</script>
	<script>
		$(document).ready(function(){
			<?php $_SESSION['counter'] = 0;?>
			
			$.ajax({
				type: 'POST',
				url: 'firstPage.php',
				success: function(data){
					$('#items').empty();
					$('#items').append(data);
				}
			});
			
			$('#left').click(function(){
				$('#items').hide();
				
				$.ajax({
					type: 'POST',
					url: 'pageDown.php',
					success: function(data){
						$('#items').empty();
						$('#items').append(data);
					}
				});
				
				$('#items').fadeIn();
			});
			$('#right').click(function(){
				$('#items').hide();
				
				$.ajax({
					type: 'POST',
					url: 'pageUp.php',
					success: function(data){
						$('#items').empty();
						$('#items').append(data);
					}
				});
				
				$('#items').fadeIn();
			});
		});
	</script>
	<style>
		#recent{
			margin-left: 5.4cm;
		}
		
		#top{
			margin-left: 5.4cm;
		}
	</style>
</head>
<body>
<div>
	<?php 
		echo "<p id='top'>Welcome ".$_SESSION['login_user'].", <a href='logout.php'>Logout</a></p>";
	?>
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
		if( $_SESSION['login_user'] === "admin"){	
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
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div id="carousel1" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#carousel1" data-slide-to="0" class="active"> </li>
            <li data-target="#carousel1" data-slide-to="1" class=""> </li>
            <li data-target="#carousel1" data-slide-to="2" class=""> </li>
          </ol>
          <div class="carousel-inner">
            <div class="item"> <img class="img-responsive" src="images/fifa.jpg" alt="thumb">
            </div>
            <div class="item active"> <img class="img-responsive" src="images/Horizon_Zero_Dawn.jpg" alt="thumb">
            </div>
            <div class="item"> <img class="img-responsive" src="images/Warhammer.jpg" alt="thumb">
            </div>
          </div>
          <a class="left carousel-control" href="#carousel1" data-slide="prev"><span class="icon-prev"></span></a> <a class="right carousel-control" href="#carousel1" data-slide="next"><span class="icon-next"></span></a></div>
      </div>
	</div>
</div>
<hr>
<div>
<h3 id="recent"> Recently Added </h3>
</div>
<div id="items" class="container">
	
</div>
<div>
  <nav class="text-center">
    <div class="btn-group">
	  <button id="left" class="btn btn-default" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </button>
      <button id="right" class="btn btn-default" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </button>
    </div>
  </nav>
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