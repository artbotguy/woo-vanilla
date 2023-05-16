<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woovanilla
 */

if ( ! is_active_sidebar( 'woovanilla-sidebar' ) ) :
	return;
endif;
?>

<?php
if ( is_customize_preview() ) {
	echo '<div id="woovanilla-sidebar-control"></div>';
}
