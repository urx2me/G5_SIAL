<?php
/*
Template Name: Recipe Details Page
*/

// Ensure to include the header if needed
// get_header();

// Handle Comment Submission
get_template_part('header-loggedin'); 

// Handle Comment Submission
if (isset($_POST['comment_post_ID'])) {
    $post_id = intval($_POST['comment_post_ID']);
    // Redirect to the same page with the appropriate recipe_id and comments section
    $redirect_url = add_query_arg(array(
        'recipe_id' => $post_id,
        'comment_status' => 'approved'
    ), get_permalink($post_id));
    wp_redirect($redirect_url);
    exit;
}

?>
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

<!--================ Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <?php
                // Ensure proper retrieval of recipe_id
                $recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : 0;

                if ($recipe_id) :
                    $recipe = get_post($recipe_id);

                    if ($recipe) :
                        setup_postdata($recipe);
                        ?>

                        <div class="single-post">
                            <div class="feature-img">
                                <?php
                                if (has_post_thumbnail($recipe_id)) :
                                    echo get_the_post_thumbnail($recipe_id, 'large', array('class' => 'img-fluid'));
                                else : ?>
                                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/default-recipe.jpg" alt="Default Recipe Image">
                                <?php endif; ?>
                            </div>
                            <div class="blog_details">
                                <h2><?php echo esc_html($recipe->post_title); ?></h2>

                                <!-- Display Categories -->
                                <ul class="blog-info-link mt-3 mb-4">
                                    <li>Category: 
                                        <?php 
                                        $categories = get_the_terms($recipe_id, 'category');
                                        if ($categories && !is_wp_error($categories)) {
                                            $category_links = array();
                                            foreach ($categories as $category) {
                                                // Use term_id instead of slug
                                                $category_link = esc_url(home_url('/recipe-categories/?category_id=' . $category->term_id));
                                                $category_links[] = '<a href="' . $category_link . '">' . esc_html($category->name) . '</a>';
                                            }
                                            echo implode(', ', $category_links);
                                        } else {
                                            echo 'No category assigned';
                                        }
                                        ?>
                                    </li>
                                </ul>


                                    <!-- Display Tags -->
                                    <li>Tags: 
                                        <?php 
                                        $tags = get_the_terms($recipe_id, 'post_tag');
                                        if ($tags && !is_wp_error($tags)) {
                                            $tag_links = array();
                                            foreach ($tags as $tag) {
                                                $tag_link = esc_url(home_url('/tag-page/?tag=' . $tag->slug));
                                                $tag_links[] = '<a href="' . $tag_link . '">' . esc_html($tag->name) . '</a>';
                                            }
                                            echo implode(', ', $tag_links);
                                        } else {
                                            echo 'No tags assigned';
                                        }
                                        ?>
                                    </li>
                                </ul>
                                        
                                <!-- Display Nutrition Information -->
                                <div class="recipe-nutrition-info">
                                    <ul class="blog-info-link mt-3 mb-4">
                                        <li>Energy: <?php echo esc_html(get_post_meta($recipe_id, 'energy', true)); ?> kcal</li>
                                        <li>Carbohydrate: <?php echo esc_html(get_post_meta($recipe_id, 'carbohydrate', true)); ?> g</li>
                                        <li>Protein: <?php echo esc_html(get_post_meta($recipe_id, 'protein', true)); ?> g</li>
                                    </ul>
                                </div>
                            
<!-- Rating Display and Form -->
<?php
$all_ratings = get_post_meta($recipe_id, 'crp_ratings', true);
$total_ratings = is_array($all_ratings) ? count($all_ratings) : 0;
$sum_ratings = is_array($all_ratings) ? array_sum($all_ratings) : 0;
$average_rating = $total_ratings ? round($sum_ratings / $total_ratings, 1) : 0;
?>

