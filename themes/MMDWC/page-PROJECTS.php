<?php

/**
 * Template Name: TEMPLATE PROJECTS
 */

?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php

        $press_query = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        ?>

        <?php if ($press_query->have_posts()) : ?>

            <?php $project_index = 0; ?>

            <section id="projects" class="projects">

                <div class="section-header">

                    <h1><?php the_title(); ?></h1>

                </div>

                <?php while ($press_query->have_posts()) : $press_query->the_post(); ?>

                    <?php

                    $title = get_field('title');
                    $sub_title = get_field('sub-title');
                    $sub_title_2 = get_field('sub-title_2');
                    $text = get_field('text');
                    $link = get_field('link');
                    $file = get_field('file');
                    $left_column = get_field('left_column');
                    $video_id = get_field('video_url');
                    $carousel = get_field('carousel');

                    $video_url = $video_id
                        ? 'https://vz-809edc8b-256.b-cdn.net/' . $video_id . '/play_720p.mp4'
                        : '';

                    $has_left_column = !empty($left_column['title']) || !empty($left_column['text']);

                    ?>

                    <?php if ($has_left_column) : ?>

                        <!-- PROJECT ITEM WITH LEFT COLUMN ------------------------------------------------------------------------------------------------>

                        <article class="project-item project-item--with-left-column">

                            <!-- PROJECT ITEM MEDIA ------------------------------------------------------------------------------------------------>

                            <?php if ($carousel || $video_id || has_post_thumbnail()) : ?>

                                <div class="project-item__media">

                                    <?php if ($carousel) : ?>

                                        <!-- PROJECT ITEM CAROUSEL ------------------------------------------------------------------------------------------------>

                                        <div class="swiper project-item__carousel">

                                            <div class="swiper-wrapper">

                                                <?php foreach ($carousel as $image) : ?>

                                                    <?php
                                                    $image_id = is_array($image)
                                                        ? $image['ID']
                                                        : $image;
                                                    ?>

                                                    <div class="swiper-slide project-item__carousel-slide">

                                                        <div class="media-container project-item__carousel-media">

                                                            <?php echo wp_get_attachment_image($image_id, 'full'); ?>

                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>

                                            </div>

                                        </div>

                                        <!-- END PROJECT ITEM CAROUSEL ------------------------------------------------------------------------------------------------>

                                    <?php elseif ($video_id) : ?>

                                        <!-- PROJECT ITEM VIDEO ------------------------------------------------------------------------------------------------>

                                        <div class="media-container media-container--16-9">

                                            <video
                                                playsinline
                                                disablepictureinpicture
                                                webkit-playsinline
                                                preload="metadata">

                                                <source
                                                    src="<?php echo esc_url($video_url); ?>"
                                                    type="video/mp4">

                                            </video>

                                            <button
                                                type="button"
                                                class="project-item__play"
                                                aria-label="<?php esc_attr_e('play video', 'mmdwc'); ?>">
                                            </button>

                                        </div>

                                        <!-- END PROJECT ITEM VIDEO ------------------------------------------------------------------------------------------------>

                                    <?php else : ?>

                                        <!-- PROJECT ITEM THUMBNAIL ------------------------------------------------------------------------------------------------>

                                        <div class="media-container media-container--16-9">

                                            <?php the_post_thumbnail('full'); ?>

                                        </div>

                                        <!-- END PROJECT ITEM THUMBNAIL ------------------------------------------------------------------------------------------------>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>

                            <!-- END PROJECT ITEM MEDIA ------------------------------------------------------------------------------------------------>

                            <!-- PROJECT ITEM HEADER ------------------------------------------------------------------------------------------------>

                            <div class="project-item__header">

                                <div class="project-item__date">

                                    <?php echo esc_html(get_the_date('F j, Y')); ?>

                                </div>

                                <?php if ($title || $sub_title || $sub_title_2) : ?>

                                    <h3 class="item-title project-item__title">

                                        <?php if ($title) : ?>

                                            <strong>

                                                <?php echo esc_html($title); ?>

                                            </strong>

                                        <?php endif; ?>

                                        <?php if ($sub_title) : ?>

                                            <span>

                                                <?php echo esc_html($sub_title); ?>

                                            </span>

                                        <?php endif; ?>

                                        <?php if ($sub_title_2) : ?>

                                            <span class="sub-title-2">

                                                <?php echo esc_html($sub_title_2); ?>

                                            </span>

                                        <?php endif; ?>

                                    </h3>

                                <?php endif; ?>

                            </div>

                            <!-- END PROJECT ITEM HEADER ------------------------------------------------------------------------------------------------>

                            <!-- PROJECT ITEM BODY ------------------------------------------------------------------------------------------------>

                            <div class="project-item__body">

                                <!-- PROJECT ITEM LEFT COLUMN ------------------------------------------------------------------------------------------------>

                                <div class="project-item__left-column">

                                    <?php if (!empty($left_column['title'])) : ?>

                                        <h3 class="item-title project-item__left-column-title">

                                            <?php echo esc_html($left_column['title']); ?>

                                        </h3>

                                    <?php endif; ?>

                                    <?php if (!empty($left_column['text'])) : ?>

                                        <div class="project-item__left-column-text p--normal">

                                            <?php echo wp_kses_post($left_column['text']); ?>

                                        </div>

                                    <?php endif; ?>

                                </div>

                                <!-- END PROJECT ITEM LEFT COLUMN ------------------------------------------------------------------------------------------------>

                                <!-- PROJECT ITEM RIGHT COLUMN ------------------------------------------------------------------------------------------------>

                                <div class="project-item__right-column">

                                    <?php if (get_the_content()) : ?>

                                        <div class="project-item__main-text p--big">

                                            <?php the_content(); ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ($text) : ?>

                                        <div class="project-item__text p--normal">

                                            <?php echo wp_kses_post($text); ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ($link) : ?>

                                        <a
                                            href="<?php echo esc_url($link['url']); ?>"
                                            class="custom-button project-item__link"
                                            <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>

                                            <?php echo esc_html($link['title']); ?>

                                        </a>

                                    <?php endif; ?>

                                    <?php if ($file && $file['file'] && $file['text']) : ?>

                                        <a
                                            href="<?php echo esc_url($file['file']); ?>"
                                            class="custom-button project-item__file"
                                            download>

                                            <?php echo esc_html($file['text']); ?>

                                        </a>

                                    <?php endif; ?>

                                </div>

                                <!-- END PROJECT ITEM RIGHT COLUMN ------------------------------------------------------------------------------------------------>

                            </div>

                            <!-- END PROJECT ITEM BODY ------------------------------------------------------------------------------------------------>

                        </article>

                        <!-- END PROJECT ITEM WITH LEFT COLUMN ------------------------------------------------------------------------------------------------>

                    <?php else : ?>

                        <!-- PROJECT ITEM STANDARD ------------------------------------------------------------------------------------------------>

                        <article class="project-item<?php echo $project_index % 2 ? ' project-item--reverse' : ''; ?>">

                            <!-- PROJECT ITEM IMAGE ------------------------------------------------------------------------------------------------>

                            <div class="project-item__image">

                                <?php if (has_post_thumbnail()) : ?>

                                    <div class="media-container media-container--square">

                                        <?php the_post_thumbnail('full'); ?>

                                    </div>

                                <?php endif; ?>

                            </div>

                            <!-- END PROJECT ITEM IMAGE ------------------------------------------------------------------------------------------------>

                            <!-- PROJECT ITEM CONTENT ------------------------------------------------------------------------------------------------>

                            <div class="project-item__content">

                                <div class="project-item__content-inner">

                                    <div class="project-item__date">

                                        <?php echo esc_html(get_the_date('F j, Y')); ?>

                                    </div>

                                    <?php if ($title || $sub_title || $sub_title_2) : ?>

                                        <h3 class="item-title project-item__title">

                                            <?php if ($title) : ?>

                                                <strong>

                                                    <?php echo esc_html($title); ?>

                                                </strong>

                                            <?php endif; ?>

                                            <?php if ($sub_title) : ?>

                                                <span>

                                                    <?php echo esc_html($sub_title); ?>

                                                </span>

                                            <?php endif; ?>

                                            <?php if ($sub_title_2) : ?>

                                                <span class="sub-title-2">

                                                    <?php echo esc_html($sub_title_2); ?>

                                                </span>

                                            <?php endif; ?>

                                        </h3>

                                    <?php endif; ?>

                                    <?php if (get_the_content()) : ?>

                                        <div class="project-item__main-text p--big">

                                            <?php the_content(); ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ($text) : ?>

                                        <div class="project-item__text p--normal">

                                            <?php echo wp_kses_post($text); ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ($link) : ?>

                                        <a
                                            href="<?php echo esc_url($link['url']); ?>"
                                            class="custom-button project-item__link"
                                            <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>

                                            <?php echo esc_html($link['title']); ?>

                                        </a>

                                    <?php endif; ?>

                                    <?php if ($file && $file['file'] && $file['text']) : ?>

                                        <a
                                            href="<?php echo esc_url($file['file']); ?>"
                                            class="custom-button project-item__file"
                                            download>

                                            <?php echo esc_html($file['text']); ?>

                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <!-- END PROJECT ITEM CONTENT ------------------------------------------------------------------------------------------------>

                        </article>

                        <!-- END PROJECT ITEM STANDARD ------------------------------------------------------------------------------------------------>

                        <?php $project_index++; ?>

                    <?php endif; ?>

                <?php endwhile; ?>

            </section>

            <!-- END PROJECTS SECTION ------------------------------------------------------------------------------------------------>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>