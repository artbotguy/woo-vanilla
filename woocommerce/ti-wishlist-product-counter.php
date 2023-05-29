<?php
/**
 * The Template for displaying dropdown wishlist products.
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script( 'tinvwl' );

?>
<a href="<?php echo esc_url( tinv_url_wishlist_default() ); ?>" id="linkWishlist" 
   name="<?php echo esc_attr( sanitize_title( $text ) ); ?>" aria-label="<?php echo esc_attr( $text ); ?>"
   class="_wv-hovervable wv-link-item wv-header-mobile-menu__item wishlist_products_counter
   <?php
	echo ' ' . $icon_class . ' ' .
	 $icon_style . ( empty( $text ) ? ' no-txt' : '' ) .
	 ( 0 < $counter ? ' wishlist-counter-with-products' : '' ); // WPCS: xss ok.
	?>
	 "
data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlist">	
<svg class="wv-icon wv-link-item__icon">
	<use xlink:href="#sprite-wish"></use>
</svg>
<div class="wv-link-item__title">Избранное</div>
</a>
