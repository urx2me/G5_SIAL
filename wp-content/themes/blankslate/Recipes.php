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

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <?php include get_template_directory() . '/css.php'; ?>
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
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
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_6.png" alt=""></a>
                        </div>
                        <h3><a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">Egg Manchurian</a></h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_2.png" alt=""></a>
                        </div>
                        <h3>Egg Manchurian</h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_1.png" alt=""></a>
                        </div>
                        <h3>Egg Manchurian</h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_3.png" alt=""></a>
                        </div>
                        <h3>Egg Manchurian</h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_4.png" alt=""></a>
                        </div>
                        <h3>Egg Manchurian</h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <a href="<?php echo get_template_directory_uri(); ?>/recipes_details.html">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_5.png" alt=""></a>
                        </div>
                        <h3>Egg Manchurian</h3>
                        <p>

                            Published: 10-Jan-2023
                        </p>
                        <!-- <a href="recipes_details.html" class="line_btn">View Full Recipe</a> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /recepie_area_start  -->
    <div class="pagination justify-content-center">
        <a class="next page-numbers" href="">Previous </a>
        <span aria-current="page" class="page-numbers current">1</span>
        <a class="page-numbers" href="">2</a>
        <a class="next page-numbers" href="">Next </a>
    </div>




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