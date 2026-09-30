<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- PIECE SINGLE ------------------------------------------------------------------------------------------------>

        <section class="piece-product-single">

            <!-- DESKTOP ------------------------------------------------------------------------------------------------>

            <div class="piece-product-single__gallery desktop">

                <?php if (has_post_thumbnail()) : ?>

                    <div class="media-container">

                        <?php the_post_thumbnail('large_medium'); ?>

                    </div>

                <?php endif; ?>

                <?php $images = get_field('images'); ?>

                <?php if ($images) : ?>

                    <?php foreach ($images as $image_id) : ?>

                        <div class="media-container">

                            <?php echo wp_get_attachment_image($image_id, 'large_medium'); ?>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <!-- END DESKTOP ------------------------------------------------------------------------------------------------>

            <!-- MOBILE ------------------------------------------------------------------------------------------------>

            <div class="piece-product-single__thumbnail mobile">

                <div class="media-container">

                    <?php the_post_thumbnail('large_medium'); ?>

                </div>

            </div>

            <!-- MOBILE ------------------------------------------------------------------------------------------------>

            <div class="piece-product-single__details">

                <div class="piece-product-single__details-inner">

                    <div class="piece-product-single__intro">

                        <h1 class="piece-product-single__title item-title">

                            <strong><?php the_field("title"); ?></strong>
                            <span><?php the_field("sub-title"); ?></span>
                            <?php if (get_field("sub-title_2")): ?>
                                <span class="sub-title-2"><?php the_field("sub-title_2"); ?></span>
                            <?php endif; ?>

                        </h1>

                        <div class="piece-product-single__subtitle p--big">

                            <?php the_content(); ?>

                        </div>

                        <div class="piece-product-single__description p--normal">

                            <?php the_field("description"); ?>

                        </div>

                    </div>

                    <!-- PIECE SPECS ------------------------------------------------------------------------------------------------>

                    <?php get_template_part("/template-parts/piece/section-single-piece-specs"); ?>

                    <!-- END PIECE SPECS ------------------------------------------------------------------------------------------------>

                </div>

                <?php $product = wc_get_product(get_the_ID()); ?>

                <div class="piece-product-single__purchase">

                    <!-- PIECE PRICE ------------------------------------------------------------------------------------------------>

                    <div class="piece-product__price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <!-- END PIECE PRICE ------------------------------------------------------------------------------------------------>

                    <!-- PIECE ADD TO CART ------------------------------------------------------------------------------------------------>

                    <form class="cart" action="<?php echo esc_url($product->get_permalink()); ?>" method="post">

                        <button
                            type="submit"
                            name="add-to-cart"
                            value="<?php echo esc_attr($product->get_id()); ?>"
                            class="piece-product__add-to-cart">
                            <?php esc_html_e('add to cart', 'mmdwc'); ?>
                        </button>

                    </form>
                    <!-- END PIECE ADD TO CART ------------------------------------------------------------------------------------------------>

                </div>

                <!-- MOBILE ------------------------------------------------------------------------------------------------>

                <div class="piece-product-single__gallery mobile">

                    <?php
                    $images = get_field('images');
                    $size = 'large_medium';
                    if ($images): ?>

                        <?php foreach ($images as $image_id): ?>

                            <div class="media-container">

                                <?php echo wp_get_attachment_image($image_id, $size); ?>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

                <!-- END MOBILE ------------------------------------------------------------------------------------------------>

            </div>

        </section>

        <!-- END PIECE SINGLE ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<!-- PRODUCTS GRID ------------------------------------------------------------------------------------------------>

<?php

$products = new WP_Query([
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'menu_order',
    'order'          => 'DESC',
]);

get_template_part('woocommerce/products-grid', null, [
    'query' => $products,
]);

wp_reset_postdata();

?>

<!-- END PRODUCTS GRID ------------------------------------------------------------------------------------------------>

<?php get_footer(); ?>