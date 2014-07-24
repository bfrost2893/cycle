<?php
//Input: connection to cycle database
//Adds a row to the trips table in the cycle database.
function addTrip($con) {
	//if post is empty from html form, exit function and display error 
	if (!(isset($_POST['duration']) && isset($_POST['distance']))) {
		return false;
	}
	//if duration and distance values are not numeric, return false and display error
	if (!(is_numeric($_POST['duration']) && is_numeric($_POST['distance']))) {
		return false;
	}

	// do query

	// escape variables for security
	$duration = mysqli_real_escape_string($con, $_POST['duration']);
	$distance = mysqli_real_escape_string($con, $_POST['distance']);

	$sql=
	"INSERT INTO 
	trips (duration, distance)
	VALUES 
	('$duration', '$distance')";

	if (!mysqli_query($con,$sql)) {
	  	return false;
	} else {
	  	return true;
	}
}

$con=mysqli_connect("localhost","root","root","cycle");
// Check connection
if (!mysqli_connect_errno()) {
	$succeeded = addTrip($con);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="cycle web application">
    <meta name="author" content="brad frost">
    <link rel="icon" href="../favicon.ico">

    <title>Cycle</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cycle.css" rel="stylesheet">

  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Cycle</h3>
              <ul class="nav masthead-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="trips.php">Trips</a></li>
                <li><a href="stats.php">Stats</a></li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
          	<div class="trip-entry">
	            <h1 class="cover-heading">Enter your latest trip.</h1>
	            <form class="form" role="form" action="index.php" method="post">
	              <div class="form-group">
	                <input type="text" class="form-control" id="distance" name="distance" placeholder="How far did you go? (miles)">
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" id="duration" name="duration" placeholder="How long did it take you? (minutes)">
	              </div>
	              <button type="submit" class="btn btn-default" name="submit">Submit</button>
	            </form>
	          </div>
	          <div class="trip-added">
	          <?php
	          	//if submit button is pressed
	          	if (isset($_POST['submit'])) {
	          		//and succeded variable (contains return value of getTrips function)
		          	if ($succeeded) { ?>
		          		<!-- display trip added! -->
		          	  <h2>Trip Added!</h2>
		          	<?php } else { ?>
		          	  <h2>Error while inputting trip.</h2>
		          	<?php }
		       		}
		       		// close connection
		       		mysqli_close($con);
		      	?>
		      	</div>
	        	<div class="mastfoot">
		            <div class="inner">
		              <p>Powered by <a href="http://getbootstrap.com">Bootstrap</a>, built by <strong>Brad Frost</strong>.</p>
		            </div>
		        </div>
		    	</div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="../../assets/js/docs.min.js"></script> -->
  </body>
</html>