<?php

/*
*	Split Navigation Walker
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( !class_exists('Crocal_Eutf_Split_Navigation_Walker') ) {

	class Crocal_Eutf_Split_Navigation_Walker extends Walker_Nav_Menu {

		var $current_menu = null;
		var $break_point = null;

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			//---------------------------
			if( !isset( $this->current_menu ) ) {
				if( isset( $args->theme_location ) && !empty( $args->theme_location ) ) {
					if( ($locations = get_nav_menu_locations() ) && isset( $locations[$args->theme_location] ) ) {
						$this->current_menu = wp_get_nav_menu_object( $locations[$args->theme_location] );
					}
				} else {
					$this->current_menu = wp_get_nav_menu_object( $args->menu );
				}
			}
			if( !isset( $this->break_point ) ) {
					$menu = $this->current_menu;
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					$temp_menu = array();
					foreach($menu_items as $current_menu_item){
					   if($current_menu_item->menu_item_parent != 0) continue;
					   array_push($temp_menu, $current_menu_item->menu_order);
					}
					if( !empty( $temp_menu ) ) {
						$len = count($temp_menu);
						$split_menu_item_position = crocal_eutf_option( 'split_menu_item_position', 'left' );
						if ( 'left' == $split_menu_item_position ) {
							$this->break_point = $temp_menu[ceil( $len / 2 )];
						} else {
							$this->break_point = $temp_menu[floor( $len / 2 )];
						}
					}
				}
			//---------------------------


			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			 $class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			//Megamenu only on first level
			if ( '0' == $depth && isset( $item->eut_megamenu ) && !empty( $item->eut_megamenu ) ) {
				$classes[] = 'megamenu column-' . $item->eut_megamenu;
			}

			if ( '0' == $depth ) {
				$classes[] = 'eut-first-level';
			}

			//Link Mode
			$link_mode = '';
			if ( isset( $item->eut_link_mode ) ) {
				$link_mode = $item->eut_link_mode;
			}

			if ( 'no-link' == $link_mode ) {
				$classes[] = 'eut-menu-no-link';
			} else if ( 'hidden' == $link_mode ) {
				$classes[] = 'eut-hidden-menu-item';
			}

			//Menu Item Style
			if ( isset( $item->eut_style ) && !empty( $item->eut_style ) ) {
				$menu_item_color = 'primary-1';
				$menu_item_hover_color = 'black';
				if ( 'button' == $item->eut_style ) {
					$classes[] = 'eut-menu-type-button';
				}
				if ( isset( $item->eut_color ) && !empty( $item->eut_color ) ) {
					$menu_item_color = $item->eut_color;
				}
				if ( isset( $item->eut_hover_color ) && !empty( $item->eut_hover_color ) ) {
					$menu_item_hover_color = $item->eut_hover_color;
				}

				$classes[] = 'eut-' . $menu_item_color;
				$classes[] = 'eut-hover-' . $menu_item_hover_color;

			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			if( null != $this->break_point  && ( $this->break_point == $item->menu_order ) ) {
				$output .= $indent . '</li></ul>';

				ob_start();
				do_action( 'crocal_eutf_split_logo_before' );
				crocal_eutf_print_logo( 'default', 'default' );
				do_action( 'crocal_eutf_split_logo_after' );
				$output .= ob_get_clean();

				$output .= '<ul class="eut-menu eut-split-menu-second"><li' . $id . $class_names .'>';
			 } else {
				$output .= $indent . '<li' . $id . $class_names .'>';
			}

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			if ( '_blank' === $item->target && empty( $item->xfn ) ) {
				$atts['rel'] = 'noopener noreferrer';
			} else {
				$atts['rel'] = $item->xfn;
			}
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-current'] = $item->current ? 'page' : '';

			//Remove href if no-link mode
			if ( 'no-link' == $link_mode ) {
				$atts['href'] = '#';
			}

			//Add Link Class
			if ( isset( $item->eut_link_classes ) && !empty( $item->eut_link_classes ) ) {
				$atts['class'] = $item->eut_link_classes;
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before;

			//Add Menu icon
			if ( isset( $item->eut_icon_fontawesome ) && !empty( $item->eut_icon_fontawesome ) ) {
				$item_output .= '<i class="eut-menu-icon ' . esc_attr( $item->eut_icon_fontawesome ) . '"></i>';
			}
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

			if ( isset( $item->description ) && !empty( $item->description ) ) {
				$item_output .= '<span class="eut-menu-description">' . esc_html( $item->description ) . '</span>';
			}

			//Add Label text
			if ( isset( $item->eut_label_text ) && !empty( $item->eut_label_text ) ) {
				$label_class = "label";
				if ( isset( $item->eut_label_color ) && !empty( $item->eut_label_color ) ) {
					$label_class .= " eut-bg-" . $item->eut_label_color;
				} else {
					$label_class .= " eut-bg-default";
				}
				$item_output .= '<span class="' . esc_attr( $label_class ) . '">' . esc_html( $item->eut_label_text ) . '</span>';
			}
			$item_output .= $args->link_after;

			$item_output .= '</a>';

			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}


	}
}