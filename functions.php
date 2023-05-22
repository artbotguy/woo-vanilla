<?php
/**
 * Based AWPS
 *
 * @package woovanilla
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'WooVanilla' ) ) :
	WooVanilla::register_services();
endif;

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 3;
	return $cols;
}
