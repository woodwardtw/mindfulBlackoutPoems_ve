
jQuery( document ).ready( function ( $ ) {
    $( '#post-submission-form' ).on( 'submit', function(e) {
        e.preventDefault();
        var title = $( '#post-submission-title' ).val();
        var content = $( '#post-submission-content' ).val();
        var parent =  $( '#post-submission-parent-id' ).val(); 
        var status = 'publish';        

        var data = {
            title: title,
            content: content,
            status: status,
            parent: parent,
        };

        $.ajax({
            method: "POST",
            url: POST_SUBMITTER.root + 'wp/v2/poems',
            data: data,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', POST_SUBMITTER.nonce );
            },
            success : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.success );
            },
            fail : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.failure );
            }

        });

    });

} );
