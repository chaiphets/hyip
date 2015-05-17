<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4><b>Investment Plan</b></h4>
			</div>
			<div class="panel-body">
				<p>
				ForexDBLot offers its investors 4 investment plans. They differ from each other depending on the investment limits and risk exposure.
				The maturity period is 60 business days for all investment plans.
				At the end of the maturity period, the principal amount is returned to the investor.
				</p>
				
				<?php if($this->router->class != 'investment'):?>
				
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead><th>Plan</th><th>Weekly</th><th>Monthly</th></thead>
						<tbody class="text-center">
						<tr><td class="text-right">Basic</td>
							<td><b>Basic Weekly Partner</b><br>
								<b>3%weekly</b><br>
								for 60 business days<br>
								Deposit: $100<br>
								Principal back: Yes<br>
								Compounding: Not available<br>
								Earning: every 5 business days
							</td>
							<td><b>Basic Monthly Partner</b><br>
								<b>15%monthly</b><br>
								for 60 business days<br>
								Deposit: $100<br>
								Principal back: Yes<br>
								Compounding: Not available<br>
								Earning: every 20 business days
							</td>
						</tr>
						<tr><td class="text-right">Advance</td>
							<td><b>Advance Weekly Partner</b><br>
								<b>5%weekly</b><br>
								for 60 business days<br>
								Deposit: $1000<br>
								Principal back: Yes<br>
								Compounding: Not available<br>
								Earning: every 5 business days
							</td>
							<td><b>Advance Monthly Partner</b><br>
								<b>25%monthly</b><br>
								for 60 business days<br>
								Deposit: $1000<br>
								Principal back: Yes<br>
								Compounding: Not available<br>
								Earning: every 20 business days
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				
				<?php else:?>
					
				<b>Active Investment Plans</b>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead id="activeInvestment"><th>Plan Name</th><th>Deposit Amount</th><th>Interest</th><th>Term<br><small>(business days)</small></th></thead>
						<tbody class="text-center">
							<tr><td class="text-left">Basic Weekly Partner</td>
								<td>$100</td>
								<td>3%weekly</td>
								<td>60 days</td>
							</tr>
							<tr><td class="text-left">Basic Monthly Partner</td>
								<td>$100</td>
								<td>15%monthly</td>
								<td>60 days</td>
							</tr>
							<tr><td class="text-left">Advance Weekly Partner</td>
								<td>$1000</td>
								<td>5%weekly</td>
								<td>60 days</td>
							</tr>
							<tr><td class="text-left">Advance Monthly Partner</td>
								<td>$1000</td>
								<td>25%monthly</td>
								<td>60 days</td>
							</tr>
						</tbody>
					</table>
				</div>
				<p>
					The amount of money you earn will depend on the amount of money you invest and on the total of the company's profit at each trading day.
				</p><p>
					The more you invest - the bigger the profit you will get!
				</p><p>	
					Our system enables you to decide how much to invest by choosing the profits that you plan to receive.
				</p>
				
				
				<b>Compounding</b>
				<p>
					You can compound your interest if you desire.
				</p><p>
					Compounding allows an investor to earn an interest not only on the original investment, but also on the reinvestment of his/her daily income.
				</p><p>
					You can choose all or part of your daily income to be reinvested.
				</p><p>
					You are welcome to use our Calculator to better understand the effect of compounding.
				</p>
				
				<?php endif;?>
				
			</div>
		</div>
		
	</div>
</div>

<script>
	$(document).ready(function(){
		$('th', '#activeInvestment').addClass('success').css('vertical-align', 'middle');
	});
</script>