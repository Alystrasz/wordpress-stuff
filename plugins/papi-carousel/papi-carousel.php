<?php
/**
 * Plugin Name:       Papi Carousel
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       papi-carousel
 *
 * @package           create-block
 */

function papi_carousel_dynamic_render_callback( $block_attributes, $content ) {
    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 3,
        'post_status' => 'publish',
    ) );
    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
    $carouselIndicators = '';
    $carouselItems = '';
    for ($i=0; $i<count($recent_posts); $i++) {
        $post = $recent_posts[$i];
        $post_id = $post['ID'];
        $tid = get_post_thumbnail_id($post_id);
        $url = $tid ? wp_get_attachment_image_src( $tid, 'small' )[0] : 'https://via.placeholder.com/800x400';

        $carouselIndicators .= 
            '<button ' . ($i == 0 ? 'class="active" aria-current="true"' : '') . ' type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to=' . $i . ' aria-label="Slide ' . ($i+1) . '"></button>';
        $carouselItems .=
            '<div' . ($i == 0 ? ' class="carousel-item active"' : ' class="carousel-item"') . '>
                <img src="' . $url . '" class="d-block w-100" alt="..."/>
                <div class="carousel-caption d-none d-md-block">
                    <h5>' . esc_html( get_the_title( $post_id ) ) . '</h5>
                    <p>' . esc_html( get_post_excerpt( $post_id ) ) . '</p>
                </div>
            </div>';
    }
    
    return '<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" { ...useBlockProps() }>' . 
        '<div class="carousel-indicators">' . $carouselIndicators . '</div>' .
        '<div class="carousel-inner">' . $carouselItems . '</div>' .
        '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>' .    
    '</div>';
}

function get_post_excerpt ($postId) {
    $charactersCount = 200;
    $excerpt = get_the_excerpt($postId);
    $result = substr($excerpt, 0, $charactersCount);
    $result = substr($result, 0, strrpos($result, ' '));
    if (strlen($excerpt) > $charactersCount)
        $result .= '…';
    return $result;
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function create_block_papi_carousel_block_init() {
	register_block_type( __DIR__, array(
        'api_version' => 2,
        'render_callback' => 'papi_carousel_dynamic_render_callback'
    ) );
}
add_action( 'init', 'create_block_papi_carousel_block_init' );
