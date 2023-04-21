const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const { merge } = require('webpack-merge');
const mix = require('laravel-mix');
require('@tinypixelco/laravel-mix-wp-blocks');
const path = require('path');
// const jQuery = require('/home/artbot/dev/wc-docker-apache/html/wp-content/themes/woo-vanilla/node_modules/jquery/dist/jquery.min.js');
const webpack = require('webpack');

// mix.autoload({
// 	jquery: ['$', 'window.jQuery', 'jQuery'],
// });

mix.setPublicPath('./assets/dist');

// Compile assets.
mix
	.js('assets/src/scripts/wp/add-to-cart-variation.js', 'assets/dist/js')
	.js('assets/src/scripts/wp/xoo-wsc-main.js', 'assets/dist/js')
	.js('assets/src/scripts/app.js', 'assets/dist/js')
	.js('assets/src/scripts/admin.js', 'assets/dist/js')

	.block('assets/src/scripts/gutenberg.js', 'assets/dist/js')
	.sass('assets/src/sass/admin.scss', 'assets/dist/css')
	.sass('assets/src/sass/gutenberg.scss', 'assets/dist/css')
	// .sass('assets/src/sass/bootstrap.scss', 'assets/dist/css')
	.sass('assets/src/sass/style.scss', 'assets/dist/css')


const webpackConfig = {
	// optimization: {
	// 	runtimeChunk: 'single'
	// },
	resolve: {
		alias: {
			// jquery: path.join(__dirname, 'node_modules/jquery/src/jquery'),
		},
	},
};
// Add source map and versioning to assets in production environment.
if (mix.inProduction()) {
	mix.sourceMaps().version();

	mix.webpackConfig(
		merge(webpackConfig, {
			module: {
				rules: [],
			},
			plugins: [
				new SVGSpritemapPlugin('./assets/src/images/svg/*.svg', {
					output: {
						filename: 'images/svg/inline-icons-sprite.svg.php',
					},
					styles: {
						// keepAttributes:
					},
				}),
			],
		})
	);
	// mix.copy('./assets/src/images/svg/', './assets/dist/images/svg/sprite-icons/')
} else {
	mix.webpackConfig(
		merge(webpackConfig, {
			devtool: 'source-map',
			plugins: [
				new webpack.ProvidePlugin({
					$: '/home/artbot/dev/wc-docker-apache/html/wp-content/themes/woo-vanilla/node_modules/jquery/dist/jquery.min.js',
					// jQuery: '/home/artbot/dev/wc-docker-apache/html/wp-content/themes/woo-vanilla/node_modules/jquery/dist/jquery.min.js',
				}),
			],
		})
	);
	mix.browserSync({
		proxy: 'http://localhost',
		files: [
			'**/*.php',
			// 'views/**/*.php'
		],
		notify: false,
		open: false,
	});
}

mix.webpackConfig(webpackConfig);

mix.disableNotifications();
