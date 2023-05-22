<?php
/**
 * Checkout billing information form
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

$fields = $checkout->get_checkout_fields( 'billing' );

?>

<div class="wv-checkout-form__billing woocommerce-billing-fields">
	<div class="wv-checkout-form__item">
		<h5 class="wv-checkout-form__title"><span class="wv-checkout-form__title-id">1</span>Контактные данные</h5>
		<div class="wv-checkout-form__fields">
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_first_name', $fields['billing_first_name'], $checkout->get_value( 'billing_first_name' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_last_name', $fields['billing_last_name'], $checkout->get_value( 'billing_last_name' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_phone', $fields['billing_phone'], $checkout->get_value( 'billing_phone' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_email', $fields['billing_email'], $checkout->get_value( 'billing_email' ) ); ?>
			</div>
		</div>
	</div>
	<div class="wv-checkout-form__item">
		<h5 class="wv-checkout-form__title"><span class="wv-checkout-form__title-id">2</span>Детали доставки</h5>
		<div class="wv-checkout-form__fields">
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_state', $fields['billing_state'], $checkout->get_value( 'billing_state' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item" hidden>
				<?php woocommerce_form_field( 'billing_country', $fields['billing_country'], $checkout->get_value( 'billing_country' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_city', $fields['billing_city'], $checkout->get_value( 'billing_city' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_postcode', $fields['billing_postcode'], $checkout->get_value( 'billing_postcode' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_address_1', $fields['billing_address_1'], $checkout->get_value( 'billing_address_1' ) ); ?>
			</div>
			<div class="wv-checkout-form__sub-item">
				<?php woocommerce_form_field( 'billing_address_2', $fields['billing_address_2'], $checkout->get_value( 'billing_address_2' ) ); ?>
			</div>
		</div>
	</div>
		<div class="wv-checkout-form__item">
		<h5 class="wv-checkout-form__title"><span class="wv-checkout-form__title-id">3</span>Способы оплаты</h5>
		<?php woocommerce_checkout_payment(); ?>
	</div>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
