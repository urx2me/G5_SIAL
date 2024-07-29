<?php
/*
Template Name: Login Page
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
    <!-- /search  -->


    <!-- bradcam_area  -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
    <!-- /bradcam_area  -->

    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Sign in to your account</h2>
                </div>
                <div class="col-lg-12">
                    <!-- <form class="form-contact contact_form"  method="post" id="contactForm" > -->
                    <form action="" class="form-contact contact_form" method="post">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="username" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" required="">
                            </div>
                            <div class="col-12 text-center mt-10">
                                <button class="button button-contactForm btn_4 boxed-btn" type="submit">Login</button>
                                <a href="http://localhost/G5_Case_Study_Project/home">Simulate Login</a> <!--to remove -->
                            </div>
                        </div>
                    </form>
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
get_footer();
?>