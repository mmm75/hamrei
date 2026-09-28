<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <section id="films" class="films">

        <div class="section-header">

            <h1><?php post_type_archive_title(); ?></h1>

        </div>

        <div class="films__grid">

            <?php $film_index = 0; ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php

                $title = get_field('title');
                $sub_title = get_field('sub-title');
                $sub_title_2 = get_field('sub-title_2');

                $video = get_field('video');

                $video_thumbnail = !empty($video['video_thumbnail'])
                    ? $video['video_thumbnail']
                    : '';

                ?>

                <article class="films__item<?php echo $film_index === 0 ? ' films__item--featured' : ''; ?>">

                    <a
                        href="<?php the_permalink(); ?>"
                        class="films__link">

                        <?php if ($video_thumbnail) : ?>

                            <div class="media-container media-container--16-9 films__media">

                                <?php echo wp_get_attachment_image($video_thumbnail, 'large'); ?>

                            </div>

                        <?php endif; ?>

                        <div class="films__content">

                            <div class="title-date films__date">

                                <?php echo get_the_date('F j, Y'); ?>

                            </div>

                            <?php if ($title || $sub_title || $sub_title_2) : ?>

                                <h2 class="item-title films__title">

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

                                </h2>

                            <?php endif; ?>

                        </div>

                    </a>

                </article>

                <?php $film_index++; ?>

            <?php endwhile; ?>

        </div>

    </section>

<?php endif; ?>

<?php get_footer(); ?>