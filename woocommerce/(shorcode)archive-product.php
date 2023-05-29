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
	woovanilla_output_content_wrapper( array( 'wrapper_template_class' => 'archive' ) );
	woovanilla_breadcrumb();

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


	<?php
	woocommerce_catalog_ordering();

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

	global $wp_query;

	if ( isset( $_GET['wv_shortcode_type'] ) ) {
		// echo do_shortcode( '[' . $_GET['wv_shortcode_type'] . ']' );
		// $shs = new WVE_Shortcodes( array(), $_GET['wv_shortcode_type'] );
		// $ps = wc_get_products( $shs->get_query_args() );
		$query_vars           = $wp_query->query_vars;
		$shortcode            = new WooVanilla_Expander\Shortcodes\WVE_Shortcode_Products( $query_vars, $_GET['wv_shortcode_type'] );
		$shortcode_query_vars = $shortcode->get_query_args();
		$args                 = array_merge( $query_vars, $shortcode_query_vars );
		// wc_get_products($args);
		// get_posts( $args );
		echo $shortcode->get_content();

	}

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
echo '</div>';
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );


?>
</div> 
</div> <!-- #container -->

<?php


get_footer();
?>
