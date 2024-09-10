<!doctype html>
<html lang="en">
  <head>
  	<title>Organization Data</title>
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
	<div style="padding-top: 170px; margin-left: 300px">
        <table style="width: 100%";>
	<tr>
		<td>
		<?php
		
		// Define your API key
        $apiKey = 'TRkM6YrP_XzMUpdFfvj6Xk5_yBJAseC_zj_IwY2hlVIvmeAqwWNlh26Ll1pI6T-69J_4MYIELtIeQmln3iAHYZWtpTZgv-QKm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnEKe96dRh3xlE4bf7q_tjhJ8GKC1SstGggXs59cK2bf7RxdvkRS7x8neGN3g8v9c2V_WxKqxKuErP8yfzUK9C-Hyn1Z4YyOlLg';


		// retrieve the data from the API
		$url = "https://script.googleusercontent.com/macros/echo?user_content_key=$apiKey&lib=MTxGty_92YnxQurd7Sp3In18-k_s04r_S";
		// Make the GET request and retrieve the response data
    
    $json = file_get_contents($url);
        $data = json_decode($json, true);

// echo $json;


// Generate table header
$table = '<table><thead><tr>';
foreach ($data['data'][0] as $key => $value) {
  $table .= "<th>$key</th>";
}
$table .= '</tr></thead>';

// Generate table body
$table .= '<tbody>';
foreach ($data['data'] as $row) {
  $table .= '<tr>';
  foreach ($row as $key => $value) {
    $table .= "<td>$value</td>";
  }
  $table .= '</tr>';
}
$table .= '</tbody></table>';

// Output table
echo $table;

?>



<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #007bff;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #ddd;
  }
</style>

<table>
  <thead>
    <tr>
      <th>Organization Name</th>
      <th>Services</th>
      <th>Status</th>
    </tr>
  </thead>
  
</table>
		


		
		
		
</td>
	</tr>
</table>
</div>

</br>

      </div>
	  		
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>