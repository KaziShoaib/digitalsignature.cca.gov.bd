<!doctype html>
<html lang="en">
  <head>
  	<title>Monthly Data</title>
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
        $apiKey = 'yjAPQQ_5vcId7FU7HE8TwiEd269ROjC_KGnmTaG9_4Z7xcns02nOGZThCeTLdZZLhsqfs57Om0ur-8IKgswNciGTR7O_gR4im5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnHmfeN6TJ7hEFw6pSo8qjfhrur6jCDac7aRFBS2fC90qhQ4O_wztJ8t4v6Y1DOiMTbfz8zh0j9DlgY3hELvQVGWnsKMVaARu4Nz9Jw9Md8uu';

		// retrieve the data from the API
	    $url = "https://script.googleusercontent.com/macros/echo?user_content_key=$apiKey&lib=MeGZTXIjHSkatWYBWAbb14qjdwx4fgKwJ";
			// Make the GET request and retrieve the response data
        $json = file_get_contents($url);
        $data = json_decode($json, true);

//echo $json;

// get a list of available CAs from the data
$cas = array();
foreach ($data['data'] as $item) {
    $ca = $item['CA'];
    if (!in_array($ca, $cas)) {
        array_push($cas, $ca);
    }
}


// get a list of available years from the data
$years = array();
foreach ($data['data'] as $item) {
    $year = $item['Year'];
    if (!in_array($year, $years)) {
        array_push($years, $year);
    }
}

// get a list of available months from the data
$months = array();
foreach ($data['data'] as $item) {
    $month = $item['Month'];
    if (!in_array($month, $months)) {
        array_push($months, $month);
    }
}

// set the default year and month to the first available year and month
$selected_ca = 'All';
$selected_year = $years[0];
$selected_month = $months[0];


// handle form submission to update the selected CA, year, and month
if (isset($_POST['ca'])) {
    $selected_ca = $_POST['ca'];
} else {
    $selected_ca = 'All';
}

if (isset($_POST['year'])) {
    $selected_year = $_POST['year'];
} else {
    $selected_year = $years[0];
}

if (isset($_POST['month'])) {
    $selected_month = $_POST['month'];
} else {
    $selected_month = $months[0];
}




// create an array of labels and values for the bar chart
$labels = array();
$valuesI = array();
$valuesII = array();
$valuesIII = array();
$valuesE = array();

foreach ($data['data'] as $item) {
    $year = $item['Year'];
    $month = $item['Month'];
    $ca = $item['CA'];
    $valueI = $item['Class I Certificate'];
    $valueII = $item['Class II Certificate'];
    $valueIII = $item['Class III Certificate'];
    $valueE = $item['eSign Certificate'];
        if (($selected_ca == 'All' || $ca == $selected_ca) && $year == $selected_year && $month == $selected_month)  {
        array_push($labels, $ca);
        array_push($valuesI, $valueI);
        array_push($valuesII, $valueII);
        array_push($valuesIII, $valueIII);
        array_push($valuesE, $valueE);
    }
}
 
// generate the bar chart using chart.js

?>
<!DOCTYPE html>
<html>
<head>
    <title>Monthly data Bar Chart</title>
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
		h1 
    </style>
</head>
<body>
    <div style="padding: 170px;">
      <h1 align="center">Monthly data</h1>
    	<div style="width: 100%; margin: 0 auto;" align="center">
		<div style="display: flex; justify-content: center;">
        <form method="post" class="form-inline">
            <label for="ca">Select a CA:</label>
            <select id="ca" name="ca" class="form-control mr-2">
                <option value="All" <?php if ($selected_ca == 'All') echo 'selected'; ?>>All</option>
                <?php foreach ($cas as $ca) {
                    echo '<option value="' . $ca . '"';
                    if ($selected_ca == $ca) echo 'selected';
                    echo '>' . $ca . '</option>';
                }?>
            </select>

            <label for="year">Select a Year:</label>
            <select id="year" name="year" class="form-control mr-2">
                <?php foreach ($years as $year) {
                    echo '<option value="' . $year . '"';
                    if ($selected_year == $year) echo 'selected';
                    echo '>' . $year . '</option>';
                }?>
            </select>

            <label for="month">Select a Month:</label>
            <select id="month" name="month" class="form-control mr-2">
                <?php foreach ($months as $month) {
                    echo '<option value="' . $month . '"';
                    if ($selected_month == $month) echo 'selected';
                    echo '>' . $month . '</option>';
                }?>
            </select>

            <input type="submit" value="Show Data" class="btn btn-primary">
        </form>
		</div>
        <div id="noDataMessage" style="display:none">
            <p>No data available for the selected criteria.</p>
        </div>

        <canvas id="myChart"></canvas>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                            label: 'Class I Certificate',
                            data: <?php echo json_encode($valuesI); ?>,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255,99,132,1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Class II Certificate',
                            data: <?php echo json_encode($valuesII); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Class III Certificate',
                            data: <?php echo json_encode($valuesIII); ?>,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'eSign Certificate',
                            data: <?php echo json_encode($valuesE); ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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

            // Check if the chart has any data
            var isChartEmpty = myChart.data.datasets.every(function(dataset) {
                return dataset.data.every(function(value) {
                    return value === 0;
                });
            });


// Show error message if chart has no data
if (isChartEmpty) {
    document.getElementById('myChart').style.display = 'none';
    document.getElementById('noDataMessage').style.display = 'block';
} else {
    document.getElementById('myChart').style.display = 'block';
    document.getElementById('noDataMessage').style.display = 'none';
}

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