<div class="crp-rating" data-recipe-id="<?php echo esc_attr($recipe_id); ?>" data-average-rating="<?php echo esc_attr($average_rating); ?>">
    <div class="crp-stars">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
        <?php endfor; ?>
    </div>
    <div class="crp-message">
        <?php
        if (!is_user_logged_in()) {
            echo '<p><a href="' . esc_url(home_url('/login/')) . '">Login to rate</a></p>';
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






                                <!-- Display Ingredients -->
                                <h4>Ingredients</h4>
                                <ul>
                                    <?php
                                    $ingredients = get_post_meta($recipe_id, 'ingredients', true);
                                    if ($ingredients) {
                                        $ingredients = maybe_unserialize($ingredients);
                                        if (is_array($ingredients)) {
                                            foreach ($ingredients as $ingredient) {
                                                echo '<li>' . esc_html($ingredient) . '</li>';
                                            }
                                        } else {
                                            echo '<p>' . esc_html($ingredients) . '</p>';
                                        }
                                    } else {
                                        echo '<p>No ingredients found</p>';
                                    }
                                    ?>
                                </ul>

                                <!-- Display Methods -->
                                <h4>Methods</h4>
                                <ul>
                                    <?php
                                    $methods = get_post_meta($recipe_id, 'method', true);
                                    if (!empty($methods)) {
                                        echo nl2br(esc_html($methods));
                                    } else {
                                        echo '<p>No method found</p>';
                                    }
                                    ?>
                                </ul>

                                <!-- Display Tips -->
                                <div class="quote-wrapper">
                                    <div class="quotes">
                                        <h4>Tips</h4>
                                        <p><?php 
                                        $tips = get_post_meta($recipe_id, 'tips', true);
                                        if ($tips) {
                                            echo esc_html($tips);
                                        } else {
                                            echo '<p>No tips provided</p>';
                                        }
                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Display Comments -->
                        <div class="comments-area">
                            <?php
                            // Ensure recipe_id is properly retrieved
                            $recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : 0;

                            if ($recipe_id) :
                                if (comments_open($recipe_id) || get_comments_number($recipe_id) > 0) :
                                    // Display existing comments
                                    $args = array('post_id' => $recipe_id);
                                    $comments = get_comments($args);
                                    $comments_count = count($comments);
                                    ?>
                                    <h4><?php echo esc_html($comments_count); ?> Comments</h4>
                                    <?php foreach ($comments as $comment): ?>
                                        <?php
                                        // Retrieve profile picture URL
                                        $user_id = $comment->user_id;
                                        $profile_picture = get_user_meta($user_id, 'profile_picture', true); // Adjusted the meta key to 'profile_image'
                                        ?>
                                        <div class="comment-list">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb" style="height: 50px; width: 50px;">
                                                        <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($comment->comment_author); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    </div>
                                                    <div class="desc">
                                                        <p class="comment">
                                                            <?php echo esc_html($comment->comment_content); ?>
                                                        </p>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex align-items-center">
                                                                <h5>
                                                                    <a href="#"><?php echo esc_html($comment->comment_author); ?></a>
                                                                </h5>
                                                                <p class="date"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($comment->comment_date))); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <!-- Display comment form -->
                                <?php if (is_user_logged_in()) : ?>
                                    <?php if (comments_open($recipe_id)) : ?>
                                        <div class="comment-form">
                                            <div id="comments">
                                                <div id="respond" class="comment-respond">
                                                    <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">Cancel reply</a></small></h3>
                                                    <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform" class="comment-form">
                                                        <p class="logged-in-as">Logged in as <?php echo wp_get_current_user()->display_name; ?>. <a href="<?php echo admin_url('profile.php'); ?>">Edit your profile</a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>">Log out?</a> <span class="required-field-message">Required fields are marked <span class="required">*</span></span></p>
                                                        <p class="comment-form-comment"><label for="comment">Comment <span class="required">*</span></label><textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Enter Message" required></textarea></p>
                                                        <p class="form-submit"><button type="submit" class="mt-10 button button-contactForm btn_4 boxed-btn">Send Message</button> 
                                                            <input type="hidden" name="comment_post_ID" value="<?php echo $recipe_id; ?>" id="comment_post_ID">
                                                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                                        </p>
                                                        <input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment" value="<?php echo wp_create_nonce('unfiltered-html-comment_' . $recipe_id); ?>">
                                                    </form>
                                                </div><!-- #respond -->
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <p>Comments are closed for this recipe.</p>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <b>You must be logged in to comment.</b>
                                <?php endif; ?>
                            <?php else :?>
                                <p>No recipe ID specified</p>
                            <?php endif; ?>
                            
                        </div><!-- .comments-area -->
                        <script type="text/javascript">
                            document.addEventListener('DOMContentLoaded', function() {
                                var form = document.querySelector('#commentform');
                                if (form) {
                                    form.addEventListener('submit', function(event) {
                                        event.preventDefault();
                                        var formData = new FormData(form);
                                        formData.set('comment_post_ID', '<?php echo $recipe_id; ?>'); // Set the correct recipe_id
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => response.text())
                                        .then(text => {
                                            console.log('Response:', text);
                                            // Refresh the page to show the updated comments
                                            window.location.reload();
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Error submitting comment');
                                        });
                                    });
                                }
                            });
                        </script>
                        <?php
                    else :
                        echo '<p>Invalid recipe ID or recipe not found.</p>';
                    endif;
                else :
                    echo '<p>No recipe ID specified.</p>';
                endif;
                ?>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- category side -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            <?php
                            $categories = get_categories();
                            foreach ($categories as $category) {
                                $category_count = $category->count;
                                $category_slug = $category->slug;
                                $category_link = esc_url(home_url('/recipe-categories/?category_id=' . $category->term_id));
                                ?>
                                <li>
                                    <a href="<?php echo $category_link; ?>" class="d-flex">
                                        <p><?php echo esc_html($category->name); ?></p>
                                        <p>(<?php echo intval($category_count); ?>)</p>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </aside>
                     <!-- new recipe side -->
                     <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent New Recipes</h3>
                        <?php
                        // Query to get the 6 most recent posts from the 'recipe' post type
                        $recent_recipes = new WP_Query(array(
                            'post_type'      => 'recipe', // Post type to query
                            'posts_per_page' => 6,        // Number of posts to display
                            'orderby'        => 'date',    // Order by date
                            'order'          => 'DESC'     // Most recent first
                        ));
                        
                        // Check if there are posts
                        if ($recent_recipes->have_posts()) :
                            // Loop through posts
                            while ($recent_recipes->have_posts()) : $recent_recipes->the_post();
                                // Get post thumbnail URL
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                $recipe_id = get_the_ID();
                                // Construct the link to /recipe-details/ with recipe_id
                                $recipe_link = esc_url(home_url('/recipe-details/?recipe_id=' . $recipe_id));
                                ?>
                                <div class="media post_item">
                                    <a href="<?php echo $recipe_link; ?>">
                                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" style="height: 50px; width: 50px;">
                                    </a>
                                    <div class="media-body">
                                        <a href="<?php echo $recipe_link; ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                        <p><?php echo get_the_date(); ?></p>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            // Reset post data
                            wp_reset_postdata();
                        else :
                            ?>
                            <p>No recent recipes found.</p>
                            <?php
                        endif;
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->

<!-- footer  -->
<?php include get_template_directory() . '/nav/ifooter.php'; ?>
<!--/ footer  -->

<!-- JS here -->
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/popper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/ajax-form.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/waypoints.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.counterup.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scrollIt.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/nice-select.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.slicknav.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/gijgo.min.js"></script>

<!--contact js-->
<script src="<?php echo get_template_directory_uri(); ?>/js/contact.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/mail-script.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>


</body>

</html>

<?php
// Optionally include footer if needed
// get_footer();
?>