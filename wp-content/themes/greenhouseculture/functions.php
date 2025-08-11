<?php
/**
 * Greenhouse Culture functions and definitions
 * Based on Prefer and Prefer Blog themes
 *
 * @package GreenhouseCulture
 */

if ( ! function_exists( 'greenhouseculture_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function greenhouseculture_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'greenhouseculture' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'greenhouseculture' ),
			'top' => esc_html__( 'Top Menu', 'greenhouseculture' ),
			'footer' => esc_html__( 'Footer Menu', 'greenhouseculture' ),
			'social' => esc_html__( 'Social Icons', 'greenhouseculture' ),
		) );

		/*
		 * Greenhouse Culture default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );

		/*
		 * Add support custom font sizes.
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'greenhouseculture' ),
					'shortName' => __( 'S', 'greenhouseculture' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Medium', 'greenhouseculture' ),
					'shortName' => __( 'M', 'greenhouseculture' ),
					'size'      => 20,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'greenhouseculture' ),
					'shortName' => __( 'L', 'greenhouseculture' ),
					'size'      => 25,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Larger', 'greenhouseculture' ),
					'shortName' => __( 'XL', 'greenhouseculture' ),
					'size'      => 35,
					'slug'      => 'larger',
				),
			)
		);

		/**
         * Add theme support for New Image
         */
        
        add_image_size('greenhouseculture-thumbnail-size', 800, 800, true); 
        add_image_size('greenhouseculture-related-size', 600, 400, true); 
        add_image_size('greenhouseculture-promo-post', 800, 500, true); 
        add_image_size('greenhouseculture-related-post-thumbnails', 850, 550, true ); 


        // Add support for Yoast SEO Breadcrumbs.
        add_theme_support( 'yoast-seo-breadcrumbs' );
	}
endif;
add_action( 'after_setup_theme', 'greenhouseculture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function greenhouseculture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'greenhouseculture_content_width', 640 );
}
add_action( 'after_setup_theme', 'greenhouseculture_content_width', 0 );

/**
 * Register widget area.
 */
