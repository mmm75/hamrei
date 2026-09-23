<?php

//////////////////////////////////////////////////////////////
// GET PREVIOUS AND NEXT PRODUCTS
//////////////////////////////////////////////////////////////

function hamrei_get_product_navigation()
{
	if (!is_product()) {
		return false;
	}

	$product_ids = get_posts([
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'orderby'        => [
			'menu_order' => 'DESC',
			'ID'         => 'DESC',
		],
	]);

	if (count($product_ids) < 2) {
		return false;
	}

	$current_index = array_search(get_the_ID(), $product_ids, true);

	if ($current_index === false) {
		return false;
	}

	$count = count($product_ids);

	$previous_index = ($current_index - 1 + $count) % $count;
	$next_index     = ($current_index + 1) % $count;

	return [
		'previous' => get_permalink($product_ids[$previous_index]),
		'next'     => get_permalink($product_ids[$next_index]),
	];
}

//////////////////////////////////////////////////////////////
// DISABLE PRODUCT QUANTITY SELECTION
//////////////////////////////////////////////////////////////

add_filter('woocommerce_is_sold_individually', 'hamrei_products_sold_individually', 10, 2);

function hamrei_products_sold_individually($sold_individually, $product)
{
	return true;
}
