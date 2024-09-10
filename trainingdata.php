<!doctype html>
<html lang="en">
  <head>
  	<title>Training Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<style>
			.header {
				height: 150px; /* adjust the height as needed */
				width: 100%; /* span the entire width of the page */
				position: fixed; /* fix the position so it stays at the top of the page */
				z-index: 1; /* set the z-index to 1 so it stays below the navbar */
				top: 0;
				left: 0;
				background-color: rgba(0, 123, 255, 0.5);
			}

			nav#sidebar {
				z-index: 2; /* set the z-index to 2 so it stays on top of the header */
				 height: 100%;
				position: fixed;
			}

	</style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
				<a href="index.php"><img alt="CCA" src="images/cca logo.jpg" width="200"/></a>
	        <ul class="list-unstyled components mb-5">
	           <li>
              <a href="index.php">Home</a>
	          </li>
	          <li>
              <a href="monthlydata.php">Monthly data</a>
	          </li>
			  <li>
              <a href="yearlydata.php">Yearly data</a>
	          </li>
	          <li>
              <a href="trainingdata.php">Training data</a>
	          </li>
			  <li>
              <a href="orgdata.php">Organization data</a>
	          </li>


	        </ul>

<!--	        <div class="mb-5">
						<h3 class="h6">Subscribe for newsletter</h3>
						<form action="#" class="colorlib-subscribe-form">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	              <input type="text" class="form-control" placeholder="Enter Email Address">
	            </div>
	          </form>
					</div>

	        <div class="footer">
	        	<p> Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
	        </div>
-->
	      </div>
    	</nav>

        <!-- Page Content  -->
 <header>
			<div class="header">
				<div id="content" class="p-4 p-md-5 pt-5">
				<h1 class="mb-4" bold align="center">Digital Signature Data Visualization Tool</h1>
		</div>
			</div>
		 </header>
        <table style="width: 100%">
	<tr>
		<td><?php
		
		// Define your API key
        $apiKey = 'g-KGI0uxIU6zd6jkyt3Awe2WcK6NC0ZJ6_Mt4QJhUMPB5g0me6e8I0H5dyNEzVMLCUm3alV4MoklLjASE2NEZuu6yAS0qay2m5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnAi8RfExziIgWLMk__B7Mvd_m4J1cKoZAW1K6a1lGjTxn8R_oF_gdJSA3Gcq7B0pDnsAsrnk88hlVumhNY85H66aqda43P994A';


		// retrieve the data from the API
		$url = "https://script.googleusercontent.com/macros/echo?user_content_key=$apiKey&lib=Mr0BtZz6bt70USNjw38g_bl8-k_s04r_S";
		// Make the GET request and retrieve the response data
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        

// Extract the year and the values for each category
$year = array();
$target = array();
$achievement = array();

foreach ($data['data'] as $item) {
    $year[] = $item['Fiscal Year'];
    $target[] = $item['Training Target in APA'];
    $achievement[] = $item['Achievement'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Training Targets and Achievements Bar Chart</title>
	<script src="chart.js"></script>
	<style>
		.chart-container {
    width: 100%;
    max-width: 800px;
    height: auto;
    margin: 0 auto;
}
		
		@media (min-width: 768px) {
			.chart-container {
				width: 80%;
			}
		}
	</style>
</head>
<body>
	<div style="padding: 170px;">
    <h1 align="center">Training Targets and Achievements</h1>
	<div style="width: 100%; margin: 0 auto;">
	<div class="chart-container">
		<canvas id="myChart"></canvas>
	</div>
	
	<script>
<?php
// Define the JSON data

// Extract the year and the values for each category
$year = array();
$target = array();
$achievement = array();

foreach ($data['data'] as $item) {
    $year[] = $item['Fiscal Year'];
    $target[] = $item['Training Target in APA'];
    $achievement[] = $item['Achievement'];
}

// Set up the chart
echo "<html>";
echo "<head>";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
echo "</head>";
echo "<body>";

echo "<canvas id='myChart'></canvas>";

echo "<script>";
echo "var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ".json_encode($year).",
            datasets: [{
                label: 'Training Target in APA',
                data: ".json_encode($target).",
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Achievement',
                data: ".json_encode($achievement).",
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });";
echo "</script>";
echo "</body>";
echo "</html>";
?>


	</script>
</body>
</html>

</td>
	</tr>
</table>
</br>
        
      </div>
	  
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>