function greenhouseculture_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'greenhouseculture' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area Below Slider', 'greenhouseculture' ),
		'id'            => 'below-slider-area',
		'description'   => esc_html__( 'You can add Mailchimp widget or other widgets here.', 'greenhouseculture' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Post and Newsletter', 'greenhouseculture' ),
		'id'            => 'post-area',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'greenhouseculture' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'greenhouseculture' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'greenhouseculture' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'greenhouseculture' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Offcanvas', 'greenhouseculture' ),
		'id'            => 'offcanvas',
		'description'   => esc_html__( 'Add widgets here.', 'greenhouseculture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'greenhouseculture_widgets_init' );

/**
 * Load TS Core Files
 */
require get_stylesheet_directory() . '/templatesell/ts-core-files.php';

/**
 * Theme Default Options
 */
if ( !function_exists('greenhouseculture_default_theme_options_values') ) :

    function greenhouseculture_default_theme_options_values() {

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
            'prefer-single-page-related-posts-title' => esc_html__('You may like','greenhouseculture'),
            'prefer-sidebar-single-page'=> 'single-right-sidebar',
            'prefer-single-social-share' => 1,


            /*Sticky Sidebar*/
            'prefer-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'prefer-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2024','greenhouseculture'),

            /*Breadcrumb Options*/
            'prefer-extra-breadcrumb' => 1,
            'prefer-breadcrumb-selection-option'=> 'theme-breadcrumb',

        );
return apply_filters( 'greenhouseculture_default_theme_options_values', $default_theme_options );
}
endif;

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'greenhouseculture_enqueue_scripts');
function greenhouseculture_enqueue_scripts() {

    /*google font  */
    global $prefer_theme_options;
    $greenhouseculture_name_font_url   = esc_attr( $prefer_theme_options['prefer-font-family-url'] );  

    wp_enqueue_style( 'greenhouseculture-fonts', '//fonts.googleapis.com/css?family='.$greenhouseculture_name_font_url );

    wp_enqueue_style( 'greenhouseculture-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

/**
 * Enqueue Style for block pattern.
 */
add_action( 'enqueue_block_assets', 'greenhouseculture_block_style');
function greenhouseculture_block_style() {

    /*Block Pattern*/
    if (is_admin()) {
        wp_enqueue_style( 'greenhouseculture-block-style', get_stylesheet_directory_uri() . '/block-style.css');
    }
}


//sanitize function for font
function greenhouseculture_sanitize_select( $input, $setting ) {
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function greenhouseculture_customize_register( $wp_customize ) {

   $default = greenhouseculture_default_theme_options_values();

    /*Read time Show hide*/
    $wp_customize->add_setting('prefer_options[prefer-show-hide-read-time]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['prefer-show-hide-read-time'],
        'sanitize_callback' => 'prefer_sanitize_checkbox'
    ));

    $wp_customize->add_control('prefer_options[prefer-show-hide-read-time]', array(
        'label' => __('Show Read Time', 'greenhouseculture'),
        'description' => __('Option to hide the read time on the blog page.', 'greenhouseculture'),
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
            'sanitize_callback' => 'greenhouseculture_sanitize_select'
        ) );
        $choices = greenhouseculture_google_fonts();
        $wp_customize->add_control( 'prefer_options[prefer-font-family-url]', array(
            'label'     => __( 'URL of Font Family', 'greenhouseculture' ),
            'description' => __( 'Select the font here.', 'greenhouseculture' ),
            'choices'   => $choices,
            'section'   => 'prefer_blog_page_section',
            'settings'  => 'prefer_options[prefer-font-family-url]',
            'type'      => 'select',
            'priority'  => 15,
        ) );

}
add_action( 'customize_register', 'greenhouseculture_customize_register', 999 );


/* Word read count Pagination */
if (!function_exists('greenhouseculture_read_time')) :
    /**
     * @param $content
     *
     * @return string
     */
    function greenhouseculture_read_time()
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
 */
if (!function_exists('greenhouseculture_google_fonts')) :
    function greenhouseculture_google_fonts()
    {
        $greenhouseculture_google_fonts = array(
            'Muli' => 'Muli',
            'Lato' => 'Lato',
            'Open+Sans' => 'Open Sans',
            'Montserrat' => 'Montserrat',
            'Alegreya:400,400italic,700,900' => 'Alegreya',
            'Alex+Brush' => 'Alex Brush'
        );
        return apply_filters('greenhouseculture_google_fonts', $greenhouseculture_google_fonts);
    }
endif;


/**
 * Enqueue the list of fonts.
 */
function greenhouseculture_customizer_fonts()
{
    wp_enqueue_style('greenhouseculture_customizer_fonts', 'https://fonts.googleapis.com/css?family=Muli|Lato|Open+Sans| Montserrat|Alegreya', array(), null);
}

add_action('customize_controls_print_styles', 'greenhouseculture_customizer_fonts');
add_action('customize_preview_init', 'greenhouseculture_customizer_fonts');

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



if (!function_exists('greenhouseculture_dynamic_css')) :

    function greenhouseculture_dynamic_css()
    {
        global $prefer_theme_options;
        $greenhouseculture_google_fonts = greenhouseculture_google_fonts(); 
        $prefer_font_family = $prefer_theme_options['prefer-font-family-url'];       
        /* Paragraph Font Options */
        $prefer_font_body_family = esc_attr($greenhouseculture_google_fonts[$prefer_font_family] );

        $custom_css = '';
        //Paragraph Font Options 
        if (!empty($prefer_font_body_family)) {
            $custom_css .= "
            body,
            .entry-content p{ 
                font-family:".$prefer_font_body_family."; 
            }";
        }

        wp_add_inline_style('greenhouseculture-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'greenhouseculture_dynamic_css', 99);

/**
 * Load Block Pattern
 */
require get_stylesheet_directory() . '/block-pattern.php';