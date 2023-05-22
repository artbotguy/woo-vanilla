<?php
/**
 * Side Cart Header
 *
 * @package WooVanilla
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

extract( Xoo_Wsc_Template_Args::cart_header() );

?>

	<div class="wv-offcanvas__title offcanvas-title">Корзина</div>
	<button type="button" class="wv-offcanvas__btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
