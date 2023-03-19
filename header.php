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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="icons-sprite"><?php svg('icons-sprite'); ?></div>

	<?php wp_body_open(); ?>
	<div id="page" class="site" <?php echo !is_customize_preview() ?: 'style="padding: 0 40px;"'; ?>>

		<header id="masthead" class="header site-header" role="banner">

			<?php
			// if (is_customize_preview()) {
			// 	echo '<div id="awps-header-control"></div>';
			// }
			?>

			<div class="header__body">
				<div class="container container-fluid">
					<div class="row">
						<?php get_template_part('views/public/components/header/header-nav-menu'); ?>
					</div>
					<div class="row">
						<?php get_template_part('views/public/components/header/header-main-menu'); ?>
					</div>
					<div class="row">
						<?php get_template_part('views/public/components/header/header-catalog-menu'); ?>
					</div>
					<?php get_template_part('views/public/components/header/header-actions-mobile'); ?>
				</div>
		</header>

		<div id="content" class="site-content">