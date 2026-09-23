<?php

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/hero-videos.php';
require_once get_template_directory() . '/inc/woocommerce.php';

//////////////////////////////////////////////////////////////
// MENU LINK DATA ATTRIBUTES
//////////////////////////////////////////////////////////////

add_filter('nav_menu_link_attributes', 'theme_menu_link_attributes', 10, 4);

function theme_menu_link_attributes($atts, $menu_item, $args, $depth)
{
    $atts['data-text'] = $menu_item->title;

    return $atts;
}

//////////////////////////////////////////////////////////////
// ACF OPTIONS PAGE
//////////////////////////////////////////////////////////////

add_action('acf/init', 'hamrei_register_options_page');

function hamrei_register_options_page()
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-options',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
}
