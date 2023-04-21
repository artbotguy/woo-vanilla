<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woovanilla
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
	<div class="icons-sprite"><?php svg( 'icons-sprite' ); ?></div>

	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header class="header site-header">
			<div class="container">
				<div class="header__body">
					<?php get_template_part( 'views/public/components/header/header-menu-nav' ); ?>
					<?php get_template_part( 'views/public/components/header/header-menu-main' ); ?>
					<?php get_template_part( 'views/public/components/header/header-menu-catalog' ); ?>
					<?php get_template_part( 'views/public/components/header/header-actions' ); ?>
				</div>
			</div>
		</header>
		<div id="content" class="site-content">
