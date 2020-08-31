<?php 
array_unshift($data_entrada, 'Mês');
array_unshift($PI, 'PI');
array_unshift($CP, 'Consumo Ponta');
array_unshift($CFP, 'Consumo Fora da Ponta');
array_unshift($LU, 'Limite de Ultrapassagem');
?>

<html lang="pt-br">
<head>
<style>


</style>
	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	 <?php 
for ($i=0; $i < $endkey_entrada+2; $i++) 
        	{ 
        		if ($i==0) {
        			echo "['$data_entrada[$i]','$PI[$i]'],";
        			
        		}	
        		else if ($i == $endkey_entrada+1) {
        			echo "['$data_entrada[$i]',$PI[$i]]";
        		}
        		else
        		{
        			echo "['$data_entrada[$i]',$PI[$i]],";

        		}

        	}
     ?>
        ]);

        var options = {
          title: 'PI (R$/MWh)',
          titleTextStyle: {color: 'gray', fontSize:20, fontName: 'Lato'},
          hAxis: {textStyle: {color: 'gray', fontName: 'Lato'}},
           'height':350,
          vAxis: {viewWindow: {
        min: 90,
        max: 310
    },
    ticks: [90,110,130,150,170,190,210,230,250,270,290,310],minValue: 0, textStyle: {color: 'gray', fontName: 'Lato'}}

        };


        var chart = new google.visualization.AreaChart(document.getElementById('chart_div1'));

        chart.draw(data, options);
      }












       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          <?php 
for ($i=0; $i < $endkey_entrada+2; $i++) 
          { 
            if ($i==0) {
              echo "['$data_entrada[$i]','$CP[$i]','$CFP[$i]'],";             
            } 
            else if ($i == $endkey_entrada+1) {
              echo "['$data_entrada[$i]',$CP[$i],$CFP[$i]]";
            }
            else
            {
              echo "['$data_entrada[$i]',$CP[$i],$CFP[$i]],";

            }

          }
     ?>
      ]);

    var options = {
      title : 'CARGA (MWh)',
      titleTextStyle: {color: 'gray', fontSize:20, fontName: 'Lato'},
      hAxis: {textStyle: {color: 'gray', fontName: 'Lato'}},
      vAxis: {textStyle: {color: 'gray', fontName: 'Lato'}},
      seriesType: 'bars',
      'height':300,
      series: {2: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
  }
	   </script>
</head>

<body>
 <div id="chart_div1" style="width: auto;"></div>
 <div id="chart_div2" style="width: auto;"></div>
</body>
</html>
