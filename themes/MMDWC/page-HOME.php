<?php
/*
Template Name: TEMPLATE HOME
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- HERO SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-hero" class="home__hero">

            <h1><img
                    src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_BIG.png"
                    class="logo-hamrei-big"
                    alt="HAMREI"></h1>

            <video
                id="video"
                autoplay
                muted
                loop
                playsinline
                disablepictureinpicture
                webkit-playsinline
                preload="metadata">
                <source
                    src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                    type="video/mp4">
            </video>

        </section>

        <!-- END HERO SECTION ------------------------------------------------------------------------------------------------>

        <!-- HIGHTLIGHTS SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-highlights" class="home__highlights">

            <h2>HIGHLIGHTS</h2>

            <!-- HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

            <div class="highlights__row">

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

                    <div class="media-container media-container--3-4">

                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            disablepictureinpicture
                            webkit-playsinline
                            preload="metadata">
                            <source
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>OSSO</strong>
                            <span>LAMP</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

                    <div class="media-container media-container--3-4">

                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            disablepictureinpicture
                            webkit-playsinline
                            preload="metadata">
                            <source
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>XX</strong>
                            <span>LAMP</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__row-item">

                    <div class="media-container media-container--3-4">

                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            disablepictureinpicture
                            webkit-playsinline
                            preload="metadata">
                            <source
                                src="https://vz-809edc8b-256.b-cdn.net/23d6a690-db6b-420c-a9c5-058a19418956/play_720p.mp4"
                                type="video/mp4">
                        </video>

                    </div>

                    <div class="highlights__row-content">

                        <h3 class="item-title">
                            <strong>FUN GUY</strong>
                            <span>TABLE</span>
                        </h3>

                        <a href="#" class="button">
                            DISCOVER
                        </a>

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

            </div>

            <!-- END HIGHTLIGHTS ROW ------------------------------------------------------------------------------------------------>

            <!-- HIGHTLIGHTS GRID ------------------------------------------------------------------------------------------------>

            <div class="highlights__grid">

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/lighting-pic.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/objects.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/rugs-pic.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/seating-pic.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/storage-pic.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

                <!-- ITEM ------------------------------------------------------------------------------------------------>

                <div class="highlights__grid-item">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/tables-pic.jpg" alt="">

                    </div>

                </div>

                <!-- END ITEM ------------------------------------------------------------------------------------------------>

            </div>

            <!-- END HIGHTLIGHTS GRID ------------------------------------------------------------------------------------------------>

        </section>

        <!-- END HIGHTLIGHTS SECTION ------------------------------------------------------------------------------------------------>

        <!-- ABOUT SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-about" class="home__about">

            <h2>ABOUT US</h2>

            <!-- ABOUT TOP ------------------------------------------------------------------------------------------------>

            <div class="home__about-top">

                <div class="home__about-top-left">

                    <div class="media-container media-container--square">

                        <img src="http://localhost:8888/wp-content/uploads/2026/09/hamreifn1665-1-scaled.jpg" alt="">

                    </div>

                </div>

                <div class="home__about-top-right">

                    <div class="home__about-quote">

                        <blockquote>
                            ‘Longevity is the most elegant form of sustainability’
                        </blockquote>

                        <div class="home__about-signature">
                            HAMREI
                        </div>

                    </div>

                    <div class="p--big">

                        <p>Based in Lisbon, Portugal, and founded by Anglo-Brazilian artist and designer Hamrei in 2022, the studio creates sculptural work that reflects his double heritage, both raw and refined</p>

                    </div>

                    <div class="p--normal">

                        <p>Each HAMREI piece is created with the highest quality materials, selected for their longevity and character, and comes to life through close collaboration with master craftmen, primarily based in Europe.</p>

                        <p>Recognised by collectors and galleries worldwide, HAMREI's world extends beyond the objects, occasionally into the rooms they inhabit, into a philosophy: beauty that endures, allure that draws you in and design that stands the test of time. Because longevity is the most elegant form of sustainability.</p>

                    </div>

                    <a href="#" class="button">
                        DISCOVER
                    </a>

                </div>

            </div>

            <!-- END ABOUT TOP ------------------------------------------------------------------------------------------------>

            <!-- ABOUT BOTTOM ------------------------------------------------------------------------------------------------>

            <div class="home__about-bottom">

                <div class="home__about-bottom-left">


                    <div class="p--big">

                        <p>Based in Marvila, Lisbon's art district, HAMREI's creative studio doubles up as an appointment-only showroom.</p>

                    </div>

                    <div class="p--normal">

                        <p>Transformed from its days as a nightclub, it is a place where ideas, people, and creativity naturally blend. Within its walls, HAMREI's own design and art pieces coexist with a selection from his personal collection, each piece a glimpse into his evolving creative world. An industrial setting for enduring beauty. Contact us to find out more about using the Studio for private events, dinners, and photoshoots.</p>

                    </div>

                    <a href="#" class="button">
                        DISCOVER
                    </a>

                </div>

                <div class="home__about-bottom-right">

                    <img src="http://localhost:8888/wp-content/uploads/2026/09/studio-photos.jpg" alt="">

                    <div class="home__about-studio-label">
                        THE STUDIO
                    </div>

                </div>

            </div>

            <!-- END ABOUT BOTTOM ------------------------------------------------------------------------------------------------>

        </section>

        <!-- END ABOUT SECTION ------------------------------------------------------------------------------------------------>

        <!-- EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>

        <?php get_template_part("/template-parts/section-explore-our-shop"); ?>

        <!-- END EXPLORE OUR SHOP SECTION ------------------------------------------------------------------------------------------------>

        <!-- PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

        <section id="home-pre-footer" class="home__pre-footer">

            <div class="media-container media-container--9-4">

                <img
                    src="http://localhost:8888/wp-content/uploads/2026/09/pre-footer-scaled.jpg"
                    alt="">

            </div>

        </section>

        <!-- END PRE FOOTER SECTION ------------------------------------------------------------------------------------------------>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>