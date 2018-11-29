<?php
	date_default_timezone_set("America/Los_Angeles");
	
	$phone_number = Array(
		"mission-bay" => "415-514-4545",
		"parnassus" => "415-476-1115"
	);
	
	$loading_spinner = '<div class="spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
?>
<!DOCTYPE HTML>
<html>

	<head>
		<title>Raquetball Court Times</title>
		<link rel="stylesheet/less" href="resources/css/style.less">
		<script src="resources/js/lib/less.js"></script>
		<script src="resources/js/lib/jquery.js"></script>
		<script src="resources/js/main.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="resources/images/ios-icon.png?m=1415832492" />
	</head>
	<body ontouchstart="">
		
		<div id="header-icon">
			<img src="resources/images/racquetball.png">
		</div>
		
		<div id="filter-container">
			<div id="filter">
				<a data-filter="suggestions" class="selected">Suggestions</a><a data-filter="all-times">All Times</a>
			</div>
		</div>
		
		<div id="cards">
			<div class="filter-content" id="suggestions">
			
				<div class="card">
					<div class="header">
						<h1>Mission Bay</h1>
						<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="call-button"><img src="resources/images/call.png"><label>Call</label></a>
					</div>
					<div class="content" data-resource="mission-bay-racquetball-suggestions">
						<div class="loading"><?php echo $loading_spinner; ?></div>
						<div class="info">
							<div class="day">
								<h3>Today</h3>
								<div class="resource-availability"
										data-resource-id="mission-bay-racquetball"
										data-date="<?php echo date("m/d/Y"); ?>"
										data-filter="suggestions">
									<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="available-slots"></a>
								</div>
							</div>

							<div class="day">
								<h3>Tomorrow</h3>
								<div class="resource-availability"
										data-resource-id="mission-bay-racquetball"
										data-date="<?php echo date("m/d/Y", strtotime("+1 day")); ?>"
										data-filter="suggestions">
									<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="available-slots"></a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="header">
						<h1>Parnassus</h1>
						<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="call-button"><img src="resources/images/call.png"><label>Call</label></a>
					</div>
					<div class="content" data-resource="parnassus-racquetball-suggestions">
						<div class="loading"><?php echo $loading_spinner; ?></div>
						<div class="info">
							<div class="day">
								<h3>Today</h3>
								<div class="resource-availability"
										data-resource-id="parnassus-racquetball"
										data-date="<?php echo date("m/d/Y"); ?>"
										data-filter="suggestions">
									<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="available-slots"></a>
								</div>
							</div>

							<div class="day">
								<h3>Tomorrow</h3>
								<div class="resource-availability"
										data-resource-id="parnassus-racquetball"
										data-date="<?php echo date("m/d/Y", strtotime("+1 day")); ?>"
										data-filter="suggestions">
									<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="available-slots"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		
			<div class="filter-content" id="all-times">

				<div class="card">
					<div class="header">
						<h1>Mission Bay</h1>
						<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="call-button"><img src="resources/images/call.png"><label>Call</label></a>
					</div>
					<div class="content" data-resource="mission-bay-racquetball">
						<div class="loading"><?php echo $loading_spinner; ?></div>
						<div class="info">
							<div class="day">
								<h3>Today</h3>
								<div class="resource-availability"
										data-resource-id="mission-bay-racquetball"
										data-date="<?php echo date("m/d/Y"); ?>"
										data-filter="">
									<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="available-slots"></a>
								</div>
							</div>

							<div class="day">
								<h3>Tomorrow</h3>
								<div class="resource-availability"
										data-resource-id="mission-bay-racquetball"
										data-date="<?php echo date("m/d/Y", strtotime("+1 day")); ?>"
										data-filter="">
									<a href="tel:<?php echo $phone_number["mission-bay"]; ?>" class="available-slots"></a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="header">
						<h1>Parnassus</h1>
						<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="call-button"><img src="resources/images/call.png"><label>Call</label></a>
					</div>
					<div class="content" data-resource="parnassus-racquetball">
						<div class="loading"><?php echo $loading_spinner; ?></div>
						<div class="info">
							<div class="day">
								<h3>Today</h3>
								<div class="resource-availability"
										data-resource-id="parnassus-racquetball"
										data-date="<?php echo date("m/d/Y"); ?>"
										data-filter="">
									<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="available-slots"></a>
								</div>
							</div>

							<div class="day">
								<h3>Tomorrow</h3>
								<div class="resource-availability"
										data-resource-id="parnassus-racquetball"
										data-date="<?php echo date("m/d/Y", strtotime("+1 day")); ?>"
										data-filter="">
									<a href="tel:<?php echo $phone_number["parnassus"]; ?>" class="available-slots"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>

		<div id="background"></div>

	</body>
</html>