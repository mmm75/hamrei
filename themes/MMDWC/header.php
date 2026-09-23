<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<header id="header" <?php if (is_page_template(['page-HOME.php', 'page-ABOUT.php', 'page-CONTACT.php'])) : ?> class="absolute-header" <?php endif; ?>>

		<!-- HEADER MAIN ------------------------------------------------------------------------------------------------>

		<div class="header__main header-bar">

			<div class="header__logo">

				<a href="<?php echo esc_url(home_url('/')); ?>">

					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_SMALL.svg"
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

			<div class="header__cart">

				<a
					href="<?php echo esc_url(wc_get_cart_url()); ?>"
					class="header__cart-link">

					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/img/cart.svg"
						alt="<?php esc_attr_e('cart', 'mmdwc'); ?>">

				</a>

			</div>

		</div>

		<!-- END HEADER MAIN ------------------------------------------------------------------------------------------------>

		<!-- HEADER PIECE SUBNAV ------------------------------------------------------------------------------------------------>

		<?php if (is_singular('piece')) : ?>

			<?php
			$piece_categories = get_the_terms(get_the_ID(), 'piece_category');
			$parent_category = null;
			$child_category = null;

			if ($piece_categories && !is_wp_error($piece_categories)) {
				foreach ($piece_categories as $piece_category) {
					if ($piece_category->parent) {
						$child_category = $piece_category;
						$parent_category = get_term($piece_category->parent, 'piece_category');
						break;
					}
				}

				if (!$parent_category) {
					foreach ($piece_categories as $piece_category) {
						if (!$piece_category->parent) {
							$parent_category = $piece_category;
							break;
						}
					}
				}
			}
			?>

			<nav class="piece-subnav header-bar">

				<a
					href="<?php echo esc_url(get_post_type_archive_link('piece')); ?>"
					class="piece-subnav__back"
					data-collection-url="<?php echo esc_url(get_post_type_archive_link('piece')); ?>"
					data-text="<?php esc_html_e('go back', 'mmdwc'); ?>">
					<?php esc_html_e('go back', 'mmdwc'); ?>
				</a>

				<ul class="piece-subnav__categories">

					<?php if ($parent_category && !is_wp_error($parent_category)) : ?>

						<li class="piece-subnav__category-item">

							<a
								href="<?php echo esc_url(get_term_link($parent_category)); ?>"
								class="piece-subnav__category"
								data-text="<?php echo esc_attr($parent_category->name); ?>">

								<?php echo esc_html($parent_category->name); ?>

							</a>

						</li>

					<?php endif; ?>

					<?php if ($child_category) : ?>

						<li class="piece-subnav__category-item">

							<a
								href="<?php echo esc_url(get_term_link($child_category)); ?>"
								class="piece-subnav__category"
								data-text="<?php echo esc_attr($child_category->name); ?>">

								<?php echo esc_html($child_category->name); ?>

							</a>

						</li>

					<?php endif; ?>

				</ul>

				<div class="piece-subnav__spacer"></div>

			</nav>

		<?php endif; ?>

		<!-- END HEADER PIECE SUBNAV ------------------------------------------------------------------------------------------------>

		<!-- HEADER COLLECTION MENU CAT PARENT ------------------------------------------------------------------------------------------------>

		<?php if (is_post_type_archive('piece') || is_tax('piece_category')) : ?>

			<nav class="collection-nav header-bar">

				<a
					href="<?php echo esc_url(home_url('/collection/')); ?>"
					class="collection-nav__all"
					data-text="<?php esc_html_e('all', 'mmdwc'); ?>">
					<?php esc_html_e('all', 'mmdwc'); ?>
				</a>

				<ul class="collection-nav__categories">

					<?php
					$piece_categories = get_terms([
						'taxonomy'   => 'piece_category',
						'parent'     => 0,
						'hide_empty' => false,
						'orderby'    => 'term_order',
						'order'      => 'ASC',
					]);

					if (!is_wp_error($piece_categories)) :

						foreach ($piece_categories as $piece_category) :

							$is_current_category = is_tax('piece_category', $piece_category->term_id);

							$is_current_category_parent = (
								is_tax('piece_category') &&
								get_queried_object()->parent == $piece_category->term_id
							);					?>

							<li class="collection-nav__category-item<?php echo $is_current_category ? ' current-cat' : ''; ?><?php echo $is_current_category_parent ? ' current-cat-parent' : ''; ?>">
								<a
									href="<?php echo esc_url(get_term_link($piece_category)); ?>"
									class="collection-nav__category"
									data-text="<?php echo esc_attr($piece_category->name); ?>">
									<?php echo esc_html($piece_category->name); ?>
								</a>

							</li>

					<?php
						endforeach;

					endif;
					?>

				</ul>

				<div class="collection-nav__grid-controls">

					<a
						class="collection-nav__grid-control collection-nav__grid-control--more"
						data-text="<?php esc_html_e('more', 'mmdwc'); ?> +">
						<?php esc_html_e('more', 'mmdwc'); ?> +
					</a>

					<a
						class="collection-nav__grid-control collection-nav__grid-control--less"
						data-text="<?php esc_html_e('less', 'mmdwc'); ?> −">
						<?php esc_html_e('less', 'mmdwc'); ?> −
					</a>

				</div>

			</nav>

			<!-- HEADER COLLECTION MENU CAT CHILD ------------------------------------------------------------------------------------------------>

			<?php if (is_tax('piece_category')) : ?>

				<?php
				$current_category = get_queried_object();

				if ($current_category->parent) {
					$parent_category = get_term($current_category->parent, 'piece_category');
				} else {
					$parent_category = $current_category;
				}

				$child_categories = get_terms([
					'taxonomy'   => 'piece_category',
					'parent'     => $parent_category->term_id,
					'hide_empty' => false,
					'orderby'    => 'term_order',
					'order'      => 'ASC',
				]);
				?>

				<?php if (!is_wp_error($child_categories) && !empty($child_categories)) : ?>

					<nav class="collection-subnav header-bar">

						<div class="collection-subnav__spacer"></div>

						<ul class="collection-subnav__categories">

							<?php foreach ($child_categories as $child_category) : ?>

								<?php $is_current_category = $current_category->term_id === $child_category->term_id; ?>

								<li class="collection-subnav__category-item<?php echo $is_current_category ? ' current-cat' : ''; ?>">

									<a
										href="<?php echo esc_url(get_term_link($child_category)); ?>"
										class="collection-subnav__category"
										data-text="<?php echo esc_attr($child_category->name); ?>">
										<?php echo esc_html($child_category->name); ?>
									</a>

								</li>

							<?php endforeach; ?>

						</ul>

					</nav>

				<?php endif; ?>

			<?php endif; ?>

			<!-- END HEADER COLLECTION MENU CAT CHILD ------------------------------------------------------------------------------------------------>

		<?php endif; ?>

		<!-- END HEADER COLLECTION MENU CAT PARENT ------------------------------------------------------------------------------------------------>

		<!-- HEADER PRODUCT SUBNAV ------------------------------------------------------------------------------------------------>

		<?php if (is_product() || is_shop()) : ?>

			<?php $product_navigation = is_product() ? hamrei_get_product_navigation() : false; ?>

			<nav class="product-subnav header-bar">

				<?php if ($product_navigation) : ?>

					<a
						href="<?php echo esc_url($product_navigation['previous']); ?>"
						class="product-subnav__previous"
						data-text="<?php esc_html_e('previous', 'mmdwc'); ?>">

						<?php esc_html_e('previous', 'mmdwc'); ?>

					</a>

				<?php endif; ?>

				<div class="product-subnav__shop">

					<?php esc_html_e('e-shop', 'mmdwc'); ?>

				</div>

				<?php if ($product_navigation) : ?>

					<a
						href="<?php echo esc_url($product_navigation['next']); ?>"
						class="product-subnav__next"
						data-text="<?php esc_html_e('next', 'mmdwc'); ?>">

						<?php esc_html_e('next', 'mmdwc'); ?>

					</a>

				<?php endif; ?>

			</nav>

		<?php endif; ?>

		<!-- END HEADER PRODUCT SUBNAV ------------------------------------------------------------------------------------------------>
	</header>

	<main id="main">