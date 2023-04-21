<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woovanilla
 */

?>

</div><!-- #content -->

<?php
if ( is_customize_preview() ) {
		echo '<div id="woovanilla-footer-control" style="margin-top:-30px;position:absolute;"></div>';
}
?>

<footer id="colophon" class="site-footer container-fluid" role="contentinfo">

</footer>
<?php get_template_part( 'views/public/components/offcanvases-modals' ); ?>
</div>

<?php wp_footer(); ?>

</body>

</html>
