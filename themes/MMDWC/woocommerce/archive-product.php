<?php get_header(); ?>

<h1 class="visually-hidden">
    <?php woocommerce_page_title(); ?>
</h1>

<?php get_template_part('woocommerce/products-grid', null, [
    'query' => $GLOBALS['wp_query'],
]); ?>

<?php get_footer(); ?>