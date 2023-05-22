<?php
/**
 * Side Cart Container
 *
 * @package WooVanilla
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( Xoo_Wsc_Template_Args::cart_container() );

?>

<div class="xoo-wsc-container">

	<div class="wv-offcanvas__header xoo-wsc-header offcanvas-header">
		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-header.php' ); ?>
	</div>

	<div class="wv-offcanvas__body offcanvas-body xoo-wsc-body">
		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-body.php' ); ?>
	</div>

	<div class="wv-offcanvas__footer xoo-wsc-footer">
		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-footer.php' ); ?>
	</div>

	<span class="xoo-wsc-loader"></span>

</div>
