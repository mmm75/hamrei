<?php

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/hero-videos.php';
require_once get_template_directory() . '/inc/woocommerce.php';
require_once get_template_directory() . '/inc/mailchimp.php';

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
//DISABLE WOOCOMMERCE PAGES
//////////////////////////////////////////////////////////////

/**
 * Disable WooCommerce frontend pages.
 */
function hamrei_disable_shop_pages()
{

    if (! function_exists('is_woocommerce')) {
        return;
    }

    if (
        is_woocommerce() ||
        is_cart() ||
        is_checkout() ||
        is_account_page()
    ) {
        wp_safe_redirect(home_url('/'), 302);
        exit;
    }
}
add_action('template_redirect', 'hamrei_disable_shop_pages', 20);


/**
 * Exclude WooCommerce products from Yoast sitemap.
 */
add_filter('wpseo_sitemap_exclude_post_type', function ($exclude, $post_type) {
    return $post_type === 'product' ? true : $exclude;
}, 10, 2);


/**
 * Exclude WooCommerce pages from Yoast sitemap.
 */
add_filter('wpseo_exclude_from_sitemap_by_post_ids', function ($excluded) {

    $pages = array(
        wc_get_page_id('shop'),
        wc_get_page_id('cart'),
        wc_get_page_id('checkout'),
        wc_get_page_id('myaccount')
    );

    return array_merge($excluded, array_filter($pages, function ($id) {
        return $id > 0;
    }));
});



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

//////////////////////////////////////////////////////////////
// CUSTOM BACK OFFICE
//////////////////////////////////////////////////////////////

add_action('admin_menu', function () {

    $user = wp_get_current_user();

    if (!in_array('shop_manager', (array) $user->roles, true)) {
        return;
    }

    /*
	 * Standard WordPress menus.
	 */
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('themes.php');        // Appearance
    remove_menu_page('users.php');         // Users
    remove_menu_page('tools.php');         // Tools

    /*
	 * Known Yoast / WPML slugs.
	 */
    remove_menu_page('wpseo_dashboard');
    remove_menu_page('wpseo_page_settings');
    remove_menu_page('wpseo_workouts');

    // Current WPML main menu slug.
    remove_menu_page('tm/menu/main.php');

    // Old WPML slug, kept as fallback.
    remove_menu_page('sitepress-multilingual-cms/menu/languages.php');

    /*
	 * Final fallback:
	 * remove Yoast SEO / WPML directly from the generated
	 * WordPress menu, whatever slug the plugin has registered.
	 */
    global $menu;

    foreach ((array) $menu as $key => $item) {

        $label = isset($item[0])
            ? trim(wp_strip_all_tags($item[0]))
            : '';

        $slug = isset($item[2])
            ? (string) $item[2]
            : '';

        $is_yoast =
            stripos($label, 'Yoast SEO') !== false ||
            strpos($slug, 'wpseo_') !== false;

        $is_wpml =
            $label === 'WPML' ||
            strpos($slug, 'tm/menu/') !== false ||
            strpos($slug, 'sitepress-multilingual-cms') !== false;

        if ($is_yoast || $is_wpml) {
            unset($menu[$key]);
        }
    }
}, PHP_INT_MAX);
