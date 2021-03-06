<?php
  $con=mysqli_connect("localhost","root","root","cycle");
  // Check connection
  if (mysqli_connect_errno()) {
   die;
  }


  // do query of dates
  $sql = "SELECT distance AS trip_distance, duration AS trip_duration, DATE_FORMAT(`tripdate`, '%Y,%m,%d,%H,%i') AS trip_date
          FROM `trips`"; 
  $queryResult = mysqli_query($con, $sql) or die(mysql_error());
  //position variables for making table
  //the table will be input to google chart api script
  $row_pos = -1;
  $row_step = 1;

  //if rows don't exist, assign displaygraph var to false
  if(mysqli_num_rows( $queryResult ) == 0) {
    $displayGraph = false;
  }
  //obtain number of rows and set displaygraph var to true
  else {
    $numRows = mysqli_num_rows($queryResult);
    $displayGraph = true;
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

    <script type="text/javascript" src="http://www.google.com/jsapi"></script> 
    
      <script type="text/javascript"> 
        google.load("visualization", "1", {packages:["annotationchart"]}); 
        google.setOnLoadCallback(drawData); 
        //google chart api function to draw chart
        function drawData() { 
          //let data var equal to GCAPI datatable
          var data = new google.visualization.DataTable(); 
          data.addColumn('datetime', 'Date');             //add date column
          data.addColumn('number', 'Total Distance');     //add total distance column
          data.addColumn('number', 'Average Speed');      //add average speed column

          <?php 
          //add numRows number of rows (assigned above)
          echo "data.addRows($numRows);\n";
          //assign base variables to 0
          $total_distance = 0; 
          $row_pos_base1 = 0;
          $avg_speed = 0;
          $speed = 0;
          //while there is still data to fetch from table
          while($row = mysqli_fetch_assoc($queryResult)) { 
            //increment row position
            $row_pos += $row_step;
            //increment row_base1 (used for averaging)
            $row_pos_base1 = $row_pos + 1; 
            //updated total distance
            $total_distance += $row['trip_distance'];
            //get speed (mph)
            $speed = $row['trip_distance'] / ($row['trip_duration']/60);
            //calculate average speed
            $avg_speed = ($avg_speed + $speed) / $row_pos_base1;
            //echo js to assign values to data var
            echo "         data.setValue(" . $row_pos . ", 0, new Date(" . $row['trip_date'] . "));\n"; 
            echo "         data.setValue(" . $row_pos . ", 1, " . $total_distance . ");\n";
            echo "         data.setValue(" . $row_pos . ", 2, " . $avg_speed . ");\n"; 
          } 
          ?> 
          //make annotationchart style with element id time_div
          var chart = new google.visualization.AnnotationChart(document.getElementById('time_div'));
          //chart options
          var options = {
            // title: 'Total Distance and Average Speed over Time',
            displayLegendValues: true,
            displayAnnotations: true,
            displayLegendDots: true,           
          }; 
          //draw the chart
          chart.draw(data, options); 

        } 
      </script> 
    
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
            <div id="google-chart">
              
              <?php
                //if there is no data, don't display anything
                if ((!$displayGraph)) {
                   ?><h2>No data to graph!</h2><?php
                }
                else {
                  ?><h2 id="chart-title">Total Distance and Average Speed over Time</h2><?php
                } 
              ?>
              <!-- display GCAPI chart here -->
              <div id="time_div" style='height: 500px; width: 120%;'></div>
            </div>
            <?php
              // close connection
              mysqli_close($con);
            ?>
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