<?php
/*Promo Section Options*/

$wp_customize->add_section( 'greenhouseculture_promo_section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Boxes Below Slider Settings', 'greenhouseculture' ),
    'panel'          => 'greenhouseculture_panel',
) );

/*callback functions slider*/
if ( !function_exists('greenhouseculture_promo_active_callback') ) :
    function greenhouseculture_promo_active_callback(){
        global $greenhouseculture_theme_options;
        $enable_promo = absint($greenhouseculture_theme_options['greenhouseculture_enable_promo']);
        if( 1 == $enable_promo ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*Boxes Enable Option*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_promo]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture_enable_promo'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_promo]', array(
    'label'     => __( 'Enable Boxes', 'greenhouseculture' ),
    'description' => __('Enable and select the category to show the boxes below slider.', 'greenhouseculture'),
    'section'   => 'greenhouseculture_promo_section',
    'settings'  => 'greenhouseculture_options[greenhouseculture_enable_promo]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );

/*Promo Category Selection*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture-promo-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture-promo-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Greenhouseculture_Customize_Category_Dropdown_Control(
        $wp_customize,
        'greenhouseculture_options[greenhouseculture-promo-select-category]',
        array(
            'label'     => __( 'Category For Boxes', 'greenhouseculture' ),
            'description' => __('From the dropdown select the category for the boxes. Category having post will display in below boxes section.', 'greenhouseculture'),
            'section'   => 'greenhouseculture_promo_section',
            'settings'  => 'greenhouseculture_options[greenhouseculture-promo-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 5,
            'active_callback'=>'greenhouseculture_promo_active_callback'
        )
    )
);