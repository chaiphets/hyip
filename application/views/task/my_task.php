<div class="row">
	<div class="col-xs-12 col-md-8">
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<th>Task Title</th>
				<th>Type</th>
				<th>Price</th>
				<th>Purchased Date</th>
				<th>Owner</th>
			</thead>
			<tbody>
				<?php foreach($tasks as $key => $task):?>
					<tr>
						<td>
							<a href="<?=site_url('task/task/taskDetail/'.$task['task_id'])?>">
								<?=$task['task_detail']['material_name']?>
							</a>
						</td>
						<td><?=$task['type']?></td>
						<td class="text-right"><?=$task['task_detail']['material_price']?></td>
						<td class="text-center"><?=$task['task_detail']['purchased_date']?></td>
						<td><?=$task['task_detail']['owner_user_detail']['first_name']?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
