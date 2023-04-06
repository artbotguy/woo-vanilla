<div class="header-menu-main">
  <div class="header-menu-main__body">
    <div class="header-menu-main__logo logo-header-menu-main">
      <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-header-menu-main__link">
        <?php svg('logo'); ?>
        <?php svg('logo-title'); ?>
      </a>
    </div>
    <div class="header-menu-main__call call-header-menu-main">
      <div class="call-header-menu-main__body">
        <div class="dropdown call-header-menu-main__dropdown">
          <a class="call-header-menu-main__call link-item link-item_type_circle" id="linkCall" href="tel:+79202114903">
            <svg class="link-item__icon icon">
              <use xlink:href="#sprite-call"></use>
            </svg>
          </a>
          <button class="btn dropdown-toggle icon-after_m call-header-menu-main__dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">+7 (920) 211-49-03
          </button>
          <div class="call-header-menu-main__request-call">Заказать звонок</div>
          <ul class="dropdown-menu call-header-menu-main__dropdown-menu">
            <!-- # -->
          </ul>
        </div>
      </div>

    </div>
    <div class="header-menu-main__search search-header-menu-main">
      <div class="search search-header-menu-main__wrapper" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog">
        <?php get_template_part('views/public/components/header/header-search'); ?>
      </div>
    </div>
    <div class="header-menu-main__wishlist wishlist-header-menu-main">
      <!-- #linkWishlist -->
    </div>
    <div class="header-menu-main__cart cart-header-menu-main">
      <!-- #linkCart -->
      <div class="cart-header-menu-main__price">16 500 ₽</div>
    </div>
  </div>
</div>