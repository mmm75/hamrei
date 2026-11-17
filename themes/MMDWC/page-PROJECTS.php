<?php

/**
 * Template Name: TEMPLATE PROJECTS
 */

?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php

        $press_query = new WP_Query([
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'posts_per_page'         => -1,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
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
                    $date = get_field("date");
                    ?>



                    <!-- PROJECT ITEM STANDARD ------------------------------------------------------------------------------------------------>

                    <article class="project-item<?php echo $project_index % 2 ? ' project-item--reverse' : ''; ?>">

                        <!-- PROJECT ITEM IMAGE ------------------------------------------------------------------------------------------------>

                        <div class="project-item__image">

                            <?php if (has_post_thumbnail()) : ?>

                                <div class="media-container media-container--square">

                                    <?php
                                    the_post_thumbnail(
                                        'image_square',
                                        [
                                            'sizes' => '(max-width: 768px) 100vw, 50vw',
                                        ]
                                    );
                                    ?>

                                </div>

                            <?php endif; ?>

                        </div>

                        <!-- END PROJECT ITEM IMAGE ------------------------------------------------------------------------------------------------>

                        <!-- PROJECT ITEM CONTENT ------------------------------------------------------------------------------------------------>

                        <div class="project-item__content">

                            <div class="project-item__content-inner">

                                <?php if ($date) : ?>

                                    <div class="title-date project-item__date">

                                        <?php echo $date; ?>

                                    </div>

                                <?php endif; ?>

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

                <?php endwhile; ?>

            </section>

            <!-- END PROJECTS SECTION ------------------------------------------------------------------------------------------------>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>