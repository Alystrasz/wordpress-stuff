<?php 

// Adding site title to <title> tag
add_theme_support( 'title-tag' );

// Posts do have a thumbnail image
add_theme_support( 'post-thumbnails' ); 

// Import customize functions
require_once(get_template_directory() . '/parts/customize.php');

// Registering CSS style files
function register_styles () {
    wp_register_style(
        'bootstrap-style',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css'
    );

    wp_register_style(
        'overlay-scrollbars-style',
        'https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css'
    );

    wp_register_style(
        'papi-colors',
        get_template_directory_uri() . '/assets/css/colors.css'
    );

    wp_register_style(
        'papi-fonts',
        get_template_directory_uri() . '/assets/css/fonts.css'
    );

    wp_register_style(
        'papi-style', // handle name
        get_stylesheet_uri()
    );

    wp_enqueue_style( 'bootstrap-style' );
    wp_enqueue_style( 'overlay-scrollbars-style' );
    wp_enqueue_style( 'papi-colors' );
    wp_enqueue_style( 'papi-fonts' );
    wp_enqueue_style( 'papi-style' );
}
add_action( 'wp_enqueue_scripts', 'register_styles' );

// Registering JavaScript files
function load_scripts () {
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'overlay-scrollbars',
        'https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'scrollbars',
        get_template_directory_uri() . '/assets/js/scrollbars.js',
        ['overlay-scrollbars'],
        null,
        true
    );

    wp_enqueue_script(
        'sticky-menu',
        get_template_directory_uri() . '/assets/js/sticky.js',
        [],
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );


// Adding menus slots to the website.
// Only the header menu is available for this theme.
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' )
        )
     );
}
add_action( 'init', 'register_my_menus' );




/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------

///                               Highlighting menu items when on related page

/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------

function _isItemPageCurrentlyDisplayed ($link) {
    global $wp;
    $current_url = home_url( $wp->request );
    // check if "href" item attribute matches current URL
    return (strcmp($link, $current_url) === 0 || strcmp($link, $current_url . '/') === 0)
    // check if home page is not currently displayed (this case will be matched by _isItemPageHome)
    && strcmp(get_home_url(), $current_url) !== 0;
}

function _isItemPageHome ($atts) {
    global $wp;
    $home_url = get_home_url();
    $tag_url = $atts['href'];
    $tag_url_without_final_slash = substr($tag_url, 0, -1);
    return $home_url === home_url( $wp->request ) 
        && ($home_url === $tag_url || $home_url === $tag_url_without_final_slash);
}

function _isItemCategoryTitle ($link) {
    return is_category() && strcmp($link, get_category_link( get_query_var( 'cat' ) )) === 0;
}

function addLinkClassesWithActive( $atts, $item, $args ) {
    if (
        // check if the item is in the primary menu 
        $args->theme_location == 'header-menu'

        // check if the item should be highlighted
        && _isItemPageCurrentlyDisplayed($atts['href']) || _isItemPageHome($atts) || _isItemCategoryTitle($atts['href'])
    ) {
        $atts['class'] .= ' active';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'addLinkClassesWithActive', 10, 3 );


/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------
/// ------------------------------------------------------------------------------------------------------------



// Register Custom Navigation Walker
// This is used for menus to have Bootstrap-like attributes.
function register_navwalker(){
	require_once get_template_directory() . '/plugins/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 * Needed with Bootstrap 5.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
