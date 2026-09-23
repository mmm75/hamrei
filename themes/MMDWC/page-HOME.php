<?php
/*
Template Name: TEMPLATE HOME
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- HERO SECTION ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/section-hero"); ?>

        <!-- END HERO SECTION ------------------------------------------------------------------------------------------------>

        <!-- HIGHTLIGHTS SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-highlights" class="home__highlights">

            <div class="section-header">

                <h2><?php esc_html_e('highlights', 'mmdwc'); ?></h2>

            </div>

            <!-- HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

            <?php
            $highlights = get_field('highlights');

            if ($highlights) :
            ?>

                <div class="highlights__row">

                    <?php for ($i = 1; $i <= 3; $i++) :

                        $piece_id = $highlights['highlight_' . $i] ?? null;
                        $video_id = $highlights['highlight_' . $i . '_video'] ?? null;

                        if (!$piece_id) {
                            continue;
                        }

                        $title = get_field('title', $piece_id);
                        $subtitle = get_field('sub-title', $piece_id);
                    ?>

                        <!-- ITEM ------------------------------------------------------------------------------------------------>

                        <div class="highlights__row-item">

                            <?php if ($video_id) : ?>

                                <a href="<?php echo esc_url(get_permalink($piece_id)); ?>">

                                    <div class="media-container media-container--3-4">

                                        <video
                                            autoplay
                                            muted
                                            loop
                                            playsinline
                                            disablepictureinpicture
                                            webkit-playsinline
                                            preload="metadata">

                                            <source
                                                src="https://vz-809edc8b-256.b-cdn.net/<?php echo esc_attr($video_id); ?>/play_720p.mp4"
                                                type="video/mp4">

                                        </video>

                                    </div>

                                </a>

                            <?php endif; ?>

                            <div class="highlights__row-content">

                                <h3 class="item-title">

                                    <strong><?php echo esc_html($title); ?></strong>

                                    <?php if ($subtitle) : ?>

                                        <span><?php echo esc_html($subtitle); ?></span>

                                    <?php endif; ?>

                                </h3>

                                <a href="<?php echo esc_url(get_permalink($piece_id)); ?>" class="custom-button">

                                    <?php esc_html_e('discover', 'mmdwc'); ?>

                                </a>

                            </div>

                        </div>

                        <!-- END ITEM ------------------------------------------------------------------------------------------------>

                    <?php endfor; ?>

                </div>

            <?php endif; ?>

            <!-- END HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

            <!-- HIGHTLIGHTS GRID ------------------------------------------------------------------------------------------------>

            <?php
            $highlight_categories = get_terms([
                'taxonomy'   => 'piece_category',
                'parent'     => 0,
                'hide_empty' => false,
                'exclude'    => [
                    get_term_by('slug', 'art', 'piece_category')->term_id,
                    get_term_by('slug', 'in-stock', 'piece_category')->term_id,
                ],
                'orderby'    => 'term_order',
                'order'      => 'ASC',
            ]);
            ?>

            <div class="highlights__grid">

                <?php if (!is_wp_error($highlight_categories)) : ?>

                    <?php foreach ($highlight_categories as $highlight_category) : ?>

                        <?php
                        $featured_image = get_field('featured_image', 'piece_category_' . $highlight_category->term_id);                        ?>

                        <!-- ITEM ------------------------------------------------------------------------------------------------>

                        <div class="highlights__grid-item">

                            <a href="<?php echo esc_url(get_term_link($highlight_category)); ?>">

                                <?php if ($featured_image) : ?>

                                    <div class="media-container media-container--square">

                                        <?php echo wp_get_attachment_image($featured_image, 'full'); ?>

                                    </div>

                                <?php endif; ?>

                                <div class="highlights__grid-item--name background-<?php echo esc_attr($highlight_category->slug); ?>">

                                    <h3><?php echo esc_html($highlight_category->name); ?></h3>

                                    <img
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_SMALL.svg"
                                        class="logo-hamrei-small"
                                        alt="HAMREI">

                                </div>

                            </a>

                        </div>

                        <!-- END ITEM ------------------------------------------------------------------------------------------------>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <!-- END HIGHTLIGHTS GRID ------------------------------------------------------------------------------------------------>

        </section>

        <!-- END HIGHTLIGHTS SECTION ------------------------------------------------------------------------------------------------>

        <!-- ABOUT SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-about" class="about__section">

            <div class="section-header">

                <?php
                $about_page_id = apply_filters('wpml_object_id', 18, 'page', true);
                ?>

                <h2><?php echo esc_html(get_the_title($about_page_id)); ?></h2>

            </div>

            <!-- ABOUT SECTION 1 ------------------------------------------------------------------------------------------------>

            <?php get_template_part("/template-parts/about/section-about-1"); ?>

            <!-- END ABOUT SECTION 1 ------------------------------------------------------------------------------------------------>

            <!-- ABOUT SECTION 2 ------------------------------------------------------------------------------------------------>

            <?php get_template_part("/template-parts/about/section-about-2"); ?>

            <!-- END ABOUT SECTION 2 ------------------------------------------------------------------------------------------------>

            <!-- ABOUT BOTTOM ------------------------------------------------------------------------------------------------>

        </section>

        <!-- END ABOUT SECTION ------------------------------------------------------------------------------------------------>

        <!-- EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/section-explore-our-shop"); ?>

        <!-- END EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>

        <!-- PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

        <?php $image_footer = get_field('image_footer'); ?>

        <?php if ($image_footer) : ?>

            <section id="home-pre-footer" class="home__pre-footer">

                <div class="media-container media-container--9-4">

                    <?php echo wp_get_attachment_image($image_footer, 'full'); ?>

                </div>

            </section>

        <?php endif; ?>

        <!-- END PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>