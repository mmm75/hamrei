<?php

//////////////////////////////////////////////////////////////
// RESET CSS
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_reset_css', 5);

function theme_load_reset_css()
{
	$reset_path = get_template_directory() . '/assets/css/reset.css';

	wp_enqueue_style(
		'reset',
		get_template_directory_uri() . '/assets/css/reset.css',
		array(),
		file_exists($reset_path) ? filemtime($reset_path) : null
	);
}

//////////////////////////////////////////////////////////////
// ADOBE FONTS
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_adobe_fonts', 6);

function theme_load_adobe_fonts()
{
	wp_enqueue_style(
		'adobe-fonts',
		'https://use.typekit.net/rkp3gyv.css',
		array(),
		null
	);
}

//////////////////////////////////////////////////////////////
// BOOTSTRAP CSS
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_bootstrap_css', 10);

function theme_load_bootstrap_css()
{
	wp_enqueue_style(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css',
		array(),
		'5.3.8'
	);
}

//////////////////////////////////////////////////////////////
// BOOTSTRAP JS
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_bootstrap_js', 20);

function theme_load_bootstrap_js()
{
	wp_enqueue_script(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.8',
		true
	);
}

//////////////////////////////////////////////////////////////
// GSAP
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_gsap', 20);

function theme_load_gsap()
{
	wp_enqueue_script(
		'gsap',
		'https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js',
		array(),
		null,
		true
	);
}

//////////////////////////////////////////////////////////////
// GSAP SCROLLTRIGGER
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_scrolltrigger', 21);

function theme_load_scrolltrigger()
{
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js',
		array('gsap'),
		null,
		true
	);
}

//////////////////////////////////////////////////////////////
// GSAP SCROLLTO
//////////////////////////////////////////////////////////////

// add_action('wp_enqueue_scripts', 'theme_load_scrollto', 22);

function theme_load_scrollto()
{
	wp_enqueue_script(
		'gsap-scrollto',
		'https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollToPlugin.min.js',
		array('gsap'),
		null,
		true
	);
}

//////////////////////////////////////////////////////////////
// SWIPER
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_swiper', 25);

function theme_load_swiper()
{
	$swiper_css_path = get_template_directory() . '/assets/vendor/swiper/swiper-bundle.min.css';
	$swiper_js_path = get_template_directory() . '/assets/vendor/swiper/swiper-bundle.min.js';

	wp_enqueue_style(
		'swiper',
		get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css',
		array(),
		file_exists($swiper_css_path) ? filemtime($swiper_css_path) : null
	);

	wp_enqueue_script(
		'swiper',
		get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js',
		array(),
		file_exists($swiper_js_path) ? filemtime($swiper_js_path) : null,
		true
	);
}

//////////////////////////////////////////////////////////////
// THEME CSS
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_styles', 30);

function theme_load_styles()
{
	$style_path = get_stylesheet_directory() . '/style.css';

	wp_enqueue_style(
		'theme-style',
		get_stylesheet_uri(),
		array(),
		file_exists($style_path) ? filemtime($style_path) : null
	);
}

//////////////////////////////////////////////////////////////
// THEME JS
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_scripts', 30);

function theme_load_scripts()
{
	$functions_js_path = get_template_directory() . '/assets/js/functions.js';

	wp_enqueue_script(
		'functions',
		get_template_directory_uri() . '/assets/js/functions.js',
		array('jquery', 'swiper'),
		file_exists($functions_js_path) ? filemtime($functions_js_path) : null,
		true
	);
}

//////////////////////////////////////////////////////////////
// HERO VIDEOS JS
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_hero_videos', 30);

function theme_load_hero_videos()
{
	$hero_videos_js_path = get_template_directory() . '/assets/js/hero-videos.js';

	wp_enqueue_script(
		'hero-videos',
		get_template_directory_uri() . '/assets/js/hero-videos.js',
		array('jquery'),
		file_exists($hero_videos_js_path) ? filemtime($hero_videos_js_path) : null,
		true
	);

	wp_localize_script(
		'hero-videos',
		'hamreiHero',
		[
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'schedule' => hamrei_get_hero_video_schedule(),
		]
	);
}
