<?php
/*
Template Name: Recipe Details
*/
//get_header();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tasty Recipes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/gijgo.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slicknav.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
</head>

<body>
    <!-- header-start -->
    <?php include get_template_directory() . '/nav/iheader.php'; ?>
    <!-- header-end -->

    <!-- search -->
    <?php include get_template_directory() . '/nav/isearch.php'; ?>
    <!-- /end search -->

    <!-- bradcam_area -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
    <!-- /bradcam_area -->

    <div class="recepie_area">
    <div class="container">
        <div class="row">
            <?php
            // Get the recipe ID from the query parameter
            $recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

            if ($recipe_id) {
                // WP Query to get the single recipe
                $args = array(
                    'post_type' => 'recipe',
                    'p' => $recipe_id
                );
                $recipe_query = new WP_Query($args);

                if ($recipe_query->have_posts()) :
                    while ($recipe_query->have_posts()) : $recipe_query->the_post();
                        $recipe_title = get_the_title();
                        $recipe_content = get_the_content();
                        $recipe_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
               ?>
                           <div class="col-12">
                              <div class="single_recepie">
                                 <div class="recepie_thumb">
                                       <?php if ($recipe_thumbnail) : ?>
                                          <img src="<?php echo esc_url($recipe_thumbnail); ?>" alt="<?php echo esc_attr($recipe_title); ?>">
                                       <?php else : ?>
                                          <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="No Image Available">
                                       <?php endif; ?>
                                 </div>
                                 <h1><?php echo esc_html($recipe_title); ?></h1>
                                 <div class="recipe-content">
                                       <?php echo wp_kses_post($recipe_content); ?>
                                 </div>
                              </div>
                           </div>
               <?php
                     endwhile;
                     wp_reset_postdata();
                  else :
                     echo '<p>Recipe not found.</p>';
                  endif;
               } else {
                  echo '<p>Invalid recipe ID.</p>';
               }
               ?>
         </div>
      </div>
   </div>

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
