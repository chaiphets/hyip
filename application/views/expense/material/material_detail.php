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
	            
	        	$('#upload_file').val('');
	        	$('#upload_file').hide();
	        }
	    });
	});
	
	$('#delete_upload_btn').click(function(){
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

<?php if(isset($readonly)):?>
<script>
	$(document).ready(function(){
		$('input').attr('readonly', true);
		$('textarea').attr('readonly', true);
		$('.datepicker').datepicker('remove');
		$('input[type=submit]','#saveForm').hide();
		$('#cancelBtn').html('Close');
	});
</script>
<?php endif;?>

<?=validation_errors('<div class="row autoclose"><div class="col-xs-12 col-md-8 alert alert-danger alert-dismissible"><div class="spin"></div>&nbsp;&nbsp;', '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div></div>')?>
<?=isset($upload_error)?$upload_error:''?>

<?php if(!isset($readonly)):?>
<?=form_open('expense/material/saveMaterial', array('id'=>'saveForm','class'=>'form-horizontal','role'=>'form'))?>
<?php else:?>
<form id="saveForm" class="form-horizontal" role="form">
<?php endif;?>
	<div class="form-group">
		<label class="control-label col-md-2" for="material_name">Name</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="material_name" id="material_name" value="<?=$material['material_name']?>" placeholder="อุปกรณ์" maxlength="128" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="material_brand">Brand</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="material_brand" id="material_brand" value="<?=$material['material_brand']?>" placeholder="ยี่ห้อ" maxlength="128" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2" for="material_serial">Serial</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="material_serial" id="material_serial" value="<?=$material['material_serial']?>" placeholder="รุ่น" maxlength="128" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="purchased_date">Purchased Date</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control datepicker" type="text" name="purchased_date" id="purchased_date" value="<?=$material['purchased_date']?>" placeholder="วันที่ซื้อ" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="material_price">Price</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control decimal" type="text" name="material_price" id="material_price" value="<?=$material['material_price']?>" placeholder="ราคา" required />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="claim_rate">Claim Rate</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control decimal" type="text" name="claim_rate" id="claim_rate" value="<?=$material['claim_rate']?>" placeholder="จำนวนเงินที่เบิกได้" readonly />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="is_claimed">Claimed</label>
		<div class="col-xs-5 col-md-2">
			<input class="form-control" type="text" id="is_claimed" value="<?=($material['is_claimed']==0)?'No':'Yes'?>" placeholder="ทำการเบิกแล้ว" readonly />
			<input class="form-control" type="hidden" name="is_claimed" value="<?=$material['is_claimed']?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="first_name">Owner</label>
		<div class="col-xs-8 col-md-4">
			<input class="form-control" type="text" name="first_name" id="first_name" value="<?=$material['first_name']?>" placeholder="ผู้รับผิดชอบ" readonly />
			<input class="form-control" type="hidden" name="owner_user_id" value="<?=$material['owner_user_id']?>" />
		</div>
	</div>
	<?php if(!isset($readonly)):?>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="upload_file">Upload file</label>
		<div class="col-xs-12 col-md-4">
			<input class="form-control" type="file" id="upload_file" />
			<img id="upload_img" class="img-responsive img-thumbnail" />
			<input type="hidden" name="upload_file_name" />
			<input type="hidden" name="upload_file_data" />
		</div>
		<div class="col-xs-12 col-md-offset-2 col-md-10">
			<i class="text-warning">Please upload file before save</i>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-3 col-md-offset-2 col-md-1">
			<input class="btn btn-primary" type="submit" name="submit" value="Upload" />
		</div>
		<div class="col-xs-3 col-md-1">
			<input class="btn btn-danger" type="button" id="delete_upload_btn" value="Delete" />
		</div>
	</div>
	<?php endif;?>
	<?php if(isset($material['files']) && sizeof($material['files']) > 0):?>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="upload_file">Files table</label>
		<div class="col-xs-12 col-md-6">
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<th>File</th>
					<th>Delete</th>
				</thead>
				<tbody>
					<?php foreach ($material['files'] as $key => $file):?>
						<tr>
							<td>
								<div class="col-xs-6 col-md-6">
									<?php if(!isset($readonly)):?>
									<img src="<?=base_url('img/tmp/'.$file['file_name'])?>" class="img-responsive img-thumbnail" />
									<?=$file['file_name']?>
									<?php else:?>
									<a href="javascript:window.open('<?=base_url($file['full_path'])?>','_blank','width=720,height=540,scrollbars=yes');">
									<img src="<?=base_url($file['full_path'])?>" class="img-responsive img-thumbnail" />
									<?=$file['file_name']?></a>
									<?php endif;?>
								</div>
								<input type="hidden" name="files[][file_name]" value="<?=$file['file_name']?>" />
							</td>
							<td class="text-center">
								<?php if(!isset($readonly)):?>
									<input class="btn btn-danger" type="submit" name="submit" value="Delete" onclick="javascript:$('#delete_file_name').val('<?=$file['file_name']?>');" />
								<?php endif;?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<input type="hidden" name="delete_file" id="delete_file_name" />
		</div>
	</div>
	<?php endif;?>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2">Depreciation Table</label>
		<div class="col-xs-12 col-md-6">
			<table class="table table-striped table-bordered table-condensed">
				<thead class="text-center">
					<th class="text-center">ปีที่</th>
					<th class="text-center">อัตราเสื่อมราคาต่อปี</th>
				</thead>
				<tbody class="text-center">
					<tr>
						<td>1</td>
						<td>20%</td>
					</tr>
					<tr>
						<td>2</td>
						<td>20%</td>
					</tr>
					<tr>
						<td>3</td>
						<td>20%</td>
					</tr>
					<tr>
						<td>4</td>
						<td>20%</td>
					</tr>
					<tr>
						<td>5</td>
						<td>20%</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-2" for="memo">Memo</label>
		<div class="col-xs-12 col-md-6">
			<textarea class="form-control" name="memo" id="memo" rows="5"><?=$material['memo']?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-2 col-md-6">
			<input class="btn btn-primary" type="submit" name="submit" value="Save" />
			<!--button class="btn btn-primary" type="button" id="cancelBtn" onclick="javascript:window.location='<?=site_url('material/material')?>';">Cancel</button-->
			<input class="btn btn-primary" type="submit" name="submit" value="Cancel" id="cancel_btn" />
		</div>
	</div>
</form>

<?php if(isset($readonly)):?>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<th>Approver</th>
					<th>Status</th>
					<th>Completed Date</th>
					<th>Comment</th>
				</thead>
				<tbody>
					<?php foreach($material['tasks'] as $key => $taskList):?>
						<tr>
							<td><?=$taskList['first_name']?></td>
							<td><?=$taskList['status']?></td>
							<td><?=$taskList['completed_date']?></td>
							<td><?=$taskList['comment']?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif;?>

<?php if(isset($approveTask)):?>
	<?=form_open('task/task/completeTask', array('id'=>'approveForm','class'=>'form-horizontal','role'=>'form'))?>
		<input type="hidden" name="task_id" value="<?=$task['task_id']?>" />
		<div class="row container">
			<label class="control-label col-xs-12 col-md-1" for="comment">Comment</label>
		</div>
		<!--
		<div class="row container">
			<textarea class="col-xs-12 col-md-6" rows="5" name="comment" id="comment"></textarea>
		</div>
		-->
		<div class="form-group">
			<!--<label class="control-label col-xs-12 col-md-2" for="memo">Memo</label>-->
			<div class="col-xs-12 col-md-6">
				<textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-6 col-md-3">
				<input class="btn btn-success btn-block" type="submit" name="submit" value="Approve" />
			</div>
			<div class="col-xs-6 col-md-3">
				<input class="btn btn-danger btn-block" type="submit" name="submit" value="Reject" id="rejectBtn" />
			</div>
		</div>
	</form>
	
	<script>
		$(function(){
			$('#comment').attr('readonly', false);
		});
		$('#rejectBtn').click(function(){
			if($('#comment').val() == ''){
				alert('ใส่ comment ด้วยดิ');
				$('#comment').focus();
				return false;
			}
			return true;
		});
	</script>
<?php endif;?>