<?php
/*
	Section: Seconds
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: What you do and why it matters in 3 seconds
	Class Name: PLSeconds
	Filter: dual-width
*/


class PLSeconds extends PageLinesSection {

	function section_persistent(){

		add_action( 'wp_ajax_nopriv_pl_ajax_add_new_account', array( $this, 'add_new_account' ) );
		add_action( 'wp_ajax_pl_ajax_add_new_account', array( $this, 'add_new_account' ) );

	}
	
	function add_new_account(){
		
		$postdata = $_POST;
		
		$response = array(); 
		
		$email = $postdata['email'];
		
		$response['email'] = $email;
		
		// add the actual account
		
		$user_id = username_exists( $email );
		
		if ( ! $user_id && email_exists( $email ) == false ) {
			
			$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
			
			$user_id = wp_create_user( $email, $random_password, $email );
			
			$response['result'] = 'Account Created';
			
		} else {
			
			$response['result'] = __('User already exists.');
			
		}
		
		
		// RESPONSE
		echo json_encode(  pl_arrays_to_objects( $response ) );

		die(); // don't forget this, always returns 0 w/o
		
	}

	// when section is used on a page
	// render this code
	function section_head(){
		
	}
	
	function section_styles(){

		wp_enqueue_script( 'fittext', $this->base_url . '/utils.fittext.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'seconds', $this->base_url . '/seconds.js', array( 'fittext' ), pl_get_cache_key(), true );

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
					array(
						'key'	=> 'text_sub',
						'type'	=> 'textarea',
						'label'	=> __( 'Text', 'pagelines' ),
					),
					array(
						'key'	=> 'text_class',
						'type'	=> 'text',
						'label'	=> __( 'Text Class', 'pagelines' ),
					),
					array(
						'key'	=> 'button_text',
						'type'	=> 'text',
						'label'	=> __( 'Button Text', 'pagelines' ),
					),
					array(
						'key'	=> 'link',
						'type'	=> 'text',
						'label'	=> __( 'Link', 'pagelines' ),
					),
				)
			),
			
		);

		
		

		return $options;
	}

   function section_template( ) {

		$text = ( $this->opt('text') ) ? $this->opt('text') : '<a href="http://fromfiction.com/understanding-first-principles/">First Principles</a> Thinking, Community, and Events';
		
		$text_sub = $this->opt('text_sub');
		
		$text_class = $this->opt('text_class') ? $this->opt('text_class') : 'tk-din-condensed-web';
		$button_text = ($this->opt('button_text')) ? $this->opt('button_text') : 'Get An Account <i class="icon icon-angle-right"></i>';
		$link = $this->opt('link');
		
	 ?>

	<div class="seconds-text-wrap">
		<h2 class="seconds-text <?php echo $text_class;?>"><?php echo $text;?></h2>
		<?php if( $text_sub ): ?><p class="sections-sub"><?php echo $text_sub; ?></p><?php endif; ?>
		<?php if( $link ): ?>
		<div class="seconds-signup">
			<a class="seconds-signup-btn btn btn-large btn-primary" href="<?php echo $link;?>" ><?php echo $button_text; ?></a>
		</div>
		<?php endif; ?>
	</div>
<?php }


}