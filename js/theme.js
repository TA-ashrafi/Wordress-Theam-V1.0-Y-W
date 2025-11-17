jQuery(document).ready(function($) {
    // Load More Posts functionality
    $(document).on('click', '.load-more-posts', function() {
        var button = $(this);
        var category = button.data('category');
        var paged = button.data('paged');

        button.text('Loading...');
        button.prop('disabled', true);

        $.ajax({
            url: ajax_params.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                category: category,
                paged: paged
            },
            success: function(response) {
                if (response.success) {
                    $('.archive-posts-grid').append(response.data.html);
                    button.data('paged', paged + 1);
                    button.text('View More');
                    button.prop('disabled', false);

                    if (!response.data.has_more) {
                        button.hide();
                    }
                } else {
                    button.text('No more posts');
                    button.prop('disabled', true);
                }
            },
            error: function() {
                button.text('Error loading posts');
                button.prop('disabled', false);
            }
        });
    });
});
