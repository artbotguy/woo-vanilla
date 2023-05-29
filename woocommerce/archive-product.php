<?php
/**
 * The Template for displaying products in a product category.
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
	woovanilla_output_content_wrapper( array( 'template' => $template ) );
	woovanilla_breadcrumb();

?>
<div class="container-lg">

<div class="">
<?php
if ( woocommerce_product_loop() ) {




	?>
<header class="woocommerce-products-header placeholder-wave">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title _wv-spec-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>


	<?php

	woocommerce_catalog_ordering();
	?>

</header>


	<?php
	/**
	 * Hook: woocommerce_before_shop_loop.
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			// **
			// * Hook: woocommerce_shop_loop .
			// * /
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	wc_get_template( 'wv-sections/wv-catalog-description.php' );

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );


?>
</div> <!-- #container -->

<?php


get_footer();
?>
