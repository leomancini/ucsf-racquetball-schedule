function check_available_times(date) {
	$(".resource-availability").each(function() {
		var card_div = $(this).parent().parent().parent(".content").parent(".card");
		var content_div = $(this).parent().parent().parent(".content");
		var resource_div = $(this);
		var info_div = $(this).parent().parent(".info");
		var day_div = $(this).parent(".day");
		var resource = resource_div.attr("data-resource-id");
		var date = resource_div.attr("data-date");
		var filter = resource_div.attr("data-filter");
		
		$.get("resources/helpers/get_availability.php", { resource: resource, date: date, filter: filter }, function(data) {
			if(data) {
				if(filter != "") {
					window.load_status[resource+"-"+filter]++;
				} else {
					window.load_status[resource]++;
				}
			}
			var times = jQuery.parseJSON(data);
			if(times.length > 0) {
				resource_div.children(".available-slots").empty();
				day_div.show();
				$.each(times, function(key, time) {
					resource_div.children(".available-slots").append("<div class='time-slot'>"+time+"</div>");
				});
			}
			if(filter != "") {
				if(window.load_status[resource+"-"+filter] == 2) {
					content_div.children(".loading").hide();
					info_div.show();
				}
			} else {
				if(window.load_status[resource] == 2) {
					content_div.children(".loading").hide();
					info_div.show();
				}
			}
			
		});
	});
}

$(document).ready(function() {
	window.load_status = { "mission-bay-racquetball-suggestions": 0, "parnassus-racquetball-suggestions": 0, "mission-bay-racquetball": 0, "parnassus-racquetball": 0};
	
	check_available_times();
	
	$("#filter a").click(function() {
		$("#filter a").removeClass("selected");
		$(this).addClass("selected");
		
		selected_filter = $(this).attr("data-filter");
		
		$(".filter-content#"+selected_filter).show();
		$(".filter-content").not("#"+selected_filter).hide();
	});
	
});

/*

function get_date_from_picker(date) {
	year = date.substring(0, 4);
	month = date.substring(5, 7);
	day = date.substring(8, 10);
	
	date = month+"/"+day+"/"+year;
	return date;
}


$("#date").on("touch click change", function() {
	date = get_date_from_picker($(this).val());
	if(date !== window.selected_date) {
		check_available_times(date);
	}
});

date = get_date_from_picker($("#date").val());

window.selected_date = date;

*/