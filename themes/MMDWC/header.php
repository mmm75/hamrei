<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<header id="header" <?php if (is_page_template('page-HOME.php')) : ?> class="absolute-header" <?php endif; ?>>

		<div class="header__logo">

			<a href="<?php echo esc_url(home_url('/')); ?>">

				<img
					src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_SMALL-temp.png"
					class="logo-hamrei-small"
					alt="HAMREI">

			</a>

		</div>

		<nav class="header__nav">

			<div class="header__menu">

				<?php
				wp_nav_menu([
					'menu'       => 'Menu Header',
					'container'  => false,
					'menu_class' => 'header__menu-list',
				]);
				?>

			</div>

			<div class="header__languages">
				PT - EN
			</div>

		</nav>

	</header>

	<main id="main">