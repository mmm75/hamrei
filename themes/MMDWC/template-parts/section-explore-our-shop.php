<?php $products = get_field('selection', 9); ?>

<?php if ($products) : ?>

    <section id="shop-row-items" class="shop-row-items">

        <div class="section-header">

            <h2><?php esc_html_e('explore our e-shop', 'mmdwc'); ?></h2>

        </div>

        <!-- EXPLORE OUR SHOP ROW ------------------------------------------------------------------------------------------------>

        <div class="swiper shop-row-items__row">

            <div class="swiper-wrapper">

                <?php foreach ($products as $product_id) : ?>

                    <?php
                    $product_url = get_permalink($product_id);
                    $title       = get_field('title', $product_id);
                    $sub_title   = get_field('sub-title', $product_id);
                    ?>

                    <!-- EXPLORE OUR SHOP ITEM ------------------------------------------------------------------------------------------------>

                    <div class="swiper-slide shop-row-items__row-item">

                        <a href="<?php echo esc_url($product_url); ?>">

                            <div class="media-container media-container--3-4">

                                <?php echo get_the_post_thumbnail($product_id, 'image_thumb_product'); ?>

                            </div>

                        </a>

                        <div class="shop-row-items__row-content">

                            <h3 class="item-title">

                                <strong><?php echo esc_html($title); ?></strong>

                                <span><?php echo esc_html($sub_title); ?></span>

                            </h3>

                            <a href="<?php echo esc_url($product_url); ?>" class="custom-button">

                                <?php esc_html_e('discover', 'mmdwc'); ?>

                            </a>

                        </div>

                    </div>

                    <!-- END EXPLORE OUR SHOP ITEM ------------------------------------------------------------------------------------------------>

                <?php endforeach; ?>

            </div>

            <div class="swiper-pagination carousel-pagination shop-row-items__pagination"></div>

        </div>

        <!-- END EXPLORE OUR SHOP ROW ------------------------------------------------------------------------------------------------>

    </section>

<?php endif; ?>