<?php

namespace WooVanilla\Core;

use Walker_Nav_Menu;

/**
 * Undocumented class
 */
class Walker_Dropdown extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$display_depth = ( $depth + 1 );
		$classes       = array(
			'menu-sub',
			( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
			( $display_depth >= 2 ? 'menu-sub-sub' : '' ),
			'menu-depth-' . $display_depth,
		);
		$class_names   = implode( ' ', $classes );

		$output .= "\n" . $indent . '<ul class="' . 'dropdown-menu ' . $class_names . '">' . "\n";
	}

	function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		global $wp_query;

		$item = $data_object;

		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		$depth_classes     = array(
			( $depth == 0 ? 'dropdown menu-main__item' : 'menu-sub__item' ),
			( $depth >= 2 ? 'menu-sub-sub__item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '<li id="menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'menu-sub__link' : 'menu-main__link' ) . '"';

		$item_output = sprintf(
			( $depth == 0 ? '<span class="wv-universal-toggle" data-bs-toggle="dropdown"></span>' : '' ) . '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
