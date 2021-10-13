(function($){
    /* main color */
    wp.customize( 'gridy_color_main', function( color_code ) {
        color_code.bind( function( updated_color_code ) {
            $( ':root' )
                .css( '--main-color', updated_color_code );
        } );
    } );

    wp.customize( 'gridy_color_accent_1', function( color_code ) {
        color_code.bind( function( updated_color_code ) {
            $( ':root' )
                .css( '--accent-color-1', updated_color_code );
        } );
    } );

    wp.customize( 'gridy_color_accent_2', function( color_code ) {
        color_code.bind( function( updated_color_code ) {
            $( ':root' )
                .css( '--accent-color-2', updated_color_code );
        } );
    } );

    wp.customize( 'gridy_homepage_highlight_link_text', function( text ) {
        text.bind( function( new_text ) {
            $( '.articles-images-label')[0].textContent = new_text;
        } );
    } );
})(jQuery);
