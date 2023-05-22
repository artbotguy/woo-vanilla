<?php
/**
 * Product
 *
 * @package WooVanilla
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$productClasses = apply_filters( 'xoo_wsc_product_class', $productClasses );

?>
<div data-key="<?php echo $cart_item_key; ?>" class="wv-item <?php echo implode( ' ', $productClasses ); ?>">

	<?php if ( $showPimage ) : ?>

		<div class="wv-item__first-column xoo-wsc-img-col">

			<?php echo $thumbnail; ?>

			<?php
			woocommerce_quantity_input(
				array(
					'input_value' => $cart_item['quantity'],
					'classes'     => array( 'xoo-wsc-qty' ),
				),
				$_product
			);
			?>

		</div>

	<?php endif; ?>

	<div class="wv-item__summary xoo-wsc-sum-col">
				<?php if ( $showPname ) : ?>
					<span class="wv-item__name xoo-wsc-pname"><?php echo $product_name; ?></span>
				<?php endif; ?>
				<?php
				if ( $showPmeta ) {
					echo $product_meta;}
				?>
				<div class="wv-item__sku">Артикул: <span>0092S40240</span></div>
				<div class="wv-item__price"><?php echo $product_subtotal; ?></div>
	</div>
	
	
	<div class="wv-item__last-column xoo-wsc-sm-right">
		<svg class="wv-icon xoo-wsc-smr-del">
			<use xlink:href="#sprite-remove"></use>
		</svg>
	</div>
</div>
