<?php
/*
Template Name: TEMPLATE CONTACT
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- HERO SECTION ------------------------------------------------------------------------------------------------>

        <!-- < ?php get_template_part("/template-parts/section-hero"); ?> -->

        <!-- END HERO SECTION ------------------------------------------------------------------------------------------------>

        <!-- CONTACT SECTION ------------------------------------------------------------------------------------------------>

        <section id="contact-contact" class="contact__section">

            <div class="section-header">

                <h1><?php the_title(); ?></h1>

            </div>

            <?php if (have_rows('contacts')) : ?>

                <?php while (have_rows('contacts')) : the_row(); ?>

                    <?php
                    $contact_text  = get_sub_field('text');
                    $contact_email = get_sub_field('e-mail');
                    ?>

                    <!-- CONTACT ITEM ------------------------------------------------------------------------------------------------>

                    <div class="contact-item">

                        <h3><?php echo esc_html($contact_text); ?></h3>

                        <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>

                    </div>

                    <!-- END CONTACT ITEM ------------------------------------------------------------------------------------------------>

                <?php endwhile; ?>

            <?php endif; ?>

        </section>

        <!-- END CONTACT SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>