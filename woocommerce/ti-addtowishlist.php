<?php

/**
 * The Template for displaying add to wishlist product button.
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script( 'tinvwl' );
?>
<div class="tinv-wishlist wv-link-item wv-link-item_type_circle" data-tinvwl_product_id="<?php echo $product->get_id(); ?>">

	<?php
	do_action( 'tinvwl_wishlist_addtowishlist_button', $product, $loop );
	?>
	<!-- woovanilla_tinvwl_wishlist_button_after() -->
</div>
