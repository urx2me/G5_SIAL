<?php
/*
Template Name: Add Recipe Page
*/
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    wp_redirect(home_url('/login'));
    exit;
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Recipe</title>
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
                    <h2 class="contact-title">Add Your Recipe</h2>
                </div>
                <div class="col-lg-12">
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form-contact contact_form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="col-12 col-lg-3 col-sm-12 mt-10">
                                <label for="category">Category:</label>
                                <select name="category" id="category" class="form-control form-select" required>
                                    <option disabled selected>Select Category</option>
                                    <?php
                                    $categories = get_terms(array(
                                        'taxonomy'   => 'recipe_category',
                                        'hide_empty' => false, // Change to true if you want to hide empty categories
                                    ));
                                    foreach ($categories as $category) {
                                        echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="tags">Tags:</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags (comma separated)" required>
                            </div>
                            <div class="col-lg-4 pl-0 col-sm-4 mb-2">
                                <label for="energy">Energy (kcal):</label>
                                <input type="number" name="energy" id="energy" class="form-control" placeholder="Energy" step="0.1" required>
                            </div>
                            <div class="col-lg-4 col-sm-4 mb-2">
                                <label for="carbohydrate">Carbohydrate (g):</label>
                                <input type="number" name="carbohydrate" id="carbohydrate" class="form-control" placeholder="Carbohydrate" step="0.1" required>
                            </div>
                            <div class="col-lg-4 pr-0 col-sm-4 mb-2">
                                <label for="protein">Protein (g):</label>
                                <input type="number" name="protein" id="protein" class="form-control" placeholder="Protein" step="0.1" required>
                            </div>
                            <div class="col-12 mb-2" style="height: fit-content;">
                                <label for="method">Method:</label>
                                <textarea name="method" class="form-control" id="method" cols="20" rows="10" placeholder="Method" required></textarea>
                            </div>
                            <div class="col-12 mb-2" style="height: fit-content;">
                                <label for="ingredients">Ingredients:</label>
                                <textarea name="ingredients" class="form-control" id="ingredients" cols="20" rows="10" placeholder="Ingredients" required></textarea>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="tips">Tips:</label>
                                <textarea name="tips" class="form-control" id="tips" cols="20" rows="10" placeholder="Tips" required></textarea>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="thumbnail_recipe">Thumbnail Recipe:</label>
                                <input type="file" name="thumbnail_recipe" id="thumbnail_recipe" class="form-control" accept="image/png, image/jpg, image/jpeg" required>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="add_recipe">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button class="button button-contactForm btn_4 boxed-btn" type="submit">Add New Recipe</button>
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
<?php get_footer(); ?>
