<?php
$navigation =  wp_get_nav_menu_items('navigation');
$info =  wp_get_nav_menu_items('info');
?>
<nav class="navbar navbar-expand-md fixed-top d-flex header-menu-nav">
  <div class="d-flex align-items-center flex-grow-1 header-menu-nav__head">
    <!-- header-shedule -->
    <button class="navbar-toggler btn me-3 header-menu-nav__icon btn-minimal" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav">
      <span></span><span></span><span></span>
    </button>
    <?php get_template_part('views/public/components/header/header-description'); ?>
    <div class="ms-auto header-menu-nav__local-contacts">
      <a target="_blank" rel="noopener noreferrer" href="https://vk.com/" id="linkVK">
        <svg class="icon">
          <use xlink:href="#sprite-vk"></use>
        </svg>
      </a>
      <a href="whatsapp://send?abid=+79308360370&text=Hello%2C%20World!" id="linkWA">
        <svg class="icon">
          <use xlink:href="#sprite-wa"></use>
        </svg>
      </a>
      <a href="tel:+79308360370" id="linkCall">
        <svg class="icon">
          <use xlink:href="#sprite-call"></use>
        </svg>
      </a>
    </div>

  </div>
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav">
    <div class="offcanvas-header border-bottom">
      <?php get_template_part('views/public/components/header/header-shedule'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div id="navigation" class="header-menu-nav__nav header-nav-menu" role="navigation">
        <ul class="header-nav-menu__items header-nav-menu__items_type_main">
          <?php
          for ($i = 0; $i < count($navigation); $i++) :
            $item = $navigation[$i];
          ?>
            <?php if ($item->ID !== 772) : ?>
              <li id="nav-menu-item-<?php echo $item->ID; ?>" class="nav-item header-nav-menu__item">
                <a class="nav-link header-nav-menu__link" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
              </li>
            <?php else : ?>
              <li id="nav-menu-item-<?php echo $item->ID; ?>" class="nav-item header-nav-menu__item <?php echo $item->ID === 772 ? 'header-nav-menu__item_info' : ''; ?>">
                <a class="nav-link icon-after_m header-nav-menu__link header-nav-menu__link_info" href="<?php echo $item->url; ?>">
                  <?php echo $item->title; ?>
                </a>
              </li>

            <?php endif; ?>
          <?php
          endfor;
          ?>
        </ul>
        <ul class="dropdown-menu header-nav-menu__items header-nav-menu__items_type_info">
          <?php
          for ($i = 0; $i < count($info); $i++) :
            $item = $info[$i];
          ?>
            <li id="nav-menu-item-<?php echo $item->ID; ?>" class="nav-item header-nav-menu__item">
              <a class="nav-link header-nav-menu__link" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
            </li>
          <?php
          endfor;
          ?>
        </ul>
      </div>
      <?php get_template_part('views/public/components/header/header-contacts'); ?>
    </div>
  </div>
</nav>