<?php require_once( 'includes/header.php' ); ?>
<?php require_once( 'includes/navigation.php' ); ?>

<div class="container"> <?php
		
	if( empty( $loggedInUser ) ) { ?>
	
		<br /><br />
		<div class="row"> <?php
			
			if( !empty( $_SESSION['errors'] ) ) { ?>
				<div class="col-xs-12"> <?php
					errorBlock( $_SESSION['errors'] ); ?>
				</div> <?php
			}
			
			if( !empty( $_SESSION['messages'] ) ) { ?>
				<div class="col-xs-12"> <?php
					messageBlock( $_SESSION['messages'] ); ?>
				</div> <?php
			} ?>
					
			<div class="col-xs-6 pull-left">
				<?php require_once( 'login-include.php' ); ?>
			</div>
			
			<div class="col-xs-6 pull-right">
				<?php require_once( 'register-include.php' ); ?>
			</div> 
			
		</div> <?php
		
		if( !empty( $_SESSION['errors'] ) ) {
			$_SESSION['errors'] = null;
		}
		
		if( !empty( $_SESSION['messages'] ) ) {
			$_SESSION['messages'] = null;
		}
		

	} else { ?>
	
		<h1>Welcome</h1>
        
    	<p>Welcome to your account page <strong><?php echo $loggedInUser->display_username; ?></strong></p>


        <p>You are a <strong><?php  $group = $loggedInUser->groupID(); echo $group['group_name']; ?></strong></p>
      
        
        <p>You joined on <?php echo date("l \\t\h\e jS Y",$loggedInUser->signupTimeStamp()); ?> </p>
        

		<p>This page doesn't really do anything special. It's up to you to create something interesting and useful based on the framework we have provided.</p>
		
        <p>Using UserPie you can build just about anything: a blog, content management system, discussion forum, social network...</p> <?php
   
    } ?>
			
<!--closing div tag for container class is in footer -->

<?php require_once( 'includes/footer.php' ); ?>