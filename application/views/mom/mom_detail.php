<?=form_open('mom/mom/saveMom', array('id'=>'saveForm','class'=>'form-horizontal','role'=>'form'))?>
	<input type="hidden" name="mom_id" value="<?=$mom['mom_id']?>" />
	<input type="hidden" name="create_by_user_id" value="<?=$mom['create_by_user_id']?>" />
	<div class="form-group">
		<label class="control-label col-md-2" for="mom_subject">Subject</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="mom_subject" id="mom_subject" value="<?=$mom['mom_subject']?>" placeholder="หัวเรื่อง" maxlength="32" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="meeting_date">Meeting Date</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control datepicker" type="text" name="meeting_date" id="meeting_date" value="<?=$mom['meeting_date']?>" placeholder="วันที่ประชุม" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="mom_content">Content</label>
		<div class="col-md-10">
			<!--<input class="form-control" type="text" name="mom_content" id="mom_content" value="<?=$mom['mom_content']?>" placeholder="บันทึกการประชุม" required />-->
			<textarea name="mom_content" id="mom_content" reuqired><?=$mom['mom_content']?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-offset-2 col-md-6">
			<input class="btn btn-primary" type="submit" name="submit" value="Save" />
			<!--button class="btn btn-primary" type="button" id="cancelBtn" onclick="javascript:window.location='<?=site_url('material/raw_material')?>';">Cancel</button-->
			<input class="btn btn-primary" type="submit" name="submit" value="Cancel" id="cancel_btn" />
		</div>
	</div>
</form>


<script>
	$(function(){
		$('#mom_content').trumbowyg();
		
		$('#cancel_btn').click(function(){
			$('input').attr('required', false);
		});
	})
</script>