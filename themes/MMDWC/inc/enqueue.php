<?php

//////////////////////////////////////////////////////////////
// BOOTSTRAP CSS
//////////////////////////////////////////////////////////////

add_action('wp_enqueue_scripts', 'theme_load_bootstrap_css', 10);

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

add_action('wp_enqueue_scripts', 'theme_load_bootstrap_js', 20);

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

add_action('wp_enqueue_scripts', 'theme_load_gsap', 20);

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

add_action('wp_enqueue_scripts', 'theme_load_scrolltrigger', 21);

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

add_action('wp_enqueue_scripts', 'theme_load_scrollto', 22);

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
		array('jquery'),
		file_exists($functions_js_path) ? filemtime($functions_js_path) : null,
		true
	);
}
