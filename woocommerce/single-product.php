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

<?php woocommerce_output_content_wrapper(); ?>
<?php	woocommerce_breadcrumb(); ?>
	 
<div class="container-lg">
	

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php
		endwhile; // end of the loop.
		?>
</div> <!-- #container -->

<?php woocommerce_output_content_wrapper_end(); ?>


<?php
get_footer();
