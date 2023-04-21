<?php

/**
 * The Template for displaying add to wishlist product button.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-addtowishlist.php.
 *
 * @version             1.47.0
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script( 'tinvwl' );
?>
<div class="tinv-wishlist link-item link-item_type_circle" data-tinvwl_product_id="<?php echo $product->get_id(); ?>">

	<?php
	do_action( 'tinvwl_wishlist_addtowishlist_button', $product, $loop );
	?>
	<svg class="icon icon_s">
		<use xlink:href="#sprite-wish"></use>
	</svg>
</div>
