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

    register_post_type('hbc_match', [
        'labels' => [
            'name'          => 'Matches',
            'singular_name' => 'Match',
            'add_new_item'  => 'Add New Match',
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-awards',
        'supports'     => ['title', 'editor'],
        'rewrite'      => ['slug' => 'matches'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'hexham_register_cpts');
