<?php
/**
 * Loop Price
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="prices">
	<div class="price"><?php echo esc_html( $product->get_regular_price() ); ?></div>
	<div class="price"><?php echo esc_html( $product->get_sale_price() ); ?></div>
</div>
