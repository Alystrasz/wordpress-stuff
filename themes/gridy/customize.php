<?php

function gridy_customize_register($wp_customize) {
    // removing core components that aren't needed
    $wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
    $wp_customize->remove_section('static_front_page');

    // identity section
    $wp_customize->add_section( 'gridy_identity_options',
        array(
            'title'         => __( 'Identity', 'identity' ),
            'description'   => 'You can choose here both logo and description text appearing on the left side of the website.'
        )
    );

    // logo
    $wp_customize->add_setting('gridy_identity_logo', array(
        'transport'         => 'refresh',
        'default'           => get_template_directory_uri() . '/assets/img/logo.png',
        'height'            => 325,
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customizer_setting_one_control', array(
        'label'             => __('Logo', 'gridy-logo'),
        'section'           => 'gridy_identity_options',
        'settings'          => 'gridy_identity_logo',
    )));

    // text
    $wp_customize->add_setting( 'gridy_identity_text',
        array(
            'default'           => __( "<p>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard 
dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen 
book.
</p>

<p>
Here is an link example to the text source : <a href='https://www.lipsum.com/' target='_blank'>lipsum.com</a>
</p>", 'gridy' ),
            'transport'         => 'refresh',
            'sanitize_callback' => 'wp_kses_post'
        )
    );
    $wp_customize->add_control( 'gridy_identity_text',
        array(
            'type'        => 'textarea',
            'description' => 'You can write HTML code to split your presentation into several paragraphs, or add links.',
            'section'     => 'gridy_identity_options',
            'label'       => 'Presentation text',
        )
    );


    // featured content
    $wp_customize->add_section( 'gridy_featured_content',
        array(
            'title'         => __( 'Featured content', 'featured_content' ),
            'description'   => 'You can choose here which articles are displayed on your front page.'
        )
    );

    $categories = get_categories();
    $cats = array();
    $default = null;
    foreach($categories as $category){
        if ($default == null) {
            $default = $category->slug;
        }
        $cats[$category->slug] = $category->name;
    }

    $wp_customize->add_setting( 'gridy_homepage_highlight_link_text',
        array(
            'default'           => __( "Discover my projects", 'gridy' ),
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control( 'gridy_homepage_highlight_link_text',
        array(
            'type'        => 'text',
            'section'     => 'gridy_featured_content',
            'label'       => 'Link text',
        )
    );

    $wp_customize->add_setting('gridy_homepage_highlight_category', array(
        'default'        => $default
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'gridy_homepage_highlight_category', array(
        'label' => 'Pictures slider features articles from category:',
        'section' => 'gridy_featured_content',
        'type'    => 'select',
        'choices' => $cats
    )));


    $wp_customize->add_setting('gridy_homepage_featured_category', array(
        'default'        => $default
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'gridy_homepage_featured_category', array(
        'label' => 'Home page displays articles from category:',
        'section' => 'gridy_featured_content',
        'type'    => 'select',
        'choices' => $cats
    )));


    // category section
    $wp_customize->add_section( 'gridy_categories_options',
        array(
            'title'         => __( 'Categories', 'menu_categories' ),
            'description'   => 'You can choose here which image appears on top of categories pages.'
        )
    );

    $wp_customize->add_setting('gridy_categories_header_image', array(
        'transport'         => 'refresh',
        'default'           => get_template_directory_uri() . '/assets/img/category-image.jpg',
        'height'            => 325,
    ));
    // todo fix validator
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '', array(
        'label'             => __('Category header image', 'category-header-image'),
        'section'           => 'gridy_categories_options',
        'settings'          => 'gridy_categories_header_image',
    )));



    // colors section
    $wp_customize->add_section( 'gridy_color_options',
        array(
            'title'         => __( 'Colors', 'menu_colors' )
        )
    );

    $wp_customize->add_setting( 'gridy_color_main',
        array(
            'default'              => '1e90ff',
            'sanitize_callback'    => 'sanitize_hex_color_no_hash',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
            'transport'            => 'postMessage',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'gridy_color_main',
            array(
                'label'         => esc_html__( 'Main color', 'main_color' ),
                'description'   => 'This color is used as background color to display your articles through the 
                                    entire website.',
                'section'       => 'gridy_color_options',
                'settings'      => 'gridy_color_main',
            )
        )
    );

    $wp_customize->add_setting( 'gridy_color_accent_1',
        array(
            'default'              => '4169e1',
            'sanitize_callback'    => 'sanitize_hex_color_no_hash',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
            'transport'            => 'postMessage',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'gridy_color_accent_1',
            array(
                'label'         => esc_html__( 'Accent color n°1', 'accent_color_1' ),
                'section'       => 'gridy_color_options',
                'settings'      => 'gridy_color_accent_1',
            )
        )
    );

    $wp_customize->add_setting( 'gridy_color_accent_2',
        array(
            'default'              => '6495ed',
            'sanitize_callback'    => 'sanitize_hex_color_no_hash',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
            'transport'            => 'postMessage',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'gridy_color_accent_2',
            array(
                'label'         => esc_html__( 'Accent color n°2', 'accent_color_2' ),
                'section'       => 'gridy_color_options',
                'settings'      => 'gridy_color_accent_2',
            )
        )
    );
}

add_action( 'customize_register', 'gridy_customize_register', 50 );


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


/**
 * Generate Internal CSS from Customize Panel Settings values
 */
function gridy_customization_css(){
    $main_color     = get_theme_mod ( 'gridy_color_main', '1e90ff' );
    $accent_color_1 = get_theme_mod ( 'gridy_color_accent_1', '4169e1' );
    $accent_color_2 = get_theme_mod ( 'gridy_color_accent_2', '6495ed' );

    $style =
        ':root {
            --main-color: #' . $main_color . ';
            --accent-color-1: #' . $accent_color_1 . ';
            --accent-color-2: #' . $accent_color_2 . ';
        }';

    echo '<style>' . $style . '</style>';
}
add_action( 'wp_head', 'gridy_customization_css' );
