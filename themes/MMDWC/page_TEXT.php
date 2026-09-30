<?php
/*
Template Name: TEMPLATE TEXT
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <section id="page-defautlt" class="page-defautlt">

            <div class="section-header">

                <h1><?php the_title(); ?></h1>

            </div>

            <div class="page-default-content">

                <?php the_content(); ?>

            </div>

        </section>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>