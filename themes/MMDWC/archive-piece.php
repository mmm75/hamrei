<?php get_header(); ?>

<?php
global $wp_query;

if (have_posts()) :

    get_template_part(
        'template-parts/collection/collection-grid',
        null,
        [
            'query' => $wp_query,
        ]
    );

endif;
?>

<?php get_footer(); ?>