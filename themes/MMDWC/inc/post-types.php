<?php

//////////////////////////////////////////////////////////////
// PIECES CUSTOM POST TYPE
//////////////////////////////////////////////////////////////

add_action('init', 'hamrei_register_post_types');

function hamrei_register_post_types()
{
	register_post_type('piece', [
		'labels' => [
			'name'               => 'Pieces',
			'singular_name'      => 'Piece',
			'menu_name'          => 'Pieces',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Piece',
			'edit_item'          => 'Edit Piece',
			'new_item'           => 'New Piece',
			'view_item'          => 'View Piece',
			'search_items'       => 'Search Pieces',
			'not_found'          => 'No pieces found',
			'not_found_in_trash' => 'No pieces found in Trash',
			'all_items'          => 'All Pieces',
		],

		'public' => true,
		'has_archive' => 'collection',
		'rewrite' => [
			'slug'       => 'collection',
			'with_front' => false,
		],
		'show_in_rest' => true,

		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],

		'menu_icon' => 'dashicons-images-alt2',
	]);
}

//////////////////////////////////////////////////////////////
// PIECES CUSTOM TAXONOMY
//////////////////////////////////////////////////////////////

add_action('init', 'hamrei_register_taxonomies');

function hamrei_register_taxonomies()
{
	register_taxonomy('piece_category', ['piece'], [
		'labels' => [
			'name'              => 'Piece Categories',
			'singular_name'     => 'Piece Category',
			'search_items'      => 'Search Piece Categories',
			'all_items'         => 'All Piece Categories',
			'parent_item'       => 'Parent Piece Category',
			'parent_item_colon' => 'Parent Piece Category:',
			'edit_item'         => 'Edit Piece Category',
			'update_item'       => 'Update Piece Category',
			'add_new_item'      => 'Add New Piece Category',
			'new_item_name'     => 'New Piece Category Name',
			'menu_name'         => 'Piece Categories',
		],

		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,

		'rewrite' => [
			'slug'         => 'collection',
			'with_front'   => false,
			'hierarchical' => true,
		],
	]);
}

//////////////////////////////////////////////////////////////
// GET PIECE PARENT CATEGORIES
//////////////////////////////////////////////////////////////

function hamrei_get_piece_parent_categories()
{
	static $categories = null;

	if ($categories !== null) {
		return $categories;
	}

	$categories = get_terms([
		'taxonomy'   => 'piece_category',
		'parent'     => 0,
		'hide_empty' => true,
		'orderby'    => 'term_order',
		'order'      => 'ASC',
	]);

	return $categories;
}

//////////////////////////////////////////////////////////////
// GET PIECE CATEGORY CHILDREN
//////////////////////////////////////////////////////////////

function hamrei_get_piece_category_children($parent_id)
{
	static $cache = [];

	$parent_id = (int) $parent_id;

	if (isset($cache[$parent_id])) {
		return $cache[$parent_id];
	}

	$cache[$parent_id] = get_terms([
		'taxonomy'   => 'piece_category',
		'parent'     => $parent_id,
		'hide_empty' => true,
		'orderby'    => 'term_order',
		'order'      => 'ASC',
	]);

	return $cache[$parent_id];
}

//////////////////////////////////////////////////////////////
// OPTIMIZE ARCHIVE QUERIES
//////////////////////////////////////////////////////////////

add_action('pre_get_posts', 'hamrei_optimize_archive_queries');

function hamrei_optimize_archive_queries($query)
{
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	if ($query->is_post_type_archive('piece')) {

		$query->set('post_status', 'publish');
		$query->set('posts_per_page', 20);

		$query->set('orderby', 'menu_order');
		$query->set('order', 'ASC');

		$query->set('update_post_term_cache', false);
	}

	if ($query->is_tax('piece_category')) {

		$query->set('post_status', 'publish');

		$query->set('orderby', 'menu_order');
		$query->set('order', 'ASC');

		$query->set('update_post_term_cache', false);
	}

	if ($query->is_post_type_archive('film')) {

		$query->set('no_found_rows', true);
		$query->set('update_post_term_cache', false);
	}
}

//////////////////////////////////////////////////////////////
// PIECE CATEGORY REWRITE RULES
//////////////////////////////////////////////////////////////

