<div>
	<form name="newUser" action="<?php echo SITE_DIR . '/bin/register-process.php'; ?>" method="post">

		<div class="input-group form-group">
		  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		  <input type="text" name="username" class="form-control" placeholder="Username">
		</div>					

		<div class="input-group form-group">
		  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
		  <input type="email" name="email" class="form-control" placeholder="Email">
		</div>		
					
		<div class="input-group form-group">
		  <span class="input-group-addon"><i class="fa fa-key"></i></span>
		  <input type="password" name="password" class="form-control" placeholder="Password">
		</div>					

		<div class="input-group form-group">
		  <span class="input-group-addon"><i class="fa fa-check"></i></span>
		  <input type="password" name="passwordc" class="form-control" placeholder="Confirm Password">
		</div>					

		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Register">

	</form>
</div>
<div class="clearfix"></div>