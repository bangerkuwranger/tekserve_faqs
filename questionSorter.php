<?php

// include wp-load
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
$issue = (isset($_GET['issue'])) ? $_GET['issue'] : 0;
$post_type = (isset($_GET['type'])) ? 'tekserve_faq_' . $_GET['type'] : 0;
$connect_type = $post_type . '_to_post';

// get posts
$connected = new WP_Query( array(
	'posts_per_page' 		=> $numPosts,
    'paged'          		=> $page,
// 	'connected_type' 		=> $connect_type,
// 	'connected_items' 		=> get_queried_object(),
	'tekserve_faq_issue'	=> $issue,
	'post_type'				=> 'post'
) );
 
// display posts
if ($connected->have_posts()) {
	echo '<ul class="tekserve-faq-issue-question-list">';
	while ( $connected->have_posts() ) : $connected->the_post();
		echo '<li class="tekserve-faq-issue-question"><a href="';
		echo the_permalink();
		echo '">';
		echo the_title();
		echo '</a>';
		echo '</li>';
	endwhile;
	echo "</ul>";
 }
 else {
 	echo '<h1>No Questions Available</h1>';
 }
 wp_reset_postdata();