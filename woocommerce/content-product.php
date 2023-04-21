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

$full_class = ( $wv_loop_product_view_type === 'default' ? '' : 'swiper-slide woocommerce-loop-product_type_slider' ) . ' woocommerce-loop-product';
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( $full_class, $product ); ?>>
	<?php


	echo '<div class="woocommerce-loop-product__head">';
	/**
	 * Hook: woovanilla_before_shop_loop_item_head.
	 *
	 * @hooked woovanilla_show_product_loop_labels - 10
	 * @hooked tinvwl_view_addto_htmlloop - 10
	 * @hooked woovanilla_template_product_loop_preview - 10
	 */
	do_action( 'woovanilla_before_shop_loop_item_head' );
	echo '</div>';

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
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Theme has 2 view type loop products. Default is catalog. Specific is slider loop product
	 */
	if ( 'default' === $wv_loop_product_view_type ) {
			/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woovanilla_template_rating - 10
	 * @hooked woovanilla_template_loop_item_delivery_time_waiting - 10
	 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	} else {
				/**
	 * Hook: woocommerce_after_shop_loop_item_slider_title.
	 *
	 * @hooked woovanilla_template_product_attributes - 10
	 */
		do_action( 'woocommerce_after_shop_loop_item_slider_title' );

	}

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 */
	do_action( 'woocommerce_after_shop_loop_item' );

	echo '<div class="woocommerce-loop-product__footer">';
	/**
	 * Hook: woovanilla_shop_loop_item_footer
	 *
	 * @hooked woovanilla_variable_add_to_cart - 10
	 */
	do_action( 'woovanilla_shop_loop_item_footer', array( 'wv_loop_product_view_type' => $wv_loop_product_view_type ) );

	echo '</div>';
	?>


</div>
