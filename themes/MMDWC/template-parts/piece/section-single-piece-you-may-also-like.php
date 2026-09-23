<?php
$current_piece_id = get_the_ID();
$related_piece_ids = [];

// 1. Add manually selected Pieces from ACF first
$selected_pieces = get_field('you_may_also_like');

if ($selected_pieces) {
    foreach ($selected_pieces as $piece_id) {
        $piece_id = (int) $piece_id;

        if ($piece_id !== $current_piece_id && !in_array($piece_id, $related_piece_ids, true)) {
            $related_piece_ids[] = $piece_id;
        }

        if (count($related_piece_ids) === 4) {
            break;
        }
    }
}

// Get the current Piece parent and child categories
$piece_categories = get_the_terms($current_piece_id, 'piece_category');
$parent_category = null;
$child_category = null;

if ($piece_categories && !is_wp_error($piece_categories)) {
    foreach ($piece_categories as $piece_category) {
        if ($piece_category->parent) {
            $child_category = $piece_category;
            $parent_category = get_term($piece_category->parent, 'piece_category');
            break;
        }
    }

    if (!$parent_category) {
        foreach ($piece_categories as $piece_category) {
            if (!$piece_category->parent) {
                $parent_category = $piece_category;
                break;
            }
        }
    }
}

// 2. Complete with Pieces from the same child category
if (count($related_piece_ids) < 4 && $child_category) {
    $child_pieces = get_posts([
        'post_type'      => 'piece',
        'posts_per_page' => 4 - count($related_piece_ids),
        'post_status'    => 'publish',
        'post__not_in'   => array_merge([$current_piece_id], $related_piece_ids),
        'fields'         => 'ids',
        'orderby'        => 'menu_order',
        'order'          => 'DESC',
        'tax_query'      => [
            [
                'taxonomy' => 'piece_category',
                'field'    => 'term_id',
                'terms'    => $child_category->term_id,
            ],
        ],
    ]);

    $related_piece_ids = array_merge($related_piece_ids, $child_pieces);
}

// 3. Complete with Pieces from the same parent category
if (count($related_piece_ids) < 4 && $parent_category && !is_wp_error($parent_category)) {
    $parent_pieces = get_posts([
        'post_type'      => 'piece',
        'posts_per_page' => 4 - count($related_piece_ids),
        'post_status'    => 'publish',
        'post__not_in'   => array_merge([$current_piece_id], $related_piece_ids),
        'fields'         => 'ids',
        'orderby'        => 'menu_order',
        'order'          => 'DESC',
        'tax_query'      => [
            [
                'taxonomy'         => 'piece_category',
                'field'            => 'term_id',
                'terms'            => $parent_category->term_id,
                'include_children' => true,
            ],
        ],
    ]);

    $related_piece_ids = array_merge($related_piece_ids, $parent_pieces);
}

// 4. Complete with random Pieces
if (count($related_piece_ids) < 4) {
    $random_pieces = get_posts([
        'post_type'      => 'piece',
        'posts_per_page' => 4 - count($related_piece_ids),
        'post_status'    => 'publish',
        'post__not_in'   => array_merge([$current_piece_id], $related_piece_ids),
        'fields'         => 'ids',
        'orderby'        => 'menu_order',
        'order'          => 'DESC',
    ]);

    $related_piece_ids = array_merge($related_piece_ids, $random_pieces);
}
?>

<?php if ($related_piece_ids) : ?>

    <section id="shop-row-items" class="shop-row-items">

        <div class="section-header">

            <h2><?php esc_html_e('you may also like', 'mmdwc'); ?></h2>

        </div>

        <!-- YOU MAY ALSO LIKE ROW ------------------------------------------------------------------------------------------------>

        <div class="shop-row-items__row">

            <?php foreach ($related_piece_ids as $piece_id) : ?>

                <!-- YOU MAY ALSO LIKE ITEM ------------------------------------------------------------------------------------------------>

                <div class="shop-row-items__row-item">

                    <a href="<?php echo esc_url(get_permalink($piece_id)); ?>">

                        <div class="media-container media-container--3-4">

                            <?php if (has_post_thumbnail($piece_id)) : ?>

                                <?php echo get_the_post_thumbnail($piece_id, 'full'); ?>

                            <?php endif; ?>

                        </div>

                    </a>

                    <div class="shop-row-items__row-content">

                        <h3 class="item-title">

                            <strong><?php echo esc_html(get_field('title', $piece_id)); ?></strong>

                            <?php if (get_field('sub-title', $piece_id)) : ?>

                                <span><?php echo esc_html(get_field('sub-title', $piece_id)); ?></span>

                            <?php endif; ?>

                        </h3>

                        <a href="<?php echo esc_url(get_permalink($piece_id)); ?>" class="custom-button">

                            <?php esc_html_e('discover', 'mmdwc'); ?>

                        </a>

                    </div>

                </div>

                <!-- END YOU MAY ALSO LIKE ITEM ------------------------------------------------------------------------------------------------>

            <?php endforeach; ?>

        </div>

        <!-- END YOU MAY ALSO LIKE ROW ------------------------------------------------------------------------------------------------>

    </section>

<?php endif; ?>