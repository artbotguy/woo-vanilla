<?php
/**
 * The template
 *
 * @package WooWanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;

$full_class = 'swiper-slide woocommerce-loop-product_type_variation woocommerce-loop-product placeholder';

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( $full_class, $product ); ?>>

	<div class="woocommerce-loop-product__head">
		<?php
			woovanilla_show_product_loop_labels();
			tinvwl_view_addto_htmlloop();
		?>
	</div>
	<?php
		woocommerce_template_loop_product_link_open();
		woovanilla_template_product_loop_slider();
		woocommerce_template_loop_product_link_close();

		woocommerce_template_loop_product_title();

		woovanilla_template_product_attributes( array(), ',' );
		// woovanilla_variable_add_to_cart();

	?>
									<?php
									// if ( apply_filters( 'tinvwl_wishlist_item_action_add_to_cart', 'В корзину'_product, $product ) ) {
										?>
									<button class="button alt" name="tinvwl-add-to-cart"
											value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
											title="<?php echo esc_html( apply_filters( 
												'tinvwl_wishlist_item_add_to_cart', 
												'В корзину', $wl_product, $product ) ); ?>">
										<i
											class="ftinvwl ftinvwl-shopping-cart"></i><span
											class="tinvwl-txt"><?php echo wp_kses_post( apply_filters( 'tinvwl_wishlist_item_add_to_cart', 'В корзину', $wl_product, $product ) ); ?></span>
									</button>
										<?php
									// } elseif ( apply_filters( 'tinvwl_wishlist_item_action_default_loop_button', 'В корзину'_product, $product ) ) {
									// 	woocommerce_template_loop_add_to_cart();
									// }
									?>
</div>
