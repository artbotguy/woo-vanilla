<?php
/**
 * Header Main Call
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wv-header-main placeholder-wave">
  <div class="wv-header-main__body placeholder">
  <?php wc_get_template( 'wv-blocks/wv-header/wv-header-main/wv-header-main-logo.php' ); ?>
  <?php wc_get_template( 'wv-blocks/wv-header/wv-header-main/wv-header-main-call.php' ); ?>
  <?php wc_get_template( 'wv-blocks/wv-header/wv-header-main/wv-header-main-search.php' ); ?>
  <?php wc_get_template( 'wv-blocks/wv-header/wv-header-main/wv-header-main-wishlist.php' ); ?>
  <?php wc_get_template( 'wv-blocks/wv-header/wv-header-main/wv-header-main-cart.php' ); ?>
  </div>
</div>
