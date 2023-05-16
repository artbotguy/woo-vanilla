<div class="offcanvas offcanvas-start wv-offcanvas-header-top" tabindex="-1" id="offcanvasNav">
	<div class="offcanvas-header">
	  <?php
		woovanilla_template_header_shedule();
		?>
	  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
<?php
	wv_nav_menu(
		array(
			'theme_location'              => 'navigation',
			'walker'                      => new WooVanilla\Core\Walker_Bootstrapped_Menu(),
			'container'                   => false,
			'menu_class'                  => 'menu wv-dropdown-menu wv-menu-navigation wv-menu-navigation_location_header placeholder',
			'menu_id'                     => 'menu-navigation',
			'wv_bootstrap_type_component' => 'dropdown',
			'menu_id'                     => 'menu-navigation_header',

		)
	);
	?>
	  <?php wc_get_template( 'wv-blocks/wv-header-contacts.php' ); ?>
	</div>
  </div>
