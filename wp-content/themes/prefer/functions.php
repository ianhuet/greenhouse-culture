<?php
/**
 * Prefer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Prefer
 */

if ( ! function_exists( 'prefer_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function prefer_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Prefer, use a find and replace
		 * to change 'prefer' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'prefer' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'prefer' ),
			'top' => esc_html__( 'Top Menu', 'prefer' ),
			'footer' => esc_html__( 'Footer Menu', 'prefer' ),
			'social' => esc_html__( 'Social Icons', 'prefer' ),
		) );

		/*
		 * Prefer default core markup for search form, comment form, and comments
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
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
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
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'prefer' ),
					'shortName' => __( 'S', 'prefer' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Medium', 'prefer' ),
					'shortName' => __( 'M', 'prefer' ),
					'size'      => 20,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'prefer' ),
					'shortName' => __( 'L', 'prefer' ),
					'size'      => 25,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Larger', 'prefer' ),
					'shortName' => __( 'XL', 'prefer' ),
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
        
        add_image_size('prefer-thumbnail-size', 800, 800, true); 
        add_image_size('prefer-related-size', 600, 400, true); 
        add_image_size('prefer-promo-post', 800, 500, true); 
        add_image_size('prefer-related-post-thumbnails', 850, 550, true ); 


        // Add support for Yoast SEO Breadcrumbs.
        add_theme_support( 'yoast-seo-breadcrumbs' );
	}
endif;
add_action( 'after_setup_theme', 'prefer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prefer_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'prefer_content_width', 640 );
}
add_action( 'after_setup_theme', 'prefer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prefer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'prefer' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area Below Slider', 'prefer' ),
		'id'            => 'below-slider-area',
		'description'   => esc_html__( 'You can add Mailchimp widget or other widgets here.', 'prefer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Post and Newsletter', 'prefer' ),
		'id'            => 'post-area',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'prefer' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'prefer' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'prefer' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'prefer' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Offcanvas', 'prefer' ),
		'id'            => 'offcanvas',
		'description'   => esc_html__( 'Add widgets here.', 'prefer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'prefer_widgets_init' );

/**
 * Load TS Core Files
 */
require get_template_directory() . '/templatesell/ts-core-files.php';