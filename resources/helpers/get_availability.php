<?php
	date_default_timezone_set("America/Los_Angeles");

	$url = "https://west-a-60ols.csi-cloudapp.net/ucsf/Library/OlsService.asmx/GetSchedulerResourceAvailability";   
	
	$resource_dictionary = Array(
		"mission-bay-racquetball" => "88",
		"mission-bay-squash-1" => "86",
		"mission-bay-squash-2" => "87",
		"parnassus-racquetball" => "80",
		"parnassus-squash" => "78"
	);

	$resource_id = $resource_dictionary[$_GET['resource']];
	
	$selected_date = $_GET['date'];
	$filter = $_GET['filter'];
	
	$url_variables = '{"siteId":"473","resourceIds":["'.$resource_id.'"],"selectedDate":"'.$selected_date.'"}';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $url_variables);

	$json_response = curl_exec($curl);
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	curl_close($curl);
	
	$data = json_decode($json_response, true);
	$available_slots = Array();
	
	foreach($data["d"]["Value"][0]["Availability"] as $slot) {
		// echo $slot["TimeId"] + 360 . " –– ";
		// if($slot["IsAvailable"] == 0) { echo "booked"; }
		/*
		// draw calendar
		if($slot["TimeId"] >= 360 && $slot["TimeId"] < 1320) {
			echo "<div id='".$slot["TimeId"]."' style='width: 500px; height: 0.5px; display: inline-block; overflow: visible; ";
			if($slot["IsAvailable"] == 0) { echo " background: red;"; } else { echo " background: white;"; }
			echo "'>";
			if($slot["TimeId"] % 60 == 0) {
				echo ($slot["TimeId"] / 60) - 12;
			}
			echo "</div>";
			echo "<br>";
		}
		*/
		
		if($slot["TimeId"] >= 360 && $slot["TimeId"] < 1320) {
			if($slot["IsAvailable"] == 1) {
				$available_slots[$slot["TimeId"]/60] = 1; 
			}
		}
	}
	
	$next_available_slots = Array();
	
	foreach($available_slots as $time => $availability) {
		$current_hour = date('H');
		$available_hour = $time;
		
		$current_date = date("m/d/Y");
		
		if($current_date == $selected_date) {
			// if selected date is today, only show available slots in the future 
			
			// if there is a filter, show only times that match the filter
			if($filter == "suggestions") {
				// if selected date is a weekend, use different suggestion criteria for filter
				if(date('w', strtotime($selected_date)) == 0 || date('w', strtotime($selected_date)) == 6) {
					if(intval($available_hour) >= 10 && intval($available_hour) <= 20) {
						if(intval($available_hour) > intval($current_hour)) {
							$next_available_slots[] = date('ga', strtotime("$time:00"));
						}
					}
				} else {
					if(intval($available_hour) >= 17 && intval($available_hour) <= 20) {
						if(intval($available_hour) > intval($current_hour)) {
							$next_available_slots[] = date('ga', strtotime("$time:00"));
						}
					}
				}
			} else {	
				if(intval($available_hour) > intval($current_hour)) {
					$next_available_slots[] = date('ga', strtotime("$time:00"));
				}
			}
		} else {
			// if selected date is NOT today, show all available slots
			
			// if there is a filter, show only times that match the filter
			if($filter == "suggestions") {
				// if selected date is a weekend, use different suggestion criteria for filter
				if(date('w', strtotime($selected_date)) == 0 || date('w', strtotime($selected_date)) == 6) {
					if(intval($available_hour) >= 10 && intval($available_hour) <= 20) {
						$next_available_slots[] = date('ga', strtotime("$time:00"));
					}
				} else {
					if(intval($available_hour) >= 17 && intval($available_hour) <= 20) {
						$next_available_slots[] = date('ga', strtotime("$time:00"));
					}
				}
			} else {
				$next_available_slots[] = date('ga', strtotime("$time:00"));
			}
		}
	}
	
	echo json_encode($next_available_slots);
?>