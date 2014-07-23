<?php

function getTrips($con) {
  
  // do query
  $sql=
  "SELECT tripdate, distance, duration FROM `trips`";
  
  $queryResult = mysqli_query($con, $sql);
  
  if (mysqli_num_rows( $queryResult )==0) {
    ?>Nothing here.<?php
  }
  else {
    ?>
    <table class="table">
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
          $date_string = date_parse($row['tripdate']);
          $monthNum = $date_string['month'];
          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = $dateObj->format('F');
          ?>
          <tr>
            <td><?= $monthName ?> <?= $date_string['day'] ?>, <?= $date_string['year'] ?></td>
            <td><?= $row['distance'] ?></td>
            <td><?= $row['duration'] ?></td>
          </tr><?php
        }
        ?>
      </tbody>
    </table>
    <?php
  }
  
  
}

$con=mysqli_connect("localhost","root","root","cycle");
// Check connection
if (mysqli_connect_errno()) {
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
                <li class="active"><a href="trips.php">Trips</a></li>
                <li><a href="stats.html">Stats</a></li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
            <?php getTrips($con); ?>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Powered by <a href="http://getbootstrap.com">Bootstrap</a>, built by <strong>Brad Frost</strong>.</p>
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