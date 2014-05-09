<?php
/**
 * Plugin Name: Tekserve FAQs for WordPress
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Custom Taxonomies and Structures to manage searchable Data for FAQs
 * Version: 1.0
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2014 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

//add support for mobi/epub
function addUploadMimes($mimes) {
    $mimes = array_merge($mimes, array(
        'epub'	=>	'application/epub',
        'mobi'	=>	'application/mobi'
    ));
    return $mimes;
}
add_filter('upload_mimes', 'addUploadMimes');

// Register Custom Taxonomy
function create_device_taxonomy()  {
	$labels = array(
		'name'                       => _x( 'Devices', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Device', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Device', 'text_domain' ),
		'all_items'                  => __( 'All Devices', 'text_domain' ),
		'parent_item'                => __( 'Parent Device', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Device:', 'text_domain' ),
		'new_item_name'              => __( 'New Device Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Device', 'text_domain' ),
		'edit_item'                  => __( 'Edit Device', 'text_domain' ),
		'update_item'                => __( 'Update Device', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate devices with commas', 'text_domain' ),
		'search_items'               => __( 'Search devices', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove devices', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previously used devices', 'text_domain' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);

	register_taxonomy( 'device', 'post', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_device_taxonomy', 0 );


// Register Custom Taxonomy
function create_os_taxonomy()  {
	$labels = array(
		'name'                       => _x( 'OSs', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'OS', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'OS', 'text_domain' ),
		'all_items'                  => __( 'All OSs', 'text_domain' ),
		'parent_item'                => __( 'Parent OS', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent OS:', 'text_domain' ),
		'new_item_name'              => __( 'New OS Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New OS', 'text_domain' ),
		'edit_item'                  => __( 'Edit OS', 'text_domain' ),
		'update_item'                => __( 'Update OS', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate operating systems with commas', 'text_domain' ),
		'search_items'               => __( 'Search operating systems', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove OSes', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previously used OSes', 'text_domain' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);

	register_taxonomy( 'os', 'post', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_os_taxonomy', 0 );

// Add Shortcode for front page boxes
function tekserve_faq_boxes( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'boxonename' => 'Device',
			'boxtwoname' => 'Operating System',
			'boxthreename' => 'Topic',
			'boxonelink' => 'index.php?page_id=51',
			'boxtwolink' => 'index.php?page_id=61',
			'boxthreelink' => 'index.php?page_id=56',
		), $atts )
	);

	// Code
$boxes = '
<script type="text/javascript">
	jQuery(function() {
		jQuery("body").addClass("tekserve-faq-boxes");
	});
</script>
<div id="hero-image" class="wpb_row vc_row-fluid">
<div id="hero">
  <div class="container">
    <div class="hero-title">
      <h1>TekFAQs</h1>
    </div>
    <div class="hero-search">
      <form role="search" method="get" id="searchform" class="form-search" action="http://faq.tekserve.com/">
  <label class="hide" for="s">Search for:</label>
  <input type="text" id="autocomplete-ajax" name="s" class="searchajax search-query placeholder search-input" autocomplete="on" placeholder="Find help! Enter search term here.">
  <input type="submit" id="searchsubmit" value="Search" class="btn-black">
</form>
<script> _url = "http://faq.tekserve.com";</script>    </div>
  </div>
</div>

<div id="boxes-container" class="wpb_row vc_row-fluid"><h1>Browse By:</h1>
  <div class="container vc_span12 wpb_column column_container">
  <div class="row boxes wpb_row vc_row-fluid" style="width: 70%; min-width: 960px; margin: 0 auto;">
    <div class="span4 vc_span4 wpb_column column_container">
      <div class="box">
        <div class="box-icon">
          <a href="' . $boxonelink . '"><i class="icon-desktop"></i></a>
        </div>
        <div class="box-title">
          <h2><a href="' . $boxonelink . '">' . $boxonename . '</a></h2>
        </div>
        <div class="box-text">
          <br>
          <a class="btn-black" href="' . $boxonelink . '">Continue</a>
        </div>
      </div>
    </div>
    <div class="span4 vc_span4 wpb_column column_container">
      <div class="box">
        <div class="box-icon">
          <a href="' . $boxtwolink . '"><i class="icon-file-alt"></i></a>
        </div>
        <div class="box-title">
          <h2><a href="' . $boxtwolink . '">' . $boxtwoname . '</a></h2>
        </div>
        <div class="box-text">
          <br>
          <a class="btn-black" href="' . $boxtwolink . '">Continue</a>
        </div>
      </div>
    </div>
    <div class="span4 vc_span4 wpb_column column_container">
      <div class="box">
        <div class="box-icon">
          <a href="' . $boxthreelink . '"><i class="icon-question-sign"></i></a>
        </div>
        <div class="box-title">
          <h2><a href="' . $boxthreelink . '">' . $boxthreename . '</a></h2>
        </div>
        <div class="box-text">
          <br>
          <a class="btn-black" href="' . $boxthreelink . '">Continue</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>';
return $boxes;
}
add_shortcode( 'tekservefaqboxes', 'tekserve_faq_boxes' );


//Add VC buttons if VC is installed
if (function_exists('vc_map')) { //check for vc_map function before mapping buttons
	$args = array (
		'title_li'	=> '',
		'echo'		=> 0
	);
	$category_list = get_categories($args);
	$slug_array = array();
	$i = 0;
	foreach($category_list as $category) {
		$slug_array[$i] = $category->slug;
		$i++;
	}
	$cat_array = print_r($slug_array, 'true');
	
	vc_map( array(
	   "name" => __("FAQ Boxes"),
	   "base" => "tekservefaqboxes",
	   "class" => "",
	   "icon" => "icon-wpb-rentalitem",
	   "category" => __('Content'),
	   "params" => array(
		   array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box One Title Text"),
				 "param_name" => "boxonename",
				 "value" => __("Device"),
				 "description" => __("Enter the text for the title of box 1. Required."),
				 "admin_label" => True
			  ),
			array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box One URL"),
				 "param_name" => "boxonelink",
				 "value" => __(""),
				 "description" => __("Enter the url for box 1. Required."),
				 "admin_label" => True
			  ),
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box Two Title Text"),
				 "param_name" => "boxtwoname",
				 "value" => __("Operating System"),
				 "description" => __("Enter the text for the title of box 2. Required."),
				 "admin_label" => True
			  ),
			array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box Two URL"),
				 "param_name" => "boxtwolink",
				 "value" => __(""),
				 "description" => __("Enter the url for box 3. Required."),
				 "admin_label" => True
			  ),
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box Three Title Text"),
				 "param_name" => "boxthreename",
				 "value" => __("Topic"),
				 "description" => __("Enter the text for the title of box 3. Required."),
				 "admin_label" => True
			  ),
			array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Box Three URL"),
				 "param_name" => "boxthreelink",
				 "value" => __(""),
				 "description" => __("Enter the url for box 3. Required."),
				 "admin_label" => True
			  ),
		)
	)	);
	

}

if ( ! function_exists( 'tekserve_faq_issue' ) ) {

	// Register Custom Taxonomy - Issue
	function tekserve_faq_issue() {

		$labels = array(
			'name'                       => _x( 'Issues', 'Taxonomy General Name', 'tekserve_faq_issue' ),
			'singular_name'              => _x( 'Issue', 'Taxonomy Singular Name', 'tekserve_faq_issue' ),
			'menu_name'                  => __( 'Issue', 'tekserve_faq_issue' ),
			'all_items'                  => __( 'All Issues', 'tekserve_faq_issue' ),
			'parent_item'                => __( 'Parent Issue', 'tekserve_faq_issue' ),
			'parent_item_colon'          => __( 'Parent Issue:', 'tekserve_faq_issue' ),
			'new_item_name'              => __( 'New Issue Name', 'tekserve_faq_issue' ),
			'add_new_item'               => __( 'Add New Issue', 'tekserve_faq_issue' ),
			'edit_item'                  => __( 'Edit Issue', 'tekserve_faq_issue' ),
			'update_item'                => __( 'Update Issue', 'tekserve_faq_issue' ),
			'separate_items_with_commas' => __( 'Separate issues with commas', 'tekserve_faq_issue' ),
			'search_items'               => __( 'Search Issues', 'tekserve_faq_issue' ),
			'add_or_remove_items'        => __( 'Add or remove Issues', 'tekserve_faq_issue' ),
			'choose_from_most_used'      => __( 'Choose from the most used Issues', 'tekserve_faq_issue' ),
			'not_found'                  => __( 'Not Found', 'tekserve_faq_issue' ),
		);
		$rewrite = array(
			'slug'                       => 'issue',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'tekserve_faq_issue', array( 'post', 'tekserve_faq_os', 'tekserve_faq_device' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'tekserve_faq_issue', 0 );

}

if ( ! function_exists('tekserve_faq_device') ) {

	// Register Custom Post Type for Devices
	function tekserve_faq_device() {

		$labels = array(
			'name'                => _x( 'Devices', 'Post Type General Name', 'tekserve_faq_device' ),
			'singular_name'       => _x( 'Device', 'Post Type Singular Name', 'tekserve_faq_device' ),
			'menu_name'           => __( 'Devices', 'tekserve_faq_device' ),
			'parent_item_colon'   => __( 'Parent Device:', 'tekserve_faq_device' ),
			'all_items'           => __( 'All Devices', 'tekserve_faq_device' ),
			'view_item'           => __( 'View Device', 'tekserve_faq_device' ),
			'add_new_item'        => __( 'Add New Device', 'tekserve_faq_device' ),
			'add_new'             => __( 'Add New', 'tekserve_faq_device' ),
			'edit_item'           => __( 'Edit Device', 'tekserve_faq_device' ),
			'update_item'         => __( 'Update Device', 'tekserve_faq_device' ),
			'search_items'        => __( 'Search Devices', 'tekserve_faq_device' ),
			'not_found'           => __( 'Not found', 'tekserve_faq_device' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'tekserve_faq_device' ),
		);
		$rewrite = array(
			'slug'                => 'devices',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'tekserve_faq_device', 'tekserve_faq_device' ),
			'description'         => __( 'Device Post Type for Tekserve FAQs', 'tekserve_faq_device' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'genesis-cpt-archives-settings', ),
			'taxonomies'          => array( 'tekserve_faq_issue' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-desktop',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'tekserve_faq_device', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'tekserve_faq_device', 0 );

}


// Register Custom Post Type for Operating Systems
if ( ! function_exists('tekserve_faq_os') ) {

	// Register Custom Post Type
	function tekserve_faq_os() {

		$labels = array(
			'name'                => _x( 'Operating Systems', 'Post Type General Name', 'tekserve_faq_os' ),
			'singular_name'       => _x( 'Operating System', 'Post Type Singular Name', 'tekserve_faq_os' ),
			'menu_name'           => __( 'Operating System', 'tekserve_faq_os' ),
			'parent_item_colon'   => __( 'Parent Operating System:', 'tekserve_faq_os' ),
			'all_items'           => __( 'All Operating Systems', 'tekserve_faq_os' ),
			'view_item'           => __( 'View Operating System', 'tekserve_faq_os' ),
			'add_new_item'        => __( 'Add New Operating System', 'tekserve_faq_os' ),
			'add_new'             => __( 'Add New', 'tekserve_faq_os' ),
			'edit_item'           => __( 'Edit Item', 'tekserve_faq_os' ),
			'update_item'         => __( 'Update Operating System', 'tekserve_faq_os' ),
			'search_items'        => __( 'Search Operating Systems', 'tekserve_faq_os' ),
			'not_found'           => __( 'Not found', 'tekserve_faq_os' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'tekserve_faq_os' ),
		);
		$rewrite = array(
			'slug'                => 'operating-system',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'tekserve_faq_os', 'tekserve_faq_os' ),
			'description'         => __( 'Operating System', 'tekserve_faq_os' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'genesis-cpt-archives-settings', ),
			'taxonomies'          => array( 'tekserve_faq_issue' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-welcome-widgets-menus',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'tekserve_faq_os', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'tekserve_faq_os' );

}

// Register Custom Post Type for FAQ Edition Downloads
if ( ! function_exists('tekserve_faq_edition_type') ) {

	// Register Custom Post Type
	function tekserve_faq_edition_type() {

		$labels = array(
			'name'                => _x( 'FAQ Editions', 'Post Type General Name', 'tekserve_faq_edition' ),
			'singular_name'       => _x( 'FAQ Edition', 'Post Type Singular Name', 'tekserve_faq_edition' ),
			'menu_name'           => __( 'FAQ Edition', 'tekserve_faq_edition' ),
			'parent_item_colon'   => __( 'Parent FAQ Edition:', 'tekserve_faq_edition' ),
			'all_items'           => __( 'All FAQ Editions', 'tekserve_faq_edition' ),
			'view_item'           => __( 'View FAQ Edition', 'tekserve_faq_edition' ),
			'add_new_item'        => __( 'Add New FAQ Edition', 'tekserve_faq_edition' ),
			'add_new'             => __( 'Add New', 'tekserve_faq_edition' ),
			'edit_item'           => __( 'Edit FAQ Edition', 'tekserve_faq_edition' ),
			'update_item'         => __( 'Update FAQ Edition', 'tekserve_faq_edition' ),
			'search_items'        => __( 'Search FAQ Editions', 'tekserve_faq_edition' ),
			'not_found'           => __( 'Not found', 'tekserve_faq_edition' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'tekserve_faq_edition' ),
		);
		$rewrite = array(
			'slug'                => 'faq-edition',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'tekserve_faq_edition', 'tekserve_faq_edition' ),
			'description'         => __( 'Files to Download for a Particular Edition of the FAQ', 'tekserve_faq_edition' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'genesis-cpt-archives-settings', ),
			'taxonomies'          => array( 'category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-book',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'tekserve_faq_edition', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'tekserve_faq_edition_type', 0 );

}

//create metabox for file uploads
function tekserve_faq_add_upload_meta_box() {  
	// Define the custom attachment for post type 
    add_meta_box( 'tekserve_faq_upload_files', 'FAQ Edition Files', 'display_tekserve_faq_file_upload', 'tekserve_faq_edition', 'side', 'high' );  
}
add_action('admin_init', 'tekserve_faq_add_upload_meta_box');

// Retrieve meta based on edition ID
function display_tekserve_faq_file_upload($tekserve_faq_edition) {  
  
    wp_nonce_field(plugin_basename(__FILE__), 'tekserve_faq_upload_file_nonce');  
      
   
    $pdf = get_post_meta( $tekserve_faq_edition->ID, 'tekserve_faq_edition_pdf', true );
    $html = '<h2>PDF</h2>';
     $html .= '<div id="tekserve_faq_edition_pdf-file-description">';
    if ( strlen(trim($pdf['url'])) > 0 ) {
    	$html .= '<p class="current-file"><b>Current File:</b><br/><a target="_blank" href="'. $pdf['url'] . '">' . $pdf['name'] . '</a></p><p><b>Select a different PDF file:</b></p>';
    }
    else {
		$html .= '<p><b>Select a PDF file to upload:</b></p>';
    }
    $html .= '</div>';  
    $html .= '<input type="file" id="tekserve_faq_upload_pdf" name="tekserve_faq_upload_pdf" value="" size="25">';

    $html .= '<input type="hidden" id="tekserve_faq_upload_pdf_url" name="tekserve_faq_upload_pdf_url" value=" ' . $pdf['url'] . '" size="30" />';  
    if(strlen(trim($pdf['url'])) > 0) {  
        $html .= '<p><a href="javascript:;" id="tekserve-faq-edition-pdf-delete"><b>' . __('Delete File') . '</b></a></p>';  
    } // end if
    
    $epub = get_post_meta( $tekserve_faq_edition->ID, 'tekserve_faq_edition_epub', true );
    $html .= '<h2>ePub</h2>';
     $html .= '<div id="tekserve_faq_edition_epub-file-description">';
    if ( strlen(trim($epub['url'])) > 0 ) {
    	$html .= '<p class="current-file"><b>Current File:</b><br/><a target="_blank" href="'. $epub['url'] . '">' . $epub['name'] . '</a></p><p><b>Select a different ePub file:</b></p>';
    }
    else {
		$html .= '<p><b>Select an ePub file to upload:</b></p>';
    }
    $html .= '</div>';  
    $html .= '<input type="file" id="tekserve_faq_upload_epub" name="tekserve_faq_upload_epub" value="" size="25">';

    $html .= '<input type="hidden" id="tekserve_faq_upload_epub_url" name="tekserve_faq_upload_epub_url" value=" ' . $epub['url'] . '" size="30" />';  
    if(strlen(trim($epub['url'])) > 0) {  
        $html .= '<p><a href="javascript:;" id="tekserve-faq-edition-epub-delete"><b>' . __('Delete File') . '</b></a></p>';  
    } // end if  
    
    $mobi = get_post_meta( $tekserve_faq_edition->ID, 'tekserve_faq_edition_mobi', true );
    $html .= '<h2>MOBI</h2>';
     $html .= '<div id="tekserve_faq_edition_mobi-file-description">';
    if ( strlen(trim($mobi['url'])) > 0 ) {
    	$html .= '<p class="current-file"><b>Current File:</b><br/><a target="_blank" href="'. $mobi['url'] . '">' . $mobi['name'] . '</a></p><p><b>Select a different MOBI file:</b></p>';
    }
    else {
		$html .= '<p><b>Select an MOBI file to upload:</b></p>';
    }
    $html .= '</div>';  
    $html .= '<input type="file" id="tekserve_faq_upload_mobi" name="tekserve_faq_upload_mobi" value="" size="25">';

    $html .= '<input type="hidden" id="tekserve_faq_upload_mobi_url" name="tekserve_faq_upload_mobi_url" value=" ' . $mobi['url'] . '" size="30" />';  
    if(strlen(trim($mobi['url'])) > 0) {  
        $html .= '<p><a href="javascript:;" id="tekserve-faq-edition-mobi-delete"><b>' . __('Delete File') . '</b></a></p>';  
    } // end if  
      
    echo $html;  
}

//store pdf data
function upload_tekserve_faq_pdf($id) {  
  
    /* --- security verification --- */  
    if(!wp_verify_nonce($_POST['tekserve_faq_upload_file_nonce'], plugin_basename(__FILE__))) {  
      return $id;  
    } // end if  
        
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {  
      return $id;  
    } // end if  
        
    if('page' == $_POST['post_type']) {  
      if(!current_user_can('edit_page', $id)) {  
        return $id;  
      } // end if  
    } else {  
        if(!current_user_can('edit_page', $id)) {  
            return $id;  
        } // end if  
    } // end if  
    /* - end security verification - */  
	
	// Make sure the file array isn't empty  
    if(!empty($_FILES['tekserve_faq_upload_pdf']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $pdf_supported_types = array('application/pdf');  
          
        // Get the file type of the upload  
        $pdf_arr_file_type = wp_check_filetype(basename($_FILES['tekserve_faq_upload_pdf']['name']));  
        $pdf_uploaded_type = $pdf_arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($pdf_uploaded_type, $pdf_supported_types)) {  
  
            // Use the WordPress API to upload the file  
            $pdf_upload = wp_upload_bits($_FILES['tekserve_faq_upload_pdf']['name'], null, file_get_contents($_FILES['tekserve_faq_upload_pdf']['tmp_name']));  
      
            if(isset($pdf_upload['error']) && $pdf_upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $pdf_upload['error']);  
            } else { 
            	$pdf_upload['name'] = $_FILES['tekserve_faq_upload_pdf']['name'];
                add_post_meta($id, 'tekserve_faq_edition_pdf', $pdf_upload);  
                update_post_meta($id, 'tekserve_faq_edition_pdf', $pdf_upload);
                update_post_meta($id, 'tekserve_faq_edition_pdf_url', $pdf_upload['url']);        
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a PDF.");  
        } // end if/else  
          
    }
    else {  
        // Grab a reference to the file associated with this post  
        $pdf_doc = get_post_meta($id, 'tekserve_faq_edition_pdf', true); 
         
        // Grab the value for the URL to the file stored in the text element 
        $pdf_delete_flag = $_POST['tekserve_faq_upload_pdf_url']; 
         
        // Determine if a file is associated with this post and if the delete flag has been set (by clearing out the input box) 
        if(strlen(trim($pdf_doc['url'])) > 0 && strlen(trim($pdf_delete_flag)) == 0) { 
         
            // Attempt to remove the file. If deleting it fails, print a WordPress error. 
            if(unlink($pdf_doc['file'])) { 
                 
                // Delete succeeded so reset the WordPress meta data 
                update_post_meta($id, 'tekserve_faq_edition_pdf', null); 
                update_post_meta($id, 'tekserve_faq_edition_pdf_url', ''); 
                 
            } 
            else { 
            	wp_die('There was an error trying to delete your file.'); 
            } // end if/else 
        } // end if 
    } // end if/else 
}

