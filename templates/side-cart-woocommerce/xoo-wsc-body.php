<?php
/**
 * Side Cart Body (Avoid editing this template)
 *
 * @package WooVanilla
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


extract( Xoo_Wsc_Template_Args::cart_body() );

?>
<?php
if ( empty( $cart ) ) {
	echo '<div class="wv-offcanvas__sub-title">Ваша корзина пуста!</div>';
}

?>
<div class="xoo-wsc-products">

	<?php

	/* Output Products */
	foreach ( $cart as $cart_item_key => $cart_item ) {

		$bundleData = xoo_wsc_cart()->is_bundle_item( $cart_item );

		if ( ! empty( $bundleData ) ) {
			$showPLink = ! $bundleData['link'] ? false : $showPLink;
		}

		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] < 0 || ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			continue;
		}

		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		$product_name = $_product->get_name();

		if ( $_product->get_type() === 'variation' ) {
			if ( $pnameVariation === 'no' ) {
				$product_name = $_product->get_title();
				$cart_item['data']->set_name( $_product->get_title() );
			}
		}

		// $product_name = apply_filters( 'woocommerce_cart_item_name', $product_name, $cart_item, $cart_item_key );
		// $product_name = $product_permalink && $showPLink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $product_name ) : $product_name;

		$product_meta = wc_get_formatted_cart_item_data( $cart_item );

		$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

		$product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

		$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
		$thumbnail = $product_permalink && $showPLink ? sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ) : $thumbnail;

		$cart_item_args = array(
			'cart_item_key'     => $cart_item_key,
			'cart_item'         => $cart_item,
			'_product'          => $_product,
			'product_id'        => $product_id,
			'product_name'      => $product_name,
			'product_permalink' => $product_permalink,
			'product_meta'      => $product_meta,
			'product_price'     => $product_price,
			'product_subtotal'  => $product_subtotal,
			'thumbnail'         => $thumbnail,
			'bundleData'        => $bundleData,
		);

		$args = Xoo_Wsc_Template_Args::product( $_product, $cart_item, $cart_item_key, $cart_item_args );

		xoo_wsc_helper()->get_template(
			'global/body/product.php',
			$args
		);

	}

	?>

</div>

<?php do_action( 'xoo_wsc_after_products' ); ?>
