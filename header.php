<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package awps
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link href="https://fonts.googleapis.com/css?family=Yeseva+One:regular" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900)" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="icons-sprite"><?php svg('icons-sprite'); ?></div>

	<?php wp_body_open(); ?>
	<div id="page" class="site" <?php echo !is_customize_preview() ?: 'style="padding: 0 40px;"'; ?>>
		<header class="header site-header">

			<?php
			// if (is_customize_preview()) {
			// 	echo '<div id="awps-header-control"></div>';
			// }
			?>
			<div class="container">
				<div class="header__body">
					<?php get_template_part('views/public/components/header/header-menu-nav'); ?>
					<?php get_template_part('views/public/components/header/header-menu-main'); ?>
					<?php get_template_part('views/public/components/header/header-menu-catalog'); ?>
					<?php get_template_part('views/public/components/header/header-actions'); ?>
				</div>
			</div>



		</header>

		<div id="content" class="site-content">