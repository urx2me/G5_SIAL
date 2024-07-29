<?php
/*
Template Name: Register Page
*/
get_header();
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
    <!-- /bradcam_area  -->

    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Create an account</h2>
                </div>
                <div class="col-lg-12">
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



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