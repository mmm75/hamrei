<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php

        $title = get_field('title');
        $sub_title = get_field('sub-title');
        $sub_title_2 = get_field('sub-title_2');
        $text = get_field('text');

        $left_column = get_field('left_column');
        $pieces = get_field('pieces');

        $video = get_field('video');

        $video_id = !empty($video['video_id']) ? $video['video_id'] : '';
        $video_thumbnail = !empty($video['video_thumbnail']) ? $video['video_thumbnail'] : '';

        $video_thumbnail_url = $video_thumbnail
            ? wp_get_attachment_image_url($video_thumbnail, 'large')
            : '';

        $video_url = $video_id
            ? 'https://vz-eb7b1f3f-f93.b-cdn.net/' . $video_id . '/play_720p.mp4'
            : '';

        ?>

        <article class="film-single">

            <!-- FILM VIDEO ------------------------------------------------------------------------------------------------>

            <?php if ($video_id) : ?>

                <div class="film-single__video">

                    <div class="media-container media-container--16-9 video-container">

                        <video
                            playsinline
                            disablepictureinpicture
                            webkit-playsinline
                            preload="metadata"
                            <?php if ($video_thumbnail_url) : ?>
                            poster="<?php echo esc_url($video_thumbnail_url); ?>"
                            <?php endif; ?>>

                            <source
                                src="<?php echo esc_url($video_url); ?>"
                                type="video/mp4">

                        </video>

                        <button
                            type="button"
                            class="project-item__play film-single__play"
                            aria-label="<?php esc_attr_e('play video', 'mmdwc'); ?>">
                        </button>

                    </div>

                </div>

            <?php endif; ?>

            <!-- END FILM VIDEO ------------------------------------------------------------------------------------------------>

            <!-- FILM HEADER ------------------------------------------------------------------------------------------------>

            <div class="film-single__header">

                <div class="title-date film-single__date">

                    <?php echo get_the_date('F j, Y'); ?>

                </div>

                <?php if ($title || $sub_title || $sub_title_2) : ?>

                    <h1 class="item-title films__title film-single__title">

                        <?php if ($title) : ?>

                            <strong>

                                <?php echo $title; ?>

                            </strong>

                        <?php endif; ?>

                        <?php if ($sub_title) : ?>

                            <span>

                                <?php echo $sub_title; ?>

                            </span>

                        <?php endif; ?>

                        <?php if ($sub_title_2) : ?>

                            <span class="sub-title-2">

                                <?php echo $sub_title_2; ?>

                            </span>

                        <?php endif; ?>

                    </h1>

                <?php endif; ?>

            </div>

            <!-- END FILM HEADER ------------------------------------------------------------------------------------------------>

            <!-- FILM CONTENT ------------------------------------------------------------------------------------------------>

            <div class="film-single__body">

                <!-- FILM LEFT COLUMN ------------------------------------------------------------------------------------------------>

                <div class="left-column film-single__left-column">

                    <?php if (!empty($left_column['title'])) : ?>

                        <h3 class="left-column-title item-title film-single__left-column-title">

                            <?php echo $left_column['title']; ?>

                        </h3>

                    <?php endif; ?>

                    <?php if (!empty($left_column['text'])) : ?>

                        <div class="left-column-text film-single__left-column-text p--normal">

                            <?php echo wp_kses_post($left_column['text']); ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- END FILM LEFT COLUMN ------------------------------------------------------------------------------------------------>

                <!-- FILM MIDDLE COLUMN ------------------------------------------------------------------------------------------------>

                <div class="middle-column film-single__middle-column">

                    <?php if ($pieces) : ?>

                        <h3 class="middle-column-title item-title film-single__middle-column-title">

                            <?php _e('pieces', 'mmdwc'); ?>

                        </h3>

                        <div class="film-single__pieces">

                            <?php foreach ($pieces as $piece) : ?>

                                <?php

                                $piece_id = is_object($piece)
                                    ? $piece->ID
                                    : $piece;

                                $piece_title = get_field('title', $piece_id);
                                $piece_sub_title = get_field('sub-title', $piece_id);

                                ?>

                                <a
                                    href="<?php echo get_permalink($piece_id); ?>"
                                    class="item-title film-single__piece">

                                    <?php if ($piece_title) : ?>

                                        <strong>

                                            <?php echo $piece_title; ?>

                                        </strong>

                                    <?php endif; ?>

                                    <?php if ($piece_sub_title) : ?>

                                        <span>

                                            <?php echo $piece_sub_title; ?>

                                        </span>

                                    <?php endif; ?>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- END FILM MIDDLE COLUMN ------------------------------------------------------------------------------------------------>

                <!-- FILM RIGHT COLUMN ------------------------------------------------------------------------------------------------>

                <div class="right-column film-single__right-column">

                    <?php if (get_the_content()) : ?>

                        <div class="film-single__main-text p--big">

                            <?php the_content(); ?>

                        </div>

                    <?php endif; ?>

                    <?php if ($text) : ?>

                        <div class="film-single__text p--normal">

                            <?php echo wp_kses_post($text); ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- END FILM RIGHT COLUMN ------------------------------------------------------------------------------------------------>

            </div>

            <!-- END FILM CONTENT ------------------------------------------------------------------------------------------------>

            <?php

            $films_query = new WP_Query([
                'post_type'      => 'film',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'post__not_in'   => [get_the_ID()],
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);

            ?>

            <?php if ($films_query->have_posts()) : ?>

                <!-- OTHER FILMS ------------------------------------------------------------------------------------------------>

                <div class="film-single__other-films films__grid">

                    <?php while ($films_query->have_posts()) : $films_query->the_post(); ?>

                        <?php

                        $other_title = get_field('title');
                        $other_sub_title = get_field('sub-title');
                        $other_sub_title_2 = get_field('sub-title_2');

                        $other_video = get_field('video');

                        $other_video_thumbnail = !empty($other_video['video_thumbnail'])
                            ? $other_video['video_thumbnail']
                            : '';

                        ?>

                        <article class="films__item">

                            <a
                                href="<?php the_permalink(); ?>"
                                class="films__link">

                                <?php if ($other_video_thumbnail) : ?>

                                    <div class="media-container media-container--16-9 films__media">

                                        <?php echo wp_get_attachment_image($other_video_thumbnail, 'large'); ?>

                                    </div>

                                <?php endif; ?>

                                <div class="films__content">

                                    <div class="title-date films__date">

                                        <?php echo get_the_date('F j, Y'); ?>

                                    </div>

                                    <?php if ($other_title || $other_sub_title || $other_sub_title_2) : ?>

                                        <h2 class="item-title films__title">

                                            <?php if ($other_title) : ?>

                                                <strong>

                                                    <?php echo $other_title; ?>

                                                </strong>

                                            <?php endif; ?>

                                            <?php if ($other_sub_title) : ?>

                                                <span>

                                                    <?php echo $other_sub_title; ?>

                                                </span>

                                            <?php endif; ?>

                                            <?php if ($other_sub_title_2) : ?>

                                                <span class="sub-title-2">

                                                    <?php echo $other_sub_title_2; ?>

                                                </span>

                                            <?php endif; ?>

                                        </h2>

                                    <?php endif; ?>

                                </div>

                            </a>

                        </article>

                    <?php endwhile; ?>

                </div>

                <!-- END OTHER FILMS ------------------------------------------------------------------------------------------------>

                <?php wp_reset_postdata(); ?>

            <?php endif; ?>

        </article>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>