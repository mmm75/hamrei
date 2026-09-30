<header id="header-mobile" class="mobile">

    <?php

    $is_collection = is_post_type_archive('piece') || is_tax('piece_category');

    $current_category = null;
    $expanded_parent_id = 0;
    $child_categories = [];

    if (is_tax('piece_category')) {

        $current_category = get_queried_object();

        $expanded_parent_id = $current_category->parent
            ? $current_category->parent
            : $current_category->term_id;

        $child_categories = hamrei_get_piece_category_children($expanded_parent_id);
    }

    ?>

    <!-- HEADER MOBILE MAIN ------------------------------------------------------------------------------------------------>

    <div class="header-mobile__main">

        <div class="header-mobile__logo">

            <a href="<?php echo esc_url(home_url('/')); ?>">

                <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_SMALL.svg"
                    alt="HAMREI">

            </a>

        </div>

        <button
            type="button"
            class="header-mobile__menu-toggle"
            aria-expanded="false"
            aria-label="<?php esc_attr_e('menu', 'mmdwc'); ?>">

            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/img/menu-burger.svg"
                alt="">

        </button>

    </div>

    <!-- END HEADER MOBILE MAIN ------------------------------------------------------------------------------------------------>

    <!-- HEADER MOBILE PAGES MENU ------------------------------------------------------------------------------------------------>

    <div class="header-mobile__pages-panel">

        <nav class="header-mobile__nav">

            <?php echo hamrei_get_header_menu_html('header-mobile__menu-list'); ?>

        </nav>

        <div class="header-mobile__languages">

            <?php echo hamrei_get_language_selector_html(); ?>

        </div>

    </div>

    <!-- END HEADER MOBILE PAGES MENU ------------------------------------------------------------------------------------------------>

    <?php if ($is_collection) : ?>

        <!-- HEADER MOBILE COLLECTION ------------------------------------------------------------------------------------------------>

        <div class="header-mobile__collection">

            <div class="header-mobile__collection-controls">

                <button
                    type="button"
                    class="header-mobile__filters-toggle"
                    aria-expanded="false">

                    <?php esc_html_e('filters', 'mmdwc'); ?>

                </button>

                <button
                    type="button"
                    class="header-mobile__grid-more"
                    aria-label="<?php esc_attr_e('more', 'mmdwc'); ?>">

                    +

                </button>

                <button
                    type="button"
                    class="header-mobile__grid-less"
                    aria-label="<?php esc_attr_e('less', 'mmdwc'); ?>">

                    −

                </button>

            </div>

            <div class="header-mobile__filters-panel">

                <ul class="header-mobile__filters-list">

                    <?php
                    $piece_categories = hamrei_get_piece_parent_categories();

                    ?>

                    <?php if (!is_wp_error($piece_categories)) : ?>

                        <?php foreach ($piece_categories as $piece_category) : ?>

                            <?php

                            $is_current = (
                                $current_category &&
                                $current_category->term_id === $piece_category->term_id
                            );

                            $is_current_parent = (
                                $expanded_parent_id &&
                                $expanded_parent_id === $piece_category->term_id
                            );

                            ?>

                            <li class="header-mobile__filters-item<?php echo $is_current ? ' is-current' : ''; ?><?php echo $is_current_parent ? ' is-current-parent' : ''; ?>">

                                <a href="<?php echo esc_url(get_term_link($piece_category)); ?>">

                                    <?php echo esc_html($piece_category->name); ?>

                                </a>

                                <?php if (
                                    $expanded_parent_id === $piece_category->term_id &&
                                    !is_wp_error($child_categories) &&
                                    !empty($child_categories)
                                ) : ?>

                                    <ul class="header-mobile__filters-children">

                                        <?php foreach ($child_categories as $child_category) : ?>

                                            <li class="<?php echo $current_category && $current_category->term_id === $child_category->term_id ? 'is-current' : ''; ?>">

                                                <a href="<?php echo esc_url(get_term_link($child_category)); ?>">

                                                    <?php echo esc_html($child_category->name); ?>

                                                </a>

                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                <?php endif; ?>

                            </li>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

        <!-- END HEADER MOBILE COLLECTION ------------------------------------------------------------------------------------------------>

    <?php endif; ?>

    <?php if (is_shop() || is_product()) : ?>

        <?php
        $product_navigation = is_product()
            ? hamrei_get_product_navigation()
            : false;
        ?>

        <!-- HEADER MOBILE E-SHOP ------------------------------------------------------------------------------------------------>

        <div class="header-mobile__product">

            <div class="header-mobile__product-shop">

                <?php esc_html_e('e-shop', 'mmdwc'); ?>

            </div>

            <?php if (is_product() && $product_navigation) : ?>

                <nav class="header-mobile__product-navigation">

                    <a
                        href="<?php echo esc_url($product_navigation['previous']); ?>"
                        class="header-mobile__product-previous" data-text="<?php esc_html_e('previous', 'mmdwc'); ?>">

                        <?php esc_html_e('previous', 'mmdwc'); ?>

                    </a>

                    <a
                        href="<?php echo esc_url($product_navigation['next']); ?>"
                        class="header-mobile__product-next" data-text="<?php esc_html_e('next', 'mmdwc'); ?>">

                        <?php esc_html_e('next', 'mmdwc'); ?>

                    </a>

                </nav>

            <?php endif; ?>

        </div>

        <!-- END HEADER MOBILE E-SHOP ------------------------------------------------------------------------------------------------>

    <?php endif; ?>

</header>