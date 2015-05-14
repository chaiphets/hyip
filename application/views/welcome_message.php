<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/mixitup/jquery.mixitup.min.js')?>"></script>

<script>
	$(document).ready(function(){
		$('#home').mixItUp({
			load: {
				sort: 'postingid:desc'
			}
		});
	});
</script>

<style>
	.mix{
		display: none;
	}
</style>

<div class="row hidden">
	<div class="col-md-12">
		Chawanat : <?=crypt('Chawanat','fastgood')?>
		<br>
		Choncharn : <?=crypt('Choncharn','fastgood')?>
		<br>
		Chaiphet : <?=crypt('Chaiphet','fastgood')?>
	</div>
</div>
<div class="row hidden">
	<div class="col-xs-12 col-md-4">
		<?=now();?><br>
		<?=local_to_gmt(now());?><br>
		<?=date('Y-m-d H:i:s', local_to_gmt(now()));?><br>
	</div>
</div>
<div class="row">
	<h3 class="col-xs-12 col-md-12" style="margin-top: 0px;">เห็นแล้วหิว</h3>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				Who post
			</div>
			<div class="panel-body btn-group">
				<button class="btn btn-default filter" data-filter="all">All</button>
				<button class="btn btn-default filter" data-filter=".Choncharn">Choncharn</button>
				<button class="btn btn-default filter" data-filter=".Chawanat">Chawanat</button>
				<button class="btn btn-default filter" data-filter=".Chaiphet">Chaiphet</button>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				Sort by posting date
			</div>
			<div class="panel-body btn-group">
				<button class="btn btn-default sort" data-sort="postingid:asc">ASC</button>
				<button class="btn btn-default sort" data-sort="postingid:desc">DESC</button>
			</div>
		</div>
	</div>
</div>
<!--div class="row thumbnail">
	<div class="col-xs-12 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-info btn-block filter" data-filter="all">All</button>
	</div>
	<div class="col-xs-4 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-default btn-block filter" data-filter=".Chaiphet">Chaiphet</button>
	</div>
	<div class="col-xs-4 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-default btn-block filter" data-filter=".Choncharn">Choncharn</button>
	</div>
	<div class="col-xs-4 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-default btn-block filter" data-filter=".Chawanat">Chawanat</button>
	</div>
</div>
<div class="row thumbnail">
	<div class="col-xs-12 col-md-3 hidden" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-primary btn-block sort" data-sort="random">Random</button>
	</div>
	<div class="col-xs-6 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-default btn-block sort" data-sort="postingid:asc">ASC</button>
	</div>
	<div class="col-xs-6 col-md-3" style="margin-top: 10px; margin-bottom: 10px;">
		<button class="btn btn-default btn-block sort" data-sort="postingid:desc">DESC</button>
	</div>
</div-->

<div class="row" id="home">
	<?php foreach ($postMenus as $key => $postMenu):?>
		<div class="col-xs-12 col-sm-4 col-md-3 mix <?=$postMenu['first_name']?>" style="padding: 5px;" data-postingid="<?=$postMenu['posting_id']?>">
			<div class="thumbnail">
				<img src="<?=base_url('img/home/'.$postMenu['upload_file_name'])?>" class="img-responsive" 
					style="cursor: pointer;" data-title="<?=$postMenu['first_name']?> <?=$postMenu['date']?>" data-caption="<?=$postMenu['caption']?>">
				<div class="caption" style="display: none;">
					<?=$postMenu['caption']?><br>by <?=$postMenu['first_name']?> <?=$postMenu['date']?><br>
				</div>
			</div>
		</div>
	<?php endforeach;?>
</div>

<script>
	$(function(){
		var element = document.querySelectorAll('img');
    	Intense( element );
    	
    	$('img').hover(
    		function(){
    			$(this).fadeTo(100, 0.7);
    			//$('.captions', $(this).parent()).fadeIn(100);
    		},
    		function(){
    			$(this).fadeTo(100, 1);
    			//$('.captions', $(this).parent()).fadeOut(100);
    		}
    	);
	});
</script>