<?php
/**
 * The template for displaying product content within loops
 *
 * $wv_loop_product_view_type Variable, defining view type. Theme has 2 view type loop products. Default is catalog. Specific is slider loop product
 *
 * @package WooWanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;
$wv_loop_product_view_type = isset( $wv_loop_product_view_type ) ? $wv_loop_product_view_type : 'default';

$full_class = ( 'default' === $wv_loop_product_view_type ? 'woocommerce-loop-product_type_catalog' : 'swiper-slide woocommerce-loop-product_type_slider' ) . ' woocommerce-loop-product placeholder';

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( $full_class, $product ); ?>>
	<?php



	if ( 'default' === $wv_loop_product_view_type ) :
		echo '<div class="woocommerce-loop-product__imageble-content-wrapper _wv-swiper-parent">';
		endif;
	echo '<div class="woocommerce-loop-product__head">';
	if ( 'default' === $wv_loop_product_view_type ) :
		woovanilla_template_product_attributes( array( 'pa_vysota', 'pa_shirina' ) );
		woocommerce_template_single_excerpt();
	endif;


	/**
	 * Hook: woovanilla_before_shop_loop_item_head.
	 *
	 * @hooked woovanilla_show_product_loop_labels - 10
	 * @hooked tinvwl_view_addto_htmlloop - 10
	 * @hooked woovanilla_template_product_loop_preview_btn - 10
	 */
	do_action( 'woovanilla_before_shop_loop_item_head' );
	echo '</div>'; // END - woocommerce-loop-product__head
			/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woovanilla_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woovanilla_template_product_loop_slider - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );


	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 */
	do_action( 'woocommerce_after_shop_loop_item' );

	if ( 'default' === $wv_loop_product_view_type ) :
		echo '</div>'; // woocommerce-loop-product__imageble-content-wrapper
		endif;

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Theme has 2 view type loop products. Default is catalog. Specific is slider loop product
	 */
	if ( 'default' === $wv_loop_product_view_type ) {
		echo '<div class="woocommerce-loop-product__reviews-and-time-waiting">';
			/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woovanilla_template_rating - 10
	 * @hooked woovanilla_template_loop_item_delivery_time_waiting - 10
	 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		echo '</div>';
	} else {

		woovanilla_template_product_attributes( array( 'pa_vysota', 'pa_shirina' ), ',' );
				/**
	 * Hook: woocommerce_after_shop_loop_item_slider_title.
	 */
		do_action( 'woocommerce_after_shop_loop_item_slider_title' );

	}


	/**
	 * Hook: woovanilla_shop_loop_item_footer
	 *
	 * @hooked woovanilla_variable_add_to_cart - 10
	 */
	do_action( 'woovanilla_shop_loop_item_footer', array( 'wv_loop_product_view_type' => $wv_loop_product_view_type ) );

	?>


</div>
