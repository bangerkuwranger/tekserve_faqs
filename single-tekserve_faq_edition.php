<?php
 
/**
 * Template Name: Tekserve FAQ Edition - Single
 * Description: Used as a page template showing the contents of a single edition of the tekserve FAQ and its related downloads.  Genesis only for now...
 */
 
//* Customize the post info function to display custom fields

//add text to the title
add_action('genesis_post_title', 'tekserve_faq_edition_title');
function tekserve_faq_edition_title() {
	$faq_edition_custom_title = 'Download ' . get_the_title();
	echo "<h1 class='entry-title'>".$faq_edition_custom_title."</h1>";
}

//enqueue script for form
add_action('genesis_meta', 'gfom_meta');
function gform_meta() {
	gravity_form_enqueue_scripts($form_id, $is_ajax);
}

//add content & DL links
add_action('genesis_after_post', 'tekserve_faq_edition_content');
function tekserve_faq_edition_content() {
	$besideform = "";
	$besideform = '<h2>Choose a Format to Download</h2>';
	if (genesis_get_custom_field('tekserve_faq_edition_pdf_url')) {
		$besideform .= '<div class="tekserve-faq-edition-pdf-link-container"><a target="_blank" href="';
		$besideform .= genesis_get_custom_field('tekserve_faq_edition_pdf_url');
		$besideform .= '"><h3 class="tekserve-faq-edition-pdf-link">PDF</h3></a></div>';
	}
// 	else { $besideform .= 'NO PDF<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_epub_url')) {
		$besideform .= '<div class="tekserve-faq-edition-epub-link-container"><a target="_blank" href="';
		$besideform .= genesis_get_custom_field('tekserve_faq_edition_epub_url');
		$besideform .= '"><h3 class="tekserve-faq-edition-epub-link">ePub</h3></a></div>';
	}
// 	else { $besideform .= 'NO ePub<br/>'; }
	if (genesis_get_custom_field('tekserve_faq_edition_mobi_url')) {
		$besideform .= '<div class="tekserve-faq-edition-mobi-link-container"><a target="_blank" href="';
		$besideform .= genesis_get_custom_field('tekserve_faq_edition_mobi_url');
		$besideform .= '"><h3 class="tekserve-faq-edition-mobi-link">MOBI</h3></a></div>';
	}
// 	else { $besideform .= 'NO MOBI<br/>'; }

	

}

//display featured image before title
add_action('genesis_before_post_title', 'tekserve_faq_edition_cover');
function tekserve_faq_edition_cover() {
	$tekserve_faq_edition_cover = get_the_post_thumbnail($post_id, '800x800');
	echo $tekserve_faq_edition_cover;
}

//Footer
add_action( 'genesis_before_footer', 'add_footer_folk' );

function add_footer_folk() {

 	$formhtml = "<div class='bgwrapper'><div class='beside-form leftside'>".$besideform."</div><div class='gravity-form-wrapper rightside'><h1 class='vendor-contact-title'>Contact Us</h1>";
	$footerfolk = "</div></div><div class='tekserve-faq-edition-folk'>".footer_folk( array( 'rotate' => 'yes' ) )."</div>";
		echo $formhtml;
	gravity_form(1, false, false, false, '', true);
	echo $footerfolk;
}

/** Remove Post Info */
remove_action( 'genesis_after_post_title', 'genesis_post_meta' );
remove_action( 'genesis_post_title', 'genesis_do_post_title' );
 
genesis();