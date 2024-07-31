<?php
/*
Template Name: Recipes Page
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

    <!-- CSS here -->
    <?php include get_template_directory() . '/css.php'; ?>
    <style>
        .single_recepie .recepie_thumb img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

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
    <div class="recepie_area plus_padding">
        <div class="container">
            <div class="row">
                <?php
                // WP Query to get all recipes
                $args = array(
                    'post_type' => 'recipe',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $recipe_query = new WP_Query($args);

                if ($recipe_query->have_posts()) :
                    while ($recipe_query->have_posts()) : $recipe_query->the_post();
                        $recipe_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        $recipe_title = get_the_title();
                        $recipe_permalink = get_permalink();
                        $recipe_date = get_the_date('d-M-Y');
                ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single_recepie text-center">
                                <div class="recepie_thumb">
                                    <?php if ($recipe_thumbnail) : ?>
                                        <a href="<?php echo esc_url($recipe_permalink); ?>">
                                            <img src="<?php echo esc_url($recipe_thumbnail); ?>" alt="<?php echo esc_attr($recipe_title); ?>"></a>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url($recipe_permalink); ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="No Image Available"></a>
                                    <?php endif; ?>
                                </div>
                                <h3><a href="<?php echo esc_url($recipe_permalink); ?>"><?php echo esc_html($recipe_title); ?></a></h3>
                                <p>
                                    Published: <?php echo esc_html($recipe_date); ?>
                                </p>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No recipes found.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
    <!-- /recepie_area_start  -->

    <!-- pagination -->
    <div class="pagination justify-content-center">
        <?php
        // Pagination code
        echo paginate_links(array(
            'total' => $recipe_query->max_num_pages
        ));
        ?>
    </div>
    <!-- /pagination -->

    <!-- footer  -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
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
get_footer();
?>
