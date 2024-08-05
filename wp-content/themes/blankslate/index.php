<?php
//echo get_template_directory_uri() ;
/*
*    Template Name: Landing Page
*/

//get_header();
global $is_IIS;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your login logic here
    $username = sanitize_text_field($_POST['username']);
    $password = $_POST['password'];
    $user = wp_authenticate($username, $password);

    if (!is_wp_error($user)) {
        $_SESSION['loggedin'] = true; // Set the session variable to true
        $_SESSION['user_id'] = $user->ID;
        $_SESSION['username'] = $user->user_login;

        // Redirect to the Home Page or another page
        $location = home_url('/index_loggin/');
        $status = 302;
        $x_redirect_by = 'WordPress';

        $location = apply_filters('wp_redirect', $location, $status);
        $status = apply_filters('wp_redirect_status', $status, $location);

        if ($location) {
            if ($status < 300 || 399 < $status) {
                wp_die(__('HTTP redirect status code must be a redirection code, 3xx.'));
            }

            $location = wp_sanitize_redirect($location);

            if (!$is_IIS && 'cgi-fcgi' !== PHP_SAPI) {
                status_header($status); // This causes problems on IIS and some FastCGI setups.
            }

            $x_redirect_by = apply_filters('x_redirect_by', $x_redirect_by, $status, $location);
            if (is_string($x_redirect_by)) {
                header("X-Redirect-By: $x_redirect_by");
            }

            header("Location: $location", true, $status);
            exit();
        }
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tasty Recipes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <?php include get_template_directory() . '/css.php'; ?>
    
</head>

    <!-- header-start -->
    <?php include get_template_directory() . '/nav/iheader.php'; ?>
    <!-- header-end -->

    <!-- search  -->
    <?php include get_template_directory() . '/nav/isearch.php'; ?>
    <!-- /end search  -->

    <!-- bradcam_area  -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
    <!-- /bradcam_area  -->
     
    <!-- recepie_area_start  -->
    <div class="recepie_area">
        <div class="container">
            <h1 class="text-center mb-5 w-100">Top Best Recipes</h1>
            <div class="row">
    <?php
    // Custom function to get the average rating
    function get_average_rating($recipe_id) {
        $all_ratings = get_post_meta($recipe_id, 'crp_ratings', true);
        $total_ratings = is_array($all_ratings) ? count($all_ratings) : 0;
        $sum_ratings = is_array($all_ratings) ? array_sum($all_ratings) : 0;
        return $total_ratings ? round($sum_ratings / $total_ratings, 1) : 0;
    }

    // Get all recipes and calculate their average ratings
    $recipes = new WP_Query(array(
        'post_type'      => 'recipe',
        'posts_per_page' => -1 // Get all recipes
    ));

    $recipes_with_ratings = array();

    if ($recipes->have_posts()) :
        while ($recipes->have_posts()) : $recipes->the_post();
            $recipe_id = get_the_ID();
            $average_rating = get_average_rating($recipe_id);
            $recipes_with_ratings[] = array(
                'recipe_id' => $recipe_id,
                'average_rating' => $average_rating
            );
        endwhile;
        wp_reset_postdata();

        // Sort recipes by average rating in descending order
        usort($recipes_with_ratings, function($a, $b) {
            return $b['average_rating'] <=> $a['average_rating'];
        });

        // Get top 3 recipes
        $top_recipes = array_slice($recipes_with_ratings, 0, 3);
        
        foreach ($top_recipes as $recipe) :
            $recipe_id = $recipe['recipe_id'];
            $average_rating = $recipe['average_rating'];
            $thumbnail_url = get_the_post_thumbnail_url($recipe_id, 'thumbnail');
            $recipe_link = esc_url(home_url('/recipe-details/?recipe_id=' . $recipe_id));
            ?>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single_recepie text-center">
                    <div class="recepie_thumb">
                        <a href="<?php echo $recipe_link; ?>"><img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo get_the_title($recipe_id); ?>"></a>
                    </div>
                    <p class="mt-3">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<i class="fa ' . ($i <= $average_rating ? 'fa-star' : 'fa-star-o') . '" aria-hidden="true"></i>';
                        }
                        ?>
                    </p>
                    <h3 class="mt-0"><?php echo get_the_title($recipe_id); ?></h3>
                </div>
            </div>
            <?php
        endforeach;
    else :
        ?>
        <p>No top recipes found.</p>
        <?php
    endif;
    ?>
