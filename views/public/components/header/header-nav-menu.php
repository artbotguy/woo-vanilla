<div class="header-nav-menu">
  <div class="d-flex align-items-center header-nav-menu__head">
    <!-- header-shedule -->
    <div class="btn me-3 header-nav-menu__icon" data-bs-toggle="modal" data-bs-target="#navModal">
      <span></span><span></span><span></span>
    </div>
    <?php get_template_part('views/public/components/header/header-description'); ?>
    <div class="ms-auto header-nav-menu__local-contacts">
      <svg class="icon">
        <use xlink:href="#sprite-call"></use>
      </svg>
    </div>
  </div>

  <div class="modal fade" id="navModal" tabindex="-1" aria-labelledby="navModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <?php get_template_part('views/public/components/header/header-shedule'); ?>
          <div class="header-nav-menu__items">
            <nav id="site-navigation" class="col main-navigation" role="navigation">

              <?php
              $navigation =  wp_get_nav_menu_items('navigation');
              $info =  wp_get_nav_menu_items('info');
              for ($i = 0; $i < count($navigation); $i++) :
                $item = $navigation[$i];
                echo '<pre><b>', __FILE__, __LINE__, '</b><br>', print_r($item, 1), '</pre>';
              ?>

                <li class="<?php echo $item['id'] === 772 ? 'info' : ''; ?>"><a href="<?php $item['url']; ?>"></a></li>
              <?php
              endfor;

              ?>
            </nav>
          </div>
          <?php get_template_part('views/public/components/header/header-contacts'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!--              
                  
wp_nav_menu(
                array(
                  'theme_location' => 'navigation',
                  'fallback_cb' => ''
                )
              );
              wp_nav_menu(
                array(
                  'theme_location' => 'info',
                  'fallback_cb' => ''
                )
              ); 
            -->