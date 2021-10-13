<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// Import customize functions
require_once(get_template_directory() . '/customize.php');

function register_styles() {
    wp_register_style(
        'gridy-colors', // handle name
        get_template_directory_uri() . '/assets/style/colors.css'
    );

    wp_register_style(
        'gridy-style', // handle name
        get_stylesheet_uri()
    );

    wp_register_style(
        'gridy-cards', // handle name
        get_template_directory_uri() . '/assets/style/cards.css',
        array( 'gridy-colors' ) // an array of dependent styles
    );

    wp_register_style(
        'gridy-single', // handle name
        get_template_directory_uri() . '/assets/style/single.css',
        array( 'gridy-colors' )
    );

    wp_register_style(
        'gridy-articles', // handle name
        get_template_directory_uri() . '/assets/style/articles.css',
        array( 'gridy-colors' )
    );

    wp_register_style(
        'simplebar',
        'https://unpkg.com/simplebar@latest/dist/simplebar.css',
        []
    );

    wp_enqueue_style( 'gridy-style' );
    wp_enqueue_style( 'gridy-cards' );
    wp_enqueue_style( 'gridy-colors' );

    wp_enqueue_style( 'gridy-single' );
    wp_enqueue_style( 'gridy-articles' );
    wp_enqueue_style( 'simplebar' );
}

function load_scripts () {
    wp_enqueue_script(
        'jquery',
        'https://code.jquery.com/jquery-3.2.1.slim.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'page-transitions',
        get_template_directory_uri() . '/assets/js/page-transitions.js',
        [ 'jquery' ],
        null,
        true
    );

    wp_localize_script('page-transitions', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));

    wp_enqueue_script(
        'tinySlider',
        'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js',
        [],
        null,
        true
    );

    if (is_front_page()) {
        wp_enqueue_script(
            'gridy-main',
            get_template_directory_uri() . '/assets/js/sliders.js',
            ['tinySlider'],
            null,
            true
        );
    } else {
        wp_enqueue_script(
            'simplebar',
            'https://unpkg.com/simplebar@latest/dist/simplebar.min.js',
            [],
            null,
            true
        );
    }


    wp_enqueue_script (
        'bootstrap',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script (
        'popper',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
        [],
        null,
        true
    );
}

add_action( 'wp_enqueue_scripts', 'register_styles' );
add_action( 'wp_enqueue_scripts', 'load_scripts' );

function update_excerpt_length($length){
    return 25;
}
add_filter('excerpt_length', 'update_excerpt_length');

// removing admin bar margin
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

add_filter('next_posts_link_attributes', 'next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'previous_posts_link_attributes');

function next_posts_link_attributes() {
    return 'class="articles-navigation older"';
}

function previous_posts_link_attributes() {
    return 'class="articles-navigation newer"';
}
