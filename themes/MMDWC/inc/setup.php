<?php

add_action('after_setup_theme', 'theme_setup');

function theme_setup()
{
	show_admin_bar(false);

	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');

	add_theme_support('html5', [
		'search-form',
		'gallery',
		'caption',
	]);

	add_theme_support('responsive-embeds');

	add_theme_support('menus');

	// WooCommerce
	// add_theme_support('woocommerce');
}
