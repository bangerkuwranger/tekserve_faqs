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