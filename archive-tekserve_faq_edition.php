<?php
 
/**
 * Template Name: Tekserve FAQ Edition - Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */
 
 //both this and the single template need correct footer placement; otherwise operational
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop


 
function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<div class="entry-content">' . get_the_content() ;
 
	$args = array(
		'post_type' => 'tekserve_faq_edition', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '40',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
// 	var_dump($loop);
	$opening_tags = '<div class="wpb_row">
		<div class="vc_span12 wpb_column column_container" style="min-height: 0px;">
			<div class="wpb_wrapper">
								<ul class="wpb_thumbnails wpb_thumbnails-fluid vc_clearfix isotope" data-layout-mode="fitRows" style="position: relative; overflow: hidden;">';

	if( $loop->have_posts() ):
		$post_html = '';		
		while( $loop->have_posts() ): $loop->the_post(); global $post;
 

		$downloads = "";
		$downloads = '<h3 style="font-size: 16px;">Choose a Format to Download</h3>';
	if (genesis_get_custom_field('tekserve_faq_edition_pdf_url')) {
		$downloads .= '<div class="tekserve-faq-edition-pdf-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_pdf_url');
		$downloads .= '"><h4 class="tekserve-faq-edition-pdf-link" style="font-size:16px;">PDF</h4></a></div>';
	}
// 	else { $downloads .= 'NO PDF<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_epub_url')) {
		$downloads .= '<div class="tekserve-faq-edition-epub-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_epub_url');
		$downloads .= '"><h4 class="tekserve-faq-edition-epub-link" style="font-size:16px;">ePub</h4></a></div>';
	}
// 	else { $downloads .= 'NO ePub<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_mobi_url')) {
		$downloads .= '<div class="tekserve-faq-edition-mobi-link-container"><a target="_blank" href="';
		$downloads .= genesis_get_custom_field('tekserve_faq_edition_mobi_url');
		$downloads .= '"><h4 class="tekserve-faq-edition-mobi-link" style="font-size:16px;">MOBI</h4></a></div>';
	}
// 	else { $downloads .= 'NO MOBI<br/>'; }
			$post_html .= '<li class="isotope-item vc_span4 grid-cat-2040">';
			$post_html .= '<h2 class="post-title" style="font-size: 24px;">' . get_the_title() . '</h2>';
			$post_html .= '<div class="post-thumb">'. get_the_post_thumbnail( $id, array(150,150) ).'</div>';
			$post_html .= '<div class="entry-content" style="margin-top:20px;line-height:20px;"><p>' . $downloads . '</p></div>';
			$post_html .= '</li>';
		
		endwhile;
		
	endif;
	echo $opening_tags;
	echo $post_html;
	echo '		</ul>
			</div>
		</div></div>';
	// Outro Text (hard coded)
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';
}

//Footer
add_action( 'genesis_before_footer', 'add_footer_folk' );

function add_footer_folk() {
	$footerfolk = "<div class='tekserve-faq-edition-folk'>".footer_folk( array( 'rotate' => 'yes' ) )."</div>";
	echo $footerfolk;
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
remove_action('genesis_post_title', 'genesis_do_post_title');

 
genesis();