add_action('save_post', 'upload_tekserve_faq_pdf');  

//store ePub data
function upload_tekserve_faq_epub($id) {  
  
    /* --- security verification --- */  
    if(!wp_verify_nonce($_POST['tekserve_faq_upload_file_nonce'], plugin_basename(__FILE__))) {  
      return $id;  
    } // end if  
        
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {  
      return $id;  
    } // end if  
        
    if('page' == $_POST['post_type']) {  
      if(!current_user_can('edit_page', $id)) {  
        return $id;  
      } // end if  
    } else {  
        if(!current_user_can('edit_page', $id)) {  
            return $id;  
        } // end if  
    } // end if  
    /* - end security verification - */  
	
	// Make sure the file array isn't empty  
    if(!empty($_FILES['tekserve_faq_upload_epub']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just ePub.  
        $epub_supported_types = array('application/epub');  
          
        // Get the file type of the upload  
        $epub_arr_file_type = wp_check_filetype(basename($_FILES['tekserve_faq_upload_epub']['name']));  
        $epub_uploaded_type = $epub_arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($epub_uploaded_type, $epub_supported_types)) {  
  
            // Use the WordPress API to upload the file  
            $epub_upload = wp_upload_bits($_FILES['tekserve_faq_upload_epub']['name'], null, file_get_contents($_FILES['tekserve_faq_upload_epub']['tmp_name']));  
      
            if(isset($epub_upload['error']) && $epub_upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $epub_upload['error']);  
            } else { 
            	$epub_upload['name'] = $_FILES['tekserve_faq_upload_epub']['name'];
                add_post_meta($id, 'tekserve_faq_edition_epub', $epub_upload);  
                update_post_meta($id, 'tekserve_faq_edition_epub', $epub_upload);
                update_post_meta($id, 'tekserve_faq_edition_epub_url', $epub_upload['url']);        
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not an ePub.");  
        } // end if/else  
          
    }
    else {  
        // Grab a reference to the file associated with this post  
        $epub_doc = get_post_meta($id, 'tekserve_faq_edition_epub', true); 
         
        // Grab the value for the URL to the file stored in the text element 
        $epub_delete_flag = $_POST['tekserve_faq_upload_epub_url']; 
         
        // Determine if a file is associated with this post and if the delete flag has been set (by clearing out the input box) 
        if(strlen(trim($epub_doc['url'])) > 0 && strlen(trim($epub_delete_flag)) == 0) { 
         
            // Attempt to remove the file. If deleting it fails, print a WordPress error. 
            if(unlink($epub_doc['file'])) { 
                 
                // Delete succeeded so reset the WordPress meta data 
                update_post_meta($id, 'tekserve_faq_edition_epub', null); 
                update_post_meta($id, 'tekserve_faq_edition_epub_url', ''); 
                 
            } 
            else { 
            	wp_die('There was an error trying to delete your file.'); 
            } // end if/else 
        } // end if 
    } // end if/else 
}

