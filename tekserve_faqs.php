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
  <input type="text" id="autocomplete-ajax" name="s" class="searchajax search-query placeholder" autocomplete="off" placeholder="Find help! Enter search term here.">
  <input type="submit" id="searchsubmit" value="Search" class="btn-black">
</form>
<script> _url = "http://faq.tekserve.com";</script>    </div>
  </div>
</div>

<div id="boxes-container class="wpb_row vc_row-fluid"><h1>Browse By:</h1>
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