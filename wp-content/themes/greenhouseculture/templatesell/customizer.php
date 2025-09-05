<?php
/**
 * Greenhouseculture Theme Customizer
 *
 * @package Greenhouseculture
 */

if ( !function_exists('greenhouseculture_default_theme_options_values') ) :

    function greenhouseculture_default_theme_options_values() {

        $default_theme_options = array(

            /*Logo Options*/
            'greenhouseculture_logo_width_option' => '700',

            /*Top Header*/
            'greenhouseculture_enable_top_header'=> 0,
            'greenhouseculture_enable_top_header_social'=> 0,
            'greenhouseculture_enable_top_header_menu'=> 0,

           /*Header Options*/
            'greenhouseculture_enable_offcanvas'  => 1,
            'greenhouseculture_enable_search'  => 1,

            /*Colors Options*/
            'greenhouseculture_primary_color'  => '#EF9D87',

            /*Slider Options*/
            'greenhouseculture_enable_slider'      => 0,
            'greenhouseculture-select-category'    => 0,

            /*Boxes Section */
            'greenhouseculture_enable_promo'       => 0,
            'greenhouseculture-promo-select-category'=> 0,

            /*Blog Page*/
            'greenhouseculture-sidebar-blog-page' => 'right-sidebar',
            'greenhouseculture-column-blog-page'  => 'one-column',
            'greenhouseculture-image-layout' => 'left-image',
            'greenhouseculture-content-show-from' => 'excerpt',
            'greenhouseculture-excerpt-length'    => 25,
            'greenhouseculture-pagination-options'=> 'numeric',
            'greenhouseculture-read-more-text'    => '',
            'greenhouseculture-exclude-category'=> '',
            'greenhouseculture-show-hide-share'   => 1,
            'greenhouseculture-show-hide-category'=> 1,
            'greenhouseculture-show-hide-date'=> 1,
            'greenhouseculture-show-hide-author'=> 1,

            /*Single Page */
            'greenhouseculture-single-page-featured-image' => 1,
            'greenhouseculture-single-page-related-posts'  => 1,
            'greenhouseculture-single-page-related-posts-title' => esc_html__('You may like','greenhouseculture'),
            'greenhouseculture-sidebar-single-page'=> 'single-right-sidebar',
            'greenhouseculture-single-social-share' => 1,


            /*Sticky Sidebar*/
            'greenhouseculture-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'greenhouseculture-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2020','greenhouseculture'),

            /*Breadcrumb Options*/
            'greenhouseculture-extra-breadcrumb' => 1,
            'greenhouseculture-breadcrumb-selection-option'=> 'theme-breadcrumb',

        );
return apply_filters( 'greenhouseculture_default_theme_options_values', $default_theme_options );
}
endif;
/**
 *  Greenhouseculture Theme Options and Settings
 *
 * @since Greenhouseculture 1.0.0
 *
 * @param null
 * @return array greenhouseculture_get_options_value
 *
 */
if ( !function_exists('greenhouseculture_get_options_value') ) :
    function greenhouseculture_get_options_value() {
        $greenhouseculture_default_theme_options_values = greenhouseculture_default_theme_options_values();
        $greenhouseculture_get_options_value = get_theme_mod( 'greenhouseculture_options');
        if( is_array( $greenhouseculture_get_options_value )){
            return array_merge( $greenhouseculture_default_theme_options_values, $greenhouseculture_get_options_value );
        }
        else{
            return $greenhouseculture_default_theme_options_values;
        }
    }
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function greenhouseculture_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial( 'blogname', array(
         'selector'        => '.site-title a',
         'render_callback' => 'greenhouseculture_customize_partial_blogname',
     ) );
      $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
         'selector'        => '.site-description',
         'render_callback' => 'greenhouseculture_customize_partial_blogdescription',
     ) );
  }
  $default = greenhouseculture_default_theme_options_values();

  require get_template_directory() . '/templatesell/theme-settings/theme-settings.php';

}
add_action( 'customize_register', 'greenhouseculture_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function greenhouseculture_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function greenhouseculture_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function greenhouseculture_customize_preview_js() {
	wp_enqueue_script( 'greenhouseculture-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20200412', true );
}
add_action( 'customize_preview_init', 'greenhouseculture_customize_preview_js' );

/*
** Customizer Styles
*/
function greenhouseculture_panels_css() {
     wp_enqueue_style('greenhouseculture-customizer-css', get_template_directory_uri() . '/css/customizer-style.css', array(), '4.5.0');
}
add_action( 'customize_controls_enqueue_scripts', 'greenhouseculture_panels_css' );