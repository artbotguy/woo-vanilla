<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('product-catalog woocommerce-loop-product', $product); ?>>
	<?php


	echo '<div class="woocommerce-loop-product__head">';
	/**
	 * Hook: woovanilla_before_shop_loop_item_head.
	 *	
	 * @hooked woovanilla_show_product_loop_labels - 10
	 * @hooked tinvwl_view_addto_htmlloop - 10
	 * @hooked woovanilla_template_product_loop_preview - 10
	 */
	do_action('woovanilla_before_shop_loop_item_head');
	echo '</div>';

	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *	
	 * @hooked woovanilla_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item');


	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woovanilla_template_product_loop_slider - 10

	 */
	do_action('woocommerce_before_shop_loop_item_title');

	/**
	 * Hook: woovanilla_before_shop_loop_item_head.
	 *	
	 * @hooked woovanilla_show_product_loop_labels - 10
	 * @hooked tinvwl_view_addto_htmlloop - 10
	 * @hooked woovanilla_template_product_loop_preview - 10
	 */
	do_action('woovanilla_before_shop_loop_item_actions');

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action('woocommerce_shop_loop_item_title');

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 */
	do_action('woocommerce_after_shop_loop_item_title');

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 * @hooked woocommerce_template_loop_price - 10

	 */
	do_action('woocommerce_after_shop_loop_item');
	?>
</div>