add_filter('rewrite_rules_array', 'hamrei_piece_category_rewrite_rules');

function hamrei_piece_category_rewrite_rules($rules)
{
	$custom_rules = [];

	$current_language = apply_filters('wpml_current_language', null);

	// Get taxonomy terms from ALL WPML languages.
	do_action('wpml_switch_language', 'all');

	$terms = get_terms([
		'taxonomy'   => 'piece_category',
		'hide_empty' => false,
	]);

	// WPML 4.x: restore the previous language.
	if ($current_language) {
		do_action('wpml_switch_language', $current_language);
	}

	if (is_wp_error($terms)) {
		return $rules;
	}

	foreach ($terms as $term) {

		$term_path = $term->slug;

		if ($term->parent) {

			$ancestor_slugs = [];

			$ancestors = array_reverse(
				get_ancestors(
					$term->term_id,
					'piece_category',
					'taxonomy'
				)
			);

			foreach ($ancestors as $ancestor_id) {

				$ancestor = get_term($ancestor_id, 'piece_category');

				if (!is_wp_error($ancestor) && $ancestor) {
					$ancestor_slugs[] = $ancestor->slug;
				}
			}

			if (!empty($ancestor_slugs)) {
				$term_path = implode('/', $ancestor_slugs) . '/' . $term->slug;
			}
		}

		$custom_rules['^collection/' . $term_path . '/?$'] =
			'index.php?piece_category=' . $term->slug;
	}

	return $custom_rules + $rules;
}

//////////////////////////////////////////////////////////////
// SYNC PIECE ORDER EN → PT
//////////////////////////////////////////////////////////////

add_action('PTO/order_update_complete', 'hamrei_sync_piece_order_wpml');

function hamrei_sync_piece_order_wpml()
{
	global $wpdb;

	// Get every Piece, regardless of language
	$piece_ids = get_posts([
		'post_type'        => 'piece',
		'post_status'      => ['publish', 'draft', 'private'],
		'posts_per_page'   => -1,
		'fields'           => 'ids',
		'suppress_filters' => true,
	]);

	if (empty($piece_ids)) {
		return;
	}

	$english_ids = [];

	foreach ($piece_ids as $piece_id) {
		$english_id = apply_filters(
			'wpml_object_id',
			$piece_id,
			'piece',
			false,
			'en'
		);

		if ($english_id) {
			$english_ids[$english_id] = $english_id;
		}
	}

	foreach ($english_ids as $english_id) {

		$portuguese_id = apply_filters(
			'wpml_object_id',
			$english_id,
			'piece',
			false,
			'pt-pt'
		);

		if (!$portuguese_id || $portuguese_id == $english_id) {
			continue;
		}

		$english_order = (int) get_post_field('menu_order', $english_id);
		$portuguese_order = (int) get_post_field('menu_order', $portuguese_id);

		if ($english_order === $portuguese_order) {
			continue;
		}

		$wpdb->update(
			$wpdb->posts,
			['menu_order' => $english_order],
			['ID' => $portuguese_id],
			['%d'],
			['%d']
		);

		clean_post_cache($portuguese_id);
	}
}

//////////////////////////////////////////////////////////////
// SYNC PIECE MEDIA EN → PT
//////////////////////////////////////////////////////////////

add_action('acf/save_post', 'hamrei_sync_piece_media_to_pt', 20);

function hamrei_sync_piece_media_to_pt($post_id)
{
	$post_id = (int) $post_id;

	if (!$post_id || get_post_type($post_id) !== 'piece') {
		return;
	}

	$language = apply_filters(
		'wpml_element_language_code',
		null,
		[
			'element_id'   => $post_id,
			'element_type' => 'post_piece',
		]
	);

	// English is the source of truth.
	if ($language !== 'en') {
		return;
	}

	$pt_id = apply_filters(
		'wpml_object_id',
		$post_id,
		'piece',
		false,
		'pt-pt'
	);

	if (!$pt_id || (int) $pt_id === $post_id) {
		return;
	}

	$pt_id = (int) $pt_id;

	/*
     * Featured image:
     * use EXACTLY the same attachment ID as EN.
     */
	$thumbnail_id = (int) get_post_meta(
		$post_id,
		'_thumbnail_id',
		true
	);

	if ($thumbnail_id) {
		update_post_meta(
			$pt_id,
			'_thumbnail_id',
			$thumbnail_id
		);
	} else {
		delete_post_meta(
			$pt_id,
			'_thumbnail_id'
		);
	}

	/*
     * ACF gallery "images":
     * use EXACTLY the same attachment IDs as EN.
     */
	$images = get_post_meta(
		$post_id,
		'images',
		true
	);

	if (!is_array($images)) {
		$images = [];
	}

	update_field(
		'images',
		$images,
		$pt_id
	);

	clean_post_cache($pt_id);
}

