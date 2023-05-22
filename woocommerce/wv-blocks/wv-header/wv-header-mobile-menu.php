<?php
/**
 * Header Mobile Menu
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="wv-header-mobile-menu fixed-bottom bg-body">
  <div class="wv-header-mobile-menu__body">
	<div class="wv-header-mobile-menu__list">
	  <a href="#" class="col wv-link-item wv-header-mobile-menu__item" href="<?php home_url( '/' ); ?>">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-main"></use>
		</svg>
		<div class="wv-link-item__title">Главная</div>
	  </a>
	  <a href="#" class="col wv-link-item wv-header-mobile-menu__item" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-catalog"></use>
		</svg>
		<div class="wv-link-item__title">Каталог</div>
	  </a>

			  </a>
				<a href="#" id="linkCart" data-bs-target="#offcanvasCart" data-bs-toggle="offcanvas" class="col wv-link-item wv-link-item wv-header-mobile-menu__item">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-cart"></use>
		</svg>
		<div class="wv-link-item__title">Корзина</div>
		<div class="wv-cart-count"><span>
			<?php
			echo xoo_wsc_cart()->get_cart_count();
			?>
			</span></div>
	  </a>
<!-- 
		<a href="#" id="linkCart" class="added_to_cart xoo-wsc-cart-trigger col wv-link-item wv-link-item wv-header-mobile-menu__item">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-cart"></use>
		</svg>
		<div class="wv-link-item__title">Корзина</div>
		<div class="wv-cart-count"><span>
		<?php
		// echo xoo_wsc_cart()->get_cart_count();
		?>
		</span></div>
		</a> -->

	  <a href="<?php echo home_url( 'wishlist' ); ?>" id="linkWishlist" class="col wv-link-item wv-header-mobile-menu__item" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlist">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-wish"></use>
		</svg>
		<div class="wv-link-item__title">Избранное</div>
	  </a>
	  <a href="#" id="linkMyOrders" class="col wv-link-item wv-header-mobile-menu__item" role="button">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-profile"></use>
		</svg>
		<div class="wv-link-item__title">Мои заказы</div>
	  </a>
	</div>
  </div>
</div>
