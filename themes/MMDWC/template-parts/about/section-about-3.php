<?php
$about_page_id = apply_filters('wpml_object_id', 18, 'page', true);
$about_us_3_left = get_field('about_us_3_left', $about_page_id);
$about_us_3_right = get_field('about_us_3_right', $about_page_id);
?>

<?php if ($about_us_3_left || $about_us_3_right) : ?>

    <div class="about__section-3">

        <div class="about__section-3-left">

            <?php if ($about_us_3_left['image_1']) : ?>

                <div class="floating-image">

                    <div
                        class="parallax media-container media-container--2-3"
                        data-rellax-speed="2">

                        <?php
                        echo wp_get_attachment_image(
                            $about_us_3_left['image_1'],
                            'large_medium',
                            false,
                            [
                                'sizes' => '17vw',
                            ]
                        );
                        ?>

                    </div>

                </div>

            <?php endif; ?>

            <div class="about__section-3-main-image">

                <?php if ($about_us_3_left['image_2']) : ?>

                    <div
                        class="parallax media-container media-container--2-3"
                        data-rellax-speed="2">

                        <?php
                        echo wp_get_attachment_image(
                            $about_us_3_left['image_2'],
                            'large_medium',
                            false,
                            [
                                'sizes' => '(max-width: 768px) 100vw, 50vw',
                            ]
                        );
                        ?>

                    </div>

                <?php endif; ?>

                <?php if ($about_us_3_left['title']) : ?>

                    <div class="vertical-label about__section-3-left-label parallax" data-rellax-speed="1.5">

                        <?php echo esc_html($about_us_3_left['title']); ?>

                    </div>

                <?php endif; ?>

            </div>

            <div class="about__section-3-left-content">

                <?php if ($about_us_3_left['text_1']) : ?>

                    <div class="p--big">

                        <?php echo $about_us_3_left['text_1']; ?>

                    </div>

                <?php endif; ?>

                <?php if ($about_us_3_left['text_2']) : ?>

                    <div class="p--normal">

                        <?php echo $about_us_3_left['text_2']; ?>

                    </div>

                <?php endif; ?>


                <?php if ($about_us_3_left['link']) : ?>

                    <a
                        href="<?php echo esc_url($about_us_3_left['link']['url']); ?>"
                        class="custom-button"
                        <?php echo $about_us_3_left['link']['target'] ? 'target="' . esc_attr($about_us_3_left['link']['target']) . '"' : ''; ?>>

                        <?php echo $about_us_3_left['link']['title']; ?>

                    </a>

                <?php endif; ?>

            </div>

        </div>

        <div class="about__section-3-right">

            <?php if ($about_us_3_right['image_1']) : ?>

                <div class="about__section-3-top-image">

                    <div
                        class="parallax media-container media-container--3-2"
                        data-rellax-speed="3">

                        <?php
                        echo wp_get_attachment_image(
                            $about_us_3_right['image_1'],
                            'large_medium',
                            false,
                            [
                                'sizes' => '(max-width: 768px) 100vw, 40vw',
                            ]
                        );
                        ?>

                    </div>

                </div>

            <?php endif; ?>

            <div class="about__section-3-right-content">

                <?php if ($about_us_3_right['text_1']) : ?>

                    <div class="p--big">

                        <?php echo $about_us_3_right['text_1']; ?>

                    </div>

                <?php endif; ?>

                <?php if ($about_us_3_right['text_2']) : ?>

                    <div class="p--normal">

                        <?php echo $about_us_3_right['text_2']; ?>

                    </div>

                <?php endif; ?>

                <?php if ($about_us_3_right['title']) : ?>

                    <div class="vertical-label about__section-3-right-label parallax" data-rellax-speed="1.2">

                        <?php echo esc_html($about_us_3_right['title']); ?>

                    </div>

                <?php endif; ?>

            </div>

            <?php if ($about_us_3_right['image_2']) : ?>

                <div class="about__section-3-bottom-image">

                    <div class="media-container media-container--square">

                        <?php
                        echo wp_get_attachment_image(
                            $about_us_3_right['image_2'],
                            'image_square',
                            false,
                            [
                                'sizes' => '(max-width: 768px) 100vw, 50vw',
                            ]
                        );
                        ?>
                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>