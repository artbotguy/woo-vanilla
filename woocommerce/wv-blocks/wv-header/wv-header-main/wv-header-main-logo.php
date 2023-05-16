<?php
/**
 * Header Main Logo
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wv-header-main-logo">
	  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="wv-header-main-logo__link">
		<?php svg( 'logo' ); ?>
		<?php svg( 'logo-title' ); ?>
	  </a>
	  <?php woovanilla_template_header_description(); ?>

	</div>
