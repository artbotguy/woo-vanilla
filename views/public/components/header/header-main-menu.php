<div class="header-main-menu">
  <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="--bs-tertiary-color header-main-menu__logo">
    <?php svg('logo'); ?>
    <?php bloginfo('name'); ?>
  </a>
  <!-- header-description -->

  <?php get_template_part('views/public/components/header/header-search'); ?>

  <?php get_template_part('views/public/components/header/header-actions'); ?>

</div>