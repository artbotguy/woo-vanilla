<?php

namespace Awps\Setup;

/**
 * Enqueue.
 */
class Enqueue
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	/**
	 * Notice the mix() function in wp_enqueue_...
	 * It provides the path to a versioned asset by Laravel Mix using querystring-based 
	 * cache-busting (This means, the file name won't change, but the md5. Look here for 
	 * more information: https://github.com/JeffreyWay/laravel-mix/issues/920 )
	 */
	public function enqueue_scripts()
	{
		// Deregister the built-in version of jQuery from WordPress
		if (!is_customize_preview()) {
			wp_deregister_script('jquery');
		}
		// CSS
		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css', array(), '1.0.0', 'all');
		wp_enqueue_style('main-css', mix('css/style.css'), array(), '1.0.0', 'all');
		// wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/dist/css/bootstrap.min.css', array(), '1.0.0', 'all');

		// JS
		wp_enqueue_script('main-js', mix('js/app.js'), array(), '1.0.0', true);
		// wp_enqueue_script('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array('main'), '1.0.0', 'all');

		// Activate browser-sync on development environment
		if (getenv('APP_ENV') === 'development') :
			wp_enqueue_script('__bs_script__', getenv('WP_SITEURL') . ':3000/browser-sync/browser-sync-client.js', array(), null, true);
		endif;

		// Extra
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
