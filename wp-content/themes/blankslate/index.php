<?php
//echo get_template_directory_uri() ;
/*
*    Template Name: Landing Page
*/

//get_header();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tasty Recipes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->


</head>
<!-- CSS here -->
<?php include get_template_directory() . '/css.php'; ?>


    <!-- header-start -->
    <?php include get_template_directory() . '/nav/iheader.php'; ?>
    <!-- header-end -->

    <!-- search -->
    <?php include get_template_directory() . '/nav/isearch.php'; ?>
    <!-- /end search -->

    <!-- bradcam_area -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
    <!-- /bradcam_area -->

<!-- recepie_area_start  -->
<div class="recepie_area">
    <div class="container">
        <h1 class="text-center mb-5 w-100">Top Best Recipes</h1>
        <div class="row">
            <?php
            // Custom query to get the top 3 rated recipes
            $args = array(
                'post_type'      => 'recipe', // Custom post type
                'posts_per_page' => 3, // Number of recipes to display
                'meta_key'       => '_average_rating', // Custom field for rating
                'orderby'        => 'meta_value_num', // Order by numeric meta value
                'order'          => 'DESC', // Highest rating first
                'meta_query'     => array(
                    array(
                        'key'     => '_average_rating',
                        'compare' => 'EXISTS' // Ensure that the meta key exists
                    )
                )
            );
            $top_rated_recipe_query = new WP_Query($args);

            // Check if there are posts
            if ($top_rated_recipe_query->have_posts()) :
                while ($top_rated_recipe_query->have_posts()) : $top_rated_recipe_query->the_post(); ?>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb">
                                <a href="<?php echo esc_url(home_url('/recipe-details/?recipe_id=' . get_the_ID())); ?>">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        the_post_thumbnail('medium', array('class' => 'img-fluid recepie-thumb-image')); // Display recipe thumbnail
                                    else : ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/recepie/default.png'); ?>" alt="Default Thumbnail" class="img-fluid recepie-thumb-image">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <p class="mt-3">
                                <?php
                                // Display star rating
                                $average_rating = get_post_meta(get_the_ID(), '_average_rating', true);
                                $average_rating = floatval($average_rating); // Ensure it's a float
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= floor($average_rating)) {
                                        echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                    } elseif ($i - $average_rating == 0.5) {
                                        echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                                    } else {
                                        echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                                    }
                                }
                                ?>
                            </p>
                            <h3 class="mt-0"><?php the_title(); ?></h3>
                        </div>
                    </div>
                <?php endwhile;

                // Reset post data
                wp_reset_postdata();
            else :
                echo '<p>No recipes found. Debugging info: Check if meta key `_average_rating` exists and has values.</p>';
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
                    // Get the top 3 best-rated recipes
                    $top_rated_args = array(
                        'post_type'      => 'recipe',
                        'posts_per_page' => 3,
                        'meta_key'       => '_average_rating',
                        'orderby'        => 'meta_value_num',
                        'order'          => 'DESC'
                    );
                    $top_rated_query = new WP_Query($top_rated_args);
                    $top_rated_ids = array();

                    if ($top_rated_query->have_posts()) :
                        while ($top_rated_query->have_posts()) : $top_rated_query->the_post();
                            $top_rated_ids[] = get_the_ID();
                        endwhile;
                        wp_reset_postdata();
                    endif;

                    // Custom query to get all other recipes except the top 3 best-rated
                    $args = array(
                        'post_type'      => 'recipe', // Custom post type
                        'posts_per_page' => -1, // Get all recipes
                        'orderby'        => 'date', // Order by date
                        'order'          => 'DESC', // Latest first
                        'post__not_in'   => $top_rated_ids // Exclude top-rated recipes
                    );
                    $all_other_recipes_query = new WP_Query($args);

                    // Check if there are posts
                    if ($all_other_recipes_query->have_posts()) :
                        while ($all_other_recipes_query->have_posts()) : $all_other_recipes_query->the_post(); ?>
                            <div class="single_dish text-center">
                                <div class="thumb dish-thumb">
                                    <a href="<?php echo esc_url(home_url('/recipe-details/?recipe_id=' . get_the_ID())); ?>">
                                        <?php
                                        if (has_post_thumbnail()) :
                                            the_post_thumbnail('medium', array('class' => 'img-fluid dish-thumb-image')); // Display recipe thumbnail
                                        else : ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/recepie/default.png'); ?>" alt="Default Thumbnail" class="img-fluid dish-thumb-image">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <p class="mb-2">
                                    <?php
                                    // Display star rating based on actual rating
                                    $average_rating = get_post_meta(get_the_ID(), '_average_rating', true);
                                    $average_rating = !empty($average_rating) ? round($average_rating) : 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $average_rating) {
                                            echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                        } else {
                                            echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                    }
                                    ?>
                                </p>
                                Published: <?php echo get_the_date('d-M-Y'); ?>
                                <h3 class="mt-3"><?php the_title(); ?></h3>
                            </div>
                        <?php endwhile;

                        // Reset post data
                        wp_reset_postdata();
                    else :
                        echo '<p>No recipes found.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ dish_area end  -->



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
get_footer();
?>
