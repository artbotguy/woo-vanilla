<?php
/**
 * Single variation cart button
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php
	woovanilla_single_variation();
	?>

	<?php

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	?>

	<button type="submit" class="wv-add-to-cart btn _wv-form-item  single_add_to_cart_button alt
	<?php
	echo esc_attr(
		wc_wp_theme_get_element_class_name( 'button' ) ? ' ' .
		wc_wp_theme_get_element_class_name( 'button' ) : ''
	);
	?>
	">
	<svg class="wv-icon">
		<use xlink:href="#sprite-cart"></use>
	</svg>
	<span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
	</button>

	<?php tinvwl_view_addto_htmlloop(); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
