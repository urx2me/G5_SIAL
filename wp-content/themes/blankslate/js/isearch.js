jQuery(document).ready(function($) {
    $('#search-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var searchQuery = $('#search-input').val();
        var ajaxUrl = $(this).data('ajax-url');

        console.log("Search Query:", searchQuery); // Add this line

        if (searchQuery.length > 0) {
            $.ajax({
                url: ajaxUrl,
                type: 'GET',
                data: {
                    action: 'search_recipes',
                    query: searchQuery
                },
                success: function(response) {
                    console.log("AJAX Success:", response); // Add this line
                    $('.search-result').html(response); // Inject the response into the search-result div
                },
                error: function() {
                    console.log("AJAX Error"); // Add this line
                    $('.search-result').html('<p>An error occurred while searching. Please try again.</p>');
                }
            });
        } else {
            $('.search-result').html('<p>Please enter a search query.</p>');
        }
    });
});
