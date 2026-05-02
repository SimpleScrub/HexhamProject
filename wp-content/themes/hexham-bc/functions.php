<?php

function hexham_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'hexham-bc'),
    ]);
}
add_action('after_setup_theme', 'hexham_setup');

function hexham_enqueue() {
    wp_enqueue_style('hexham-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0.0');
    wp_enqueue_script('hexham-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'hexham_enqueue');

function hexham_register_cpts() {
    register_post_type('hbc_event', [
        'labels' => [
            'name'          => 'Events',
            'singular_name' => 'Event',
            'add_new_item'  => 'Add New Event',
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-calendar-alt',
        'supports'     => ['title', 'editor', 'thumbnail'],
        'rewrite'      => ['slug' => 'events'],
        'show_in_rest' => true,
    ]);

}
add_action('init', 'hexham_register_cpts');

function hexham_register_acf_fields() {
    if (! function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_hbc_event',
        'title'  => 'Event Details',
        'fields' => [
            [
                'key'           => 'field_event_date',
                'label'         => 'Event Date',
                'name'          => 'event_date',
                'type'          => 'date_picker',
                'display_format'=> 'd/m/Y',
                'return_format' => 'Y-m-d',
                'required'      => 1,
            ],
            [
                'key'           => 'field_event_start_time',
                'label'         => 'Start Time',
                'name'          => 'event_start_time',
                'type'          => 'time_picker',
                'display_format'=> 'g:i a',
                'return_format' => 'H:i',
                'required'      => 1,
            ],
            [
                'key'           => 'field_event_end_time',
                'label'         => 'End Time',
                'name'          => 'event_end_time',
                'type'          => 'time_picker',
                'display_format'=> 'g:i a',
                'return_format' => 'H:i',
            ],
            [
                'key'     => 'field_event_type',
                'label'   => 'Event Type',
                'name'    => 'event_type',
                'type'    => 'select',
                'choices' => [
                    'live_music'  => 'Live Music',
                    'raffle'      => 'Raffle',
                    'promotion'   => 'Promotion',
                    'bowls'       => 'Bowls',
                    'other'       => 'Special Events',
                ],
                'default_value' => 'live_music',
            ],
            [
                'key'   => 'field_event_featured',
                'label' => 'Show on Homepage',
                'name'  => 'event_featured',
                'type'  => 'true_false',
                'ui'    => 1,
            ],
            [
                'key'   => 'field_is_recurring',
                'label' => 'Repeating Event',
                'name'  => 'is_recurring',
                'type'  => 'true_false',
                'ui'    => 1,
                'instructions' => 'Enable if this event repeats on a regular schedule.',
            ],
            [
                'key'     => 'field_recurrence_rule',
                'label'   => 'Repeats',
                'name'    => 'recurrence_rule',
                'type'    => 'select',
                'choices' => [
                    'weekly'      => 'Every Week',
                    'fortnightly' => 'Every Two Weeks',
                    'monthly'     => 'Every Month',
                ],
                'conditional_logic' => [
                    [['field' => 'field_is_recurring', 'operator' => '==', 'value' => '1']],
                ],
            ],
            [
                'key'            => 'field_recurrence_end_date',
                'label'          => 'Repeat Until',
                'name'           => 'recurrence_end_date',
                'type'           => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format'  => 'Y-m-d',
                'instructions'   => 'Event will stop appearing after this date.',
                'conditional_logic' => [
                    [['field' => 'field_is_recurring', 'operator' => '==', 'value' => '1']],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'hbc_event',
                ],
            ],
        ],
    ]);

}
add_action('acf/init', 'hexham_register_acf_fields');

function hbc_next_occurrence($start_date, $rule) {
    if (!$start_date || !$rule) return $start_date;
    $start = new DateTime($start_date);
    $today = new DateTime('today');
    if ($start >= $today) return $start_date;
    switch ($rule) {
        case 'weekly':      $interval = new DateInterval('P7D');  break;
        case 'fortnightly': $interval = new DateInterval('P14D'); break;
        case 'monthly':     $interval = new DateInterval('P1M');  break;
        default: return $start_date;
    }
    $current = clone $start;
    while ($current < $today) {
        $current->add($interval);
    }
    return $current->format('Y-m-d');
}

function hbc_event_display_date($post_id) {
    $date = get_field('event_date', $post_id);
    if (get_field('is_recurring', $post_id)) {
        return hbc_next_occurrence($date, get_field('recurrence_rule', $post_id));
    }
    return $date;
}

function hexham_register_options() {
    if (! function_exists('acf_add_options_page')) return;
    acf_add_options_page([
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'hexham-site-settings',
        'capability' => 'manage_options',
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 3,
    ]);
}
add_action('acf/init', 'hexham_register_options');

function hexham_register_options_fields() {
    if (! function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group([
        'key'    => 'group_hbc_options',
        'title'  => 'Site Settings',
        'fields' => [

            // ── Contact Details ──────────────────────────────────────
            ['key' => 'field_tab_contact', 'label' => 'Contact Details', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_phone_main',    'label' => 'Club Phone',    'name' => 'phone_main',    'type' => 'text',  'default_value' => '(02) 4964 8079', 'instructions' => 'Display format, e.g. (02) 4964 8079'],
            ['key' => 'field_phone_bistro',  'label' => 'Bistro Phone',  'name' => 'phone_bistro',  'type' => 'text',  'default_value' => '(02) 4964 8350'],
            ['key' => 'field_email_general', 'label' => 'General Email', 'name' => 'email_general', 'type' => 'email', 'default_value' => 'info@hexhambc.com.au'],
            ['key' => 'field_email_events',  'label' => 'Events/Functions Email', 'name' => 'email_events', 'type' => 'email', 'default_value' => 'events@hexhambc.com.au'],
            ['key' => 'field_email_accom',   'label' => 'Accommodation Email',    'name' => 'email_accom',  'type' => 'email', 'default_value' => 'accommodation@hexhambc.com.au'],
            ['key' => 'field_address_street', 'label' => 'Street Address', 'name' => 'address_street', 'type' => 'text', 'default_value' => '290 Old Maitland Road'],
            ['key' => 'field_address_suburb', 'label' => 'Suburb',  'name' => 'address_suburb', 'type' => 'text', 'default_value' => 'Hexham NSW 2322'],

            // ── Membership ───────────────────────────────────────────
            ['key' => 'field_tab_membership', 'label' => 'Membership', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_mbr_renew_url', 'label' => 'Renewal Form URL', 'name' => 'mbr_renew_url', 'type' => 'url',
             'instructions' => 'Link for the Renew Now button. Update once online form is live.',
             'default_value' => 'https://hexhambowlingclub.com.au/membership-purchase/'],
            ['key' => 'field_mbr_full',         'label' => 'Full Bowling Member',    'name' => 'mbr_full',         'type' => 'text', 'default_value' => '$50.00'],
            ['key' => 'field_mbr_pensioner',     'label' => 'Pensioner Bowling Member', 'name' => 'mbr_pensioner', 'type' => 'text', 'default_value' => '$40.00'],
            ['key' => 'field_mbr_non_bowling',   'label' => 'Non-Bowling Member',    'name' => 'mbr_non_bowling',  'type' => 'text', 'default_value' => '$20.00'],
            ['key' => 'field_mbr_pensioner_non', 'label' => 'Pensioner Non-Bowling', 'name' => 'mbr_pensioner_non','type' => 'text', 'default_value' => '$12.00'],
            ['key' => 'field_mbr_junior',        'label' => 'Junior Member',         'name' => 'mbr_junior',       'type' => 'text', 'default_value' => '$12.00'],
            ['key' => 'field_mbr_social',        'label' => 'Social Member',         'name' => 'mbr_social',       'type' => 'text', 'default_value' => '$5.00'],
            ['key' => 'field_mbr_three_year',    'label' => '3-Year Membership',     'name' => 'mbr_three_year',   'type' => 'text', 'default_value' => '$12.00'],

            // ── Room Hire ────────────────────────────────────────────
            ['key' => 'field_tab_rooms', 'label' => 'Room Hire', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_room_board_cap',       'label' => 'Board Room — Capacity', 'name' => 'room_board_cap',       'type' => 'text', 'default_value' => 'Up to 10'],
            ['key' => 'field_room_board_half',      'label' => 'Board Room — Half Day', 'name' => 'room_board_half',      'type' => 'text', 'default_value' => '$70'],
            ['key' => 'field_room_board_full',      'label' => 'Board Room — Full Day', 'name' => 'room_board_full',      'type' => 'text', 'default_value' => '$120'],
            ['key' => 'field_room_heritage_cap',    'label' => 'Heritage Room — Capacity', 'name' => 'room_heritage_cap', 'type' => 'text', 'default_value' => 'Up to 50'],
            ['key' => 'field_room_heritage_half',   'label' => 'Heritage Room — Half Day', 'name' => 'room_heritage_half','type' => 'text', 'default_value' => '$100'],
            ['key' => 'field_room_heritage_full',   'label' => 'Heritage Room — Full Day', 'name' => 'room_heritage_full','type' => 'text', 'default_value' => '$180'],
            ['key' => 'field_room_audit_cap',       'label' => 'Auditorium — Capacity', 'name' => 'room_audit_cap',       'type' => 'text', 'default_value' => 'Up to 200'],
            ['key' => 'field_room_audit_half',      'label' => 'Auditorium — Half Day', 'name' => 'room_audit_half',      'type' => 'text', 'default_value' => '$150'],
            ['key' => 'field_room_audit_full',      'label' => 'Auditorium — Full Day', 'name' => 'room_audit_full',      'type' => 'text', 'default_value' => '$250'],
            ['key' => 'field_room_wedding_cap',     'label' => 'Wedding Auditorium — Capacity', 'name' => 'room_wedding_cap',  'type' => 'text', 'default_value' => 'Up to 300'],
            ['key' => 'field_room_wedding_hire',    'label' => 'Wedding Auditorium — Hire',     'name' => 'room_wedding_hire', 'type' => 'text', 'default_value' => '$400 hire'],

            // ── Accommodation ────────────────────────────────────────
            ['key' => 'field_tab_accom', 'label' => 'Accommodation', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_accom_peak_start',      'label' => 'Peak Season Start',           'name' => 'accom_peak_start',      'type' => 'text', 'default_value' => 'Nov 1'],
            ['key' => 'field_accom_peak_end',        'label' => 'Peak Season End',             'name' => 'accom_peak_end',        'type' => 'text', 'default_value' => 'Apr 30'],
            ['key' => 'field_accom_active_peak',     'label' => 'Active Member — Peak',        'name' => 'accom_active_peak',     'type' => 'text', 'default_value' => '$550 / week'],
            ['key' => 'field_accom_active_offpeak',  'label' => 'Active Member — Off-Peak',    'name' => 'accom_active_offpeak',  'type' => 'text', 'default_value' => '$425 / week'],
            ['key' => 'field_accom_nonactive_peak',  'label' => 'Non-Active Member — Peak',    'name' => 'accom_nonactive_peak',  'type' => 'text', 'default_value' => '$650 / week'],
            ['key' => 'field_accom_nonactive_offpeak','label' => 'Non-Active Member — Off-Peak','name' => 'accom_nonactive_offpeak','type' => 'text', 'default_value' => '$525 / week'],
        ],
        'location' => [
            [['param' => 'options_page', 'operator' => '==', 'value' => 'hexham-site-settings']],
        ],
    ]);
}
add_action('acf/init', 'hexham_register_options_fields');

function hbc_opt($key, $fallback = '') {
    if (! function_exists('get_field')) return $fallback;
    $val = get_field($key, 'option');
    return ($val !== '' && $val !== null && $val !== false) ? $val : $fallback;
}

function hbc_tel($field_name, $fallback = '') {
    $phone = hbc_opt($field_name, $fallback);
    return 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
}

function hbc_recurring_meta_query(array $extra = []) {
    $today = date('Y-m-d');
    $query = [
        'relation' => 'OR',
        [
            'key'     => 'event_date',
            'value'   => $today,
            'compare' => '>=',
            'type'    => 'DATE',
        ],
        [
            'relation' => 'AND',
            ['key' => 'is_recurring', 'value' => '1', 'compare' => '='],
            ['key' => 'recurrence_end_date', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
        ],
    ];
    foreach ($extra as $clause) {
        $query[] = $clause;
    }
    return $query;
}
