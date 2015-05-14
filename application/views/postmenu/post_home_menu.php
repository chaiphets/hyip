<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/resize/jquery.exif.js')?>"></script>
<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/resize/jquery.canvasResize.js')?>"></script>
<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/resize/canvasResize.js')?>"></script>

<script>
$(document).ready(function(){
	$('#upload_file').change(function(e) {
	    var file = e.target.files[0];
	    $.canvasResize(file, {
	        width: 720,
	        height: 0,
	        crop: false,
	        quality: 80,
	        //rotate: 90,
	        callback: function(data, width, height) {
	            $('#upload_img').attr('src', data);
	            $('input[name=upload_file_name]').val($('#upload_file').val());
	            $('input[name=upload_file_data]').val(data);
	            
	        	// $('#upload_file').val('');
	        	$('#upload_file').hide();
	        }
	    });
	});
	
	$('#delete_upload_btn').click(function(){
		$('#upload_file').val('');
		$('#upload_img').attr('src', '');
		$('input[name=upload_file_name]').val('');
		$('input[name=upload_file_data]').val('');
		
		$('#upload_file').show();
	});
	
	$('#cancel_btn').click(function(){
		$('input').attr('required', false);
	});
});
</script>

<?=form_open('postmenu/postmenu/savePostMenu', array('id'=>'saveForm','class'=>'form-horizontal','role'=>'form'))?>
	<div class="form-group">
		<label class="control-label col-md-2" for="upload_file">Upload</label>
		<div class="col-md-6">
			<input class="form-control" type="file" id="upload_file" required />
			<img id="upload_img" class="img-responsive img-thumbnail" />
			<input type="hidden" name="upload_file_name" />
			<input type="hidden" name="upload_file_data" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-3 col-md-offset-2 col-md-1">
			<input class="btn btn-danger" type="button" id="delete_upload_btn" value="Delete" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="caption">Caption</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="caption" id="caption" value="<?=$menu['caption']?>" placeholder="caption" maxlength="64" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="date">Date</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control datepicker" type="text" name="date" id="date" value="<?=$menu['date']?>" placeholder="วันที่" required />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-2 col-md-6">
			<input class="btn btn-primary" type="submit" name="submit" value="Save" />
			<button class="btn btn-primary" type="button" id="cancelBtn" onclick="javascript:window.location='<?=site_url()?>';">Cancel</button>
		</div>
	</div>
</form>