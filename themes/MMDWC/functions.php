<?php

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/post-types.php';

//////////////////////////////////////////////////////////////
// MENU LINK DATA ATTRIBUTES
//////////////////////////////////////////////////////////////

add_filter('nav_menu_link_attributes', 'theme_menu_link_attributes', 10, 4);

function theme_menu_link_attributes($atts, $menu_item, $args, $depth)
{
    $atts['data-text'] = $menu_item->title;

    return $atts;
}
