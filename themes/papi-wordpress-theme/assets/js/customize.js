
(function($){
    // live-updating contact footer
    wp.customize( 'papi_contact_text', function( text ) {
        text.bind( function( new_text ) {
            $('#contactInformationContainer')[0].innerHTML = new_text;
        } );
    } );
})(jQuery);