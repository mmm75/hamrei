<?php $about_us_2 = get_field('about_us_2', 18); ?>

<?php if ($about_us_2) : ?>

    <div class="about__section-2">

        <div class="about__section-2-left">

            <?php if ($about_us_2['text_1']) : ?>

                <div class="p--big">

                    <?php echo $about_us_2['text_1']; ?>

                </div>

            <?php endif; ?>

            <?php if ($about_us_2['text_2']) : ?>

                <div class="p--normal">

                    <?php echo $about_us_2['text_2']; ?>

                </div>

            <?php endif; ?>

            <?php if ($about_us_2['link']) : ?>

                <a
                    href="<?php echo esc_url($about_us_2['link']['url']); ?>"
                    class="custom-button"
                    <?php echo $about_us_2['link']['target'] ? 'target="' . esc_attr($about_us_2['link']['target']) . '"' : ''; ?>>

                    <?php echo $about_us_2['link']['title']; ?>

                </a>

            <?php endif; ?>

        </div>

        <div class="about__section-2-right">

            <?php if ($about_us_2['images']) : ?>

                <div class="swiper about__section-2-slider">

                    <div class="swiper-wrapper">

                        <?php foreach ($about_us_2['images'] as $image_id) : ?>

                            <!-- SLIDE ------------------------------------------------------------------------------------------------>

                            <div class="swiper-slide">

                                <div class="media-container media-container--3-2">

                                    <?php echo wp_get_attachment_image($image_id, 'full'); ?>

                                </div>

                            </div>

                            <!-- END SLIDE ------------------------------------------------------------------------------------------------>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

            <?php if ($about_us_2['title']) : ?>

                <div class="vertical-label about__section-2-studio-label">

                    <?php echo esc_html($about_us_2['title']); ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>