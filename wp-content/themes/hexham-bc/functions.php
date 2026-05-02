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
