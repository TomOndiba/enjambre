<script>

    $(document).ready(function() {
        $('[data-tooltip!=""]').qtip({// Grab all elements with a non-blank data-tooltip attr.
            style: "qtip-bootstrap",
            content: {
                attr: 'data-tooltip'
            }
        })
        // MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
        $('a.informacion-user').each(function() {
            $(this).qtip({
                content: {
                    text: function(event, api) {
                        $.ajax({
                            url: $(this).attr('tooltip-view') // Use href attribute as URL
                        })
                                .then(function(content) {
                                    // Set the tooltip content upon successful retrieval
                                    api.set('content.text', content);
                                }, function(xhr, status, error) {
                                    // Upon failure... set the tooltip content to error
                                    api.set('content.text', status + ': ' + error);
                                });

                        return 'Loading...'; // Set some initial text
                    }
                },
                position: {
                    viewport: $(window)
                },
                hide: {
                    fixed: true,
                    delay: 300
                },
                style: 'qtip-wiki'
            });
        });
        
    })

</script>