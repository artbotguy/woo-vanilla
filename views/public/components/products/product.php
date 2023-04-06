<?php

$product = $args['product'];
$view_type = $args['view_type'] === 'catalog' ? true : false;

if ($product->is_type('variable') && !$view_type) {
  $product = wc_get_product($product->get_visible_children()[0]);
}

$sale_percent = null;
if (!empty($product->get_sale_price()) && !empty($product->get_sale_price())) {
  $sale_percent = ceil(100 - (((int)$product->get_sale_price() / (int)$product->get_regular_price()) * 100));
}

?>

<div class="product">
  <div class="product__head">
    <div class="product__labels">
      <?php if (get_the_time('U', $product->get_id()) > time() - 7 * 24 * 3600) : ?>
        <div class="product__label">New</div>
      <?php endif; ?>
      <?php if ($sale_percent) : ?>
        <div class="product__label">- <?php echo $sale_percent; ?> %</div>
      <?php endif; ?>
      <!-- <?php if (1) : ?>
          <div class="product__label-bestseller"></div>
        <?php endif; ?> -->

    </div>
    <div class="product__head-actions">
      <button data-tinvwl_product_id="<?php echo $product->get_id(); ?>" class="link-item link-item_type_circle product__wishlist">
        <svg class="icon">
          <use xlink:href="#sprite-wish"></use>
        </svg>
      </button>
      <?php if ($view_type) : ?>
        <button class="link-item link-item_type_circle product__preview">
          <svg class="icon">
            <use xlink:href="#sprite-watch"></use>
          </svg>
        </button>
      <?php endif; ?>
    </div>
  </div>
  <?php get_template_part(
    'views/public/components/sliders/slider-product',
    null,
    [
      'product' => $product,
      'view_type' => $view_type
    ]
  ); ?>
  <div class="product__content">
    <div class="product__content-top">
      <div class="product__name"><?php echo $product->get_name(); ?></div>
      <?php if ($view_type) : ?>
        <?php get_template_part('views/public/components/product/product-catalog-actions', null, ['product' => $product]); ?>
      <?php else : ?>
        <div class="product__dimensions">
          <div class="product__dimension">
            <span><?php echo $product->get_height(); ?></span>
            <span><?php echo $product->get_width(); ?></span>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="product__content-bot">
      <div class="product__prices">
        <div class="product__sale-price"><?php echo $product->get_sale_price(); ?></div>
        <div class="product__regular-price"><?php echo $product->get_regular_price(); ?></div>
      </div>
      <button class="product__add-to-cart">В корзину</button>
    </div>
  </div>
</div>