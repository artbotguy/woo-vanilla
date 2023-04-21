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

	<div class="xoo-wsc-header">

		<?php do_action( 'xoo_wsc_header_start' ); ?>

		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-header.php' ); ?>

		<?php do_action( 'xoo_wsc_header_end' ); ?>

	</div>


	<div class="xoo-wsc-body">

		<?php do_action( 'xoo_wsc_body_start' ); ?>

		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-body.php' ); ?>

		<?php do_action( 'xoo_wsc_body_end' ); ?>

	</div>

	<div class="xoo-wsc-footer">

		<?php do_action( 'xoo_wsc_footer_start' ); ?>

		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-footer.php' ); ?>

		<?php do_action( 'xoo_wsc_footer_end' ); ?>

	</div>

	<span class="xoo-wsc-loader"></span>

</div>
