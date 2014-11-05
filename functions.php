<?php
/*
 *	Tell DMS we are in a subfolder and start it
 */
define( 'DMS_CORE', true );
require_once( 'dms/functions.php' );


// add customization functions and hooks


add_action( 'wp_enqueue_scripts', 'pl_register_headroom' );
function pl_register_headroom() {
	
	//wp_enqueue_script( 'headroom', get_stylesheet_directory_uri() . '/js/headroom.js', array( 'jquery' ), pl_get_cache_key(), true );
	wp_enqueue_script( 'fiction-common', get_stylesheet_directory_uri() . '/js/fiction.common.js', array( 'jquery', 'headroom' ), pl_get_cache_key(), true );

}

// TYPOGRAPHY
add_action( 'wp_head', 'ff_add_typekit' );
function ff_add_typekit(){
	?>
	<script type="text/javascript" src="//use.typekit.net/mqs8qwp.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php
}

// KEY URLS
function ff_url_membership(){
	return '';
}

function ff_base_url(){
	return '';
}
