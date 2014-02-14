<div>
	<form name="newUser" action="<?php echo SITE_DIR . '/bin/login-process.php'; ?>" method="post">

		<div class="input-group form-group">
		  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		  <input type="text" name="username" class="form-control" placeholder="Username">
		</div>					

		<div class="input-group form-group">
		  <span class="input-group-addon"><i class="fa fa-key"></i></span>
		  <input type="password" name="password" class="form-control" placeholder="Password">
		</div>					

		<input name="new" id="newfeedform" class="btn btn-lg btn-success btn-block" type="submit" value="Login">

		<div class="checkbox pull-right">
	      <label>
	      	<input type="checkbox" name="remember_me" value="1" />	
              Remember Me?
          </label>
		</div>

	</form>
</div>
<div class="clearfix"></div>