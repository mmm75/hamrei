<?php $about_us_1 = get_field('about_us_1', 18); ?>

<?php if ($about_us_1) : ?>

    <div class="about__section-1">

        <div class="about__section-1-left">

            <?php if ($about_us_1['image']) : ?>

                <div class="media-container media-container--square">

                    <?php echo wp_get_attachment_image($about_us_1['image'], 'full'); ?>

                </div>

            <?php endif; ?>

        </div>

        <div class="about__section-1-right">

            <?php if ($about_us_1['quote']) : ?>

                <div class="about__section-quote">

                    <blockquote>

                        <?php echo $about_us_1['quote']; ?>

                    </blockquote>

                    <div class="about__section-signature">

                        HAMREI

                    </div>

                </div>

            <?php endif; ?>

            <?php if ($about_us_1['text_1']) : ?>

                <div class="p--big">

                    <?php echo $about_us_1['text_1']; ?>

                </div>

            <?php endif; ?>

            <?php if ($about_us_1['text_2']) : ?>

                <div class="p--normal">

                    <?php echo $about_us_1['text_2']; ?>

                </div>

            <?php endif; ?>

            <?php if ($about_us_1['link']) : ?>

                <a
                    href="<?php echo esc_url($about_us_1['link']['url']); ?>"
                    class="custom-button"
                    <?php echo $about_us_1['link']['target'] ? 'target="' . esc_attr($about_us_1['link']['target']) . '"' : ''; ?>>

                    <?php echo esc_html($about_us_1['link']['title']); ?>

                </a>

            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>