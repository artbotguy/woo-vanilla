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

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<div class="container-lg">

<div class="wv-catalog-products">
<?php
if ( woocommerce_product_loop() ) {

	echo '<div class="wv-catalog-sidebar placeholder-wave">';

	echo '</div>';

	echo '<div class="wv-catalog-products__main">';

	?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
		 <button class="wv-catalog-filter-desktop-toggle _wv-form-item" data-bs-toggle="collapse" data-bs-target="#wv-catalog-filter-desktop-collapse">
		<svg class="wv-icon">
			<use xlink:href="#sprite-filter"></use>
		</svg>
		<span class="wv-catalog-filter-desktop-toggle__title">Фильтры</span>
		<div class="wv-catalog-filter-desktop-toggle__counter"></div>
	</button>	


	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_archive_description' );
	?>

</header>
<div class="wv-catalog-filter-desktop">
		<div id="wv-catalog-filter-desktop-collapse" class="wv-catalog-filter-desktop__content collapse">
		<?php WooVanilla\Api\Widget_Areas::get_instance()->area_template(); ?>
	</div>
</div>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop.
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
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
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
echo '</div>';
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

wc_get_template( 'wv-sections/wv-catalog-description.php' );

?>
</div> 
</div> <!-- #container -->

<?php


get_footer();
?>
