<?php

// include wp-load
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Variables from $_GET
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
$issue = (isset($_GET['issue'])) ? $_GET['issue'] : 0;
$post_type = (isset($_GET['type'])) ? 'tekserve_faq_' . $_GET['type'] : 0;
$connect_type = (isset($_GET['type'])) ? $_GET['type'] . '_to_post' : 0;
$connect_items = (isset($_GET['citems'])) ? $_GET['citems'] : 0;

//get relevant info for issues
$issue_obj = get_term_by( 'slug', $issue, 'tekserve_faq_issue' );
$issue_id = $issue_obj->term_id;
$issue_name = $issue_obj->name;

// get posts
$connected = new WP_Query( array(
	'posts_per_page' 		=> $numPosts,
    'paged'          		=> $page,
	'connected_type' 		=> $connect_type,
	'connected_items' 		=> get_post( $connect_items ),
	'post_type'				=> 'post',
) );
$relevant_posts = '';
// display posts
if ($connected->have_posts()) {
	$i=0;
	$all_post_issues = array();
	while ( $connected->have_posts() ) : $connected->the_post();
		$this_post = get_the_id();
		$post_issues = get_post_meta( $this_post, 'tekserve_faq_post_issue', false );
		$all_post_issues[$this_post] = $post_issues[0][$issue_id];
		$i++;
		if( $post_issues[0][$issue_id] == $issue_name ) { 
			$relevant_posts .= '<li class="tekserve-faq-issue-question"><a href="';
			$relevant_posts .= get_the_permalink();
			$relevant_posts .= '">';
			$relevant_posts .= get_the_title();
			$relevant_posts .= '</a>';
			$relevant_posts .= '</li>';
		}
	endwhile;
	if( !empty( $relevant_posts ) ) {
		$relevant_posts = '<ul class="tekserve-faq-issue-question-list">' . $relevant_posts . '</ul>';
	}
	else {
		$relevant_posts = '<h1>No Questions Available</h1> nr';
	}
}
else {
 	$relevant_posts = '<h1>No Questions Available</h1>';
}
echo $relevant_posts;
// print_r($issue_obj);
// echo '<hr>';
// print_r($all_post_issues);
// echo '<hr>';
// print_r($connected);
wp_reset_postdata();