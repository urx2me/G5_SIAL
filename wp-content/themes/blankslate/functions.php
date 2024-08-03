<?php
if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}
if (!function_exists('wp_generate_attachment_metadata')) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
}
if (!function_exists('media_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/media.php');
}

add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup()
{
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'navigation-widgets'));
    add_theme_support('woocommerce');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'blankslate')));
}

add_action('admin_notices', 'blankslate_notice');
function blankslate_notice()
{
    $user_id = get_current_user_id();
    $admin_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $param = (count($_GET)) ? '&' : '?';
    if (!get_user_meta($user_id, 'blankslate_notice_dismissed_8') && current_user_can('manage_options'))
        echo '<div class="notice notice-info"><p><a href="' . esc_url($admin_url), esc_html($param) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__('Ⓧ', 'blankslate') . '</big></a>' . wp_kses_post(__('<big><strong>📝 Thank you for using BlankSlate!</strong></big>', 'blankslate')) . '<br /><br /><a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" target="_blank">' . esc_html__('Review', 'blankslate') . '</a> <a href="https://github.com/tidythemes/blankslate/issues" class="button-primary" target="_blank">' . esc_html__('Feature Requests & Support', 'blankslate') . '</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">' . esc_html__('Donate', 'blankslate') . '</a></p></div>';
}

add_action('admin_init', 'blankslate_notice_dismissed');
function blankslate_notice_dismissed()
{
    $user_id = get_current_user_id();
    if (isset($_GET['dismiss']))
        add_user_meta($user_id, 'blankslate_notice_dismissed_8', 'true', true);
}

add_action('wp_enqueue_scripts', 'blankslate_enqueue');
function blankslate_enqueue()
{
    wp_enqueue_style('blankslate-style', get_stylesheet_uri());
    
    wp_enqueue_script('jquery');
}

add_action('wp_footer', 'blankslate_footer');
function blankslate_footer()
{
?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (deviceAgent.match(/(Android)/)) {
                $("html").addClass("android");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
<?php
}

add_filter('document_title_separator', 'blankslate_document_title_separator');
function blankslate_document_title_separator($sep)
{
    $sep = esc_html('|');
    return $sep;
}

add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return esc_html('...');
    } else {
        return wp_kses_post($title);
    }
}

function blankslate_schema_type()
{
    $schema = 'https://schema.org/';
    if (is_single()) {
        $type = "Article";
    } elseif (is_author()) {
        $type = 'ProfilePage';
    } elseif (is_search()) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope itemtype="' . esc_url($schema) . esc_attr($type) . '"';
}

add_filter('nav_menu_link_attributes', 'blankslate_schema_url', 10);
function blankslate_schema_url($atts)
{
    $atts['itemprop'] = 'url';
    return $atts;
}

if (!function_exists('blankslate_wp_body_open')) {
    function blankslate_wp_body_open()
    {
        do_action('wp_body_open');
    }
}

add_action('wp_body_open', 'blankslate_skip_link', 5);
function blankslate_skip_link()
{
    echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__('Skip to the content', 'blankslate') . '</a>';
}

add_filter('the_content_more_link', 'blankslate_read_more_link');
function blankslate_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'blankslate'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}

add_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
function blankslate_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'blankslate'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}

add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'blankslate_image_insert_override');
function blankslate_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
}

add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('wp_head', 'blankslate_pingback_header');
function blankslate_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function blankslate_custom_pings($comment)
{
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url(comment_author_link()); ?></li>
<?php
}

add_filter('get_comments_number', 'blankslate_comment_count', 0);
function blankslate_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

// Custom Recipe Submission Handling
add_action('admin_post_add_recipe', 'add_recipe_action');
add_action('admin_post_nopriv_add_recipe', 'add_recipe_action');

