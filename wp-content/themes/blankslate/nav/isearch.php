<div class="search">
    <div class="my-container" style="position: relative;">
        <p style="font-size: 40px; position: absolute; top: -80px; right: 0px; color: white; cursor: pointer;" onclick='$(".search").hide()'>X</p>
        <form id="search-form" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" class="form-contact contact_form">
            <div class="search-box d-flex">
                <input type="search" name="query" id="search-input" class="form-control col-8" placeholder="Search for recipes...">
                <button class="button button-contactForm btn_4 boxed-btn col-4" type="submit">Search</button>
            </div>
        </form>
        <div class="search-result mt-10"></div> <!-- This is where the AJAX results will be injected -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure jQuery is available
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not defined');
        return;
    }
    
    jQuery(document).ready(function($) {
        $('#search-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var searchQuery = $('#search-input').val();
            var ajaxUrl = $(this).data('ajax-url');

            if (searchQuery.length > 0) {
                $.ajax({
                    url: ajaxUrl,
                    type: 'GET',
                    data: {
                        action: 'search_recipes',
                        query: searchQuery
                    },
                    success: function(response) {
                        $('.search-result').html(response); // Inject the response into the search-result div
                    },
                    error: function() {
                        $('.search-result').html('<p>An error occurred while searching. Please try again.</p>');
                    }
                });
            } else {
                $('.search-result').html('<p>Please enter a search query.</p>');
            }
        });
    });
});
</script>
