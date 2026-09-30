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
// WPML LANGUAGE SELECTOR
//////////////////////////////////////////////////////////////

function hamrei_get_language_selector_html()
{
    static $html = null;

    if ($html !== null) {
        return $html;
    }

    ob_start();

    do_action('wpml_add_language_selector');

    $html = ob_get_clean();

    return $html;
}

//////////////////////////////////////////////////////////////
// HEADER MENU
//////////////////////////////////////////////////////////////

function hamrei_get_header_menu_html($menu_class)
{
    static $html = null;

    if ($html === null) {

        $html = wp_nav_menu([
            'menu'       => 'Menu Header',
            'container'  => false,
            'menu_class' => 'HAMREI_HEADER_MENU_CLASS',
            'echo'       => false,
        ]);
    }

    return str_replace(
        'HAMREI_HEADER_MENU_CLASS',
        esc_attr($menu_class),
        $html
    );
}

//////////////////////////////////////////////////////////////
// ACF OPTIONS PAGE
//////////////////////////////////////////////////////////////

add_action('acf/init', 'hamrei_register_options_page');

function hamrei_register_options_page()
{
    if (!is_admin() || !function_exists('acf_add_options_page')) {
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

//////////////////////////////////////////////////////////////
// COMING SOON MODE
//////////////////////////////////////////////////////////////

// add_action('template_redirect', 'hamrei_coming_soon_mode');

//////////////////////////////////////////////////////////////
// REDIRECT PUBLIC VISITORS TO COMING SOON PAGE
//////////////////////////////////////////////////////////////

function hamrei_coming_soon_mode()
{
    $preview_key = 'hamrei-preview-2026';

    if (
        isset($_GET['preview']) &&
        hash_equals($preview_key, sanitize_text_field($_GET['preview']))
    ) {
        setcookie(
            'hamrei_preview',
            '1',
            [
                'expires'  => time() + WEEK_IN_SECONDS,
                'path'     => COOKIEPATH ?: '/',
                'secure'   => is_ssl(),
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        wp_safe_redirect(remove_query_arg('preview'));
        exit;
    }

    if (is_user_logged_in()) {
        return;
    }

    if (!empty($_COOKIE['hamrei_preview']) && $_COOKIE['hamrei_preview'] === '1') {
        return;
    }

    if (is_admin()) {
        return;
    }

    if (wp_doing_ajax()) {
        return;
    }

    if (wp_doing_cron()) {
        return;
    }

    if (defined('REST_REQUEST') && REST_REQUEST) {
        return;
    }

    if (isset($_GET['wc-api']) || isset($_GET['wc-ajax'])) {
        return;
    }

    if (is_page('coming-soon')) {
        return;
    }

    wp_safe_redirect(home_url('/coming-soon/'));
    exit;
}
