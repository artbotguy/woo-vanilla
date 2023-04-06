<!-- header-menu-catalog-mobile__items  -->

<?php
if (has_nav_menu('catalog')) :
  wp_nav_menu(
    [
      'theme_location' => 'catalog',
      'walker' => new Awps\Core\WalkerCatalog,
      'container' => false,
      'menu_class' => 'menu header-menu-catalog-items'
    ],
  );
endif;
?>