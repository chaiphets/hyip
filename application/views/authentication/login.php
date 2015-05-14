<div style="max-width: 330px;margin: auto;">
	<?=form_open('authentication/authen/login')?>
		<h2>Sign in</h2>
		<input type="text" name="username" class="form-control" placeholder="username" value="<?=set_value('username')?>" required maxlength="32" />
		<?=form_error('username','<div class="validation-error">','</div>')?>
		<input type="password" name="password" class="form-control" placeholder="password" value="<?=set_value('password')?>" required />
		<?=form_error('password','<div class="validation-error">','</div>')?>
		<div class="validation-error">
			<?=isset($login_error)?$login_error:""?>
		</div>
		<br>
		<input type="hidden" id="url" name="url" value="<?=set_value('url')?>" />
		<input type="submit" id="submitBtn" class="btn btn-lg btn-primary btn-block" value="Sign In" />
	</form>
</div>

<script>
	function getUrlVars(){
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}
	
	$(document).ready(function(){
		if($('#url').val() == ''){
			$('#url').val(getUrlVars()['url']);
		}
	});
</script>