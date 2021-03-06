<?php

// Registers theme customization sections.
// This allows the user to change main logo, menu logo, header background image and mobile menu presentation text.
function papi_customize_register($wp_customize) {
    $wp_customize->add_section( 'papi_images',
        array(
            'title'         => __( 'Logos & images', 'papi_images_title' ),
            'description'   => 'Vous pouvez choisir ici les logos et images de fond apparaissant sur votre site.',
            'priority'      => 32
        )
    );

    // main logo
    $wp_customize->add_setting('papi_main_logo', array(
        'transport'         => 'refresh',
        'default'           => get_template_directory_uri() . '/assets/img/logos/default-vertical.svg',
        'height'            => 325,
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'papi_main_logo', array(
        'label'             => __('Logo principal', 'papi_main_logo_label'),
        'section'           => 'papi_images',
        'settings'          => 'papi_main_logo',
    )));

    // menu logo
    $wp_customize->add_setting('papi_menu_logo', array(
        'transport'         => 'refresh',
        'default'           => get_template_directory_uri() . '/assets/img/logos/default-horizontal.svg',
        'height'            => 325,
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'papi_menu_logo', array(
        'label'             => __('Logo du menu', 'papi_menu_logo_label'),
        'section'           => 'papi_images',
        'settings'          => 'papi_menu_logo',
    )));

    // background image
    $wp_customize->add_setting('papi_background_header_image', array(
        'transport'         => 'refresh',
        'default'           => get_template_directory_uri() . '/assets/img/default-bg.jpg',
        'height'            => 325,
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'papi_background_header_image', array(
        'label'             => __("Image de fond d'ent??te", 'papi_background_header_image'),
        'section'           => 'papi_images',
        'settings'          => 'papi_background_header_image',
    )));


    // mobile menu text
    $wp_customize->add_section( 'papi_mobile',
    array(
        'title'         => __( 'Mobile', 'papi_mobile_title' ),
        'description'   => "Vous pouvez personnaliser ici votre site tel qu'il apparait sur t??l??phone.",
        'priority'      => 61
    ));
    $wp_customize->add_setting( 'papi_mobile_menu_text',
        array(
            'default'           => __( "Bienvenue sur le site du Programme d???Actions de Pr??vention des Inondations sur le Delta de l???Aa.<br/>\nSur cette partie du site, vous pourrez suivre les avanc??es du programme, mais aussi des informations g??n??rales sur le risque inondation (sensibilisation, actualit??s nationales...).",
             'papi_mobile_menu_text' ),
            'transport'         => 'refresh',
            'sanitize_callback' => 'wp_kses_post'
        )
    );
    $wp_customize->add_control( 'papi_mobile_menu_text',
        array(
            'type'        => 'textarea',
            'description' => 'Vous pouvez ??crire ici le texte apparaissant dans le menu de votre site sur mobile.',
            'section'     => 'papi_mobile',
            'label'       => 'Texte de pr??sentation du menu',
        )
    );

    // footer contact informations
    $wp_customize->add_section( 'papi_contact_section',
        array(
            'title'         => __( 'Contact', 'papi_contact_section_title' ),
            'description'   => 'Vous pouvez ??crire ici les informations apparaissant en bas de votre site.'
        )
    );
    $wp_customize->add_setting( 'papi_contact_text',
        array(
            'default'           => __( '<p class="mb-1">P??le M??tropolitain de la C??te d???Opale<br/>Charg?? de mission PAPI</p>' .
        '<p>Pertuis de la Marine<br/>59140 DUNKERQUE</p>' . '<p>03.28.25.92.72</p>', 'papi_contact_text' ),
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
        )
    );
    $wp_customize->add_control( 'papi_contact_text',
        array(
            'type'        => 'textarea',
            'description' => 'Vous pouvez ??crire du HTML pour utiliser des paragraphes ou ajouter des liens.',
            'section'     => 'papi_contact_section',
            'label'       => 'Informations de contact',
        )
    );
}
add_action( 'customize_register', 'papi_customize_register', 50 );


/**
 * Registers the Theme Customizer Preview with WordPress.
 */
function gridy_customize_live_preview() {
    wp_enqueue_script(
        'gridy-customize-js',
        get_stylesheet_directory_uri() . '/assets/js/customize.js',
        array( 'jquery', 'customize-preview' ),
        null,
        true
    );
}
add_action( 'customize_preview_init', 'gridy_customize_live_preview' );