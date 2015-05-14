<style>
	.validation-error{
		color: #C84C64;
	}
</style>
<div style="max-width: 330px;margin: auto;">
	<?=form_open('authentication/register/savePassword')?>
		<h2>Reset Password</h2>
		<input type="text" name="reset_password_key" class="form-control" placeholder="reset_password_key" value="<?=set_value('reset_password_key')?>" required maxlength="13" />
		<?=form_error('reset_password_key','<div class="validation-error">','</div>')?>
		<input type="password" name="password" class="form-control" placeholder="new password" value="<?=set_value('password')?>" required />
		<?=form_error('password','<div class="validation-error">','</div>')?>
		<input type="password" name="rePassword" class="form-control" placeholder="new password again" value="<?=set_value('rePassword')?>" required />
		<?=form_error('rePassword','<div class="validation-error">','</div>')?>
		<br>
		<input type="submit" id="submitBtn" class="btn btn-lg btn-primary btn-block" value="Submit" />
	</form>
</div>