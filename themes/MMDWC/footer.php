</main>

<footer id="footer" class="footer">

    <?php $tagline_footer = get_field('tagline_footer', 'option'); ?>

    <?php if ($tagline_footer) : ?>

        <?php echo wp_get_attachment_image($tagline_footer, 'full', false, ['class' => 'footer__claim']); ?>

    <?php endif; ?>

    <div class="footer__content">

        <div class="footer__newsletter">

            <h2><?php esc_html_e('newsletter', 'mmdwc'); ?></h2>

            <div class="p--normal">
                <p>
                    Don't<br>
                    miss<br>
                    anything
                </p>
            </div>

            <a href="#" class="custom-button">
                <?php esc_html_e('sign up', 'mmdwc'); ?>
            </a>

        </div>

        <div class="footer__links">

            <nav class="footer__column">

                <h2><?php esc_html_e('about', 'mmdwc'); ?></h2>

                <ul>
                    <li><a href="#">The Collection</a></li>
                    <li><a href="#">Studio</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Story</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>

            </nav>

            <nav class="footer__column">

                <h2><?php esc_html_e('contact', 'mmdwc'); ?></h2>

                <ul>
                    <li><a href="#">Collection enquiries</a></li>
                    <li><a href="#">DAM Lisbon</a></li>
                    <li><a href="#">Press</a></li>
                </ul>

            </nav>

            <nav class="footer__column">

                <h2><?php esc_html_e('follow', 'mmdwc'); ?></h2>

                <?php if (have_rows('social', 'option')) : ?>

                    <ul>

                        <?php while (have_rows('social', 'option')) : the_row(); ?>

                            <li>

                                <a
                                    href="<?php echo esc_url(get_sub_field('url')); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer">

                                    <?php echo esc_html(get_sub_field('name')); ?>

                                </a>

                            </li>

                        <?php endwhile; ?>

                    </ul>

                <?php endif; ?>

            </nav>

        </div>

    </div>

    <div class="footer__logo">

        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_BIG.png"
            alt="HAMREI">

    </div>

</footer>

<?php wp_footer(); ?>

</body>

</html>