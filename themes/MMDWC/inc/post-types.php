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
// PIECES ARCHIVE POSTS PER PAGE
//////////////////////////////////////////////////////////////

add_action('pre_get_posts', 'hamrei_pieces_archive_posts_per_page');

function hamrei_pieces_archive_posts_per_page($query)
{
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('piece')) {
		$query->set('posts_per_page', 24);
	}
}

//////////////////////////////////////////////////////////////
// PIECE CATEGORY REWRITE RULES
//////////////////////////////////////////////////////////////

add_action('init', 'hamrei_piece_category_rewrite_rules', 20);

function hamrei_piece_category_rewrite_rules()
{
	$terms = get_terms([
		'taxonomy'   => 'piece_category',
		'hide_empty' => false,
	]);

	if (is_wp_error($terms)) {
		return;
	}

	foreach ($terms as $term) {

		$term_path = $term->slug;

		if ($term->parent) {
			$ancestors = array_reverse(get_ancestors($term->term_id, 'piece_category'));

			foreach ($ancestors as $ancestor_id) {
				$ancestor = get_term($ancestor_id, 'piece_category');

				if (!is_wp_error($ancestor)) {
					$term_path = $ancestor->slug . '/' . $term_path;
				}
			}
		}

		add_rewrite_rule(
			'^collection/' . $term_path . '/?$',
			'index.php?piece_category=' . $term->slug,
			'top'
		);
	}
}

//////////////////////////////////////////////////////////////
// ADD BODY CLASS WHEN PIECE CATEGORY HAS CHILDREN
//////////////////////////////////////////////////////////////

add_filter('body_class', 'hamrei_piece_category_body_class');

function hamrei_piece_category_body_class($classes)
{
	if (!is_tax('piece_category')) {
		return $classes;
	}

	$term = get_queried_object();

	$children = get_terms([
		'taxonomy'   => 'piece_category',
		'parent'     => $term->term_id,
		'hide_empty' => false,
		'number'     => 1,
	]);

	if (!is_wp_error($children) && !empty($children)) {
		$classes[] = 'tax-has-children';
	}

	return $classes;
}
