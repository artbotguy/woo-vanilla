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

	  <a href="<?php echo home_url(); ?>" class="wv-link-item wv-header-mobile-menu__item" href="<?php home_url( '/' ); ?>">
		<svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-main"></use>
		</svg>
		<div class="wv-link-item__title">Главная</div>
	  </a>

	  <a href="#" class="wv-link-item wv-header-mobile-menu__item" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog">
		<svg class="wv-icon-default wv-link-item__icon">
		  <use xlink:href="#sprite-catalog"></use>
		</svg>
		<div class="wv-link-item__title">Каталог</div>
	  </a>

		<a href="#" id="linkCart" data-bs-target="#offcanvasCart" data-bs-toggle="offcanvas" class="wv-link-item _wv-hovervable wv-link-item wv-header-mobile-menu__item">
		<!-- <svg class="wv-icon wv-link-item__icon">
		  <use xlink:href="#sprite-cart"></use>
		</svg> -->
		<?php svg( 'cart', 'icons' ); ?>
		<div class="wv-link-item__title">Корзина</div>
		<div class="wv-cart-count"><span>
			<?php
			echo xoo_wsc_cart()->get_cart_count();
			?>
			</span></div>
	  </a>

		<?php echo do_shortcode( '[ti_wishlist_products_counter]' ); ?>

	  <a href="#" id="linkMyOrders" class="wv-link-item wv-header-mobile-menu__item" role="button">
		<svg class="wv-icon-default wv-link-item__icon">
		  <use xlink:href="#sprite-profile"></use>
		</svg>
		<div class="wv-link-item__title">Мои заказы</div>
	  </a>
	</div>
  </div>
</div>
