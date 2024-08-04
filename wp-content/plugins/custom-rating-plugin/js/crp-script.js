//READ THIS FILE IS LOCATED IN THE js FOLDER in custom-rating-plugin FOLDER UNDER PLUGINS IN WP-CONTENT
jQuery(document).ready(function($) {
    $('.crp-stars .star').on('click', function() {
        var rating = $(this).data('value');
        var recipeId = $(this).closest('.crp-rating').data('recipe-id');

        $.post(
            crp_ajax.ajax_url,
            {
                action: 'crp_submit_rating',
                rating: rating,
                recipe_id: recipeId,
                nonce: crp_ajax.nonce
            },
            function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data);
                }
            }
        );
    });
});
