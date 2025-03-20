<?php
function assessment_enqueue_styles() {
    wp_enqueue_style('twentytwentyfive-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('assessment-child-style', get_stylesheet_directory_uri() . '/style.css', array('twentytwentyfive-parent-style'), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'assessment_enqueue_styles');

/* For custom logo on wp login */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png'); 
            width: 300px; /* Adjust as needed */
            height: 100px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 10px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url() {
    return home_url(); 
}
add_filter('login_headerurl', 'my_login_logo_url');

/*  Enque JS file */
function custom_enqueue_scripts() {
    wp_enqueue_script('jquery');
	wp_enqueue_script(
        'custom-ajax-script',
        get_stylesheet_directory_uri() . '/assets/js/my-ajax.js', 
        array('jquery'),
        null,
        true
    );

    wp_localize_script('custom-ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

/** Ajax Handler */
function fetch_demo_api_data() {
    $api_url = QUOTES_API; // Get only 6 posts

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        wp_send_json_error('Failed to retrieve data.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    wp_send_json_success($data);
}
add_action('wp_ajax_fetch_demo_api_data', 'fetch_demo_api_data');
add_action('wp_ajax_nopriv_fetch_demo_api_data', 'fetch_demo_api_data'); 

/** Regsiter Shortcode **/
function product_grid_shortcode() {
    // Fetch product data from API
    $response = wp_remote_get(SHORTCODE_API);
    
    if (is_wp_error($response)) {
        return "Failed to load products.";
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['products'])) {
        return "No products found.";
    }
	$output = '<section class="sect-2 items_section"  style="padding-bottom:5vw;"><div class="section-title text-center" style="margin-bottom:2vw;"><h2>WordPress Short Code</h2><div class="line"></div><p>Implemented a WordPress short code to display API data anywhere on the site</p></div>';
    $output .= '<div class="container mt-4">';
    $output .= '<div class="row row-cols-1 row-cols-md-3 g-4">';

    foreach ($data['products'] as $product) {
        $output .= '<div class="col-lg-3 col-md-6 col">';
        $output .= '<div class="card item-card h-100 text-center">';
        $output .= '<img src="' . esc_url($product['thumbnail']) . '" class="card-img-top" alt="' . esc_attr($product['title']) . '">';
        $output .= '<div class="card-body text-center">';
        $output .= '<h5 class="card-title">' . esc_html($product['title']) . '</h5>';
        $output .= '<p class="card-text">' . esc_html(wp_trim_words($product['description'], 15)) . '</p>';
        $output .= '<p class="fw-bold text-primary">$' . esc_html($product['price']) . '</p>';
        $output .= '<a href="' . esc_url($product['url'] ?? '#') . '" class="btn btn-primary">View Product</a>';
        $output .= '</div>'; 
        $output .= '</div>';
        $output .= '</div>';
    }

    $output .= '</div>'; 
    $output .= '</div>'; 
	$output .= '</section>'; 

    return $output;
}

// Register Shortcode
add_shortcode('assessment_product_grid', 'product_grid_shortcode');

/** Bottom to Top  **/
function add_back_to_top_script() {
    ?>
  
    <script>
    jQuery(document).ready(function($) {
       
        $('body').append('<div id="back-to-top" style="position: fixed; bottom: 20px; right: 20px; display: none; background: #0073aa; color: white; padding: 10px 15px; border-radius: 5px; cursor: pointer; z-index: 1000;"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></div>');

        // Show/hide button on scroll
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        // Scroll to top when clicked
        $('#back-to-top').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 500);
            return false;
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'add_back_to_top_script');


/* Theme Settings */

if (!defined('ABSPATH')) {
    exit;
}

function cts_add_theme_menu() {
    add_menu_page(
        'Theme Settings', 
        'Theme Settings', 
        'manage_options', 
        'custom-theme-settings', 
        'cts_theme_settings_page', 
        'dashicons-admin-customizer', 
        30
    );
}
add_action('admin_menu', 'cts_add_theme_menu');

function cts_register_settings() {
    $settings = ['cts_logo', 'cts_hero_image', 'cts_front_image', 'cts_hero_heading', 'cts_hero_subheading', 'cts_button_url', 'cts_checkbox'];

    foreach ($settings as $setting) {
        register_setting('cts_settings_group', $setting);
    }
}
add_action('admin_init', 'cts_register_settings');

function cts_enqueue_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_custom-theme-settings') return;

    wp_enqueue_media(); 
    wp_enqueue_script('cts-admin-script', get_stylesheet_directory_uri() . '/assets/js/cts-admin.js', ['jquery'], null, true);
}
add_action('admin_enqueue_scripts', 'cts_enqueue_admin_scripts');

function cts_theme_settings_page() { ?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('cts_settings_group'); ?>
            <?php do_settings_sections('cts_settings_group'); ?>

            <!-- Website Logo -->
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <h2>Logo</h2>
            <input type="hidden" id="cts_logo" name="cts_logo" value="<?php echo esc_attr(get_option('cts_logo')); ?>" />
            <button type="button" class="button cts-upload-btn" data-target="cts_logo">Upload</button>
            <button type="button" class="button cts-remove-btn" data-target="cts_logo">Remove</button>
            <br><br>
            <img id="cts_logo_preview" src="<?php echo esc_url(get_option('cts_logo')); ?>" style="max-width:150px; display:<?php echo get_option('cts_logo') ? 'block' : 'none'; ?>;" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Hero Section -->
            <h2>Hero Section Setting</h2>
            <label>Background Hero Image:</label>
            <input type="hidden" id="cts_hero_image" name="cts_hero_image" value="<?php echo esc_attr(get_option('cts_hero_image')); ?>" />
            <button type="button" class="button cts-upload-btn" data-target="cts_hero_image">Upload</button>
            <button type="button" class="button cts-remove-btn" data-target="cts_hero_image">Remove</button>
            <br><br>
            <img id="cts_hero_image_preview" src="<?php echo esc_url(get_option('cts_hero_image')); ?>" style="max-width:300px; display:<?php echo get_option('cts_hero_image') ? 'block' : 'none'; ?>;" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Front Hero Image -->
            <h2>Front Hero Image Setting</h2>
            <input type="hidden" id="cts_front_image" name="cts_front_image" value="<?php echo esc_attr(get_option('cts_front_image')); ?>" />
            <button type="button" class="button cts-upload-btn" data-target="cts_front_image">Upload</button>
            <button type="button" class="button cts-remove-btn" data-target="cts_front_image">Remove</button>
            <br><br>
            <img id="cts_front_image_preview" src="<?php echo esc_url(get_option('cts_front_image')); ?>" style="max-width:300px; display:<?php echo get_option('cts_front_image') ? 'block' : 'none'; ?>;" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Hero Heading -->
            <h2>Heading Setting</h2>
            <input style="width: 650px;" type="text" name="cts_hero_heading" value="<?php echo esc_attr(get_option('cts_hero_heading')); ?>" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Hero Subheading -->
            <h2>Subheading Setting</h2>
            <input style="width: 1480px;" type="text" name="cts_hero_subheading" value="<?php echo esc_attr(get_option('cts_hero_subheading')); ?>" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Button URL -->
            <h2>Call To Action Button URL</h2>
            <input style="width: 390px;" type="text" name="cts_button_url" value="<?php echo esc_attr(get_option('cts_button_url')); ?>" />
			</div>
			<div style="border-bottom:solid 1px #ccc;padding-bottom:20px;">
            <!-- Enable Feature Checkbox -->
            <h2>Set URL Target</h2>
            <input type="checkbox" name="cts_checkbox" value="1" <?php checked(1, get_option('cts_checkbox'), true); ?> />
            <label>Check For Open In New Tab</label>
			</div>

            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>
