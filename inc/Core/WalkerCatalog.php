<?php

namespace Awps\Core;

use Walker_Nav_Menu;

class WalkerCatalog extends Walker_Nav_Menu
{

  // add classes to ul subs
  function start_lvl(&$output, $depth = 0, $args = NULL)
  {
    // depth dependent classes
    $indent = ($depth > 0  ? str_repeat("\t", $depth) : ''); // code indent
    $display_depth = ($depth + 1); // because it counts the first submenu as 0
    $classes = array(
      'menu-sub',
      ($display_depth % 2  ? 'menu-odd' : 'menu-even'),
      ($display_depth >= 2 ? 'menu-sub-sub' : ''),
      'menu-depth-' . $display_depth
    );
    $class_names = implode(' ', $classes);

    // build html
    $output .= "\n" . $indent . '<ul class="' . 'dropdown-menu ' . $class_names . '">' . "\n";
  }

  // add main/sub classes to li's and links
  function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
  {
    global $wp_query;

    // Restores the more descriptive, specific name for use within this method.
    $item = $data_object;

    $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent

    // depth dependent classes
    $depth_classes = array(
      ($depth == 0 ? 'dropdown menu-main__item' : 'menu-sub__item'),
      ($depth >= 2 ? 'menu-sub-sub__item' : ''),
      ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
      'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr(implode(' ', $depth_classes));

    // passed classes
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

    // build html
    $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // link attributes
    $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
    $attributes .= ' class="menu-link ' . ($depth > 0 ? 'menu-sub__link' : 'menu-main__link') . '"';

    $item_output = sprintf(
      ($depth == 0 ? '<span class="dropdown-toggle" data-bs-toggle="dropdown"></span>' : '') . '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters('the_title', $item->title, $item->ID),
      $args->link_after,
      $args->after
    );

    // build html
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
