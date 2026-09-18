<?php
/*
Template Name: TEMPLATE CONTACT
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- HERO SECTION ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/section-hero"); ?>

        <!-- END HERO SECTION ------------------------------------------------------------------------------------------------>

        <!-- CONTACT SECTION ------------------------------------------------------------------------------------------------>

        <section id="contact-contact" class="contact__section">

            <div class="section-header">

                <h1>CONTACT US</h1>

            </div>

            <!-- CONTACT ITEM ------------------------------------------------------------------------------------------------>

            <div class="contact-item">

                <h3>Prices and Product Sheets</h3>

                <a href="#">info@hamrei.com</a>

            </div>

            <!-- END CONTACT ITEM ------------------------------------------------------------------------------------------------>

            <!-- CONTACT ITEM ------------------------------------------------------------------------------------------------>

            <div class="contact-item">

                <h3>Professionnal Enquiries</h3>

                <a href="#">pro@hamrei.com</a>

            </div>

            <!-- END CONTACT ITEM ------------------------------------------------------------------------------------------------>

            <!-- CONTACT ITEM ------------------------------------------------------------------------------------------------>

            <div class="contact-item">

                <h3>Press and Digital</h3>

                <a href="#">as@hamrei.com</a>

            </div>

            <!-- END CONTACT ITEM ------------------------------------------------------------------------------------------------>

        </section>

        <!-- END CONTACT SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>