<?php
$hero_video_id = hamrei_get_current_hero_video_id();
$hero_video_url_desktop = 'https://vz-eb7b1f3f-f93.b-cdn.net/' . $hero_video_id . '/play_1080p.mp4';
$hero_video_url_mobile  = 'https://vz-eb7b1f3f-f93.b-cdn.net/' . $hero_video_id . '/play_720p.mp4';
?>

<section id="hero" class="hero">

    <h1><img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/HAMREI_LOGO_BIG.png"
            width="2400"
            height="369"
            class="logo-hamrei-big"
            alt="HAMREI"
            loading="eager"
            fetchpriority="high"
            decoding="async"></h1>

    <video
        id="video"
        class="hero__video"
        data-video-slot=""
        autoplay
        muted
        loop
        playsinline
        disablepictureinpicture
        webkit-playsinline
        preload="metadata">
        <source
            src="<?php echo esc_url(wp_is_mobile() ? $hero_video_url_mobile : $hero_video_url_desktop); ?>"
            type="video/mp4">
    </video>

    <div class="hero__time-container">

        <div class="hero__time"></div>
        <div class="hero__location"><?php esc_html_e('at the studio', 'mmdwc'); ?></div>

    </div>

    <!-- COMING SOON -->

    <div class="hero__coming-soon">
        <h3 class="item-title">

            <strong>New Website</strong>

            <span>Coming Soon</span>


        </h3>

        <a href="mailto:info@hamrei.com" class="custom-button">

            Contact us

        </a>

    </div>

    <!-- COMING SOON -->


</section>