<?php
/**
 * Loop Price
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<div class="wv-price"><span class="price"><?php echo $price_html; ?></span></div>
<?php endif; ?>
