<?php

//////////////////////////////////////////////////////////////
// GET HERO VIDEO SLOTS
//////////////////////////////////////////////////////////////

function hamrei_get_hero_video_slots()
{
    return [
        ['start' => '00:00', 'field' => 'video_0000_0600'],
        ['start' => '06:00', 'field' => 'video_06_0745'],
        ['start' => '07:45', 'field' => 'video_0745_0930'],
        ['start' => '09:30', 'field' => 'video_0930_1115'],
        ['start' => '11:15', 'field' => 'video_1115_1300'],
        ['start' => '13:00', 'field' => 'video_1300_1445'],
        ['start' => '14:45', 'field' => 'video_1445_1630'],
        ['start' => '16:30', 'field' => 'video_1630_1815'],
        ['start' => '18:15', 'field' => 'video_1815_2000'],
        ['start' => '20:00', 'field' => 'video_2000_0000'],
    ];
}

//////////////////////////////////////////////////////////////
// GET CURRENT HERO VIDEO SLOT INDEX
//////////////////////////////////////////////////////////////

function hamrei_get_current_hero_video_slot_index()
{
    $slots = hamrei_get_hero_video_slots();
    $now = new DateTime('now', new DateTimeZone('Europe/Lisbon'));
    $time = $now->format('H:i');
    $current_index = 0;

    foreach ($slots as $index => $slot) {
        if ($time >= $slot['start']) {
            $current_index = $index;
        } else {
            break;
        }
    }

    return $current_index;
}

//////////////////////////////////////////////////////////////
// GET CURRENT HERO VIDEO FIELD
//////////////////////////////////////////////////////////////

function hamrei_get_current_hero_video_field()
{
    $slots = hamrei_get_hero_video_slots();
    $current_index = hamrei_get_current_hero_video_slot_index();

    return $slots[$current_index]['field'];
}

//////////////////////////////////////////////////////////////
// GET CURRENT HERO VIDEO ID
//////////////////////////////////////////////////////////////

function hamrei_get_current_hero_video_id()
{
    $field_name = hamrei_get_current_hero_video_field();

    return get_field($field_name, 'option');
}

//////////////////////////////////////////////////////////////
// GET NEXT HERO VIDEO FIELD
//////////////////////////////////////////////////////////////

function hamrei_get_next_hero_video_field()
{
    $slots = hamrei_get_hero_video_slots();
    $current_index = hamrei_get_current_hero_video_slot_index();
    $next_index = ($current_index + 1) % count($slots);

    return $slots[$next_index]['field'];
}

//////////////////////////////////////////////////////////////
// GET HERO VIDEO SCHEDULE FOR JS
//////////////////////////////////////////////////////////////

function hamrei_get_hero_video_schedule()
{
    $slots = hamrei_get_hero_video_slots();
    $schedule = [];

    foreach ($slots as $slot) {
        $schedule[] = [
            'start' => $slot['start'],
            'slot' => $slot['field'],
        ];
    }

    return $schedule;
}

//////////////////////////////////////////////////////////////
// GET NEXT HERO VIDEO AJAX
//////////////////////////////////////////////////////////////

add_action('wp_ajax_hamrei_get_next_hero_video', 'hamrei_get_next_hero_video_ajax');
add_action('wp_ajax_nopriv_hamrei_get_next_hero_video', 'hamrei_get_next_hero_video_ajax');

function hamrei_get_next_hero_video_ajax()
{
    $field_name = hamrei_get_next_hero_video_field();

    if (!$field_name) {
        wp_send_json_error();
    }

    $video_id = get_field($field_name, 'option');

    if (!$video_id) {
        wp_send_json_error();
    }

    wp_send_json_success([
        'url' => 'https://vz-809edc8b-256.b-cdn.net/' . $video_id . '/play_720p.mp4',
    ]);
}
