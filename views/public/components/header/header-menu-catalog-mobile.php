<div class="header-menu-catalog-mobile">
  <div class="offcanvas offcanvas-md offcanvas-start header-menu-catalog-mobile__offcanvas" tabindex="-1" id="offcanvasCatalog">
    <div class="offcanvas-header">
      <?php get_template_part('views/public/components/header/header-description'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body header-menu-catalog-mobile__body">
      <?php get_template_part('views/public/components/header/header-search'); ?>
      <div class="pb-4 header-menu-catalog-mobile__catalog">
        <div class="header-menu-catalog-mobile__title">Каталог товаров</div>
        <?php get_template_part('views/public/components/header/header-menu-catalog/header-menu-catalog-items'); ?>
      </div>
    </div>
  </div>
</div>