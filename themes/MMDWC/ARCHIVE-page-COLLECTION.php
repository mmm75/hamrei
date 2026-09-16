<?php

/**
 * Template Name: TEMPLATE COLLECTION
 */

?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php

        $paged = max(1, get_query_var('paged'), get_query_var('page'));

        $pieces = new WP_Query([
            'post_type'      => 'piece',
            'post_status'    => 'publish',
            'posts_per_page' => 24,
            'paged'          => $paged,
            'orderby'        => 'menu_order',
            'order'          => 'DESC',
        ]);

    ?>

    <?php if ($pieces->have_posts()) : ?>

        <?php
            get_template_part(
                'template-parts/collection-grid',
                null,
                [
                    'query' => $pieces,
                ]
            );
        ?>

        <?php wp_reset_postdata(); ?>

    <?php endif; ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>