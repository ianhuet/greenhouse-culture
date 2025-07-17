<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */
/**
 * Loads the child theme textdomain.
 */
function prefer_blog_load_language() {
    load_child_theme_textdomain( 'prefer-blog' );
}
add_action( 'after_setup_theme', 'prefer_blog_load_language' );

/**
 * Prefer Theme Customizer
 *
 * @package Prefer
 */

if ( !function_exists('prefer_default_theme_options_values') ) :

    function prefer_default_theme_options_values() {

        $default_theme_options = array(

            /*Logo Options*/
            'prefer_logo_width_option' => '700',

            /*Top Header*/
            'prefer_enable_top_header'=> 0, 
            'prefer_enable_top_header_social'=> 0,
            'prefer_enable_top_header_menu'=> 0,

           /*Header Options*/
            'prefer_enable_offcanvas'  => 0,
            'prefer_enable_search'  => 0,

            /*Colors Options*/
            'prefer_primary_color'  => '#EF9D87',

            /*Slider Options*/
            'prefer_enable_slider'      => 0,
            'prefer-select-category'    => 0,
    
            /*Boxes Section */
            'prefer_enable_promo'       => 0,
            'prefer-promo-select-category'=> 0,
            
            /*Blog Page*/
            'prefer-sidebar-blog-page' => 'no-sidebar',
            'prefer-column-blog-page'  => 'masonry-post',
            'prefer-blog-image-layout' => 'full-image',
            'prefer-content-show-from' => 'excerpt',
            'prefer-excerpt-length'    => 25,
            'prefer-pagination-options'=> 'numeric',
            'prefer-read-more-text'    => '',
            'prefer-blog-exclude-category'=> '',
            'prefer-show-hide-share'   => 1,
            'prefer-show-hide-category'=> 1,
            'prefer-show-hide-date'=> 1,
            'prefer-show-hide-author'=> 1,
            'prefer-show-hide-read-time'=> 1,
            'prefer-font-family-url'=>'Muli',

            /*Single Page */
            'prefer-single-page-featured-image' => 1,
            'prefer-single-page-related-posts'  => 1,
            'prefer-single-page-related-posts-title' => esc_html__('You may like','prefer-blog'),
            'prefer-sidebar-single-page'=> 'single-right-sidebar',
            'prefer-single-social-share' => 1,


            /*Sticky Sidebar*/
            'prefer-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'prefer-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2020','prefer-blog'),

            /*Breadcrumb Options*/
            'prefer-extra-breadcrumb' => 1,
            'prefer-breadcrumb-selection-option'=> 'theme-breadcrumb',

        );
return apply_filters( 'prefer_default_theme_options_values', $default_theme_options );
}
endif;

/**
 * Enqueue Style for child theme.
 */
