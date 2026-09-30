<?php

//////////////////////////////////////////////////////////////
// GET PREVIOUS AND NEXT PRODUCTS
//////////////////////////////////////////////////////////////

function hamrei_get_product_navigation()
{
	static $navigation = null;
	static $loaded = false;

	if ($loaded) {
		return $navigation;
	}

	$loaded = true;

	if (!is_product()) {
		return false;
	}

	$product_ids = get_posts([
		'post_type'              => 'product',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'fields'                 => 'ids',
		'orderby'                => [
			'menu_order' => 'DESC',
			'ID'         => 'DESC',
		],
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	]);

	if (count($product_ids) < 2) {
		return false;
	}

	$current_index = array_search(get_queried_object_id(), $product_ids, true);

	if ($current_index === false) {
		return false;
	}

	$count = count($product_ids);

	$previous_index = ($current_index - 1 + $count) % $count;
	$next_index     = ($current_index + 1) % $count;

	$navigation = [
		'previous' => get_permalink($product_ids[$previous_index]),
		'next'     => get_permalink($product_ids[$next_index]),
	];

	return $navigation;
}
