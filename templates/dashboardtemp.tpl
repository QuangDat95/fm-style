<style>
	.contain-main {
		display: flex;

	}
	.side-left-dash{
		width: 15%;
	}

	.side-right-dash{
		width: 85%;
	}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="nenbao">
	<fieldset class="nencon">
		<legend>
			<a style="cursor:pointer">
				<h4 style="Color:#FF3300;Font-Weight:Bold;">Báo Cáo Thông Kê Tổng Hợp</h4>
			</a>
		</legend>
		<div class="contain-main">
			<div class="side-left-dash">
				<div></div>
			</div>
			<div class="side-right-dash">
				<div id="chart_div"></div>
			</div>
		</div>
		
		
		
		<script src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">

			// Load the Visualization API and the corechart package.
			google.charts.load('current', {'packages':['corechart']});
	  
			// Set a callback to run when the Google Visualization API is loaded.
			google.charts.setOnLoadCallback(drawChart);
	  
			// Callback that creates and populates a data table,
			// instantiates the pie chart, passes in the data and
			// draws it.
			function drawChart() {
	  
			  // Create the data table.
			  var data = new google.visualization.DataTable();
			  data.addColumn('string', 'Topping');
			  data.addColumn('number', 'Slices');
			  data.addRows([
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
			  chart.draw(data, options);
			}
		  </script>

	</fieldset>
</div>
