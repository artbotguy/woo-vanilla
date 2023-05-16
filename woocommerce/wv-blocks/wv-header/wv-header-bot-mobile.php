<?php
/**
 * Menu catalog mobile //
 *
 * @package WooVanilla
 */
?>

<div class="wv-header-bot-mobile">
  <div class="offcanvas offcanvas-md offcanvas-start wv-header-bot-mobile__offcanvas" tabindex="-1" id="offcanvasCatalog">
	<div class="offcanvas-header">
	  <?php woovanilla_template_header_description(); ?>
	  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body wv-header-bot-mobile__body">
	  <?php wc_get_template( 'wv-blocks/wv-header-search.php' ); ?>
	  <div class="wv-header-bot-mobile__catalog">
		<div class="wv-header-bot-mobile__title">Каталог товаров</div>
		<?php
		wv_nav_menu(
			array(
				'theme_location'              => 'categories_header',
				'walker'                      => new WooVanilla\Core\Walker_Bootstrapped_Menu(),
				'container'                   => false,
				'menu_class'                  => 'menu wv-dropdown-menu wv-menu-categories wv-menu-categories_location_header placeholder',
				'wv_bootstrap_type_component' => 'dropdown',
				'menu_id'                     => 'menu-categories_header',
			)
		);
		?>
	  </div>
	</div>
  </div>
</div>
