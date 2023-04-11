<?php
$product = $args['product'];
$var_attrs = $product->get_variation_attributes();
$sizes = $var_attrs['pa_razmer'];
?>


<div class="product-catalog-actions">
  <div class="product-catalog-actions__reviews">
    <svg class="icon">
      <use xlink:href="#sprite-star"></use>
    </svg>
    <div class="product-catalog-actions__rating"></div>
    <div class="product-catalog-actions__reviews-quantity"></div>
  </div>
  <div class="product-catalog-actions__time-delivery">150 мин</div>
  <div class="product-catalog-actions__type-size">
    <div class="product-catalog-actions__type-size-title">Размер:</div>
    <div class="product-catalog-actions__type-size-list">
      <?php foreach ($sizes as $attr_name) : ?>
        <button class="product-catalog-actions__type-size-el<?php count($sizes) === 1 ? 'product-catalog-actions__type-size-el_active' : ''; ?>">
          <?php echo $attr_name; ?>
        </button>
      <?php endforeach; ?>
    </div>
  </div>


</div>