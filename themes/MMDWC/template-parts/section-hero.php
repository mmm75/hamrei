<?php
$hero_video_id = hamrei_get_current_hero_video_id();
$hero_video_url = 'https://vz-809edc8b-256.b-cdn.net/' . $hero_video_id . '/play_720p.mp4';
?>

<section id="hero" class="hero">

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
        <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4">
    </video>

    <div class="hero__time-container">

        <div class="hero__time"></div>
        <div class="hero__location"><?php esc_html_e('at the studio', 'mmdwc'); ?></div>

    </div>

</section>