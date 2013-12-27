<div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Register</h4>
      </div>
      <div class="modal-body">
        <form class="form-signin">

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

    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Register">

        </form>
      </div>
      <div class="modal-footer">
        Already have an account?
        <a href="#" data-toggle="modal" data-target="#LoginModal" data-dismiss="modal" class="btn btn-primary">Login</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
