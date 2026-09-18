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

                <h2>HIGHLIGHTS</h2>

            </div>

            <!-- HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

            <div class="highlights__row">

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

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
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>OSSO</strong>
                            <span>LAMP</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

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
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>XX</strong>
                            <span>LAMP</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

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
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>FUN GUY</strong>
                            <span>TABLE</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

            </div>

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

                <h2>ABOUT US</h2>

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

        <section id="home-pre-footer" class="home__pre-footer">

            <div class="media-container media-container--9-4">

                <img
                    src="http://localhost:8888/wp-content/uploads/2026/09/pre-footer-scaled.jpg"
                    alt="">

            </div>

        </section>

        <!-- END PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>