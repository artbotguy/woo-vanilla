<?php
$products = wc_get_products($args['params']);

?>

<section class="slider-products">
  <div class="slider-products__head">
    <h2 class="slider-products__title"><?php echo $args['title']; ?></h2>
    <div class="slider-products__arrow">
      <svg class="icon">
        <use xlink:href="#sprite-arrow-long"></use>
      </svg>
    </div>
  </div>
  <div class="swiper">
    <div class="swiper-wrapper">
      <?php
      foreach ($products as $product) :
      ?>
        <div class="swiper-slide">
          <?php get_template_part(
            'views/public/components/products/product',
            null,
            ['view_type' => 'slider', 'product' => $product]
          ); ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</section>