<table class="table">
	<tr><td>Investment Plan:</td>
		<td><select id="investment-plan" style="width: 100%;">
				<option value="1">Basic Weekly Partner</option>
				<option value="2">Basic Monthly Partner</option>
				<option value="3">Advance Weekly Partner</option>
				<option value="4">Advance Monthly Partner</option>
			</select>
		</td>
	</tr>
	<tr><td>Amount of principal:</td>
		<td><select id="basic-plan">
				<option value="100">$100</option>
				<option value="200">$200</option>
				<option value="300">$300</option>
				<option value="400">$400</option>
				<option value="500">$500</option>
				<option value="600">$600</option>
				<option value="700">$700</option>
				<option value="800">$800</option>
				<option value="900">$900</option>
				<option value="1000">$1,000</option>
			</select>
			<select id="advance-plan" style="display: none;">
				<option value="1000">$1,000</option>
				<option value="2000">$2,000</option>
				<option value="3000">$3,000</option>
				<option value="4000">$4,000</option>
				<option value="5000">$5,000</option>
				<option value="6000">$6,000</option>
				<option value="7000">$7,000</option>
				<option value="8000">$8,000</option>
				<option value="9000">$9,000</option>
				<option value="10000">$10,000</option>
			</select>
		</td>
	</tr>
	<tr><td>Interest rate:</td><td><div id="interest-rate">3% weekly</div></td></tr>
	<tr><td>Daily average interest rate:</td><td><div id="interest-rate-daily">0.6% business daily</div></td></tr>
	<tr><td>Term:</td><td>60 business days</td></tr>
	<tr><td>Profit:</td><td><div id="profit">$3 weekly</div></td></tr>
	<tr><td>Daily average profit:</td><td><div id="profit-daily">$0.6 business daily</div></td></tr>
	<tr><td>Total profit:<br><small>(after 60 business days)</small></td><td><div id="total-profit">$36</div></td></tr>
	<tr><td><b>Total return:<br><small>(Profit+Principal)</small></b></td><td><b><div id="total-return">$136</div></b></td></tr>
</table>

<script>
	function calculate(){
		var plan = $('#investment-plan').val();
		var fund = 0;
		var profit = 0;
		var totalProfit = 0;
		var totalReturn = 0;
		if(plan < 3){
			fund = $('#basic-plan').val();
			if(plan == 1){
				profit = fund * 0.03;
				totalProfit = profit * 12;
				totalReturn = parseInt(totalProfit) + parseInt(fund);
				$('#profit').text('$'+profit+' weekly');
				$('#profit-daily').text('$'+profit/5+' business daily');
				$('#total-profit').text('$'+totalProfit);
				$('#total-return').text('$'+totalReturn);
			} else {
				profit = fund * 0.15;
				totalProfit = profit * 3;
				totalReturn = parseInt(totalProfit) + parseInt(fund);
				$('#profit').text('$'+profit+' monthly');
				$('#profit-daily').text('$'+profit/20+' business daily');
				$('#total-profit').text('$'+totalProfit);
				$('#total-return').text('$'+totalReturn);
			}
		} else {
			fund = $('#advance-plan').val();
			if(plan == 3){
				profit = fund * 0.05;
				totalProfit = profit * 12;
				totalReturn = parseInt(totalProfit) + parseInt(fund);
				$('#profit').text('$'+profit+' weekly');
				$('#profit-daily').text('$'+profit/5+' business daily');
				$('#total-profit').text('$'+totalProfit);
				$('#total-return').text('$'+totalReturn);
			} else {
				profit = fund * 0.25;
				totalProfit = profit * 3;
				totalReturn = parseInt(totalProfit) + parseInt(fund);
				$('#profit').text('$'+profit+' monthly');
				$('#profit-daily').text('$'+profit/20+' business daily');
				$('#total-profit').text('$'+totalProfit);
				$('#total-return').text('$'+totalReturn);
			}
		}
	}
	$('#investment-plan').change(function(){
		if($(this).val() < 3){
			$('#basic-plan').show();
			$('#advance-plan').hide();
			$('#basic-plan').val(100);
			if($(this).val() == 1){
				$('#interest-rate').text('3% weekly');
				$('#interest-rate-daily').text('0.6% business daily');
			} else {
				$('#interest-rate').text('15% monthly');
				$('#interest-rate-daily').text('0.75% business daily');
			}
		} else {
			$('#basic-plan').hide();
			$('#advance-plan').show();
			$('#advance-plan').val(1000);
			if($(this).val() == 3){
				$('#interest-rate').text('5% weekly');
				$('#interest-rate-daily').text('1% business daily');
			} else {
				$('#interest-rate').text('25% monthly');
				$('#interest-rate-daily').text('1.25% business daily');
			}
		}
	});
	$('select').change(function(){
		calculate();
	});
</script>