<?php
/**
 * Plugin Name: Custom Rating Plugin
 * Description: A plugin to allow users to rate recipes.
 * Version: 1.0
 * Author: Group 6
 */

// Enqueue scripts and styles
function crp_enqueue_scripts() {
    wp_enqueue_script('jquery'); // Ensure jQuery is enqueued
    wp_enqueue_script('crp-script', plugins_url('js/crp-script.js', __FILE__), array('jquery'), '1.0', true);
    wp_localize_script('crp-script', 'crp_ajax', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('crp_nonce')));
    
    $css_file = plugins_url('css/rating.css', __FILE__);
    wp_enqueue_style('crp-style', $css_file);
}
add_action('wp_enqueue_scripts', 'crp_enqueue_scripts');


// Handle AJAX request to submit rating
function crp_submit_rating() {
    check_ajax_referer('crp_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error('You must be logged in to rate.');
        return;
    }

    $user_id = get_current_user_id();
    $recipe_id = intval($_POST['recipe_id']);
    $rating = intval($_POST['rating']);

    $author_id = get_post_field('post_author', $recipe_id);
    if ($author_id == $user_id) {
        wp_send_json_error('You cannot rate your own post.');
        return;
    }

    $user_rating = get_post_meta($recipe_id, 'crp_user_rating_' . $user_id, true);
    if ($user_rating) {
        wp_send_json_error('You have already rated.');
        return;
    }

    // Save user rating
    $all_ratings = get_post_meta($recipe_id, 'crp_ratings', true);
    if (!is_array($all_ratings)) {
        $all_ratings = array();
    }
    $all_ratings[$user_id] = $rating;
    update_post_meta($recipe_id, 'crp_ratings', $all_ratings);
    update_post_meta($recipe_id, 'crp_user_rating_' . $user_id, $rating);

    // Calculate new average rating
    $total_ratings = count($all_ratings);
    $sum_ratings = array_sum($all_ratings);
    $average_rating = $total_ratings ? round($sum_ratings / $total_ratings, 1) : 0;

    // Update average rating in post meta
    update_post_meta($recipe_id, '_average_rating', $average_rating);

    wp_send_json_success(array(
        'average_rating' => $average_rating,
        'total_ratings' => $total_ratings
    ));
}
add_action('wp_ajax_crp_submit_rating', 'crp_submit_rating');
// add_action('wp_ajax_nopriv_crp_submit_rating', 'crp_submit_rating'); // Allow non-logged-in users to rate if required



// Display rating stars
function crp_display_rating($content) {
    if (get_post_type() != 'recipe') {
        return $content;
    }

    global $wpdb;
    $recipe_id = get_the_ID();

    $all_ratings = get_post_meta($recipe_id, 'crp_ratings', true);
    $total_ratings = is_array($all_ratings) ? count($all_ratings) : 0;
    $sum_ratings = is_array($all_ratings) ? array_sum($all_ratings) : 0;
    $average_rating = $total_ratings ? round($sum_ratings / $total_ratings, 1) : 0;

    ob_start();
    ?>
    <div class="crp-rating" data-recipe-id="<?php echo esc_attr($recipe_id); ?>">
        <div class="crp-stars" data-user-rating="<?php echo esc_attr(get_post_meta($recipe_id, 'crp_user_rating_' . get_current_user_id(), true)); ?>">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
            <?php endfor; ?>
        </div>
        <div class="crp-message">
            <?php
            if (!is_user_logged_in()) {
                echo '<p><a href="' . wp_login_url(get_permalink()) . '">Login to rate</a></p>';
            } elseif (get_current_user_id() == get_post_field('post_author', $recipe_id)) {
                echo '<p>You cannot rate your own post.</p>';
            } else {
                $user_id = get_current_user_id();
                $user_rating = get_post_meta($recipe_id, 'crp_user_rating_' . $user_id, true);
                if ($user_rating) {
                    echo '<p>You have rated</p>';
                } else {
                    echo '<p>Click on the star(s) to rate</p>';
                }
            }
            ?>
        </div>
        <div class="crp-average-rating">
            <p>Average Rating: <?php echo esc_html($average_rating); ?> (<?php echo esc_html($total_ratings); ?> ratings)</p>
        </div>
    </div>
    <?php
    return $content . ob_get_clean();
}
add_filter('the_content', 'crp_display_rating');
