<?php
/*Promo Section Options*/

$wp_customize->add_section( 'prefer_promo_section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Boxes Below Slider Settings', 'prefer' ),
    'panel'          => 'prefer_panel',
) );

/*callback functions slider*/
if ( !function_exists('prefer_promo_active_callback') ) :
    function prefer_promo_active_callback(){
        global $prefer_theme_options;
        $enable_promo = absint($prefer_theme_options['prefer_enable_promo']);
        if( 1 == $enable_promo ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*Boxes Enable Option*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_promo]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer_enable_promo'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_promo]', array(
    'label'     => __( 'Enable Boxes', 'prefer' ),
    'description' => __('Enable and select the category to show the boxes below slider.', 'prefer'),
    'section'   => 'prefer_promo_section',
    'settings'  => 'prefer_options[prefer_enable_promo]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );

/*Promo Category Selection*/
$wp_customize->add_setting( 'prefer_options[prefer-promo-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer-promo-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Prefer_Customize_Category_Dropdown_Control(
        $wp_customize,
        'prefer_options[prefer-promo-select-category]',
        array(
            'label'     => __( 'Category For Boxes', 'prefer' ),
            'description' => __('From the dropdown select the category for the boxes. Category having post will display in below boxes section.', 'prefer'),
            'section'   => 'prefer_promo_section',
            'settings'  => 'prefer_options[prefer-promo-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 5,
            'active_callback'=>'prefer_promo_active_callback'
        )
    )
);