  <div id="chart_div" style="width:400; height:300"></div>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script>
 // Load the Visualization API and the piechart package.
      google.charts.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        

var data = google.visualization.arrayToDataTable([
  ['Answer Subtitle', 'Answer Count'],
  ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1], 
          ['Zucchini', 1],
          ['Pepperoni', 2]
  ]);
        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};
 
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          
          var myJSON = JSON.stringify(selectedItem);
          alert(myJSON);
          if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            alert('The user selected ' + topping);
          }
        }

        google.visualization.events.addListener(chart, 'select', selectHandler);    
        chart.draw(data, options);
      }
</script>