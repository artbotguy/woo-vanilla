<?php
/**
 * Review order table
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="wv-checkout-order-review shop_table woocommerce-checkout-review-order-table">

		<div class="wv-checkout-order-review__item">
			<span class="wv-checkout-order-review__label">Итого:</span>
			<h5><?php wc_cart_totals_order_total_html(); ?></h5>
		</div>

		<div class="wv-checkout-order-review__item">
			<span class="wv-checkout-order-review__label">
			<?php
			$count = count( WC()->cart->get_cart_item_quantities() );
			printf(
				_n( '%s product', '%s products', $count, 'woocommerce' ),
				'<span class="count">' .
				esc_html( $count ) . '</span>'
			)
			?>
			 </span>
			<span class="wv-checkout-order-review__value"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<div class="wv-checkout-order-review__item">
			<span class="wv-checkout-order-review__label">Доставка</span>
			<span class="wv-checkout-order-review__value">Бесплатно</span>
		</div>

</div>
