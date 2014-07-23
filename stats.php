<?php

  // do query
  $sql = "SELECT distance AS trip_distance, DATE_FORMAT(tripdate, '%Y, %m-1, %d') 
  AS date FROM `trips` WHERE date NOT LIKE '0000-00-00 00:00:00' AND date 
  NOT LIKE '2000-00-00 00:00:00' GROUP BY DATE_FORMAT(date, '%Y, %m, 
  %d')"; 
  $queryResult = mysqli_query($con, $sql);
  $numRows = mysql_num_rows($sql);

  foreach($queryResult as $result) {

  }
}

$con=mysqli_connect("localhost","root","root","cycle");
// Check connection
if (!mysqli_connect_errno()) {
  die;
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
    <link rel="icon" href="../../favicon.ico">

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
                <li><a href="index.php">Home</a></li>
                <li><a href="trips.php">Trips</a></li>
                <li class="active"><a href="stats.php">Stats</a></li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
            
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