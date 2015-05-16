<?=form_open('support')?>

<style type="text/css" media="screen">
	#support-form > div {
		margin: 5px 0 5px;
	}
</style>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Support Form</b></div>
			<div class="panel-body" id="support-form">
				<div class="col-xs-12 col-sm-3 col-md-3">Your Name:</div>
				<div class="col-xs-12 col-sm-8 col-md-8"><input class="form-control" type="text" /></div>
				<div class="col-xs-12 col-sm-3 col-md-3">Your Email:</div>
				<div class="col-xs-12 col-sm-8 col-md-8"><input class="form-control" type="text" /></div>
				<div class="col-xs-12 col-sm-3 col-md-3">Message:</div>
				<div class="col-xs-12 col-sm-8 col-md-8">
					<textarea class="form-control" rows="5"></textarea>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3"></div>
				<div class="col-xs-12 col-sm-8 col-md-8">
					<button class="btn btn-primary">Send</button>
				</div>
			</div>
		</div>
	</div>
</div>

</form>