add_action( 'wp_enqueue_scripts', 'prefer_blog_enqueue_scripts');
function prefer_blog_enqueue_scripts() {

        /*google font  */
    global $prefer_theme_options;
    $prefer_blog_name_font_url   = esc_attr( $prefer_theme_options['prefer-font-family-url'] );  

    wp_enqueue_style( 'prefer-blog-fonts', '//fonts.googleapis.com/css?family='.$prefer_blog_name_font_url );

    $parent_style = 'prefer-style-child';
    $prefer_blog_version = wp_get_theme(get_template())->get( 'Version' );

    wp_enqueue_style('prefer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'prefer-blog-style', get_stylesheet_directory_uri() . '/style.css', array(), $prefer_blog_version );
}

/**
 * Enqueue Style for block pattern.
 */
add_action( 'enqueue_block_assets', 'prefer_blog_block_style');
function prefer_blog_block_style() {

    /*Block Pattern*/
    if (is_admin()) {
        wp_enqueue_style( 'prefer-blog-block-style', get_stylesheet_directory_uri() . '/block-style.css');
    }
}


//sanitize function for font
function prefer_blog_sanitize_select( $input, $setting ) {
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prefer_blog_customize_register( $wp_customize ) {

   $default = prefer_default_theme_options_values();

    /*Read time Show hide*/
    $wp_customize->add_setting('prefer_options[prefer-show-hide-read-time]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['prefer-show-hide-read-time'],
        'sanitize_callback' => 'prefer_sanitize_checkbox'
    ));

    $wp_customize->add_control('prefer_options[prefer-show-hide-read-time]', array(
        'label' => __('Show Read Time', 'prefer-blog'),
        'description' => __('Option to hide the read time on the blog page.', 'prefer-blog'),
        'section' => 'prefer_blog_page_section',
        'settings' => 'prefer_options[prefer-show-hide-read-time]',
        'type' => 'checkbox',
        'priority' => 15,
    ));

    /*Font Family URL*/
        $wp_customize->add_setting( 'prefer_options[prefer-font-family-url]', array(
            'capability'        => 'edit_theme_options',
            'transport' => 'refresh',
            'default'           => $default['prefer-font-family-url'],
            'sanitize_callback' => 'prefer_blog_sanitize_select'
        ) );
        $choices = prefer_blog_google_fonts();
        $wp_customize->add_control( 'prefer_options[prefer-font-family-url]', array(
            'label'     => __( 'URL of Font Family', 'prefer-blog' ),
            'description' => sprintf('%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
                        __( 'Select the font here. More options are available', 'prefer-blog' ),
                        esc_url('https://www.templatesell.com/item/prefer-plus'),
                        __('in the premium version Prefer Plus' , 'prefer-blog'),
                        __('check now.' ,'prefer-blog')
            ),
            'choices'   => $choices,
            'section'   => 'prefer_blog_page_section',
            'settings'  => 'prefer_options[prefer-font-family-url]',
            'type'      => 'select',
            'priority'  => 15,
        ) );

}
add_action( 'customize_register', 'prefer_blog_customize_register', 999 );


/* Word read count Pagination */
if (!function_exists('prefer_blog_read_time')) :
    /**
     * @param $content
     *
     * @return string
     */
    function prefer_blog_read_time()
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
            $word_count_strings = sprintf(_n('%s Min Reading', '%s Min Reading', number_format_i18n($word_per_min), 'prefer-blog'), number_format_i18n($word_per_min));
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
 * @since Prefer 1.0.0
 *
 */
if (!function_exists('prefer_blog_google_fonts')) :
    function prefer_blog_google_fonts()
    {
        $prefer_blog_google_fonts = array(
            'Muli' => 'Muli',
            'Lato' => 'Lato',
            'Open+Sans' => 'Open Sans',
            'Montserrat' => 'Montserrat',
            'Alegreya:400,400italic,700,900' => 'Alegreya',
            'Alex+Brush' => 'Alex Brush'
        );
        return apply_filters('prefer_blog_google_fonts', $prefer_blog_google_fonts);
    }
endif;


/**
 * Enqueue the list of fonts.
 */
function prefer_blog_customizer_fonts()
{
    wp_enqueue_style('prefer_blog_customizer_fonts', 'https://fonts.googleapis.com/css?family=Muli|Lato|Open+Sans| Montserrat|Alegreya', array(), null);
}

add_action('customize_controls_print_styles', 'prefer_blog_customizer_fonts');
add_action('customize_preview_init', 'prefer_blog_customizer_fonts');

add_action(
    'customize_controls_print_styles',
    function (){
        ?>
        <style>
            <?php
            $arr = array( 'Muli','Lato','Open+Sans',' Montserrat','Alegreya');

            foreach ( $arr as $font ) {
                $font_family = str_replace("+", " ", $font);
                echo '.customize-control select option[value*="' . $font . '"] {font-family: ' . $font_family . '; font-size: 22px;}';
            }
            ?>
        </style>
        <?php
    }
);



if (!function_exists('prefer_blog_dynamic_css')) :

    function prefer_blog_dynamic_css()
    {
        global $prefer_theme_options;
        $prefer_blog_google_fonts = prefer_blog_google_fonts(); 
        $prefer_font_family = $prefer_theme_options['prefer-font-family-url'];       
        /* Paragraph Font Options */
        $prefer_font_body_family = esc_attr($prefer_blog_google_fonts[$prefer_font_family] );

        $custom_css = '';
        //Paragraph Font Options 
        if (!empty($prefer_font_body_family)) {
            $custom_css .= "
            body,
            .entry-content p{ 
                font-family:".$prefer_font_body_family."; 
            }";
        }

        wp_add_inline_style('prefer-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'prefer_blog_dynamic_css', 99);

/**
 * Load Block Pattern
 */
require get_stylesheet_directory() . '/block-pattern.php';