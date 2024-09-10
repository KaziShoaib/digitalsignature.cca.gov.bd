<!doctype html>
<html lang="en">
  <head>
  	<title>Yearly Data</title>
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
				z-index: -1; /* set the z-index to 1 so it stays below the navbar */
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
        $apiKey = '52xVhmtJKSi4Y-wVG-SrboC5oXFAblEtdkKBk_LglHbhW6C8VPmg3xIcAbcNL4yO9wk7YRP2tS4lLjASE2NEZpzYWaqt-8okm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnDQcrQO9quj3QwQahIrJ9dvQVeNqpqRt5WQlw93NQH4QvXel69W-t1oESoqVuxVI2Zyyt5EJeKBa5INXnLlhD-cpLTfhw_WSDg';


		// retrieve the data from the API
		$url = "https://script.googleusercontent.com/macros/echo?user_content_key=$apiKey&lib=M1PESj4_jQrSS49-H6E8WXF8-k_s04r_S";
		// Make the GET request and retrieve the response data
        $json = file_get_contents($url);
        $data = json_decode($json, true);

// get a list of available years from the data
$years = array();
foreach ($data['data'] as $item) {
    $year = $item['Financial Year'];
    if (!in_array($year, $years)) {
        array_push($years, $year);
    }
}

// set the default year to the first available year
$selected_year = $years[0];

// handle form submission to update the selected year
if (isset($_POST['year'])) {
    $selected_year = $_POST['year'];
}

// create an array of labels and values for the bar chart
$labels = array();
$values = array();
foreach ($data['data'] as $item) {
    $year = $item['Financial Year'];
    $label = $item['CA'];
    $value = $item['Total Digital Signature Certificate'];
    if ($year == $selected_year) {
        array_push($labels, $label);
        array_push($values, $value);
    }
}

// generate the bar chart using chart.js
?>
<!DOCTYPE html>
<html>
<head>
    <title>Yearly data Bar Chart</title>
     <meta charset="UTF-8">
    <script src="chart.js"></script>
    <style>
        canvas {
            display: block;
            margin: auto;
            width: 100%;
            max-width: 800px;
            height: auto;
        }

        @media (max-width: 600px) {
            canvas {
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
	<div style="padding: 170px;">
    <h1 align="center">Yearly data</h1>
<div style="width: 100%; margin: 0 auto;" align="center">
  <div style="display: flex; justify-content: center;">
    <form method="post" class="form-inline">
      <label for="year">Select year:</label>
      <select name="year" id="year" class="form-control mr-2">
        <?php foreach ($years as $year) { ?>
          <option value="<?php echo $year; ?>" <?php if ($year == $selected_year) { echo "selected"; } ?>><?php echo $year; ?></option>
        <?php } ?>
      </select>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
    <canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Digital Signature Certificate',
                    data: <?php echo json_encode($values); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
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