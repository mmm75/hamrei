<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- PIECE SINGLE ------------------------------------------------------------------------------------------------>

        <section class="piece-product-single">

            <div class="piece-product-single__gallery">

                <?php
                $images = get_field('images');
                $size = 'full';
                if ($images): ?>

                    <?php foreach ($images as $image_id): ?>

                        <div class="media-container">

                            <?php echo wp_get_attachment_image($image_id, $size); ?>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <div class="piece-product-single__details">

                <div class="piece-product-single__details-inner">

                    <div class="piece-product-single__intro">

                        <h1 class="piece-product-single__title item-title">

                            <strong><?php the_field("title"); ?></strong>
                            <span><?php the_field("sub-title"); ?></span>

                        </h1>

                        <div class="piece-product-single__subtitle p--big">

                            <?php the_content(); ?>

                        </div>

                        <div class="piece-product-single__description p--normal">

                            <?php the_field("description"); ?>

                        </div>

                    </div>


                    <div class="piece-product-single__specs">

                        <!-- PIECE SPECS ------------------------------------------------------------------------------------------------>

                        <?php get_template_part("/template-parts/piece/section-single-piece-specs"); ?>

                        <!-- END PIECE SPECS ------------------------------------------------------------------------------------------------>

                        <!-- PIECE SPEC FAMILY ------------------------------------------------------------------------------------------------>

                        <?php $families = get_the_terms(get_the_ID(), 'family');

                        if ($families && !is_wp_error($families)) : ?>

                            <?php $family = reset($families);

                            $family_pieces = get_posts([
                                'post_type'      => 'piece',
                                'posts_per_page' => 1,
                                'post_status'    => 'publish',
                                'post__not_in'   => [get_the_ID()],
                                'fields'         => 'ids',
                                'tax_query'      => [
                                    [
                                        'taxonomy' => 'family',
                                        'field'    => 'term_id',
                                        'terms'    => $family->term_id,
                                    ],
                                ],
                            ]); ?>

                            <?php if ($family_pieces) : ?>

                                <div class="piece-product-single__spec">

                                    <div class="piece-product-single__spec-title"><?php esc_html_e('family', 'mmdwc'); ?></div>

                                    <div class="piece-product-single__spec-content">

                                        <?php get_template_part("/template-parts/piece/section-single-piece-family"); ?>

                                    </div>

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>

                        <!-- END PIECE SPEC FAMILY ------------------------------------------------------------------------------------------------>

                    </div>

                    <div class="piece-product-single__actions">

                        <?php
                        $enquiry_subject = 'ENQUIRY-' . get_field('title') . '-' . get_field('sub-title');
                        ?>

                        <a href="mailto:info@hamrei.com?subject=<?php echo rawurlencode($enquiry_subject); ?>" class="custom-button"><?php esc_html_e('request a quotation', 'mmdwc'); ?></a>

                        <?php if (get_field("product_pdf")): ?>

                            <a href="<?php the_field("product_pdf"); ?>" download class="custom-button"><?php esc_html_e('download product sheet PDF', 'mmdwc'); ?></a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </section>

        <!-- PIECE SINGLE ------------------------------------------------------------------------------------------------>

        <!-- YOU MAY ALSO LIKE ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/piece/section-single-piece-you-may-also-like"); ?>

        <!-- END YOU MAY ALSO LIKE ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>