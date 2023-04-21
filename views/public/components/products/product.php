<?php

$product                   = $args['product'];
$wv_loop_product_view_type = $args['view_type'] === 'catalog' ? true : false;

if ( $product->is_type( 'variable' ) && ! $wv_loop_product_view_type ) {
	$product = wc_get_product( $product->get_visible_children()[0] );
}

$sale_percent = null;
if ( ! empty( $product->get_sale_price() ) && ! empty( $product->get_sale_price() ) ) {
	$sale_percent = ceil( 100 - ( ( (int) $product->get_sale_price() / (int) $product->get_regular_price() ) * 100 ) );
}

?>

<div class="product">
  <div class="woocommerce-loop-product__head">
	<div class="woocommerce-loop-product__labels">
	  <?php if ( get_the_time( 'U', $product->get_id() ) > time() - 7 * 24 * 3600 ) : ?>
		<div class="woocommerce-loop-product__label">New</div>
	  <?php endif; ?>
	  <?php if ( $sale_percent ) : ?>
		<div class="woocommerce-loop-product__label">- <?php echo $sale_percent; ?> %</div>
	  <?php endif; ?>
	  <!-- <?php if ( 1 ) : ?>
		  <div class="woocommerce-loop-product__label-bestseller"></div>
		<?php endif; ?> -->

	</div>
	<div class="woocommerce-loop-product__head-actions">
	  <button data-tinvwl_product_id="<?php echo $product->get_id(); ?>" class="link-item link-item_type_circle woocommerce-loop-product__wishlist">
		<svg class="icon">
		  <use xlink:href="#sprite-wish"></use>
		</svg>
	  </button>
	  <?php if ( $wv_loop_product_view_type ) : ?>
		<button class="link-item link-item_type_circle woocommerce-loop-product__preview">
		  <svg class="icon">
			<use xlink:href="#sprite-watch"></use>
		  </svg>
		</button>
	  <?php endif; ?>
	</div>
  </div>
<?php
get_template_part(
	'views/public/components/sliders/slider-product',
	null,
	array(
		'product'   => $product,
		'view_type' => $wv_loop_product_view_type,
	)
);
?>
  <div class="woocommerce-loop-product__content">
	<div class="woocommerce-loop-product__content-top">
	  <div class="woocommerce-loop-product__name"><?php echo $product->get_name(); ?></div>
	  <?php if ( $wv_loop_product_view_type ) : ?>
			<?php get_template_part( 'views/public/components/product/product-catalog-actions', null, array( 'product' => $product ) ); ?>
	  <?php else : ?>
		<div class="woocommerce-loop-product__dimensions">
		  <div class="woocommerce-loop-product__dimension">
			<span><?php echo $product->get_height(); ?></span>
			<span><?php echo $product->get_width(); ?></span>
		  </div>
		</div>
	  <?php endif; ?>
	</div>
	<div class="woocommerce-loop-product__content-bot">
	  <div class="woocommerce-loop-product__prices">
		<div class="woocommerce-loop-product__sale-price"><?php echo $product->get_sale_price(); ?></div>
		<div class="woocommerce-loop-product__regular-price"><?php echo $product->get_regular_price(); ?></div>
	  </div>
	  <button class="woocommerce-loop-product__add-to-cart">В корзину</button>
	</div>
  </div>
</div>
