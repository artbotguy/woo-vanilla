<div class="header-actions fixed-bottom bg-body">
  <div class="header-actions__body">
    <div class="header-actions__list">
      <a href="#" class="col link-item header-actions__item" href="<?php home_url('/'); ?>">
        <svg class="icon link-item__icon">
          <use xlink:href="#sprite-main"></use>
        </svg>
        <div class="link-item__title">Главная</div>
      </a>
      <a href="#" class="col link-item header-actions__item" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog">
        <svg class="icon link-item__icon">
          <use xlink:href="#sprite-catalog"></use>
        </svg>
        <div class="link-item__title">Каталог</div>
      </a>
      <a href="#" id="linkCart" class="col link-item link-item header-actions__item" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart">
        <svg class="icon link-item__icon">
          <use xlink:href="#sprite-cart"></use>
        </svg>
        <div class="link-item__title">Корзина</div>
        <div class="cart-count"><span>2</span></div>
      </a>
      <a href="<?php echo home_url('wishlist'); ?>" id="linkWishlist" class="col link-item header-actions__item" role="button">
        <svg class="icon link-item__icon">
          <use xlink:href="#sprite-wish"></use>
        </svg>
        <div class="link-item__title">Избранное</div>
      </a>
      <a href="#" id="linkMyOrders" class="col link-item header-actions__item" role="button">
        <svg class="icon link-item__icon">
          <use xlink:href="#sprite-profile"></use>
        </svg>
        <div class="link-item__title">Мои заказы</div>
      </a>
    </div>
  </div>
</div>