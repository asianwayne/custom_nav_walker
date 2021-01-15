<?php 
/**
 * @package ablog-theme
 * walker 是用在子级菜单上改写 wp_nav_menu自带的 子级菜单的class . 
 */


class Bl_Walker_Class extends Walker_Nav_Menu {

	function start_lvl(&$output,$depth = 0,$args = NULL) {  //$depth变量是你在后台设置多少级导航时候 生成的 ，比方说你设置了 二级菜单，$depth就是0, 三级菜单的时候$depth 就是1 .  $depth检测所有缩进
		$indent = str_repeat("\t",$depth); //$depth 变量会识别出有多少level； 可以自行百度str_repeat()php函数。会生成带空格的结构。\t是tab在正则里。
		$submenu = ($depth > 0 ) ? 'level-three' : 'level-two'; //$depth 检测所有的缩进也就是代码的下一层。  detect when this new level of submenu starts,when submenu ul is generated . 如果菜单大过二级， 在子级的子级ul添加 sub-menu 样式，如果只是二级菜单就为空。 
		$output .= "\n$indent<ul class=\"$submenu depth_$depth\">\n"; // \n是 escape里的换行，所有斜杠都代表escape，来避免多个双引号php不知道在哪里结束。 这里是用 在子级上 
	}



	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */

	 function start_el(&$output,$item,$depth = 0,$args = array(),$id = 0) { //$设置$depth = 0 之类的形式是为了 预防php报错， 让php 明白如果$depth没有值的话 $depth的值就设置为 0 .

	 	//varibles to use indise our loop to populate our custom html markup
	 	$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
	 	
	 	
	 	$li_attributes = ' data-src="1"';
	 	$class_names = $value = '';
	 	$classes = empty( $item->classes ) ? array() : (array) $item->classes; //定义$classes变量 包含 属于item的classes， 这些classes很多时候都来自我们自定义的classes;  如果$item->classes为空， $classes 变量就为空的数组。 
	 	$classes[] = ( $args->walker->has_children ) ? 'dropdown' : ''; //dropdown是默认的botstrap class 
	 	$classes[] = ( $item->current || $item->current_item_anchestor) ? 'active' : '';  
	 	$classes[] = 'menu-item-' . $item->ID;
	 	if ( $depth && $args->walker->has_children ) {
	 		$classes[] = 'dropdown-submenu';  // 默认bootstrap class 用在三级菜单
	 	}

	 	$class_names = join(' ',apply_filters( 'nav_menu_css_class', array_filter($classes),$item,$args )); //join把apply_filter 狗子 nav_menu_css_class 的数组结构变成 字符串输出，

	 	$class_names = ' class="' . esc_attr( $class_names ) . '"';

	 	$id = apply_filters('nav_menu_item_id','menu-item-' . $item->ID,$item,$args);
	 	$id = strlen( $id ) ? 'id="'. esc_attr( $id ) .'"' : '';

	 	$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>'; 

	 	$attributes = !empty($item->attr_title) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
	 	$attributes .= !empty($item->target) ? ' target="'. esc_attr( $item->target ) .'"' : '';
	 	$attributes .= !empty($item->xfn) ? ' rel="'. esc_attr( $item->xfn ) . '"' : '';
	 	$attributes .= !empty($item->url) ? ' href="' . esc_attr( $item->url ) . '"' : '';

	 	$attributes .= ($args->walker->has_children) ? ' class="dropdown-toggle" ' : '';

	 	$item_output = $args->before;
	 	$item_output .= '<a' . $attributes . '>';
	 	$item_output .= $args->link_before . apply_filters('the_title',$item->title,$item->ID) . $args->link_after;
	 	$item_output .= ( $depth == 0 && $args->walker->has_children ) ? '<b class="caret"></b></a>' : '</a>';

	 	$output .= apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);


	 } 

	
}