</div>
        </div>
    </div>
    <!-- /recepie_area_start  -->

    <!-- dish_area start  -->
    <div class="dish_area">
    <div class="container">
        <h1 class="text-center w-100" style="margin-bottom: 150px;">All Other Recipes</h1>
        <div class="row">
            <div class="col-xl-12">
                <div class="dish_wrap" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; row-gap: 140px;">
                    <?php
                    // Query for all recipes
                    $all_recipes = new WP_Query(array(
                        'post_type'      => 'recipe',
                        'posts_per_page' => -1, // Get all recipes
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    ));

                    if ($all_recipes->have_posts()) :
                        while ($all_recipes->have_posts()) : $all_recipes->the_post();
                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Use 'full' size for better quality
                            $recipe_id = get_the_ID();
                            $recipe_link = esc_url(home_url('/recipe-details/?recipe_id=' . $recipe_id));
                            
                            // Calculate average rating
                            $all_ratings = get_post_meta($recipe_id, 'crp_ratings', true);
                            $total_ratings = is_array($all_ratings) ? count($all_ratings) : 0;
                            $sum_ratings = is_array($all_ratings) ? array_sum($all_ratings) : 0;
                            $average_rating = $total_ratings ? round($sum_ratings / $total_ratings, 1) : 0;
                            ?>
                            <div class="single_dish text-center">
                                <div class="thumb dish-thumb">
                                    <a href="<?php echo $recipe_link; ?>">
                                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" class="dish-thumb-image">
                                    </a>
                                </div>
                                <p class="mb-2">
                                    <?php
                                    if ($average_rating) {
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<i class="fa ' . ($i <= $average_rating ? 'fa-star' : 'fa-star-o') . '" aria-hidden="true"></i>';
                                        }
                                    } else {
                                        echo '<i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                    ?>
                                </p>
                                <h3 class="mb-0"><?php the_title(); ?></h3>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p>No recipes found.</p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
    <!-- /dish_area start  -->



<!-- customer_feedback_area start -->
<div class="customer_feedback_area mt-30">
    <div class="container">
        <div class="row justify-content-center mb-50">
            <div class="col-xl-9">
                <div class="section_title text-center">
                    <h3>Most Recent Users' Comments</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="customer_active owl-carousel owl-theme">
                    <?php
                    // Get the latest 6 comments
                    $latest_comments = get_comments(array(
                        'number'      => 6, // Number of comments to retrieve
                        'status'      => 'approve', // Only approved comments
                        'post_status' => 'publish' // Only on published posts
                    ));

                    foreach ($latest_comments as $comment) :
                        // Get the recipe title and construct the link to the recipe-details page
                        $recipe_title = get_the_title($comment->comment_post_ID);
                        $recipe_id = $comment->comment_post_ID;
                        $recipe_link = home_url('/recipe-details/?recipe_id=' . $recipe_id);
                        ?>
                        
                        <a href="<?php echo esc_url($recipe_link); ?>" class="single_customer_link">
                            <div class="single_customer d-flex">
                                <?php
                                    // Retrieve profile picture URL
                                    $user_id = $comment->user_id;
                                    $profile_picture = get_user_meta($user_id, 'profile_picture', true);
                                ?>
                                <div class="thumb">
                                    <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($comment->comment_author); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>
                                <div class="customer_meta">
                                    <h3><?php echo esc_html($comment->comment_author); ?></h3>
                                    <span><?php echo esc_html($recipe_title); ?></span>
                                    <p><?php echo esc_html($comment->comment_content); ?></p>
                                    <p><?php echo esc_html(date_i18n('h:i:s a', strtotime($comment->comment_date))); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / customer_feedback_area end -->


<!-- JS here -->
<?php include get_template_directory() . '/js.php'; ?>

<!-- footer  -->
<?php include get_template_directory() . '/nav/ifooter.php'; ?>
<!--/ footer  -->

<!-- Add CSS to limit image size and apply object-fit -->
<style>
.dish-thumb {
    max-width: 100%;
    max-height: 200px; /* Adjust as needed */
    overflow: hidden;
}

.dish-thumb-image {
    width: 100%;
    height: 200px; /* Adjust as needed */
    object-fit: cover;
}

.customer_feedback_area .thumb img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
}
</style>

<!-- Add JavaScript to initialize Owl Carousel -->
<script>
jQuery(document).ready(function($){
    $(".customer_active").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,  
        items: 2, // Number of comments visible at a time
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });
});
</script>



<?php
/*
if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'entry' );
comments_template();
endwhile; endif;
get_template_part( 'nav', 'below' );
*/
//get_footer();
?>
