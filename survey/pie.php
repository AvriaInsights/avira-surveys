<html>
   <head>
      <title>Google Charts Tutorial</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
   </head>

   <body>
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Browser');
            data.addColumn('number', 'Percentage');
            data.addRows([
               ['Firefox dfdf dfdfv dfdfv dfvdfv dfdfv dfvdfvdf dfvdf', 45.0],
               ['IE dfdf dfdfvdf dffd dfvdfv dfvdfv ', 26.8],
               ['Chrome dsfsdf sdfsdfd dsfsdf sdfdsf sdfdsf sdfsdf fddsf dfsdf sddsf dffvdv dsfksjdfh kjsdhfjkhsdf sdfhhjskhfkjs fhksdhfkjshdk sdfkhskdfksdjksf ksdkjsd fkjhsdkj fsf', 12.8],
               ['Safari dffdffd dfdf dfgf hgnghn bfb dfgfd dfdf dfgdf df', 8.5],
               ['Opera', 6.2],
               ['Others', 0.7]
            ]);
               
            // Set chart options
            var options = {
               'title':'Browser market shares at a specific website, 2014',
               'width':650,
               'height':400,
               chartArea: {left: 0, top: 0, width: "100%", height: "100%"}
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
   </body>
</html>