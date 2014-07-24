<?php

function getTrips($con) {
  
  // do query
  $sql=
  "SELECT tripdate, distance, duration FROM `trips`";
  $queryResult = mysqli_query($con, $sql);
  
  if (mysqli_num_rows( $queryResult )==0) {
    ?><h2>Nothing here.</h2><?php
  }
  else {
    ?>
    <div class="trip-table">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Date</th>
            <th>Distance</th>
            <th>Duration</th>
          </tr>
        </thead>
        <tbody id="table-rows">
          <?php
          while( $row = mysqli_fetch_assoc( $queryResult ) ){
            // echo $row['tripdate'];
            $date_string = date("F j, Y \a\\t h:i", strtotime($row['tripdate']));
            // $monthNum = $date_string['month'];
            // $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            // $monthName = $dateObj->format('F');
            $tripHour = floor($row['duration']/60);
            if ($tripHour > 0) {
               $tripMinute = $row['duration'] - (60 * $tripHour);
            }
            else {
              $tripMinute = $row['duration'];
            } 
            ?>
            <tr>
              <!-- <td><?= $monthName ?> <?= $date_string['day'] ?>, <?= $date_string['year'] ?> at <?= $date_string['hour'] ?>:<?= $date_string['minute'] ?></td> -->
              <td><?= $date_string ?></td>
              <td><?= $row['distance'] ?> miles</td>
              <td><?= $tripHour ?> hours and <?= $tripMinute ?> minutes</td>
            </tr><?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
  }
}

function removeTrips($con) {

  if (!(isset($_POST['reset']))) {
    return false;
  }
  
  $sql="TRUNCATE TABLE `trips`";

  if (!mysqli_query($con,$sql)) {
      return false;
  } else {
      return true;
  }
}

$con=mysqli_connect("localhost","root","root","cycle");
// Check connection
if (mysqli_connect_errno()) {
  die;
}
else {
  removeTrips($con);
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

          <div class="masthead clearfix" id="trips-header">
            <div class="inner">
              <h3 class="masthead-brand">Cycle</h3>
              <ul class="nav masthead-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="trips.php">Trips</a></li>
                <li><a href="stats.php">Stats</a></li>
              </ul>
            </div>
          </div>
          <div class="inner cover" id="trips-inner">
            <?php getTrips($con);?>
            <form class="form" role="form" action="trips.php" method="post"> 
              <button type="submit" class="btn btn-default" name="reset">Reset</button>
            
              <?php
                if (isset($_POST['reset'])) {
                  removeTrips($con);
                }
                mysqli_close($con);
              ?>
            </form>
            
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
</html>`