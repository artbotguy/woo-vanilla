<!-- header-menu-catalog-mobile__items  -->

<?php
if ( has_nav_menu( 'catalog' ) ) :
	wp_nav_menu(
		array(
			'theme_location' => 'catalog',
			'walker'         => new WooVanilla\Core\Walker_Catalog(),
			'container'      => false,
			'menu_class'     => 'menu header-menu-catalog-items',
		),
	);
endif;
?>
