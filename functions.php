<?php
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// xdebug_info();

/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `inc/Custom/Custom.php` to write your custom functions
 *
 * @package awps
 */

include 'inc/template-functions.php';

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) :
	require_once dirname(__FILE__) . '/vendor/autoload.php';
endif;

if (class_exists('Awps\\Init')) :
	Awps\Init::register_services();
endif;


function wv_get_template($path, $args = [])
{
	wc_get_template($path, $args, '', get_template_directory() . '/templates/');
}

function woovanilla_do_shortcode($tag, array $atts = array(), $content = null)
{
	global $shortcode_tags;

	if (!isset($shortcode_tags[$tag])) {
		return false;
	}

	return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
}
