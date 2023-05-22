<?php
/**
 * Output a single payment method
 *
 * WV: Иконки названы в соответсвии с Gateway id
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<li class="wv-checkout-payment__item wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<svg class="wv-checkout-payment__icon wv-icon">
		<use xlink:href="#sprite-gateway-<?php echo $gateway->id; ?>"></use>
	</svg>
	<label class="wv-checkout-payment__label" for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
	</label>
	<input class="wv-checkout-payment__input" id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
	<span class="wv-checkout-payment__input-icon"></span>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
