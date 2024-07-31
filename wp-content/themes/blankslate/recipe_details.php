<?php
/*
Template Name: Recipe Details Page
*/

// Ensure to include the header if needed
// get_header();

if (isset($_GET['slug'])) {
    $slug = sanitize_text_field($_GET['slug']);
    $recipe_query = new WP_Query(array(
        'post_type' => 'recipe',
        'name' => $slug,
        'posts_per_page' => 1,
    ));

    if ($recipe_query->have_posts()) {
        while ($recipe_query->have_posts()) : $recipe_query->the_post();

            // Get the recipe details
            $recipe_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $recipe_title = get_the_title();
            $recipe_date = get_the_date('d-M-Y');
            $recipe_category = get_the_terms(get_the_ID(), 'category');
            $recipe_tags = get_the_terms(get_the_ID(), 'post_tag');
            $recipe_energy = get_post_meta(get_the_ID(), 'energy', true);
            $recipe_carbohydrate = get_post_meta(get_the_ID(), 'carbohydrate', true);
            $recipe_protein = get_post_meta(get_the_ID(), 'protein', true);
            $recipe_ingredients = get_post_meta(get_the_ID(), 'ingredients', true);
            $recipe_method = get_the_content();
            $recipe_tips = get_post_meta(get_the_ID(), 'tips', true);
            $recipe_content = get_the_content();

            // Display the recipe details
?>
            <!doctype html>
            <html class="no-js" lang="zxx">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title><?php echo esc_html($recipe_title); ?> - Recipe Details</title>
                <meta name="description" content="">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- CSS here -->
                <?php include get_template_directory() . '/css.php'; ?>
            </head>

            <body>
                <!-- header-start -->
                <?php include get_template_directory() . '/nav/iheader.php'; ?>
                <!-- header-end -->

                <!-- search  -->
                <?php include get_template_directory() . '/nav/isearch.php'; ?>
                <!-- /search  -->

                <!-- bradcam_area  -->
                <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
                <!-- /bradcam_area  -->

                <section class="contact-section section_padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="contact-title"><?php echo esc_html($recipe_title); ?></h2>
                            </div>
                            <div class="col-lg-12 single_recepie_details">
                                <?php if ($recipe_thumbnail) : ?>
                                    <div class="recepie_thumb">
                                        <img src="<?php echo esc_url($recipe_thumbnail); ?>" alt="<?php echo esc_attr($recipe_title); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="recepie_content">
                                    <p>Published on: <?php echo esc_html($recipe_date); ?></p>
                                    <?php if ($recipe_category) : ?>
                                        <p>Category: <?php echo esc_html($recipe_category[0]->name); ?></p>
                                    <?php endif; ?>
                                    <?php if ($recipe_tags) : ?>
                                        <p>Tags: <?php
                                            $tags = array();
                                            foreach ($recipe_tags as $tag) {
                                                $tags[] = $tag->name;
                                            }
                                            echo esc_html(implode(', ', $tags));
                                            ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="nutrition_info">
                                        <h4>Nutrition Information (per serving):</h4>
                                        <ul>
                                            <li>Energy: <?php echo esc_html($recipe_energy); ?> kcal</li>
                                            <li>Carbohydrate: <?php echo esc_html($recipe_carbohydrate); ?> g</li>
                                            <li>Protein: <?php echo esc_html($recipe_protein); ?> g</li>
                                        </ul>
                                    </div>

                                    <div class="ingredients">
                                        <h4>Ingredients:</h4>
                                        <p><?php echo wp_kses_post($recipe_ingredients); ?></p>
                                    </div>

                                    <div class="method">
                                        <h4>Method:</h4>
                                        <p><?php echo wp_kses_post($recipe_method); ?></p>
                                    </div>

                                    <div class="tips">
                                        <h4>Tips:</h4>
                                        <p><?php echo wp_kses_post($recipe_tips); ?></p>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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
        endwhile; // End while loop for recipe query
    } else {
        echo '<p>No recipe found.</p>';
    }
} else {
    echo '<p>No recipe specified.</p>';
}

// Optionally include footer if needed
// get_footer();
?>
