<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valuetext";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM desire";
$result = $conn->query($sql);

$values_list = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $values_list[] = $row["one"];
    $values_list[] = $row["two"];
    $values_list[] = $row["three"];
    $values_list[] = $row["four"];
    $values_list[] = $row["ex"];
  }
}

$conn->close();

$value_counts = array_count_values($values_list);
arsort($value_counts);
$top_values = array_slice($value_counts, 0, 5, true);

$data_rows = array();
foreach ($top_values as $value => $count) {
  $data_rows[] = "['$value', $count]";
}

$data_rows_string = implode(",", $data_rows);

echo '<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load(\'current\', {\'packages\':[\'corechart\']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          [\'Category\', \'Total\'],
          '.$data_rows_string.'
        ]);

        var options = {
          title: \'Top 5 life of value\',
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