add_action('save_post', 'upload_tekserve_faq_epub');

//store MOBI data
function upload_tekserve_faq_mobi($id) {  
  
    /* --- security verification --- */  
    if(!wp_verify_nonce($_POST['tekserve_faq_upload_file_nonce'], plugin_basename(__FILE__))) {  
      return $id;  
    } // end if  
        
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {  
      return $id;  
    } // end if  
        
    if('page' == $_POST['post_type']) {  
      if(!current_user_can('edit_page', $id)) {  
        return $id;  
      } // end if  
    } else {  
        if(!current_user_can('edit_page', $id)) {  
            return $id;  
        } // end if  
    } // end if  
    /* - end security verification - */  
	
	// Make sure the file array isn't empty  
    if(!empty($_FILES['tekserve_faq_upload_mobi']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just MOBI.  
        $mobi_supported_types = array('application/mobi');  
          
        // Get the file type of the upload  
        $mobi_arr_file_type = wp_check_filetype(basename($_FILES['tekserve_faq_upload_mobi']['name']));  
        $mobi_uploaded_type = $mobi_arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($mobi_uploaded_type, $mobi_supported_types)) {  
  
            // Use the WordPress API to upload the file  
            $mobi_upload = wp_upload_bits($_FILES['tekserve_faq_upload_mobi']['name'], null, file_get_contents($_FILES['tekserve_faq_upload_mobi']['tmp_name']));  
      
            if(isset($mobi_upload['error']) && $mobi_upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $mobi_upload['error']);  
            } else { 
            	$mobi_upload['name'] = $_FILES['tekserve_faq_upload_mobi']['name'];
                add_post_meta($id, 'tekserve_faq_edition_mobi', $mobi_upload);  
                update_post_meta($id, 'tekserve_faq_edition_mobi', $mobi_upload);
                update_post_meta($id, 'tekserve_faq_edition_mobi_url', $mobi_upload['url']);        
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not an MOBI.");  
        } // end if/else  
          
    }
    else {  
        // Grab a reference to the file associated with this post  
        $mobi_doc = get_post_meta($id, 'tekserve_faq_edition_mobi', true); 
         
        // Grab the value for the URL to the file stored in the text element 
        $mobi_delete_flag = $_POST['tekserve_faq_upload_mobi_url']; 
         
        // Determine if a file is associated with this post and if the delete flag has been set (by clearing out the input box) 
        if(strlen(trim($mobi_doc['url'])) > 0 && strlen(trim($mobi_delete_flag)) == 0) { 
         
            // Attempt to remove the file. If deleting it fails, print a WordPress error. 
            if(unlink($mobi_doc['file'])) { 
                 
                // Delete succeeded so reset the WordPress meta data 
                update_post_meta($id, 'tekserve_faq_edition_mobi', null); 
                update_post_meta($id, 'tekserve_faq_edition_mobi_url', ''); 
                 
            } 
            else { 
            	wp_die('There was an error trying to delete your file.'); 
            } // end if/else 
        } // end if 
    } // end if/else 
}

