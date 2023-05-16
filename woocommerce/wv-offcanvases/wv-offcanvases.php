<?php
/**
 * Offcanvases
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<?php
get_template_part( 'views/public/components/cart/cart-offcanvas' );

wc_get_template( 'wv-blocks/wv-header/wv-header-bot-mobile.php' );
wc_get_template( 'wv-offcanvases/wv-offcanvas-header-top.php' );
