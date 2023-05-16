<?php
/**
 * Header Main Cart
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wv-header-main-cart">
  <!-- #linkCart -->

  <div class="wv-header-main-cart__price"><?php xoo_wsc_helper()->get_template( 'global/footer/totals.php' ); ?></div>
</div>