add_action('save_post', 'upload_tekserve_faq_mobi');

//support file upload
function tekserve_faq_update_edit_form() {  
    echo ' enctype="multipart/form-data"';  
} // end tekserve_faq_update_edit_form 

add_action('post_edit_form_tag', 'tekserve_faq_update_edit_form'); 


//use custom templatea

add_filter( 'template_include', 'tekserve_faq_include_templates_function', 1 );

function tekserve_faq_include_templates_function( $template_path ) {
    if ( get_post_type() == 'tekserve_faq_edition' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-tekserve_faq_edition.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . 'single-tekserve_faq_edition.php';
            }
        }
    }
    if ( is_post_type_archive('tekserve_faq_edition') ) {
		// checks if the file exists in the theme first,
		// otherwise serve the file from the plugin
		if ( $theme_file = locate_template( array ( 'archive-tekserve_faq_edition.php' ) ) ) {
			$template_path = $theme_file;
		} 
		else {
			$template_path = plugin_dir_path( __FILE__ ) . 'archive-tekserve_faq_edition.php';
		}
    }
    if ( get_post_type() == 'tekserve_faq_device' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-tekserve_faq_device.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . 'single-tekserve_faq_device.php';
            }
        }
    }
    return $template_path;
}




//connect custom types to posts
function tekserve_faq_connection_types() {
	
	if ( function_exists( 'p2p_register_connection_type' ) ) {
		
		p2p_register_connection_type( array(
			'name' => 'device_to_post',
			'from' => 'tekserve_faq_device',
			'to' => 'post'
		) );
		
		p2p_register_connection_type( array(
			'name' => 'os_to_post',
			'from' => 'tekserve_faq_os',
			'to' => 'post'
		) );
	
	}
	
}

add_action( 'p2p_init', 'tekserve_faq_connection_types' );


//enqueue resources
function include_tekserve_faq_frontend_scripts() {
// 	wp_enqueue_script ( 'ui-elements', get_stylesheet_directory_uri() . '/js/ui-elements.js', array( 'jquery' ), '', true );
 	wp_enqueue_style ( 'tekserve_faq_styles', plugins_url( '/tekserve-faqs.css' , __FILE__ ) );
 	wp_register_script( 'ajaxLoop', plugins_url( '/js/ajaxLoop.js', __FILE__ ), array('jquery') );
 	//set folder location for js functions
	wp_localize_script( 'ajaxLoop', 'tekserveFaqData', array( plugins_url( '/', __FILE__ ), get_post_type() ) );
    wp_enqueue_script('ajaxLoop');
}

function include_tekserve_faq_backend_scripts() {
	wp_register_script('tekserve_faq_js', plugins_url( '/js/tekserve-faqs.js' , __FILE__ ) ); 
	wp_enqueue_script('tekserve_faq_js'); 
}
add_action( 'wp_enqueue_scripts', 'include_tekserve_faq_frontend_scripts' );

add_action( 'admin_enqueue_scripts', 'include_tekserve_faq_backend_scripts' );