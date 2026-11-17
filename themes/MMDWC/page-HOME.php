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

                                <div class="swiper highlights__row">

                                        <div class="swiper-wrapper">

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

                                                        <div class="swiper-slide highlights__row-item">

                                                                <?php if ($video_id) : ?>

                                                                        <a href="<?php echo esc_url(get_permalink($piece_id)); ?>">

                                                                                <div class="media-container media-container--3-4">

                                                                                        <video
                                                                                                class="js-highlight-video"
                                                                                                muted
                                                                                                loop
                                                                                                playsinline
                                                                                                disablepictureinpicture
                                                                                                webkit-playsinline
                                                                                                preload="none">

                                                                                                <source
                                                                                                        data-src-mobile="https://vz-eb7b1f3f-f93.b-cdn.net/<?php echo esc_attr($video_id); ?>/play_720p.mp4"
                                                                                                        data-src-desktop="https://vz-eb7b1f3f-f93.b-cdn.net/<?php echo esc_attr($video_id); ?>/play_1080p.mp4"
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

                                        <div class="swiper-pagination carousel-pagination highlights__pagination"></div>

                                </div>

                        <?php endif; ?>

                        <!-- END HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

                        <!-- HIGHTLIGHTS GRID ------------------------------------------------------------------------------------------------>

                        <?php
                        $grid_highlights = get_field('grid_highlights');

                        if (!is_array($grid_highlights)) {
                                $grid_highlights = [];
                        }

                        $current_language = apply_filters('wpml_current_language', null);
                        ?>

                        <!-- light tables chairs
            storage object rugs -->

                        <div class="highlights__grid">

                                <?php if ($grid_highlights) : ?>

                                        <?php foreach ($grid_highlights as $grid_highlights_category_id) : ?>

                                                <?php
                                                $grid_highlights_category_id = apply_filters(
                                                        'wpml_object_id',
                                                        (int) $grid_highlights_category_id,
                                                        'piece_category',
                                                        true,
                                                        $current_language
                                                );

                                                $highlight_category = get_term(
                                                        $grid_highlights_category_id,
                                                        'piece_category'
                                                );

                                                if (!$highlight_category || is_wp_error($highlight_category)) {
                                                        continue;
                                                }

                                                $featured_image = get_field(
                                                        'featured_image',
                                                        'piece_category_' . $highlight_category->term_id
                                                );
                                                ?>

                                                <!-- ITEM ------------------------------------------------------------------------------------------------>

                                                <div class="highlights__grid-item">

                                                        <a href="<?php echo esc_url(get_term_link($highlight_category)); ?>">

                                                                <?php if ($featured_image) : ?>

                                                                        <div class="media-container media-container--square">

                                                                                <?php
                                                                                echo wp_get_attachment_image(
                                                                                        $featured_image,
                                                                                        'image_square',
                                                                                        false,
                                                                                        [
                                                                                                'sizes' => '(max-width: 768px) 50vw, 33.333vw',
                                                                                        ]
                                                                                );
                                                                                ?>
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

                        <section id="home-pre-footer" class="home__pre-footer desktop">

                                <div class="media-container media-container--9-4">

                                        <?php echo wp_get_attachment_image($image_footer, 'large'); ?>

                                </div>

                        </section>

                <?php endif; ?>

                <!-- END PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>