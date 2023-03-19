<div class="catalog-menu">
  <div class="catalog-menu__body">
    <div class="catalog-menu__items">
      <?php
      if (has_nav_menu('catalog')) :
        wp_nav_menu(
          array(
            'theme_location' => 'catalog',
          )
        );
      endif;
      ?>
    </div>
  </div>
</div>