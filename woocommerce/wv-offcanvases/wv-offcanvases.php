<?php
/**
 * Offcanvases
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wv-offcanvases">
  <?php
	wc_get_template( 'wv-blocks/wv-header/wv-header-bot-mobile.php' );

	wc_get_template( 'wv-offcanvases/wv-offcanvas-header-top.php' );
	wc_get_template( 'wv-offcanvases/wv-offcanvas-wishlist.php' );
	wc_get_template( 'wv-offcanvases/wv-offcanvas-cart.php' );
	?>
</div>
