<?php
 
/**
 * Template Name: Tekserve FAQ Edition - Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */
 
 //lets rebuild the loop from scratch. The example ain't working. I know why; just too tired.
 
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
 
function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;
 
	$args = array(
		'post_type' => 'testimonials', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '40',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
 

		$downloads = "";
		$downloads = '<h2>Choose a Format to Download</h2>';
	if (genesis_get_custom_field('tekserve_faq_edition_pdf_url')) {
		$downloads .= '<div class="tekserve-faq-edition-pdf-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_pdf_url');
		$downloads .= '"><h3 class="tekserve-faq-edition-pdf-link">PDF</h3></a></div>';
	}
// 	else { $downloads .= 'NO PDF<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_epub_url')) {
		$downloads .= '<div class="tekserve-faq-edition-epub-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_epub_url');
		$downloads .= '"><h3 class="tekserve-faq-edition-epub-link">ePub</h3></a></div>';
	}
// 	else { $downloads .= 'NO ePub<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_mobi_url')) {
		$downloads .= '<div class="tekserve-faq-edition-mobi-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_mobi_url');
		$downloads .= '"><h3 class="tekserve-faq-edition-mobi-link">MOBI</h3></a></div>';
	}
// 	else { $downloads .= 'NO MOBI<br/>'; }
			echo '<div class="one-fourth first">';
			echo '<div class="quote-obtuse"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
			echo '<div style="margin-top:20px;line-height:20px;text-align:right;">' . $downloads . '</div>';
			echo '</div>';	
			echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
			echo '<h3>' . get_the_title() . '</h3>';
			echo '</div>';
		echo '</div>';
		
		endwhile;
		
	endif;
	
	// Outro Text (hard coded)
	echo '<div class="call-to-action">Want me to make your next web project easier? <a href="http://www.carriedils.com/contact">Let\'s Talk</a></div>';
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();