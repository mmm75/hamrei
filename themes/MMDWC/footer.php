</main>

<footer id="footer" class="footer">

    <?php $tagline_footer = get_field('tagline_footer', 'option'); ?>

    <?php if ($tagline_footer) : ?>

        <?php echo wp_get_attachment_image($tagline_footer, 'large', false, ['class' => 'footer__claim desktop']); ?>

    <?php endif; ?>

    <div class="footer__logo mobile">

        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_BIG.png"
            alt="HAMREI">

    </div>

    <div class="footer__content">

        <div class="footer__newsletter">

            <h2><?php esc_html_e('newsletter', 'mmdwc'); ?></h2>

            <div class="p--normal">
                <p>
                    <?php echo wp_kses_post(__("Don't miss a thing", 'mmdwc')); ?>
                </p>
            </div>

            <div class="mailchimp">

                <form
                    class="pfb-signup-submission"
                    autocomplete="off"
                    method="post"
                    data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                    data-success-message="<?php echo esc_attr__("Thank you for subscribing.", 'mmdwc'); ?>"
                    data-error-message="<?php echo esc_attr__('An error occurred. Please try again.', 'mmdwc'); ?>">

                    <input
                        type="email"
                        required
                        autocomplete="off"
                        name="email"
                        class="pfb-signup-box-email pfb-signup-box custom-button"
                        placeholder="<?php esc_attr_e('sign up', 'mmdwc'); ?>">

                    <input
                        type="hidden"
                        name="action"
                        value="hamrei_mailchimp_signup">

                    <?php wp_nonce_field(
                        'hamrei_mailchimp_signup',
                        'hamrei_mailchimp_nonce'
                    ); ?>

                    <button
                        type="submit"
                        class="pfb-signup-button submit-button custom-button">

                        <?php _e('Ok', 'mmdwc'); ?>

                    </button>

                </form>

                <div
                    class="mailchimp__message"
                    aria-live="polite">
                </div>

            </div>

        </div>

        <div class="footer__links">

            <nav class="footer__column">

                <h2><?php esc_html_e('about', 'mmdwc'); ?></h2>

                <?php
                wp_nav_menu([
                    'menu'       => 'Menu Footer',
                    'container'  => false,
                    'menu_class' => '',
                ]);
                ?>

            </nav>

            <nav class="footer__column">

                <h2><?php esc_html_e('contact', 'mmdwc'); ?></h2>

                <?php $contacts_page_id = apply_filters('wpml_object_id', 20, 'page', true); ?>

                <?php if (have_rows('contacts', $contacts_page_id)) : ?>

                    <ul>

                        <?php while (have_rows('contacts', $contacts_page_id)) : the_row(); ?>

                            <!-- CONTACT ITEM ------------------------------------------------------------------------------------------------>

                            <li>

                                <a href="mailto:<?php the_sub_field('e-mail'); ?>"><?php the_sub_field('text'); ?></a>

                            </li>

                            <!-- END CONTACT ITEM ------------------------------------------------------------------------------------------------>

                        <?php endwhile; ?>

                    </ul>

                <?php endif; ?>

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

    <div class="footer__logo desktop">

        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_BIG.png"
            alt="HAMREI">

    </div>

</footer>

<?php wp_footer(); ?>

</body>

</html>