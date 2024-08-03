<?php
/*
Template Name: Recipe Details Page
*/

// Ensure to include the header if needed
// get_header();

// Handle Comment Submission
if (isset($_POST['comment_post_ID'])) {
    $post_id = intval($_POST['comment_post_ID']);
    // Redirect to the same page with the appropriate recipe_id and comments section
    $redirect_url = add_query_arg(array(
        'slug' => get_post_field('post_name', $post_id),
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
                // Retrieve the recipe by slug
                $recipe_slug = isset($_GET['slug']) ? sanitize_text_field($_GET['slug']) : '';

                if ($recipe_slug) :
                    $args = array(
                        'name'        => $recipe_slug,
                        'post_type'    => 'recipe', // Ensure this matches your custom post type if applicable
                        'post_status'  => 'publish',
                        'numberposts'  => 1
                    );
                    $recipe_query = get_posts($args);

                    if (!empty($recipe_query)) :
                        $recipe = $recipe_query[0];
                        setup_postdata($recipe);
                        ?>

                        <div class="single-post">
                            <div class="feature-img">
                                <?php
                                if (has_post_thumbnail($recipe->ID)) :
                                    echo get_the_post_thumbnail($recipe->ID, 'large', array('class' => 'img-fluid'));
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
                                        $categories = get_the_terms($recipe->ID, 'recipe_category');
                                        if ($categories && !is_wp_error($categories)) {
                                            $category_links = array();
                                            foreach ($categories as $category) {
                                                $category_link = esc_url(home_url('/category-page/?category=' . $category->slug));
                                                $category_links[] = '<a href="' . $category_link . '">' . esc_html($category->name) . '</a>';
                                            }
                                            echo implode(', ', $category_links);
                                        } else {
                                            echo 'No category assigned';
                                        }
                                        ?>
                                    </li>

                                    <!-- Display Tags -->
                                    <li>Tags: 
                                        <?php 
                                        $tags = get_the_terms($recipe->ID, 'post_tag');
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
                                        <li>Energy: <?php echo esc_html(get_post_meta($recipe->ID, 'energy', true)); ?> kcal</li>
                                        <li>Carbohydrate: <?php echo esc_html(get_post_meta($recipe->ID, 'carbohydrate', true)); ?> g</li>
                                        <li>Protein: <?php echo esc_html(get_post_meta($recipe->ID, 'protein', true)); ?> g</li>
                                    </ul>
                                </div>
                                <!-- Rating -->
                                <?php
                                    if (function_exists('crp_display_rating')) {
                                        crp_display_rating($recipe->ID);
                                    }
                                ?>
                                <!-- End Rating -->
                                <!-- Display Ingredients -->
                                <h4>Ingredients</h4>
                                <ul>
                                    <?php
                                    $ingredients = get_post_meta($recipe->ID, 'ingredients', true);
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
                                    $methods = get_post_meta($recipe->ID, 'method', true);
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
                                        $tips = get_post_meta($recipe->ID, 'tips', true);
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
                            // Ensure recipe ID is properly retrieved
                            if ($recipe) :
                                $recipe_id = $recipe->ID;

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
                                        $profile_picture = get_user_meta($user_id, 'profile_picture', true);
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
                                                        <p class="comment-form-comment"><label for="comment">Comment <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>
                                                        <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment"></p>
                                                        <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr($recipe_id); ?>">
                                                        <?php comment_id_fields(); ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <p class="no-comments">Comments are closed.</p>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <p>You must be logged in to post a comment.</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <!-- End Comments -->
                    <?php
                    else :
                        echo '<p>Recipe not found.</p>';
                    endif;
                    wp_reset_postdata();
                else :
                    echo '<p>Invalid recipe slug.</p>';
                endif;
                ?>
            </div>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
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
