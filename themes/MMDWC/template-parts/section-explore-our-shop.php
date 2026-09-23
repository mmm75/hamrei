<?php $products = get_field('selection', 9); ?>

<?php if ($products) : ?>

    <section id="shop-row-items" class="shop-row-items">

        <div class="section-header">

            <h2><?php esc_html_e('explore our e-shop', 'mmdwc'); ?></h2>

        </div>

        <!-- EXPLORE OUR SHOP ROW ------------------------------------------------------------------------------------------------>

        <div class="shop-row-items__row">

            <?php foreach ($products as $product_id) : ?>

                <!-- EXPLORE OUR SHOP ITEM ------------------------------------------------------------------------------------------------>

                <div class="shop-row-items__row-item">

                    <a href="<?php echo esc_url(get_permalink($product_id)); ?>">

                        <div class="media-container media-container--3-4">

                            <?php echo get_the_post_thumbnail($product_id, 'full'); ?>

                        </div>

                    </a>

                    <div class="shop-row-items__row-content">

                        <h3 class="item-title">

                            <strong><?php echo get_field('title', $product_id); ?></strong>

                            <span>— <?php echo get_field('sub-title', $product_id); ?></span>

                        </h3>

                        <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="custom-button">

                            <?php esc_html_e('discover', 'mmdwc'); ?>

                        </a>

                    </div>

                </div>

                <!-- END EXPLORE OUR SHOP ITEM ------------------------------------------------------------------------------------------------>

            <?php endforeach; ?>

        </div>

        <!-- END EXPLORE OUR SHOP ROW ------------------------------------------------------------------------------------------------>

    </section>

<?php endif; ?>