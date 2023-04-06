<?php

/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>

<div class="container">

	<?php

	get_template_part(
		'views/public/components/sliders/slider-products',
		null,
		[
			'title' => 'Новинки',
			'params' =>
			[
				// 'orderby' => 'date'
			],
		]
	);
	get_template_part(
		'views/public/components/product-lists/product-list-catalog',
		null,
		[
			'params' =>
			[],
		]
	);
	?>

</div>

<?php
get_footer();
