<?php

/**
 * The Template for displaying all single products
 *
 * @package     WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<?php woovanilla_output_content_wrapper( array( 'template' => $template ) ); ?>
<?php	woovanilla_breadcrumb(); ?>
	 
<div class="container-lg">
	

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php
		endwhile; // end of the loop.
		?>
</div> <!-- #container -->
	
<?php wc_get_template( 'wv-sections/wv-advantages-single-product.php' ); ?>
<?php woocommerce_output_content_wrapper_end(); ?>


<?php
get_footer();
