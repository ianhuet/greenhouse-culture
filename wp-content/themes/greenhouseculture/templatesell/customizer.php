<?php
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
            'prefer_enable_offcanvas'  => 1,
            'prefer_enable_search'  => 1,

            /*Colors Options*/
            'prefer_primary_color'  => '#EF9D87',

            /*Slider Options*/
            'prefer_enable_slider'      => 0,
            'prefer-select-category'    => 0,
    
            /*Boxes Section */
            'prefer_enable_promo'       => 0,
            'prefer-promo-select-category'=> 0,
            
            /*Blog Page*/
            'prefer-sidebar-blog-page' => 'right-sidebar',
            'prefer-column-blog-page'  => 'one-column',
            'prefer-blog-image-layout' => 'left-image',
            'prefer-content-show-from' => 'excerpt',
            'prefer-excerpt-length'    => 25,
            'prefer-pagination-options'=> 'numeric',
            'prefer-read-more-text'    => '',
            'prefer-blog-exclude-category'=> '',
            'prefer-show-hide-share'   => 1,
            'prefer-show-hide-category'=> 1,
            'prefer-show-hide-date'=> 1,
            'prefer-show-hide-author'=> 1,

            /*Single Page */
            'prefer-single-page-featured-image' => 1,
            'prefer-single-page-related-posts'  => 1,
            'prefer-single-page-related-posts-title' => esc_html__('You may like','prefer'),
            'prefer-sidebar-single-page'=> 'single-right-sidebar',
            'prefer-single-social-share' => 1,


            /*Sticky Sidebar*/
            'prefer-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'prefer-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2020','prefer'),

            /*Breadcrumb Options*/
            'prefer-extra-breadcrumb' => 1,
            'prefer-breadcrumb-selection-option'=> 'theme-breadcrumb',

        );
return apply_filters( 'prefer_default_theme_options_values', $default_theme_options );
}
endif;
/**
 *  Prefer Theme Options and Settings
 *
 * @since Prefer 1.0.0
 *
 * @param null
 * @return array prefer_get_options_value
 *
 */
if ( !function_exists('prefer_get_options_value') ) :
    function prefer_get_options_value() {
        $prefer_default_theme_options_values = prefer_default_theme_options_values();
        $prefer_get_options_value = get_theme_mod( 'prefer_options');
        if( is_array( $prefer_get_options_value )){
            return array_merge( $prefer_default_theme_options_values, $prefer_get_options_value );
        }
        else{
            return $prefer_default_theme_options_values;
        }
    }
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prefer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
    if ( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial( 'blogname', array(
         'selector'        => '.site-title a',
         'render_callback' => 'prefer_customize_partial_blogname',
     ) );
      $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
         'selector'        => '.site-description',
         'render_callback' => 'prefer_customize_partial_blogdescription',
     ) );
  }
  $default = prefer_default_theme_options_values();

  require get_stylesheet_directory() . '/templatesell/theme-settings/theme-settings.php';

}
add_action( 'customize_register', 'prefer_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function prefer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function prefer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prefer_customize_preview_js() {
	wp_enqueue_script( 'prefer-customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20200412', true );
}
add_action( 'customize_preview_init', 'prefer_customize_preview_js' );

/*
** Customizer Styles
*/
function prefer_panels_css() {
     wp_enqueue_style('prefer-customizer-css', get_stylesheet_directory_uri() . '/css/customizer-style.css', array(), '4.5.0');
}
add_action( 'customize_controls_enqueue_scripts', 'prefer_panels_css' );