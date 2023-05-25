<?php 
add_action( 'admin_init', 'ht_default_metaboxes' );

// slogan page
function ht_default_metaboxes() {

	$prefix = '_ht_';

	/**
	 * Post Formats
	 */
	require_once 'post-formats.php';
	
	/**
	 * Page Metabox
	 */
	require_once 'page-metabox.php';


	/**
	 * Post Metabox
	 */
	require_once 'post-metabox.php';

}

?>