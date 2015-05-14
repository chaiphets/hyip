<div class="row">
	<div class="col-xs-12 col-md-12">
		<button class="btn btn-info" onclick="javascript:window.location='<?=site_url('mom/mom/addMom')?>'">Add new minute of meeting</button>
	</div>
</div>
<br>

<?php foreach ($momList as $key => $momDetail):?>
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
<?php endforeach;?>

<ul id="pagination"class="pagination-sm"></ul>

<script>
	$(function(){
		$('#pagination').twbsPagination({
			startPage: <?=$currentPage?>,
	        totalPages: <?=$totalPage?>,
	        visiblePages: 7,
	        // href: '?page={{number}}',
	        onPageClick: function (event, page) {
	            window.location = '<?=site_url('mom/mom?')?>page='+page;
	        }
	    });
	    
	    $('.edit_mom').click(function(){
	    	window.location = '<?=site_url('mom/mom/editMom')?>/'+$(this).attr('mom_id');
	    });
	});
</script>