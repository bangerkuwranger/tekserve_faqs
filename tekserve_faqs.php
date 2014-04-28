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
		'name'                       => _x( 'Operating Systems', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Operating System', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Operating System', 'text_domain' ),
		'all_items'                  => __( 'All Operating Systems', 'text_domain' ),
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
	register_taxonomy( 'tekserve_faq_issue', array( 'post', 'tekserve_faq_operating_system', 'tekserve_faq_device' ), $args );

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
		'slug'                => 'device',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'tekserve_faq_device', 'tekserve_faq_device' ),
		'description'         => __( 'Device Post Type for Tekserve FAQs', 'tekserve_faq_device' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( 'category', 'post_tag', 'tekserve_faq_issue' ),
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

if ( ! function_exists('tekserve_faq_operating_system') ) {

// Register Custom Post Type for Operating Systems
function tekserve_faq_operating_system() {

	$labels = array(
		'name'                => _x( 'Operating Systems', 'Post Type General Name', 'tekserve_faq_operating_system' ),
		'singular_name'       => _x( 'Operating System', 'Post Type Singular Name', 'tekserve_faq_operating_system' ),
		'menu_name'           => __( 'Operating Systems', 'tekserve_faq_operating_system' ),
		'parent_item_colon'   => __( 'Parent Operating System:', 'tekserve_faq_operating_system' ),
		'all_items'           => __( 'All Operating Systems', 'tekserve_faq_operating_system' ),
		'view_item'           => __( 'View Operating System', 'tekserve_faq_operating_system' ),
		'add_new_item'        => __( 'Add New Operating System', 'tekserve_faq_operating_system' ),
		'add_new'             => __( 'Add New', 'tekserve_faq_operating_system' ),
		'edit_item'           => __( 'Edit Operating System', 'tekserve_faq_operating_system' ),
		'update_item'         => __( 'Update Operating System', 'tekserve_faq_operating_system' ),
		'search_items'        => __( 'Search Operating Systems', 'tekserve_faq_operating_system' ),
		'not_found'           => __( 'Not found', 'tekserve_faq_operating_system' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'tekserve_faq_operating_system' ),
	);
	$rewrite = array(
		'slug'                => 'operating-system',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'tekserve_faq_operating_system', 'tekserve_faq_operating_system' ),
		'description'         => __( 'Operating System Post Type for Tekserve FAQs', 'tekserve_faq_operating_system' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( 'category', 'post_tag', 'tekserve_faq_issue' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-welcome-widgets-menus',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'tekserve_faq_operating_system', $args );

}

// Hook into the 'init' action
add_action( 'init', 'tekserve_faq_operating_system', 1 );

}