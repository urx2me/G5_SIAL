<?php
/*
<<<<<<< Updated upstream
Template Name: Register Page
*/
get_header();
=======
Template Name: Registration Page
*/
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_pass = wp_hash_password($password);
    $user_email = $email;
    $user_login = $username;
    $user_nicename = sanitize_user($username);
    $display_name = $username;

    $user = get_user_by('login', $username);
    if ($user) {
        echo '<script>alert("Username already exists")</script>';
    } else {
        $user_id = wp_insert_user(array(
            'user_login' => $user_login,
            'user_pass' => $user_pass,
            'user_nicename' => $user_nicename,
            'user_email' => $user_email,
            'display_name' => $display_name,
            'role' => 'subscriber'
        ));

        if (!is_wp_error($user_id)) {
            $upload_dir = wp_upload_dir();
            $profileImage = $_FILES['userProfileImage'];
            $profileImageName = $user_id . '_' . $profileImage['name'];
            move_uploaded_file($profileImage['tmp_name'], $upload_dir['path'] . '/' . $profileImageName);
            update_user_meta($user_id, 'profile_image', $upload_dir['url'] . '/' . $profileImageName);
            wp_redirect(site_url() . '/login/');
            exit;
        }
    }
}

//get_header();
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
    <?php include get_template_directory() . '/css.php'; ?>
=======
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
>>>>>>> Stashed changes
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
<<<<<<< Updated upstream
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo d-flex mr-3 align-center">
                                <a href="index.html">
                                   <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo" height="50">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu white_text  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="Recipes.html">Recipes</a></li>

                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="search_icon" style="cursor: pointer"
                                onclick='$(".search").css("display", "grid")'>
                                <a href="" disabled style="pointer-events: none;">
                                    <i class="ti-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none">
                                <div class="search_icon" style="cursor: pointer"
                                    onclick='$(".search").css("display", "grid")'>
                                    <a href="" disabled="" style="pointer-events: none;">
                                        <i class="ti-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->


    <div class="search">
        <div class="my-container" style="position: relative;">
            <p style="font-size: 40px; position: absolute; top: -80px; right: 0px; color: white; cursor: pointer;"
                onclick='$(".search").hide()'>X</p>
            <form action="" method="get" class="form-contact contact_form">
                <div class="search-box d-flex">
                    <input type="search" name="search" id="" class="form-control col-8">
                    <button class="button button-contactForm btn_4 boxed-btn col-4" type="submit">Search</button>
                </div>
            </form>
            <div class="search-result mt-10">
                <a href="recipes_details.html" class="result">
                    <div class="d-flex">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/recepie/recpie_1.png" alt=""
                            style="height: 50px; width: 50px; object-fit: cover; margin-right: 10px;">
                        <div class="content">
                            <h4>Fish &amp; Potato Pie</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Register</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
=======
    <?php include get_template_directory() . '/nav/iheader.php'; ?>
    <!-- header-end -->

    <!-- search  -->
    <?php include get_template_directory() . '/nav/isearch.php'; ?>
    <!-- /search  -->


    <!-- bradcam_area  -->
    <?php include get_template_directory() . '/nav/ibradcam.php'; ?>
>>>>>>> Stashed changes
    <!-- /bradcam_area  -->

    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Create an account</h2>
                </div>
                <div class="col-lg-12">
<<<<<<< Updated upstream
                    <!-- <form class="form-contact contact_form"  method="post" id="contactForm" > -->
                    <form action="" class="form-contact contact_form" method="post">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="userProfileImage">Profile Image:</label>
                                <input type="file" name="userProfileImage" id="userProfileImage" class="form-control"
                                    required="">
                            </div>
                            <div class="col-12 text-center mt-10">
                                <button class="button button-contactForm btn_4 boxed-btn" type="submit">Add New
                                    User</button>
=======
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                            </div>
                            <div class="col-12 mb-2">
                                <label for="userProfileImage">Profile Image:</label>
                                <input type="file" name="userProfileImage" id="userProfileImage" class="form-control" required="">
                            </div>
                            <div class="col-12 text-center mt-10">
                                <button class="button button-contactForm btn_4 boxed-btn" type="submit" name="submit">Add New User</button>
>>>>>>> Stashed changes
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<<<<<<< Updated upstream


    <!-- footer  -->
    <footer class="footer">

        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row align-items-center">
                    <div class="col-xl-8 col-md-8">
                        <p class="copy_right">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            2023 All rights reserved | This
                            template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="ti-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ti-twitter-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-behance"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer  -->

    <!-- JS here -->
    <?php include get_template_directory() . '/js.php'; ?>
</body>

</html>
<?php
get_footer();
?>
=======
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
<?php get_footer(); ?>
>>>>>>> Stashed changes
