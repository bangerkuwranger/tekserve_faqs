<?php
// include wp-load
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$args = array(
	'numberposts'	=>	-1,
	'post_type'		=>	'post',
	'post_status'      => 'publish',
	'orderby'          => 'slug',
	'order'            => 'ASC'
);

$tekfaqposts = get_posts( $args );
$update_what = (isset($_GET['updateThis'])) ? $_GET['updateThis'] : 0;
$updated_posts = '';

if( $update_what !== 0 ) {
	switch( $update_what ) {
		case 'tekserve_faq_device' :
			$tekserve_faq_device_list_args = array(
				'orderby'       => 'slug', 
				'order'         => 'ASC',
				'post_type'		=> 'tekserve_faq_device',
				'post_status'	=> 'publish',
				'numberposts'	=>	-1
			);
			$tekserve_faq_devices = get_posts( $tekserve_faq_device_list_args );
			foreach ( $tekfaqposts as $post ) {
					foreach( $tekserve_faq_devices as $tekserve_faq_device ) {
						$device_id = intval( $tekserve_faq_device->ID );
						$device_categories = wp_get_post_categories( $device_id );
						if( in_category( $device_categories, $post->ID ) ) {
							$p2p_id = p2p_type( 'device_to_post' )->get_p2p_id( $device_id, $post->ID );
							if ( $p2p_id ) {
							  continue;
							} 
							else {
								p2p_create_connection( 'device_to_post', array(
									'from' => $device_id,
									'to' => $post->ID,
									'meta' => array(
										'date' => current_time('mysql')
									)
								) );
								wp_publish_post( array( 'ID' => $post->ID ) );
								$updated_posts .= $post->ID . ', ';
							}
						}
					}	
				}
			break;
			break;
			case 'tekserve_faq_os' :
				$tekserve_faq_os_list_args = array(
					'orderby'       => 'slug', 
					'order'         => 'ASC',
					'post_type'		=> 'tekserve_faq_os',
					'post_status'	=> 'publish',
					'numberposts'	=>	-1
				);
				$tekserve_faq_oss = get_posts( $tekserve_faq_os_list_args );
				foreach ( $tekfaqposts as $post ) {
					foreach( $tekserve_faq_oss as $tekserve_faq_os ) {
						$os_categories = wp_get_post_categories( $os_id );
						if( in_category( $os_categories, $post->ID ) ) {
							$p2p_id = p2p_type( 'os_to_post' )->get_p2p_id( $os_id, $post->ID );
							if ( $p2p_id ) {
							  continue;
							} 
							else {
								p2p_create_connection( 'os_to_post', array(
									'from' => $os_id,
									'to' => $post->ID,
									'meta' => array(
										'date' => current_time('mysql')
									)
								) );
								wp_publish_post( array( 'ID' => $post->ID ) );
								$updated_posts .= $post->ID . ', ';
							}
						}
					}	
				}
			break;
			case 'post' :
				$tekserve_faq_issue_list_args = array(
					'orderby'       => 'slug', 
					'order'         => 'ASC',
					'hide_empty'    => 0
				);
				$tekserve_faq_issues = get_terms( 'tekserve_faq_issue', $tekserve_faq_issue_list_args );
				$allqterm = get_term_by( 'name', 'All Questions', 'tekserve_faq_issue' );
				$issues_to_cats = get_option( 'tekserve_faq_issue_cats' );
				foreach( $tekfaqposts as $post ) {
					$tekserve_faq_issues_to_add = array( intval( $allqterm->term_id ) => $allqterm->name );
					foreach( $tekserve_faq_issues as $tekserve_faq_issue ) {
						$issue_cat_value = intval( $tekserve_faq_issue->term_id );
						$issue_cats = $issues_to_cats[$issue_cat_value];
					
						if( in_category( $issue_cats, $post->ID ) ) {
							$tekserve_faq_issues_to_add[$issue_cat_value] = $tekserve_faq_issue->name;
						}
					}
					$setdatat = update_post_meta( $post->ID, 'tekserve_faq_post_issue', serialize( $tekserve_faq_issues_to_add ) );
// 					wp_publish_post( array( 'ID' => $post->ID ) );
					$updated_posts .= $post->ID . ', ';
				}
			break;
		
	}
echo 'Here are all of the ids: ';
echo $updated_posts;
echo '';

}

else {
	echo 'No dice. I don\'t know what data to update: ' . $update_what;
}