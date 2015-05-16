<div style="max-width: 390px; margin: auto; margin-top: 5px;">
	<?=form_open('authentication/authen/login')?>
		<div class="panel panel-success">
			<div class="panel-heading">Account Login</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">Email:</div>
					<div class="col-md-9">
						<input class="form-control" type="text" name="username" value="<?=set_value('username')?>" required maxlength="64" />
						<?=form_error('username','<div class="validation-error">','</div>')?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">Password:</div>
					<div class="col-md-9">
						<input class="form-control" type="password" name="password" value="<?=set_value('password')?>" required />
						<?=form_error('password','<div class="validation-error">','</div>')?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 validation-error">
						<?=isset($login_error)?$login_error:""?>
					</div>
					<div class="col-md-12">
						<button class="btn btn-success btn-block">Sign in</button>
					</div>
				</div>
				<div class="row">
					<small>
					<div class="col-md-6">
						<a href="#">Create Account</a>
					</div>
					<div class="col-md-6">
						<a href="#">Password Recovery</a>
					</div>
					</small>
				</div>
			</div>
		</div>
		<input type="hidden" id="url" name="url" value="<?=set_value('url')?>" />
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