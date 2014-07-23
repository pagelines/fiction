<?php
/*
	Section: Seconds
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: What you do and why it matters in 3 seconds
	Class Name: PLSeconds
	Filter: full-width
*/


class PLSeconds extends PageLinesSection {

	// when section is used on a page
	// render this code
	function section_head(){
		?>
		<script type="text/javascript" src="//use.typekit.net/mqs8qwp.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<?php 
	}
	
	function section_styles(){

		wp_enqueue_script( 'fittext', $this->base_url . '/utils.fittext.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'seconds', $this->base_url . '/seconds.js', array( 'fittext' ), pl_get_cache_key(), true );

	}
	

   function section_template( ) {

		
		
	 ?>
	<div class="seconds-wrap">
		<div class="pl-content">
			<div class="pl-content-pad">
				<div class="seconds-text-wrap">
					<div class="seconds-text tk-din-condensed-web">First Principles Thinking, Community and Events</div>
				</div>
			</div>
		</div>
	</div>
<?php }


}