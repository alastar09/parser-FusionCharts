<?php
header('Content-Type: text/html; charset=utf-8');
require "php/functions.php";

$db = connect('127.0.0.1','root','','parser');

$data = get_rash($db);

//print_r($data);
?>


<?php
include("fusioncharts.php");
?>

<html>
   <head>
      <!-- FusionCharts Library -->      
	  <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
	  <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
	  <script type="text/javascript" src="js/themes/fusioncharts.theme.candy.js"></script>
   </head>
<body>
<?php
   
   //$data = file_get_contents('https://s3.eu-central-1.amazonaws.com/fusion.store/ft/data/line-chart-with-time-axis-data.json');
   //$schema = file_get_contents('https://s3.eu-central-1.amazonaws.com/fusion.store/ft/schema/line-chart-with-time-axis-schema.json');
   $schema = file_get_contents('schema.json');
  
   //echo $schema;  
   //echo $data;
   $max=1;
   $min=-14;

   $fusionTable=new FusionTable($schema, $data);
   $timeSeries = new TimeSeries($fusionTable);

   $timeSeries->AddAttribute('chart', '{"theme":"candy"}');
   $timeSeries->AddAttribute('caption', '{"text":"Temperature Analysis"}');   
   $timeSeries->AddAttribute('yaxis', '[{"plot":"temp","title":"temp","format":{"suffix":"°C"},"referenceline":[{"label":"Controlled MAX","value":"$max","style":{"marker":{"fill":"#A4A7D5","stroke":"#A4A7D5"}}},{"label":"Controlled MIN","value":"$min","style":{"marker":{"fill":"#87DEDB","stroke":"#87DEDB"}}}]}]');
   

   // chart object
   $Chart = new FusionCharts(
      "timeseries",		  
      "MyFirstChart" ,
      '100%',
      '100%',	 
      "chart-container",
      "json",
      $timeSeries
   );

   // Render the chart
   $Chart->render();
?>

   <div id="chart-container">Chart will render here!</div>
</body>
</html>