<?php
$about_us_3_left = get_field('about_us_3_left', apply_filters('wpml_object_id', 18, 'page', true));
$about_us_3_right = get_field('about_us_3_right', apply_filters('wpml_object_id', 18, 'page', true));
?>

<?php if ($about_us_3_left || $about_us_3_right) : ?>

    <div class="about__section-3">

        <div class="about__section-3-left">

            <?php if ($about_us_3_left['image_1']) : ?>

                <div class="floating-image media-container media-container--2-3">

                    <?php echo wp_get_attachment_image($about_us_3_left['image_1'], 'full'); ?>

                </div>

            <?php endif; ?>

            <div class="about__section-3-main-image">

                <?php if ($about_us_3_left['image_2']) : ?>

                    <div class="media-container media-container--2-3">

                        <?php echo wp_get_attachment_image($about_us_3_left['image_2'], 'full'); ?>

                    </div>

                <?php endif; ?>

                <?php if ($about_us_3_left['title']) : ?>

                    <div class="vertical-label about__section-3-left-label">

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

            </div>

        </div>

        <div class="about__section-3-right">

            <?php if ($about_us_3_right['image_1']) : ?>

                <div class="about__section-3-top-image">

                    <div class="media-container media-container--3-2">

                        <?php echo wp_get_attachment_image($about_us_3_right['image_1'], 'full'); ?>

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

                    <div class="vertical-label about__section-3-right-label">

                        <?php echo esc_html($about_us_3_right['title']); ?>

                    </div>

                <?php endif; ?>

            </div>

            <?php if ($about_us_3_right['image_2']) : ?>

                <div class="about__section-3-bottom-image">

                    <div class="media-container media-container--square">

                        <?php echo wp_get_attachment_image($about_us_3_right['image_2'], 'full'); ?>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>