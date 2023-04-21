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
