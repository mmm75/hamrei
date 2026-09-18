<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- PIECE SINGLE ------------------------------------------------------------------------------------------------>

        <section class="piece-single">

            <div class="piece-single__gallery">

                <div class="media-container">

                    <img src="http://localhost:8888/wp-content/uploads/2026/09/piece-1.jpg" alt="">

                </div>

                <div class="media-container">

                    <img src="http://localhost:8888/wp-content/uploads/2026/09/piece-2.jpg" alt="">

                </div>

                <div class="media-container">

                    <img src="http://localhost:8888/wp-content/uploads/2026/09/piece-3.jpg" alt="">

                </div>

            </div>

            <div class="piece-single__details">

                <div class="piece-single__details-inner">

                    <div class="piece-single__intro">

                        <h1 class="piece-single__title item-title">

                            <strong>PEPE</strong>
                            <span>CHAIR</span>

                        </h1>

                        <div class="piece-single__subtitle p--big">

                            Brass-finished dining chair with<br>
                            FJ Hakimian upcycled woven leather

                        </div>

                        <div class="piece-single__description p--normal">

                            <p>The PePe chair in collaboration with FJ Hakimian makes use of their woven leather, made from weaving offcuts collected in factories to be rewoven. The result is a soft, textured backrest framed by a thick leather piping surround held in place bu the soft curves of the black steel frame. The comfortable seat is upholstered in FJ Hakimian organic cotton. Simple, subtle, chic. It is available in three sizes.</p>

                            <p>S - Easy to place and fits well with any dining table (pictured with black backrest) M - Slightly more generous width. Perfect for spacious dining rooms and desks (pictured with light brown backrest)</p>

                        </div>

                    </div>


                    <div class="piece-single__specs">

                        <!-- PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <div class="piece-single__spec">

                            <div class="piece-single__spec-title">MATERIALS</div>

                            <div class="piece-single__spec-content">

                                <p>Brass-finished steel frame, FJ Hakimian woven leather backrest, organic cotton seat </p>

                            </div>

                        </div>

                        <!-- END PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <!-- PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <div class="piece-single__spec">

                            <div class="piece-single__spec-title">SIZES &amp; DIMENSIONS</div>

                            <div class="piece-single__spec-content">

                                <p>S - W38cm / 15in, D38cm / 15in, H46cm / 18.1in<br>
                                    M - W46cm / 18.1in, D46cm / 18.1in, H46cm / 18.1in</p>

                            </div>

                        </div>

                        <!-- END PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <!-- PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <div class="piece-single__spec">

                            <div class="piece-single__spec-title">CUSTOMIZATION</div>

                            <div class="piece-single__spec-content">

                                <p>Shapes, sizes and fabrics available on request </p>

                            </div>

                        </div>

                        <!-- END PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <!-- PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <div class="piece-single__spec">

                            <div class="piece-single__spec-title">ORIGIN</div>

                            <div class="piece-single__spec-content">

                                <p>Handmade in Portugal; leather woven by FJ Hakimian </p>

                            </div>

                        </div>

                        <!-- END PIECE SPEC ITEM ------------------------------------------------------------------------------------------------>

                        <!-- PIECE SPEC FAMILY ------------------------------------------------------------------------------------------------>

                        <div class="piece-single__spec">

                            <div class="piece-single__spec-title">FAMILY</div>

                            <div class="piece-single__spec-content">

                                <?php get_template_part("/template-parts/piece/section-single-piece-family"); ?>

                            </div>

                        </div>

                        <!-- PIECE SPEC FAMILY ------------------------------------------------------------------------------------------------>


                    </div>

                    <div class="piece-single__actions">

                        <a href="#" class="button">REQUEST A QUOTATION</a>
                        <a href="#" class="button">DOWNLOAD PRODUCT SHEET PDF</a>

                    </div>

                </div>

            </div>

        </section>

        <!-- PIECE SINGLE ------------------------------------------------------------------------------------------------>

        <!-- YOU MAY ALSO LIKE ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/piece/section-single-piece-you-may-also-like"); ?>

        <!-- END YOU MAY ALSO LIKE ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>