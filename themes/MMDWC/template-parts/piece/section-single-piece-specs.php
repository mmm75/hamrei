<!-- PIECE / PRODUCT SPEC ITEM MATERIALS ------------------------------------------------------------------------------------------------>

<?php if (get_field("materials")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('materials', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("materials"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM MATERIALS ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM DIMENSIONS ------------------------------------------------------------------------------------------------>

<?php if (get_field("dimensions")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('sizes & dimensions', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("dimensions"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM DIMENSIONS ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM ORIGIN ------------------------------------------------------------------------------------------------>

<?php if (get_field("origin")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('origin', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("origin"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM ORIGIN ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM EDITION ------------------------------------------------------------------------------------------------>

<?php if (get_field("edition")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('edition', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("edition"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM EDITION ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM CUSTOMIZATION ------------------------------------------------------------------------------------------------>

<?php if (get_field("customization")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('customization', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("customization"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM CUSTOMIZATION ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM VARIANT OPTIONS ------------------------------------------------------------------------------------------------>

<?php if (get_field("variant_options")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('variant options', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("variant_options"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM VARIANT OPTIONS ------------------------------------------------------------------------------------------------>

<!-- PIECE / PRODUCT SPEC ITEM ADDITIONAL SPECS ------------------------------------------------------------------------------------------------>

<?php if (get_field("additional_specs")): ?>

    <div class="piece-product-single__spec">

        <div class="piece-product-single__spec-title"><?php esc_html_e('additional specs', 'mmdwc'); ?></div>

        <div class="piece-product-single__spec-content">

            <?php the_field("additional_specs"); ?>

        </div>

    </div>

<?php endif; ?>

<!-- END PIECE / PRODUCT SPEC ITEM ADDITIONAL SPECS ------------------------------------------------------------------------------------------------>