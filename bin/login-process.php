<?php

require_once( "../models/config.php" );
require_once( "../config.php" );

//Form has been posted
if( !empty( $_POST ) ) {
	$errors = array();
	$username = trim( $_POST["username"] );
	$password = trim( $_POST["password"] );
	$remember_choice = !empty( $_POST["remember_me"] ) ? trim( $_POST["remember_me"] ) : 0;

	//Perform some validation
	//Feel free to edit / change as required
	
	if( $username == "" ) {
		$errors[] = lang( "ACCOUNT_SPECIFY_USERNAME" );
	}
	
	if( $password == "" ) {
		$errors[] = lang( "ACCOUNT_SPECIFY_PASSWORD" );
	}
			
	//End data validation
	if( count( $errors ) == 0 ) {
		//A security note here, never tell the user which credential was incorrect
		if( !usernameExists( $username ) ) {
			$errors[] = lang( "ACCOUNT_USER_OR_PASS_INVALID" );
		} else {
			$userdetails = fetchUserDetails( $username );

			//See if the user's account is active
			if( $userdetails["active"] == 0 ) {
				$errors[] = lang( "ACCOUNT_INACTIVE" );
				$_SESSION['errors'] = $errors;
				header( "Location: " . SITE_DIR . "/account.php" );
				die();
			} else {
				//Hash the password and use the salt from the database to compare the password
				$entered_pass = generateHash( $password, $userdetails["password"] );

				if( $entered_pass != $userdetails["password"] ) {
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang( "ACCOUNT_USER_OR_PASS_INVALID" );
					$_SESSION['errors'] = $errors;
					header( "Location: " . SITE_DIR . "/account.php" );
					die();
				} else {
					//passwords match! we're good to go
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["user_id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->display_username = $userdetails["username"];
					$loggedInUser->clean_username = $userdetails["username_clean"];
					$loggedInUser->remember_me = $remember_choice;
					$loggedInUser->remember_me_sessid = generateHash( uniqid( rand(), true ) );
										
					//Update last sign in
					$loggedInUser->updatelast_sign_in();
	
					if( $loggedInUser->remember_me == 0 ) {
						$_SESSION["userPieUser"] = $loggedInUser;
					} else if( $loggedInUser->remember_me == 1) {
						$db->sql_query( "INSERT INTO ".$db_table_prefix."sessions VALUES('".time()."', '".serialize( $loggedInUser )."', '".$loggedInUser->remember_me_sessid."')" );
						setcookie( "userPieUser", $loggedInUser->remember_me_sessid, time()+parseLength( $remember_me_length ) );
					}
					
					//Redirect to user account page
					header( "Location: " . SITE_DIR . "/account.php" );
					die();
				}
			}
		}
	} else {
		$_SESSION['errors'] = $errors;
		header( "Location: " . SITE_DIR . "/account.php" );
		die();
	}
} else {
	header( "Location: " . SITE_DIR . "/index.php" );
	die();	
}
?>