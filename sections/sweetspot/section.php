<?php
/*
	Section: SweetSpot
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: 
	Class Name: PLSweetSpot
*/


class PLSweetSpot extends PageLinesSection {

	function section_styles(){

	}
	

	function section_opts(){
		$options = array(
			
			
		);

		
		

		return $options;
	}
	



   function section_template( ) {
	
		// optimize readability
		// 		- good line length - 50 to 60 chars per line
		// 		- good line height - line spacing
		// image & context focused 
		//	use Medium as inpiration
		// 	maybe social features
		//	
		
		
	 ?>
	
		<div class="sweetspot-wrap">
			<?php
				
				if( have_posts() ): while ( have_posts() ) : the_post(); // start loop
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'pl-border' ); ?>>
						<header class="entry-header">
							<?php

								the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

							?>
							<div class="the-excerpt"><?php echo custom_trim_excerpt( get_the_excerpt(), 20 ) ; ?></div>
						</header><!-- .entry-header -->
					</article>
					<?php
					
				endwhile; endif; // end loop
					
				
			
			?>
		</div>
	
<?php }


}