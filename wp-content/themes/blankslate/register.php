<?php
/*
Template Name: Registration Page
*/
if (isset($_POST['submit'])) {
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    $user = get_user_by('login', $username);
    if ($user) {
        echo '<script>alert("Username already exists")</script>';
    } else {
        $user_id = wp_insert_user(array(
            'user_login' => $username,
            'user_pass' => $password, // WordPress will hash the password
            'user_email' => $email,
            'display_name' => $username,
            'role' => 'contributer'
        ));

        if (!is_wp_error($user_id)) {
            // Handle profile image upload
            $upload_dir = wp_upload_dir();
            if (!empty($_FILES['userProfileImage']['name'])) {
                $profileImage = $_FILES['userProfileImage'];
                $profileImageName = $user_id . '_' . basename($profileImage['name']);
                $upload_path = $upload_dir['path'] . '/' . $profileImageName;
                
                if (move_uploaded_file($profileImage['tmp_name'], $upload_path)) {
                    update_user_meta($user_id, 'profile_picture', $upload_dir['url'] . '/' . $profileImageName);
                } else {
                    echo '<script>alert("Profile image upload failed")</script>';
                }
            }
            wp_redirect(site_url() . '/login/');
            exit;
        } else {
            echo '<script>alert("Registration failed: ' . $user_id->get_error_message() . '")</script>';
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
                                <input type="file" name="userProfileImage" id="userProfileImage" class="form-control">
                            </div>
                            <div class="col-12 text-center mt-10">
                                <button class="button button-contactForm btn_4 boxed-btn" type="submit" name="submit">Register</button>
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
