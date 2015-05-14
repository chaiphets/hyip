<style>
	.validation-error{
		color: #C84C64;
	}
</style>
<div style="max-width: 330px;margin: auto;">
	<?=form_open('authentication/register/saveRegister')?>
		<input type="hidden" name="first_name" value="<?=$user['first_name']?>" />
		<input type="hidden" name="user_key" value="<?=$user['user_key']?>" />
		<h2>Register</h2>
		<p>Welcome <?=$user['first_name']?>, please input your information</p>
		<input type="text" name="username" class="form-control" placeholder="username" value="<?=set_value('username')?>" required maxlength="32" />
		<?=form_error('username','<div class="validation-error">','</div>')?>
		<input type="password" name="password" class="form-control" placeholder="password" value="<?=set_value('password')?>" required />
		<?=form_error('password','<div class="validation-error">','</div>')?>
		<input type="password" name="rePassword" class="form-control" placeholder="re-password" value="<?=set_value('rePassword')?>" required />
		<?=form_error('rePassword','<div class="validation-error">','</div>')?>
		<br>
		<input type="submit" id="submitBtn" class="btn btn-lg btn-primary btn-block" value="Register" />
	</form>
</div>