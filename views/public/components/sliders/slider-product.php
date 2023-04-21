<?php
$product                   = $args['product'];
$wv_loop_product_view_type = $args['view_type'];

$product_images_src = array_map(
	function ( $id ) {
		return wp_get_attachment_url( $id );
	},
	array_merge( $product->get_gallery_image_ids(), array( $product->get_image_id() ) )
);
?>

<div id="slider-product-<?php echo $product->get_id(); ?>" class="swiper slider-product">
  <div class="swiper-wrapper">
	<?php foreach ( $product_images_src as $src ) : ?>
	  <div class="swiper-slide">
		<picture>
		  <source srcset="" type="image/webp">
		  <source srcset="" type="image/jpeg">
		  <img src="<?php echo $src; ?>" alt="">
		</picture>
	  </div>
	<?php endforeach; ?>
  </div>
  <?php if ( $wv_loop_product_view_type ) : ?>
	<div class="swiper-pagination"></div>
  <?php endif; ?>
</div>
