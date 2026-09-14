<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php endwhile; ?>

<?php else : ?>

	<h2>No posts found.</h2>

<?php endif; ?>

<?php get_footer(); ?>