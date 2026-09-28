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

	add_theme_support('woocommerce');

	//////////////////////////////////////////////////////////////
	// IMAGE SIZES
	//////////////////////////////////////////////////////////////

	add_image_size('image_square', 1500, 1500, true);
	add_image_size('image_thumb_product', 900, 1200, true);
	add_image_size('large_medium', 1500, 1500);
}
