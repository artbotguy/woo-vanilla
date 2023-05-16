<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package WooVanilla
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="icons-sprite">
	<?php
	svg( 'icons-sprite' );
	?>
	</div>

	<?php wp_body_open(); ?>
	<div id="page" class="">
		<header class="header">
			<div class="container-lg">
				<div class="header__body">
					<?php
					wc_get_template( 'wv-blocks/wv-header/wv-header-top.php' );
					wc_get_template( 'wv-blocks/wv-header/wv-header-main.php' );
					wc_get_template( 'wv-blocks/wv-header/wv-header-bot.php' );
					wc_get_template( 'wv-blocks/wv-header/wv-header-mobile-menu.php' );
					?>
				</div>
			</div>
		</header>
		<div id="content" class="site-content">
