<?php

/**
 * Greenhouseculture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Greenhouseculture
 */

if (! function_exists('greenhouseculture_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function greenhouseculture_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Greenhouseculture, use a find and replace
		 * to change 'greenhouseculture' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('greenhouseculture');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'greenhouseculture'),
            'top' => esc_html__('Top Menu', 'greenhouseculture'),
            'footer' => esc_html__('Footer Menu', 'greenhouseculture'),
            'social' => esc_html__('Social Icons', 'greenhouseculture'),
        ));

        /*
		 * Greenhouseculture default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Add support for default block styles.
        add_theme_support('wp-block-styles');

        /*
		 * Add support custom font sizes.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => __('Small', 'greenhouseculture'),
                    'shortName' => __('S', 'greenhouseculture'),
                    'size'      => 16,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => __('Medium', 'greenhouseculture'),
                    'shortName' => __('M', 'greenhouseculture'),
                    'size'      => 20,
                    'slug'      => 'medium',
                ),
                array(
                    'name'      => __('Large', 'greenhouseculture'),
                    'shortName' => __('L', 'greenhouseculture'),
                    'size'      => 25,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => __('Larger', 'greenhouseculture'),
                    'shortName' => __('XL', 'greenhouseculture'),
                    'size'      => 35,
                    'slug'      => 'larger',
                ),
            )
        );

        /**
         * Add theme support for New Image
         *
         * @link https://developer.wordpress.org/reference/functions/add_image_size/
         */

        add_image_size('greenhouseculture-thumbnail-size', 800, 800, true);
        add_image_size('greenhouseculture-related-size', 600, 400, true);
        add_image_size('greenhouseculture-promo-post', 800, 500, true);
        add_image_size('greenhouseculture-related-post-thumbnails', 850, 550, true);


        // Add support for Yoast SEO Breadcrumbs.
        add_theme_support('yoast-seo-breadcrumbs');
    }
