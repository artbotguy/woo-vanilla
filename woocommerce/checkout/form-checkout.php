<?php
/**
 * Checkout Form
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form name="checkout" method="post" class="wv-checkout-form checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php wc_cart_totals_shipping_html(); ?>

		<?php endif; ?>
	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_billing' ); ?>

	<?php endif; ?>


	<div class="wv-checkout-form__last-column">
		<div class="wv-checkout-form__ordering">
			<?php woocommerce_order_review(); ?>
			<div class="wv-checkout-form__submit form-row place-order">
				<?php
				echo apply_filters(
					'woocommerce_order_button_html',
					'<button type="submit" class="btn _wv-form-item _wv-form-item_style_emphasis button alt' .
					esc_attr(
						wc_wp_theme_get_element_class_name( 'button' ) ? ' ' .
						wc_wp_theme_get_element_class_name( 'button' ) : ''
					) . '"
				name="woocommerce_checkout_place_order" id="place_order" value="' .
					esc_attr( 'Оформить заказ' ) . '" data-value="' . esc_attr( 'Оформить заказ' ) .
				'">' . esc_html( 'Оформить заказ' ) . '</button>' ); // @codingStandardsIgnoreLine ?>
				<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			</div>
		</div>
	</div>

</form>
