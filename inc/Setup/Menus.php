<?php

namespace Awps\Setup;

/**
 * Menus
 */
class Menus
{
    /**
     * register default hooks and actions for WordPress
     * @return
     */
    public function register()
    {
        add_action('after_setup_theme', array($this, 'menus'));
    }

    public function menus()
    {
        /*
            Register all your menus here
        */
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'awps'),
            'navigation' => esc_html__('navigation'),
            'info' => esc_html__('info'),
            // 'categories' => esc_html__('categories'),
            'catalog' => esc_html__('catalog'),
        ));
    }
}
