<?php

require_once( "../models/config.php" );
require_once( "../config.php" );

//Forms posted
if( !empty( $_POST ) ) {

	$errors = array();
	$messages = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
		
	if( minMaxRange( 5, 25, $username ) ) {
		$errors[] = lang( "ACCOUNT_USER_CHAR_LIMIT", array( 5, 25 ) );
		$_SESSION['errors'] = $errors;
		header( "Location: " . SITE_DIR . "/account.php" );
		die();
	}
	
	if( minMaxRange( 8, 50, $password ) && minMaxRange( 8, 50, $confirm_pass ) ) {
		$errors[] = lang( "ACCOUNT_PASS_CHAR_LIMIT", array( 8, 50 ) );
		$_SESSION['errors'] = $errors;
		header( "Location: " . SITE_DIR . "/account.php" );
		die();
	} else if( $password != $confirm_pass ) {
		$errors[] = lang( "ACCOUNT_PASS_MISMATCH" );
		$_SESSION['errors'] = $errors;
		header( "Location: " . SITE_DIR . "/account.php" );
		die();
	}
	
	if( !isValidemail( $email ) ) {
		$errors[] = lang( "ACCOUNT_INVALID_EMAIL" );
		$_SESSION['errors'] = $errors;
		header( "Location: " . SITE_DIR . "/account.php" );
		die();
	}
	
	if( count( $errors ) == 0 ) {	
		//Construct a user object
		$user = new User( $username, $password, $email );
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if( !$user->status ) {
			if( $user->username_taken ) {
				$errors[] = lang( "ACCOUNT_USERNAME_IN_USE", array( $username ) );
				$_SESSION['errors'] = $errors;
				header( "Location: " . SITE_DIR . "/account.php" );
				die();
			}
			if( $user->email_taken ) {
				$errors[] = lang( "ACCOUNT_EMAIL_IN_USE", array( $email ) );
				$_SESSION['errors'] = $errors;
				header( "Location: " . SITE_DIR . "/account.php" );
				die();
			}		
		} else {
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if( !$user->userPieAddUser() ) {
				if( $user->mail_failure ) {
					$errors[] = lang( "MAIL_ERROR" );
					$_SESSION['errors'] = $errors;
					header( "Location: " . SITE_DIR . "/account.php" );
					die();
				}
				if( $user->sql_failure ) {
					$errors[] = lang( "SQL_ERROR" );
					$_SESSION['errors'] = $errors;
					header( "Location: " . SITE_DIR . "/account.php" );
					die();
				}
			}
		}

	    if( $emailActivation ) {
	         $messages[] = lang( "ACCOUNT_REGISTRATION_COMPLETE_TYPE2" );
	    } else {
	         $messages[] = lang( "ACCOUNT_REGISTRATION_COMPLETE_TYPE1" );
	    }
	}
	  	
	//Redirect to user account page
	if( !empty( $messages ) ) {
		$_SESSION['messages'] = $messages;
	}
	header( "Location: " . SITE_DIR . "/account.php" );
	die();

} else {
	header( "Location: " . SITE_DIR . "/index.php" );
	die();
}
?>