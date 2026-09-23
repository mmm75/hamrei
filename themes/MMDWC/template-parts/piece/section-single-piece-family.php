<!-- FAMILY GRID ------------------------------------------------------------------------------------------------>

<?php
$families = get_the_terms(get_the_ID(), 'family');

if ($families && !is_wp_error($families)) :

    $family = reset($families);

    $family_pieces = new WP_Query([
        'post_type'      => 'piece',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post__not_in'   => [get_the_ID()],
        'orderby'        => 'menu_order',
        'order'          => 'DESC',
        'tax_query'      => [
            [
                'taxonomy' => 'family',
                'field'    => 'term_id',
                'terms'    => $family->term_id,
            ],
        ],
    ]);

    if ($family_pieces->have_posts()) :
?>

        <div class="family__grid">

            <?php while ($family_pieces->have_posts()) : $family_pieces->the_post(); ?>

                <?php
                $piece_categories = get_the_terms(get_the_ID(), 'piece_category');
                $parent_category = null;

                if ($piece_categories && !is_wp_error($piece_categories)) {
                    foreach ($piece_categories as $piece_category) {
                        if ($piece_category->parent) {
                            $parent_category = get_term($piece_category->parent, 'piece_category');
                            break;
                        }

                        $parent_category = $piece_category;
                    }
                }
                ?>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="family__grid-item">

                    <a href="<?php the_permalink(); ?>">

                        <div class="media-container media-container--3-4">

                            <?php if (has_post_thumbnail()) : ?>

                                <?php the_post_thumbnail('full'); ?>

                            <?php endif; ?>

                        </div>

                        <div class="family__grid-item--name<?php echo $parent_category && !is_wp_error($parent_category) ? ' background-' . esc_attr($parent_category->slug) : ''; ?>">

                            <h3 class="item-title">

                                <strong><?php the_title(); ?></strong>

                            </h3>

                        </div>

                    </a>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

            <?php endwhile; ?>

        </div>

<?php
    endif;

    wp_reset_postdata();

endif;
?>

<!-- END FAMILY GRID ------------------------------------------------------------------------------------------------>