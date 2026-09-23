<?php

$pieces = $args['query'];

?>

<h1 class="visually-hidden">
    <?php if (is_post_type_archive('piece')) : ?>
        Collection
    <?php elseif (is_tax('piece_category')) : ?>
        <?php single_term_title(); ?>
    <?php endif; ?>
</h1>

<div id="collection-grid" class="collection-grid collection-grid--3">

    <?php while ($pieces->have_posts()) : $pieces->the_post(); ?>

        <div class="collection-grid__item">

            <?php if (has_post_thumbnail()) : ?>

                <a href="<?php the_permalink(); ?>" class="collection-grid__image">

                    <div class="media-container media-container--square">

                        <?php the_post_thumbnail('full'); ?>

                    </div>

                </a>

            <?php endif; ?>

            <h3 class="collection-grid__title item-title">

                <strong><?php the_field("title"); ?></strong>

                <span><?php the_field("sub-title"); ?></span>

            </h3>

        </div>

    <?php endwhile; ?>

</div>

<?php
$next_page = get_next_posts_link('Next', $pieces->max_num_pages);

if ($next_page) :
?>

    <div id="collection-pagination">
        <?php echo $next_page; ?>
    </div>

<?php endif; ?>

<!-- EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>

<?php get_template_part("/template-parts/section-explore-our-shop"); ?>

<!-- END EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>