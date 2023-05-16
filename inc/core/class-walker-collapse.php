<?php

namespace WooVanilla\Core;

use Walker_Nav_Menu;

/**
 * Пришлось переопределить пару методов - в start_lvl() нет индекса верхнего элемента меню.
 * Добавлен аргумент $wv_index_top_lvl_element, который позволяет (в комбинации с menu_id)
 * сделать id подменю уникальным (например для bs-collapse)
 * Изменения заторнули сигнатуры функций start_lvl(), walk(), display_element(),
 * в функции walk() изменен перебор топ-элементов.
 */
class Walker_Collapse extends Walker_Nav_Menu {

	/**
	 * Undocumented function
	 *
	 * @param [type]  $output the comment param.
	 * @param integer $depth the comment param.
	 * @param array   $top_level_elements the comment param.
	 * @param integer $wv_index_top_lvl_element the comment param.
	 * @param [type]  $args the comment param.
	 */
	function start_lvl( &$output, $depth = 0, $wv_index_top_lvl_element = 0, $args = null ) {
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$display_depth = ( $depth + 1 );
		$classes       = array(
			'menu-sub',
			( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
			( $display_depth >= 2 ? 'menu-sub-sub' : '' ),
			'menu-depth-' . $display_depth,
		);
		$class_names   = implode( ' ', $classes );

		$output .= "\n" . $indent .
		'<ul class="' . $class_names . ' collapse" id="collapse-' .
		$args->menu->term_id . '-' . $wv_index_top_lvl_element .
		// '" class="collapse" data-bs-parent="#' . $args->menu_id .
		'">' . "\n";
	}

	/**
	 * Undocumented function
	 *
	 * @param [type]  $output the comment param.
	 * @param [type]  $data_object the comment param.
	 * @param integer $depth the comment param.
	 * @param [type]  $args the comment param.
	 * @param integer $current_object_id the comment param.
	 */
	function start_el( &$output, $data_object, $wv_index_top_lvl_element = 0, $depth = 0, $args = null, $current_object_id = 0 ) {
		global $wp_query;

		$item = $data_object;

		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		$depth_classes     = array(
			( $depth == 0 ? 'menu-main__item' : 'menu-sub__item' ),
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
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		if ( $depth === 0 ) {
			$item_output .= sprintf(
				'<button class="wv-universal-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-%s"></button>',
				$args->menu->term_id . '-' . $wv_index_top_lvl_element
			);
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $elements the comment param.
	 * @param [type] $max_depth the comment param.
	 * @param [type] ...$args the comment param.
	 */
	public function walk( $elements, $max_depth, ...$args ) {
		$output = '';

		// Invalid parameter or nothing to walk.
		if ( $max_depth < -1 || empty( $elements ) ) {
			return $output;
		}

		$parent_field = $this->db_fields['parent'];

		// Flat display.
		if ( -1 == $max_depth ) {
			$empty_array = array();
			foreach ( $elements as $e ) {
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			}
			return $output;
		}

		/*
		* Need to display in hierarchical order.
		* Separate elements into two buckets: top level and children elements.
		* Children_elements is two dimensional array. Example:
		* Children_elements[10][] contains all sub-elements whose parent is 10.
		*/
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e ) {
			if ( empty( $e->$parent_field ) ) {
				$top_level_elements[] = $e;
			} else {
				$children_elements[ $e->$parent_field ][] = $e;
			}
		}

		/*
		* When none of the elements is top level.
		* Assume the first one must be root of the sub elements.
		*/
		if ( empty( $top_level_elements ) ) {

			$first = array_slice( $elements, 0, 1 );
			$root  = $first[0];

			$top_level_elements = array();
			$children_elements  = array();
			foreach ( $elements as $e ) {
				if ( $root->$parent_field == $e->$parent_field ) {
					$top_level_elements[] = $e;
				} else {
					$children_elements[ $e->$parent_field ][] = $e;
				}
			}
		}

		// #WooVanilla#
		/**
		 * Проискодит перебор элементов меню верхнего уровня. Добавлен аргумент $wv_index_top_lvl_element,
		 * который позволяет сделать id подменю уникальным
		 */
		for ( $i = 0; $i < count( $top_level_elements ); $i++ ) {
			$e = $top_level_elements[ $i ];
			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output, $i );
		}
		// #WooVanilla#

		/*
		* If we are displaying all levels, and remaining children_elements is not empty,
		* then we got orphans, which should be displayed regardless.
		*/
		if ( ( 0 == $max_depth ) && count( $children_elements ) > 0 ) {
			$empty_array = array();
			foreach ( $children_elements as $orphans ) {
				foreach ( $orphans as $op ) {
					$this->display_element( $op, $empty_array, 1, 0, $args, $output );
				}
			}
		}

		return $output;
	}

	/**
	 * Undocumented function
	 *
	 * @param [type]  $element the comment param.
	 * @param [type]  $children_elements the comment param.
	 * @param [type]  $max_depth the comment param.
	 * @param [type]  $depth the comment param.
	 * @param [type]  $args the comment param.
	 * @param [type]  $output the comment param.
	 * @param array   $top_level_elements WooVanilla.
	 * @param integer $wv_index_top_lvl_element WooVanilla.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output, $wv_index_top_lvl_element = 0 ) {
		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		// Display this element.
		$this->has_children = ! empty( $children_elements[ $id ] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Back-compat.
		}

		$this->start_el( $output, $element, $wv_index_top_lvl_element, $depth, ...array_values( $args ) );

		// Descend only when the depth is right and there are children for this element.
		if ( ( 0 == $max_depth || $max_depth > $depth + 1 ) && isset( $children_elements[ $id ] ) ) {

			foreach ( $children_elements[ $id ] as $child ) {

				if ( ! isset( $newlevel ) ) {
					$newlevel = true;
					// #WooVanilla#
					$this->start_lvl( $output, $depth, $wv_index_top_lvl_element, ...array_values( $args ) );
					// #WooVanilla#
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset( $newlevel ) && $newlevel ) {
			// End the child delimiter.
			$this->end_lvl( $output, $depth, ...array_values( $args ) );
		}

		// End this element.
		$this->end_el( $output, $element, $depth, ...array_values( $args ) );
	}
}
