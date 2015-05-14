<div class="row">
	<div class="col-xs-12 col-sm-10 col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<b><?=$momDetail['mom_subject']?>&nbsp;&nbsp;&nbsp;[<?=$momDetail['meeting_date']?>]</b>
					<button class="btn btn-default edit_mom" style="float: right;" mom_id="<?=$momDetail['mom_id']?>">
						<span class="glyphicon glyphicon-pencil"></span>
					</button>
				</h3>
			</div>
			<div class="panel-body">
				<?=$momDetail['mom_content']?>
			</div>
		</div>
	</div>
</div>