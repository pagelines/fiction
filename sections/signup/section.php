<?php
/*
	Section: Signup
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: -- 
	Class Name: PLSignup
*/


class PLSignup extends PageLinesSection {

	function section_persistent(){

		add_action( 'wp_ajax_nopriv_pl_ajax_signup_account', array( $this, 'signup_account' ) );
		add_action( 'wp_ajax_pl_ajax_signup_account', array( $this, 'signup_account' ) );

	}
	
	function signup_account(){
		
		$postdata = $_POST;
		
		$response = array(); 
		
		$email = $postdata['email'];
		
		$response['email'] = $email;
		
		// add the actual account
		
		$user_id = username_exists( $email );
		
		if ( ! $user_id && email_exists( $email ) == false ) {
			
			$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
			
			$user_id = wp_create_user( $email, $random_password, $email );
			
			wp_new_user_notification( $user_id, $random_password );
			
			if( ! is_user_logged_in() ){
				$creds = array();
				$creds['user_login'] = $email;
				$creds['user_password'] = $random_password;
				$creds['remember'] = true;

				$user = wp_signon( $creds, false );

				if ( is_wp_error( $user ) )
					$response['error'] = $user->get_error_message();
			}
			
				
			$response['result'] = 1;
			
		} else {
			
			$response['result'] = 2;
			
		}
		
		// RESPONSE
		echo json_encode(  pl_arrays_to_objects( $response ) );

		die(); // don't forget this, always returns 0 w/o
		
	}

	function section_styles(){

		wp_enqueue_script( 'signup', $this->base_url . '/signup.js', array( 'jquery' ), pl_get_cache_key(), true );

	}
	
	function section_opts(){
		$options = array(
			array(
				'type'	=> 'multi',
				'title'	=> 'Config',
				'opts'	=> array(
					array(
						'key'	=> 'text',
						'type'	=> 'text',
						'label'	=> __( 'Text', 'pagelines' ),
					),
				)
			),
			
		);

		
		

		return $options;
	}

   	function section_template( ) {

	
		echo pl_signup_center();	

	}


}