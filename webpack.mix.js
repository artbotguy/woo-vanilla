const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const { merge } = require('webpack-merge');
const mix = require('laravel-mix');
require('@tinypixelco/laravel-mix-wp-blocks');
const webpack = require('webpack');

mix.setPublicPath('./assets/dist');

/**
//  * Note: Непонятная ошибка с обработкой scss при подключенных скриптах  add-to-cart-variation / xoo-wsc-main
//  * с помощью функции mix(). Поэтому скомпилированные скрипты подключаются в ручную в 
//  * WooVanilla\Setup\Enqueue::enqueue_scripts() для корретной работы Hot Module Replacement с scss
 * При нерабочем HotReplacement необходимо проверить, везде ли есть соответсвие между
 * подлючаемым файлом из webpack.mix.js и функцией mix()
 * Так обновление стилей может не работать, если app.js используется в mix(), но не подкючен в 
 * webpack.mix.js
 */
mix
	.js('assets/src/scripts/wp/add-to-cart-variation.js', 'assets/dist/js')
	.js('assets/src/scripts/wp/xoo-wsc-main.js', 'assets/dist/js')
	.js('assets/src/scripts/wp/tinvwl-public.js', 'assets/dist/js')

	.js('assets/src/scripts/app.js', 'assets/dist/js')
	.sass('assets/src/sass/style.scss', 'assets/dist/css')
	/**
	* WVNOTE: Отключает копирование изображений, которые используются для background. Также отключает перезаписывание путей для семейств шрифтов до абсолютных (*)
	* WVNOTE: неочевидная логика - подключение и в prod и в build сборке возможно при
	* использовании шрифтов из папки assets/dist/dist/fonts - билдер в dev сборке
	* преобразует путь для шрифтов в абсолютный (несмотря на options.processCssUrls = FALSE)
* UPD: Не работало. Добавил ещё assets/dist/fonts - по итогу одна папка для prod, другая для dev

	**/
	.options({
		processCssUrls: false,
	});

const webpackConfig = {
	// WVNOTE: мб не надо так добавлять jQ в бандл...
	plugins: [
		new webpack.ProvidePlugin({
			$: '/home/artbot/dev/wc-docker-apache/html/wp-content/themes/woo-vanilla/node_modules/jquery/dist/jquery.min.js',
		}),
	],
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
						chunk: { keep: true }
					},
					styles: {
						// keepAttributes:
					},
				}),
			],
		})
	);
} else {
	mix.webpackConfig(
		merge(webpackConfig, {
			devtool: 'source-map',

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
