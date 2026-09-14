<?php
/*
Template Name: TEMPLATE HOME
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>