<?php
/**
 * Custom theme hooks
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Greenhouseculture
 */
if (!function_exists('greenhouseculture_add_main_header')) :

    /**
     * Add main header.
     *
     * @since 1.0.0
     */
    function greenhouseculture_add_main_header()
    {
        get_template_part('template-parts/sections/header', 'section');
    }
endif;
add_action('greenhouseculture_action_header', 'greenhouseculture_add_main_header', 10);

/**
 * Custom theme hook for slider
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Greenhouseculture
 */
if (!function_exists('greenhouseculture_add_main_slider')) :

    /**
     * Add main slider.
     *
     * @since 1.0.0
     */
    function greenhouseculture_add_main_slider()
    {

        get_template_part('template-parts/sections/slider', 'section');
    }
endif;
add_action('greenhouseculture_action_slider', 'greenhouseculture_add_main_slider', 10);

/**
 * Custom theme hook for promo section
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Greenhouseculture
 */
if (!function_exists('greenhouseculture_boxes_section')) :

    /**
     * Add main slider.
     *
     * @since 1.0.0
     */
    function greenhouseculture_boxes_section()
    {

        get_template_part('template-parts/sections/boxes', 'section');
    }
endif;
add_action('greenhouseculture_action_boxes', 'greenhouseculture_boxes_section', 10);

//only for blog and archive page
if( !function_exists( 'greenhouseculture_blog_sidebar_position_array' ) ) :
    /*
     * Function to get blog categories
     */
    function greenhouseculture_blog_sidebar_position_array() {

        $sidebar_positions = array(
            'right-sidebar'  => esc_url(get_template_directory_uri() . '/assets/images/right-sidebar.png'),
            'left-sidebar' => esc_url(get_template_directory_uri() . '/assets/images/left-sidebar.png'),
            'no-sidebar'  => esc_url(get_template_directory_uri() . '/assets/images/no-sidebar.png'),
            'middle-column'  => esc_url(get_template_directory_uri() . '/assets/images/middle-content.png'),
        );

        return $sidebar_positions;

    }
endif;


//only for single page
if( !function_exists( 'greenhouseculture_sidebar_position_array' ) ) :
    /*
     * Function to get blog categories
     */
    function greenhouseculture_sidebar_position_array() {

        $sidebar_positions = array(
            'single-right-sidebar'  => esc_url(get_template_directory_uri() . '/assets/images/right-sidebar.png'),
            'single-left-sidebar' => esc_url(get_template_directory_uri() . '/assets/images/left-sidebar.png'),
            'single-no-sidebar'  => esc_url(get_template_directory_uri() . '/assets/images/no-sidebar.png'),
            'single-middle-column'  => esc_url(get_template_directory_uri() . '/assets/images/middle-content.png'),
        );

        return $sidebar_positions;

    }
endif;