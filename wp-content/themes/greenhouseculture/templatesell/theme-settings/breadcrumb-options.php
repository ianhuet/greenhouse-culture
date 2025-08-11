<?php 
/*Extra Options*/

        $wp_customize->add_section( 'prefer_extra_options', array(
            'priority'       => 20,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Breadcrumb Settings', 'prefer' ),
            'panel'          => 'prefer_panel',
        ) );



        /*Breadcrumb Enable*/
        $wp_customize->add_setting( 'prefer_options[prefer-extra-breadcrumb]', array(
            'capability'        => 'edit_theme_options',
            'transport' => 'refresh',
            'default'           => $default['prefer-extra-breadcrumb'],
            'sanitize_callback' => 'prefer_sanitize_checkbox'
        ) );

        $wp_customize->add_control( 'prefer_options[prefer-extra-breadcrumb]', array(
            'label'     => __( 'Enable Breadcrumb', 'prefer' ),
            'description' => __( 'Breadcrumb will appear on all pages except home page. More settings will be on the premium version.', 'prefer' ),
            'section'   => 'prefer_extra_options',
            'settings'  => 'prefer_options[prefer-extra-breadcrumb]',
            'type'      => 'checkbox',
            'priority'  => 15,
        ) );

/*Select the breadcrumb from plugins or themes.*/
$wp_customize->add_setting('prefer_options[prefer-breadcrumb-selection-option]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-breadcrumb-selection-option'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control('prefer_options[prefer-breadcrumb-selection-option]', array(
    'choices' => array(
        'theme-breadcrumb' => __('Theme Breadcrumb', 'prefer'),
        'yoast-breadcrumb' => __('Yoast SEO Breadcrumb', 'prefer'),
        'navxt-breadcrumb' => __('NavXT Breadcrumb', 'prefer'),    
    ),
    'label' => __('Select the Breadcrumb', 'prefer'),
    'description' => __('After enable the breadcrumb, you need to install Yoast SEO, Rank Math or Breadcrumb NavXT plugin for added breadcrumb option.', 'prefer'),
    'section' => 'prefer_extra_options',
    'settings' => 'prefer_options[prefer-breadcrumb-selection-option]',
    'type' => 'select',
    'priority' => 15,
));