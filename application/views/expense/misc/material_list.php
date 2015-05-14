<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/mixitup/jquery.mixitup.min.js') ?>"></script>

<script>
	// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "buttonFilter".
	var buttonFilter = {
		// Declare any variables we will need as properties of the object
		$filters : null,
		$reset : null,
		groups : [],
		outputArray : [],
		outputString : '',

		// The "init" method will run on document ready and cache any jQuery objects we will need.
		init : function() {
			var self = this;
			// As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "buttonFilter" object so that we can share methods and properties between all parts of the object.

			self.$filters = $('#Filters');
			self.$reset = $('#Reset');
			self.$container = $('#materialtable');

			self.$filters.find('div.btn-group').each(function() {
				self.groups.push({
					$buttons : $(this).find('.filter'),
					active : ''
				});
			});

			self.bindHandlers();
		},

		// The "bindHandlers" method will listen for whenever a button is clicked.
		bindHandlers : function() {
			var self = this;

			// Handle filter clicks
			self.$filters.on('click', '.filter', function(e) {
				e.preventDefault();

				var $button = $(this);

				// If the button is active, remove the active class, else make active and deactivate others.
				$button.hasClass('active') ? $button.removeClass('active') : $button.addClass('active').siblings('.filter').removeClass('active');

				self.parseFilters();
			});

			// Handle reset click
			self.$reset.on('click', function(e) {
				e.preventDefault();

				self.$filters.find('.filter').removeClass('active');

				self.parseFilters();
			});
		},

		// The parseFilters method checks which filters are active in each group:
		parseFilters : function() {
			var self = this;

			// loop through each filter group and grap the active filter from each one.
			for (var i = 0, group; group = self.groups[i]; i++) {
				group.active = group.$buttons.filter('.active').attr('data-filter') || '';
			}

			self.concatenate();
		},

		// The "concatenate" method will crawl through each group, concatenating filters as desired:
		concatenate : function() {
			var self = this;

			self.outputString = '';
			// Reset output string
			for (var i = 0, group; group = self.groups[i]; i++) {
				self.outputString += group.active;
			}

			// If the output string is empty, show all rather than none:
			!self.outputString.length && (self.outputString = 'all');

			// console.log(self.outputString);
			// ^ we can check the console here to take a look at the filter string that is produced

			// Send the output string to MixItUp via the 'filter' method:
			if (self.$container.mixItUp('isLoaded')) {
				self.$container.mixItUp('filter', self.outputString);
			}
		}
	};

	$(document).ready(function() {
		buttonFilter.init();
		
		$('#materialtable').mixItUp({
			load : {
				sort : 'materialid:desc',
				filter : 'tr.mix'
			},
			layout : {
				display : 'table-row'
			},
			selectors : {
				target : 'tr.mix'
			},
			controls : {
				enable : false	// we won't be needing these
			},
			callbacks : {
				onMixEnd : function(state) {
					if (state.activeFilter == 'tr.mix') {
						$(this).addClass('table-striped');
					} else {
						$(this).removeClass('table-striped');
					}
					var rows = state.$show;
					var amount = 0;
					var totalClaim = 0;
					for(var i = 0; i< rows.size() ; i++){
						try{
							amount += parseFloat(rows[i].children[2].innerHTML);
						} catch(e){
							console.log('error');
						}
						try{
							totalClaim += parseFloat(rows[i].children[7].innerHTML);
						} catch(e){
							console.log('error');
						}
					}
					amount = amount.toFixed(2);
					totalClaim = totalClaim.toFixed(2);
					$('#amount').text(amount);
					$('#totalClaim').text(totalClaim);
				}
			}
		});
	});
</script>

<style>
	.mix {
		display: none;
	}
</style>

<div class="row">
	<div class="col-xs-12 col-md-12">
		<button class="btn btn-info" onclick="javascript:window.location='<?=site_url('expense/misc/addMaterial') ?>'">Add new misc</button>
	</div>
</div>
<br>
<div class="row" id="Filters">
	<!--button class="btn btn-default filter" data-filter="all">All</button-->
	<? if($user['user_id'] == 1):?>
	<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
	<? else:?>
	<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
	<? endif;?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Owner
			</div>
			<div class="panel-body btn-group">
				<? if($user['user_id'] == 1):?>
					<button class="btn btn-default filter" data-filter=".<?=$user['first_name'] ?>">My material</button>
					<button class="btn btn-default filter" data-filter=".Chawanat">Chawanat</button>
					<button class="btn btn-default filter" data-filter=".Choncharn">Choncharn</button>
				<? else:?>
					<button class="btn btn-default filter" data-filter=".<?=$user['first_name'] ?>">My material</button>
				<? endif;?>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-7 col-md-5 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Status
			</div>
			<div class="panel-body btn-group">
				<button class="btn btn-default filter" data-filter=".Waiting">Waiting for approve</button>
				<button class="btn btn-default filter" data-filter=".Approved">Approved</button>
				<button class="btn btn-default filter" data-filter=".Rejected">Rejected</button>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				Claimed?
			</div>
			<div class="panel-body btn-group">
				<button class="btn btn-default filter" data-filter=".Claimed">Claimed</button>
				<button class="btn btn-default filter" data-filter=".NotClaim">Not Claimed</button>
			</div>
		</div>
	</div>
	<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
		<button class="btn btn-warning" id="Reset">Clear filter</button>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12 col-md-8">
		<table class="table table-striped table-bordered table-condensed" id="materialtable">
			<thead>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Purchased Date</th>
				<th>Owner</th>
				<th>Claimed</th>
				<th>Claim Rate</th>
				<th>Claim Price</th>
				<th>Status</th>
			</thead>
			<tbody>
				<?php foreach($materials as $key => $material):?>
					<tr class="mix <?=$material['first_name']?> <?=$material['status']?> <?=($material['is_claimed']==0)?'NotClaim':'Claimed'?>" data-materialid="<?=$material['material_id'] ?>">
						<td class="text-center"><?=$material['material_id'] ?></td>
						<td>
							<!--a href="javascript:window.location='<?=site_url('expense/misc/showMaterial/') . '/' . $material['material_id'] ?>'"><?=$material['material_name'] ?></a-->
							<a href="<?=site_url('expense/misc/showMaterial/'.$material['material_id'])?>"><?=$material['material_name']?></a>
						</td>
						<td class="text-right"><?=$material['material_price'] ?></td>
						<td class="text-center"><?=$material['purchased_date'] ?></td>
						<td><?=$material['first_name'] ?></td>
						<td class="text-center"><?=($material['is_claimed'] == 0) ? 'No' : 'Yes' ?></td>
						<td class="text-right"><?=$material['claim_rate']?></td>
						<td class="text-right"><?=$material['claim_price']?></td>
						<td>
							<?php if($material['status'] == 'Approved'):?>
							<span class="label label-success">
							<?php elseif($material['status'] == 'Rejected'): ?>
							<span class="label label-danger">
							<?php else: ?>
							<span class="label label-info">
							<?php endif; ?>
								<?=$material['status'] ?>
							</span>
						</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td colspan="2" class="text-right"><h5>Amount</h5></td>
						<td class="text-right" id="amount">xxxx</td>
						<td colspan="5" class="text-right" id="totalClaim">xxxx</td>
					</tr>
			</tbody>
		</table>
	</div>
</div>