// Register Custom Post Type 'recipe'
function create_recipe_post_type() {
    $labels = array(
        'name' => _x('Recipes', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Recipe', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Recipes', 'text_domain'),
        'name_admin_bar' => __('Recipe', 'text_domain'),
        'archives' => __('Recipe Archives', 'text_domain'),
        'attributes' => __('Recipe Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Recipe:', 'text_domain'),
        'all_items' => __('All Recipes', 'text_domain'),
        'add_new_item' => __('Add New Recipe', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Recipe', 'text_domain'),
        'edit_item' => __('Edit Recipe', 'text_domain'),
        'update_item' => __('Update Recipe', 'text_domain'),
        'view_item' => __('View Recipe', 'text_domain'),
        'view_items' => __('View Recipes', 'text_domain'),
        'search_items' => __('Search Recipe', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Featured Image', 'text_domain'),
        'set_featured_image' => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image' => __('Use as featured image', 'text_domain'),
        'insert_into_item' => __('Insert into recipe', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this recipe', 'text_domain'),
        'items_list' => __('Recipes list', 'text_domain'),
        'items_list_navigation' => __('Recipes list navigation', 'text_domain'),
        'filter_items_list' => __('Filter recipes list', 'text_domain'),
    );
    $args = array(
        'label' => __('Recipe', 'text_domain'),
        'description' => __('Recipe Description', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => array('slug' => 'recipe'), // Adjust the slug as needed
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('recipe', $args);
}
add_action('init', 'create_recipe_post_type', 0);

function create_recipe_taxonomy() {
    $labels = array(
        'name'                       => _x('Recipe Categories', 'taxonomy general name', 'text_domain'),
        'singular_name'              => _x('Recipe Category', 'taxonomy singular name', 'text_domain'),
        'search_items'               => __('Search Recipe Categories', 'text_domain'),
        'popular_items'              => __('Popular Recipe Categories', 'text_domain'),
        'all_items'                  => __('All Recipe Categories', 'text_domain'),
        'parent_item'                => __('Parent Recipe Category', 'text_domain'),
        'parent_item_colon'          => __('Parent Recipe Category:', 'text_domain'),
        'edit_item'                  => __('Edit Recipe Category', 'text_domain'),
        'update_item'                => __('Update Recipe Category', 'text_domain'),
        'add_new_item'               => __('Add New Recipe Category', 'text_domain'),
        'new_item_name'              => __('New Recipe Category Name', 'text_domain'),
        'separate_items_with_commas' => __('Separate categories with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove categories', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used categories', 'text_domain'),
        'not_found'                  => __('No categories found.', 'text_domain'),
        'menu_name'                  => __('Recipe Categories', 'text_domain'),
    );
    $args = array(
        'hierarchical'          => true, // Set to true if you want hierarchical taxonomy
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'recipe-category'),
    );
    register_taxonomy('recipe_category', array('recipe'), $args);
}
add_action('init', 'create_recipe_taxonomy', 0);

function add_recipe_action() {
    // Check if the form is submitted
    if (isset($_POST['title'])) {
        // Get the form data
        $title = sanitize_text_field($_POST['title']);
        $category_id = intval($_POST['category']); // Use term ID
        $tags = sanitize_text_field($_POST['tags']);
        $energy = sanitize_text_field($_POST['energy']);
        $carbohydrate = sanitize_text_field($_POST['carbohydrate']);
        $protein = sanitize_text_field($_POST['protein']);
        $method = sanitize_textarea_field($_POST['method']);
        $ingredients = sanitize_textarea_field($_POST['ingredients']);
        $tips = sanitize_textarea_field($_POST['tips']);

        // Create the post array for the new post
        $new_post = array(
            'post_title' => $title,
            'post_type' => 'recipe',
            'post_content' => '', // Keep post content empty if you store method in meta
            'post_status' => 'publish',
            'meta_input' => array(
                'energy' => $energy,
                'carbohydrate' => $carbohydrate,
                'protein' => $protein,
                'ingredients' => $ingredients,
                'tips' => $tips,
                'method' => $method, // Store method in meta
            ),
        );
        

        // Insert the new post into the database
        $post_id = wp_insert_post($new_post);

        // Set the post category
        if (!empty($category_id)) {
            wp_set_post_terms($post_id, array($category_id), 'recipe_category');
        }

       // Set the post tags
        if (!empty($tags)) {
            wp_set_object_terms($post_id, explode(',', $tags), 'post_tag'); // Assuming tags are stored as comma-separated values
        }


        // Upload and attach the thumbnail image
        if (!empty($_FILES['thumbnail_recipe']['name'])) {
            $uploaded_file = $_FILES['thumbnail_recipe'];
            $upload = wp_handle_upload($uploaded_file, array('test_form' => false));

            if (isset($upload['file'])) {
                $file_name_and_location = $upload['file'];
                $file_title_for_media_library = $title;
                $attachment = array(
                    'post_mime_type' => $upload['type'],
                    'post_title' => addslashes($file_title_for_media_library),
                    'post_content' => '',
                    'post_status' => 'inherit',
                    'guid' => $upload['url'],
                );

                $attachment_id = wp_insert_attachment($attachment, $file_name_and_location, $post_id);
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_name_and_location);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
                set_post_thumbnail($post_id, $attachment_id);
            }
        }

        // Redirect after submission
        wp_redirect(home_url('/recipes'));
        exit;
    }
}



function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function enqueue_custom_scripts() {
    wp_enqueue_script('jquery'); // Ensure jQuery is enqueued
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function search_recipes() {
    if (isset($_GET['query'])) {
        $query = sanitize_text_field($_GET['query']);
        
        $args = array(
            'post_type' => 'recipe', // Replace with your custom post type if different
            's' => $query,
            'posts_per_page' => 5 // Limit the number of results
        );
        
        $search_query = new WP_Query($args);
        
        if ($search_query->have_posts()) {
            while ($search_query->have_posts()) {
                $search_query->the_post();
                $recipe_slug = get_post_field('post_name', get_the_ID());
                $recipe_permalink = home_url('/recipe-details/?slug=' . $recipe_slug);
                ?>
                <a href="<?php echo esc_url($recipe_permalink); ?>" class="result">
                    <div class="d-flex">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('thumbnail', array('style' => 'height: 50px; width: 50px; object-fit: cover; margin-right: 10px;')); ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/recepie/default.png'); ?>" alt="recipe" style="height: 50px; width: 50px; object-fit: cover; margin-right: 10px;">
                        <?php endif; ?>
                        <div class="content">
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo '<p>No recipes found.</p>';
        }
        wp_reset_postdata();
    }
    wp_die();
}

add_action('wp_ajax_search_recipes', 'search_recipes');
add_action('wp_ajax_nopriv_search_recipes', 'search_recipes');

function custom_recipe_rewrite_rule() {
    add_rewrite_rule('^recipe-details/?$', 'index.php?pagename=recipe-details', 'top');
    add_rewrite_rule('^recipe-details/([^/]*)/?', 'index.php?pagename=recipe-details&slug=$matches[1]', 'top');
}
add_action('init', 'custom_recipe_rewrite_rule');

?>
