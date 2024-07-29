<?php
/*
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
                    <h2 class="contact-title">Create an account</h2>
                </div>
                <div class="col-lg-12">
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
    <?php include get_template_directory() . '/js.php'; ?>
</body>

</html>
<?php get_footer(); ?>
