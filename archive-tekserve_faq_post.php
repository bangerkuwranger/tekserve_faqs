<?php

//* Template Name: FAQ Archive

//* Remove standard post content output
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'tekserve_faq_post_archive_loop' );


function tekserve_faq_post_archive_loop() {
	$query_cat = get_query_var( 'cat' );
	$this_cats = get_the_category();
	global $post;
 
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
		'paged'          => get_query_var( 'paged' ),
		'cat'		=>	$query_cat
	);

	global $wp_query;
	$wp_query = new WP_Query( $args );
	$root_cat = get_category( $query_cat );
	$root_parent = get_category( $root_cat->parent );
	while( $root_parent->parent !=0 ) {
		$root_parent = get_category( $root_parent->parent );
	}
	echo '<div id="faq-cat-archive-headline">';
	echo '<h1>Articles in Category</h1>';
	echo '<h2>';
	if( $root_cat->parent !=0 ) { 
		switch( $root_parent->slug ) {
			case 'mac' :
				$root_img = plugins_url( '/images/mac_logo.png' , __FILE__ );
				break;
			case 'ios' :
				$root_img = plugins_url( '/images/ios_logo.png' , __FILE__ );
				break;
		}
		$root_link = get_category_link( $root_parent->term_id );
		echo '<a href="' . $root_link . '"><img alt="' . $root_cat->name . '" src="' . $root_img . '" /></a><i class="icon-circle-arrow-right"></i>';
	}
	echo get_category($query_cat)->name . '</h2></div>';

	if ( have_posts() ) {
		echo '<ul class="tekserve-faq-post-archive-list">';
		while ( have_posts() ) : the_post(); 

			echo '<li class="tekserve-faq-post-archive-list-item"><i class="icon-question-sign"></i><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

		endwhile;
		echo '</ul>';
		do_action( 'genesis_after_endwhile' );
	}



	else { //* if no posts exist
		do_action( 'genesis_loop_else' );
	} //* end loop

	wp_reset_query();

}

genesis();