endif;
add_action('after_setup_theme', 'greenhouseculture_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function greenhouseculture_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('greenhouseculture_content_width', 640);
}
add_action('after_setup_theme', 'greenhouseculture_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function greenhouseculture_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'greenhouseculture'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Widget Area Below Slider', 'greenhouseculture'),
        'id'            => 'below-slider-area',
        'description'   => esc_html__('You can add Mailchimp widget or other widgets here.', 'greenhouseculture'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Post and Newsletter', 'greenhouseculture'),
        'id'            => 'post-area',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer One', 'greenhouseculture'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Two', 'greenhouseculture'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Three', 'greenhouseculture'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Four', 'greenhouseculture'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Offcanvas', 'greenhouseculture'),
        'id'            => 'offcanvas',
        'description'   => esc_html__('Add widgets here.', 'greenhouseculture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'greenhouseculture_widgets_init');

/**
 * Load TS Core Files
 */
require get_template_directory() . '/templatesell/ts-core-files.php';

/**
 * Greenhouseculture Theme Options - merged from greenhouseculture
 */

if (!function_exists('greenhouseculture_default_theme_options_values')) :

    function greenhouseculture_default_theme_options_values()
    {

        $default_theme_options = array(

            /*Logo Options*/
            'greenhouseculture_logo_width_option' => '700',

            /*Top Header*/
            'greenhouseculture_enable_top_header' => 0,
            'greenhouseculture_enable_top_header_social' => 0,
            'greenhouseculture_enable_top_header_menu' => 0,

            /*Header Options*/
            'greenhouseculture_enable_offcanvas'  => 0,
            'greenhouseculture_enable_search'  => 0,

            /*Colors Options*/
            'greenhouseculture_primary_color'  => '#EF9D87',

            /*Slider Options*/
            'greenhouseculture_enable_slider'      => 0,
            'greenhouseculture-select-category'    => 0,

            /*Boxes Section */
            'greenhouseculture_enable_promo'       => 0,
            'greenhouseculture-promo-select-category' => 0,

            /*Blog Page*/
            'greenhouseculture-sidebar-blog-page' => 'no-sidebar',
            'greenhouseculture-column-blog-page'  => 'masonry-post',
            'greenhouseculture-image-layout' => 'full-image',
            'greenhouseculture-content-show-from' => 'excerpt',
            'greenhouseculture-excerpt-length'    => 25,
            'greenhouseculture-pagination-options' => 'numeric',
            'greenhouseculture-read-more-text'    => '',
            'greenhouseculture-exclude-category' => '',
            'greenhouseculture-show-hide-share'   => 1,
            'greenhouseculture-show-hide-category' => 1,
            'greenhouseculture-show-hide-date' => 1,
            'greenhouseculture-show-hide-author' => 1,
            'greenhouseculture-show-hide-read-time' => 1,
            'greenhouseculture-font-family-url' => 'Muli',

            /*Single Page */
            'greenhouseculture-single-page-featured-image' => 1,
            'greenhouseculture-single-page-related-posts'  => 1,
            'greenhouseculture-single-page-related-posts-title' => esc_html__('You may like', 'greenhouseculture'),
            'greenhouseculture-sidebar-single-page' => 'single-right-sidebar',
            'greenhouseculture-single-social-share' => 1,


            /*Sticky Sidebar*/
            'greenhouseculture-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'greenhouseculture-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2020', 'greenhouseculture'),

            /*Breadcrumb Options*/
            'greenhouseculture-extra-breadcrumb' => 1,
            'greenhouseculture-breadcrumb-selection-option' => 'theme-breadcrumb',

        );
        return apply_filters('greenhouseculture_default_theme_options_values', $default_theme_options);
    }
endif;

/**
 * Google font from greenhouseculture
 */
add_action('wp_enqueue_scripts', 'greenhouseculture_blog_enqueue_scripts', 20);
function greenhouseculture_blog_enqueue_scripts()
{

    /*google font  */
    global $greenhouseculture_theme_options;
    $greenhouseculture_blog_name_font_url   = esc_attr($greenhouseculture_theme_options['greenhouseculture-font-family-url']);

    wp_enqueue_style('greenhouseculture-fonts', '//fonts.googleapis.com/css?family=' . $greenhouseculture_blog_name_font_url);
}

/**
 * Enqueue Style for block pattern.
 */
add_action('enqueue_block_assets', 'greenhouseculture_blog_block_style');
function greenhouseculture_blog_block_style()
{

    /*Block Pattern*/
    if (is_admin()) {
        wp_enqueue_style('greenhouseculture-block-style', get_stylesheet_directory_uri() . '/block-style.css');
    }
}


//sanitize function for font
function greenhouseculture_blog_sanitize_select($input, $setting)
{
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function greenhouseculture_blog_customize_register($wp_customize)
{

    $default = greenhouseculture_default_theme_options_values();

    /*Read time Show hide*/
    $wp_customize->add_setting('greenhouseculture_options[greenhouseculture-show-hide-read-time]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['greenhouseculture-show-hide-read-time'],
        'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
    ));

    $wp_customize->add_control('greenhouseculture_options[greenhouseculture-show-hide-read-time]', array(
        'label' => __('Show Read Time', 'greenhouseculture'),
        'description' => __('Option to hide the read time on the blog page.', 'greenhouseculture'),
        'section' => 'greenhouseculture_blog_page_section',
        'settings' => 'greenhouseculture_options[greenhouseculture-show-hide-read-time]',
        'type' => 'checkbox',
        'priority' => 15,
    ));

    /*Font Family URL*/
    $wp_customize->add_setting('greenhouseculture_options[greenhouseculture-font-family-url]', array(
        'capability'        => 'edit_theme_options',
        'transport' => 'refresh',
        'default'           => $default['greenhouseculture-font-family-url'],
        'sanitize_callback' => 'greenhouseculture_blog_sanitize_select'
    ));
    $choices = greenhouseculture_blog_google_fonts();
    $wp_customize->add_control('greenhouseculture_options[greenhouseculture-font-family-url]', array(
        'label'     => __('URL of Font Family', 'greenhouseculture'),
        'description' => sprintf(
            '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
            __('Select the font here. More options are available', 'greenhouseculture'),
            esc_url('https://greenhouseculture.ie/'),
            __('More options coming soon', 'greenhouseculture'),
            __('', 'greenhouseculture')
        ),
        'choices'   => $choices,
        'section'   => 'greenhouseculture_blog_page_section',
        'settings'  => 'greenhouseculture_options[greenhouseculture-font-family-url]',
        'type'      => 'select',
        'priority'  => 15,
    ));
}
add_action('customize_register', 'greenhouseculture_blog_customize_register', 999);


/* Word read count Pagination */
if (!function_exists('greenhouseculture_blog_read_time')) :
    /**
     * @param $content
     *
     * @return string
     */
    function greenhouseculture_blog_read_time()
    {
        $content = apply_filters('the_content', get_post_field('post_content'));
        $read_words = 200;
        $decode_content = html_entity_decode($content);
        $filter_shortcode = do_shortcode($decode_content);
        $strip_tags = wp_strip_all_tags($filter_shortcode, true);
        $count = str_word_count($strip_tags);
        $word_per_min = (absint($count) / $read_words);
        $word_per_min = ceil($word_per_min);

        if (absint($word_per_min) > 0) {
            $word_count_strings = sprintf(_n('%s Min Reading', '%s Min Reading', number_format_i18n($word_per_min), 'greenhouseculture'), number_format_i18n($word_per_min));
            if ('post' == get_post_type()):
                echo '<span class="min-read">';
                echo esc_html($word_count_strings);
                echo '</span>';
            endif;
        }
    }
endif;



/**
 * Google Fonts
 *
 * @param null
 * @return array
 *
 * @since Greenhouseculture 1.0.0
 *
 */
if (!function_exists('greenhouseculture_blog_google_fonts')) :
    function greenhouseculture_blog_google_fonts()
    {
        $greenhouseculture_blog_google_fonts = array(
            'Muli' => 'Muli',
            'Lato' => 'Lato',
            'Open+Sans' => 'Open Sans',
            'Montserrat' => 'Montserrat',
            'Alegreya:400,400italic,700,900' => 'Alegreya',
            'Alex+Brush' => 'Alex Brush'
        );
        return apply_filters('greenhouseculture_blog_google_fonts', $greenhouseculture_blog_google_fonts);
    }
endif;


/**
 * Enqueue the list of fonts.
 */
function greenhouseculture_blog_customizer_fonts()
{
    wp_enqueue_style('greenhouseculture_blog_customizer_fonts', 'https://fonts.googleapis.com/css?family=Muli|Lato|Open+Sans| Montserrat|Alegreya', array(), null);
}

add_action('customize_controls_print_styles', 'greenhouseculture_blog_customizer_fonts');
add_action('customize_preview_init', 'greenhouseculture_blog_customizer_fonts');

add_action(
    'customize_controls_print_styles',
    function () {
?>
    <style>
        <?php
        $arr = array('Muli', 'Lato', 'Open+Sans', ' Montserrat', 'Alegreya');

        foreach ($arr as $font) {
            $font_family = str_replace("+", " ", $font);
            echo '.customize-control select option[value*="' . $font . '"] {font-family: ' . $font_family . '; font-size: 22px;}';
        }
        ?>
    </style>
<?php
    }
);



if (!function_exists('greenhouseculture_blog_dynamic_css')) :

    function greenhouseculture_blog_dynamic_css()
    {
        global $greenhouseculture_theme_options;
        $greenhouseculture_blog_google_fonts = greenhouseculture_blog_google_fonts();
        $greenhouseculture_font_family = $greenhouseculture_theme_options['greenhouseculture-font-family-url'];
        /* Paragraph Font Options */
        $greenhouseculture_font_body_family = esc_attr($greenhouseculture_blog_google_fonts[$greenhouseculture_font_family]);

        $custom_css = '';
        //Paragraph Font Options
        if (!empty($greenhouseculture_font_body_family)) {
            $custom_css .= "
            body,
            .entry-content p{
                font-family:" . $greenhouseculture_font_body_family . ";
            }";
        }

        wp_add_inline_style('greenhouseculture-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'greenhouseculture_blog_dynamic_css', 99);

/**
 * Load Block Pattern
 */
require get_template_directory() . '/block-pattern.php';

/**
 * Register Events Custom Post Type
 */
function greenhouseculture_register_events_post_type()
{
    register_post_type('event', array(
        'labels' => array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'add_new' => 'Add New Event',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'new_item' => 'New Event',
            'view_item' => 'View Event',
            'search_items' => 'Search Events',
            'not_found' => 'No events found',
            'not_found_in_trash' => 'No events found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_rest' => true
    ));
}
add_action('init', 'greenhouseculture_register_events_post_type');

/**
 * Register Event Categories Taxonomy
 */
function greenhouseculture_register_event_taxonomy()
{
    register_taxonomy('event_category', 'event', array(
        'labels' => array(
            'name' => 'Event Categories',
            'singular_name' => 'Event Category',
            'add_new_item' => 'Add New Event Category',
            'edit_item' => 'Edit Event Category',
            'view_item' => 'View Event Category',
            'search_items' => 'Search Event Categories'
        ),
        'hierarchical' => true,
        'public' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'event-category')
    ));
}
add_action('init', 'greenhouseculture_register_event_taxonomy');

/**
 * Add Event Meta Box
 */
function greenhouseculture_add_event_meta_box()
{
    add_meta_box(
        'event_details',
        'Event Details',
        'greenhouseculture_event_meta_box_callback',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'greenhouseculture_add_event_meta_box');

/**
 * Event Meta Box Callback
 */
function greenhouseculture_event_meta_box_callback($post)
{
    wp_nonce_field('greenhouseculture_save_event_meta', 'event_meta_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);

    echo '<table>';
    echo '<tr><td><label for="event_date">Event Date:</label></td>';
    echo '<td><input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" /></td></tr>';
    echo '<tr><td><label for="event_time">Event Time:</label></td>';
    echo '<td><input type="time" id="event_time" name="event_time" value="' . esc_attr($event_time) . '" /></td></tr>';
    echo '<tr><td><label for="event_location">Location:</label></td>';
    echo '<td><input type="text" id="event_location" name="event_location" value="' . esc_attr($event_location) . '" /></td></tr>';
    echo '</table>';
}

/**
 * Save Event Meta
 */
function greenhouseculture_save_event_meta($post_id)
{
    if (!isset($_POST['event_meta_nonce']) || !wp_verify_nonce($_POST['event_meta_nonce'], 'greenhouseculture_save_event_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }
    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
}
add_action('save_post', 'greenhouseculture_save_event_meta');

/**
 * Add custom query variable for event pagination
 */
function greenhouseculture_add_query_vars($vars)
{
    $vars[] = "page_num";
    return $vars;
}
add_filter("query_vars", "greenhouseculture_add_query_vars");

/**
 * Ensure dashicons are loaded on the frontend
 * so event icons are visible to all visitors.
 */
function greenhouseculture_load_dashicons_frontend()
{
    wp_enqueue_style('dashicons');
}

add_action('wp_enqueue_scripts', 'greenhouseculture_load_dashicons_frontend');
function greenhouseculture_enqueue_ambassadors_styles() {
    if (is_page_template('ambasadors-homepage.php')) {
        wp_enqueue_style(
            'ambassadors-homepage',
            get_template_directory_uri() . '/css/ambassadors-homepage.css',
            array(),
            filemtime(get_template_directory() . '/css/ambassadors-homepage.css')
        );
        wp_enqueue_script(
            'ambassadors-tabs',
            get_template_directory_uri() . '/assets/js/ambassadors-tabs.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/ambassadors-tabs.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'greenhouseculture_enqueue_ambassadors_styles');
