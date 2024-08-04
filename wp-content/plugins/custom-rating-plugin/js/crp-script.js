jQuery(document).ready(function($) {
    // Handle star click for rating
    $('.crp-stars .star').on('click', function() {
        var starValue = $(this).data('value');
        var recipeId = $(this).closest('.crp-rating').data('recipe-id');

        $.ajax({
            url: crp_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'crp_submit_rating',
                nonce: crp_ajax.nonce,
                recipe_id: recipeId,
                rating: starValue
            },
            success: function(response) {
                if (response.success) {
                    alert('Rating submitted successfully.');

                    // Update the average rating and total ratings
                    var averageRating = response.data.average_rating;
                    var totalRatings = response.data.total_ratings;

                    $('.crp-average-rating').html('<p>Average Rating: ' + averageRating.toFixed(1) + ' (' + totalRatings + ' ratings)</p>');

                    // Update the stars display based on the average rating
                    $('.crp-stars .star').each(function(index) {
                        if (index < Math.floor(averageRating)) {
                            $(this).addClass('filled');
                        } else {
                            $(this).removeClass('filled');
                        }
                    });

                    // Update the message
                    $('.crp-message').html('<p>You have rated</p>');
                } else {
                    alert(response.data);
                }
            }
        });
    });

    // Star hover effect
    $('.crp-stars .star').hover(
        function() {
            var index = $(this).index();
            $('.crp-stars .star').each(function(i) {
                if (i <= index) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });
        }, 
        function() {
            $('.crp-stars .star').removeClass('hover');
        }
    );

    // Ensure stars remain filled based on the rating after hovering
    $('.crp-stars .star').on('mouseleave', function() {
        var averageRating = parseFloat($('.crp-rating').data('average-rating'));
        $('.crp-stars .star').each(function(index) {
            if (index < Math.floor(averageRating)) {
                $(this).addClass('filled');
            } else {
                $(this).removeClass('filled');
            }
        });
    });
});
