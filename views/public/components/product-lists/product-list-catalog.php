<?php
$products = wc_get_products($args['params']);

?>
<div class="product-list-catalog">
  <div class="product-list-catalog__items">
    <?php
    foreach ($products as $product) :
    ?>
      <?php get_template_part(
        'views/public/components/products/product',
        null,
        ['view_type' => 'catalog', 'product' => $product]
      ); ?>
    <?php endforeach; ?>
  </div>
</div>