//////////////////////////////////////////////////////////////
// ADD BODY CLASSES TO PIECE CATEGORIES
//////////////////////////////////////////////////////////////

add_filter('body_class', 'hamrei_piece_category_body_class');

function hamrei_piece_category_body_class($classes)
{
	if (!is_tax('piece_category')) {
		return $classes;
	}

	$term = get_queried_object();

	if (!$term || is_wp_error($term)) {
		return $classes;
	}

	if ($term->parent) {
		$classes[] = 'piece-category-child';
	}

	$children = hamrei_get_piece_category_children($term->term_id);

	if (!is_wp_error($children) && !empty($children)) {
		$classes[] = 'tax-has-children';
	}

	return $classes;
}

//////////////////////////////////////////////////////////////
// REGISTER PIECE FAMILY TAXONOMY
//////////////////////////////////////////////////////////////

add_action('init', 'hamrei_register_piece_family_taxonomy');

function hamrei_register_piece_family_taxonomy()
{
	register_taxonomy('family', ['piece'], [
		'labels' => [
			'name'          => 'Families',
			'singular_name' => 'Family',
			'search_items'  => 'Search Families',
			'all_items'     => 'All Families',
			'edit_item'     => 'Edit Family',
			'update_item'   => 'Update Family',
			'add_new_item'  => 'Add New Family',
			'new_item_name' => 'New Family Name',
			'menu_name'     => 'Families',
		],
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => false,
		'query_var'         => false,
	]);
}

//////////////////////////////////////////////////////////////
// FILMS CUSTOM POST TYPE
//////////////////////////////////////////////////////////////

add_action('init', 'hamrei_register_films_post_type');

//////////////////////////////////////////////////////////////
// REGISTER FILMS CUSTOM POST TYPE
//////////////////////////////////////////////////////////////

function hamrei_register_films_post_type()
{
	register_post_type('film', [
		'labels' => [
			'name'          => __('Films', 'mmdwc'),
			'singular_name' => __('Film', 'mmdwc'),
			'menu_name'     => __('Films', 'mmdwc'),
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Film',
			'edit_item'          => 'Edit Film',
			'new_item'           => 'New Film',
			'view_item'          => 'View Film',
			'search_items'       => 'Search Films',
			'not_found'          => 'No films found',
			'not_found_in_trash' => 'No films found in Trash',
			'all_items'          => 'All Films',
		],

		'public' => true,
		'has_archive' => 'films',
		'rewrite' => [
			'slug'       => 'films',
			'with_front' => false,
		],
		'show_in_rest' => true,

		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],

		'menu_icon' => 'dashicons-video-alt3',
	]);
}

//////////////////////////////////////////////////////////////
// RENAME POSTS TO PROJECTS
//////////////////////////////////////////////////////////////

add_filter('post_type_labels_post', function ($labels) {

	$labels->name               = 'Projects';
	$labels->singular_name      = 'Project';
	$labels->menu_name          = 'Projects';
	$labels->name_admin_bar     = 'Project';
	$labels->all_items          = 'All Projects';
	$labels->add_new            = 'Add Project';
	$labels->add_new_item       = 'Add New Project';
	$labels->edit_item          = 'Edit Project';
	$labels->new_item           = 'New Project';
	$labels->view_item          = 'View Project';
	$labels->search_items       = 'Search Projects';
	$labels->not_found          = 'No projects found';
	$labels->not_found_in_trash = 'No projects found in Trash';

	return $labels;
});
