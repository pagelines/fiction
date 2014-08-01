<?php
/*
 *	Tell DMS we are in a subfolder and start it
 */
define( 'DMS_CORE', true );
require_once( 'dms/functions.php' );


// add customization functions and hooks


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
