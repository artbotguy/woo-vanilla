<?php
/**
 * The template for displaying product search form
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="wv-product-search woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="search" 
	id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" 
	class="form-control search-field" 
	placeholder="Поиск по товарам"
	value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" 
	class="<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>">
	  <svg class="wv-icon">
	<use xlink:href="#sprite-search"></use>
  </svg>
	</button>
	<input type="hidden" name="post_type" value="product" />
</form>
