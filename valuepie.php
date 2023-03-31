<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "value";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM desire";
$result = $conn->query($sql);

$total_money = 0;
$total_time = 0;
$total_health = 0;
$total_honor = 0;
$total_ex = 0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $total_money += $row["money"];
    $total_time += $row["time"];
    $total_health += $row["health"];
    $total_honor += $row["honor"];
    $total_ex += $row["ex"];
  }
}

$conn->close();

echo '<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load(\'current\', {\'packages\':[\'corechart\']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          [\'Category\', \'Total\'],
          [\'Money\', '.$total_money.'],
          [\'Time\', '.$total_time.'],
          [\'Health\', '.$total_health.'],
          [\'Honor\', '.$total_honor.'],
          [\'EX\', '.$total_ex.']
        ]);

        var options = {
          title: \'My Values\',
          pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById(\'piechart\'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>';
?>
