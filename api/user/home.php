<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\Helper;
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="">
			<h3 class="ui header dividing color blue"><i class="ui home icon"></i> <?=Translator::translate("home")?></h3>
		</div>
		<div class="ui grid stackable">
			<div class="column six wide">
				<!-- Billing status -->
				<canvas id="billing_status" width="200" height="200"></canvas>
			</div>
			<div class="column eight wide">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var billing_status_chart = function(data, labels, color) {
		var context = document.getElementById("billing_status").getContext("2d");
		var chart = new Chart(context, {
			type: "doughnut",
		    data: {
		    	datasets: [
		    		{
		    			data: data,
		    			backgroundColor: color,
		    		}
		    	],
		    	labels: labels,
		    },
		});
		return chart;
	};
	var data = {};
	send_request("POST", "json", data, "<?=Helper::url("api/charts/billing_status.php")?>", function(res) {
		billing_status_chart(res.data, res.labels, res.color);
	});
</script>