<?php

$products = $args['query'] ?? $GLOBALS['wp_query'];

?>

<div id="products-grid" class="product-grid">

    <?php while ($products->have_posts()) : $products->the_post(); ?>

        <?php $product = wc_get_product(get_the_ID()); ?>

        <div class="product-grid__item">

            <?php if (has_post_thumbnail()) : ?>

                <a href="<?php the_permalink(); ?>" class="product-grid__image">

                    <div class="media-container media-container--3-4">

                        <?php the_post_thumbnail('full'); ?>

                    </div>

                </a>

            <?php endif; ?>

            <div class="product-grid__content">

                <h2 class="product-grid__title item-title">

                    <strong><?php the_field('title'); ?></strong>

                    <span><?php the_field('sub-title'); ?></span>

                </h2>

                <?php if (get_the_content()) : ?>

                    <div class="product-grid__description p--small">

                        <?php the_content(); ?>

                    </div>

                <?php endif; ?>

                <div class="piece-product__price">

                    <?php echo $product->get_price_html(); ?>

                </div>

                <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>

                    <form class="product-grid__cart" action="<?php echo esc_url($product->get_permalink()); ?>" method="post">

                        <button
                            type="submit"
                            name="add-to-cart"
                            value="<?php echo esc_attr($product->get_id()); ?>"
                            class="piece-product__add-to-cart">

                            <?php esc_html_e('add to cart', 'mmdwc'); ?>

                        </button>

                    </form>

                <?php endif; ?>

            </div>

        </div>

    <?php endwhile; ?>

</div>