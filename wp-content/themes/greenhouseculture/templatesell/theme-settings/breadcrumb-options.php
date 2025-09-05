<?php
/*Extra Options*/

        $wp_customize->add_section( 'greenhouseculture_extra_options', array(
            'priority'       => 20,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Breadcrumb Settings', 'greenhouseculture' ),
            'panel'          => 'greenhouseculture_panel',
        ) );



        /*Breadcrumb Enable*/
        $wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture-extra-breadcrumb]', array(
            'capability'        => 'edit_theme_options',
            'transport' => 'refresh',
            'default'           => $default['greenhouseculture-extra-breadcrumb'],
            'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
        ) );

        $wp_customize->add_control( 'greenhouseculture_options[greenhouseculture-extra-breadcrumb]', array(
            'label'     => __( 'Enable Breadcrumb', 'greenhouseculture' ),
            'description' => __( 'Breadcrumb will appear on all pages except home page. More settings will be on the premium version.', 'greenhouseculture' ),
            'section'   => 'greenhouseculture_extra_options',
            'settings'  => 'greenhouseculture_options[greenhouseculture-extra-breadcrumb]',
            'type'      => 'checkbox',
            'priority'  => 15,
        ) );

/*Select the breadcrumb from plugins or themes.*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-breadcrumb-selection-option]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-breadcrumb-selection-option'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-breadcrumb-selection-option]', array(
    'choices' => array(
        'theme-breadcrumb' => __('Theme Breadcrumb', 'greenhouseculture'),
        'yoast-breadcrumb' => __('Yoast SEO Breadcrumb', 'greenhouseculture'),
        'navxt-breadcrumb' => __('NavXT Breadcrumb', 'greenhouseculture'),
    ),
    'label' => __('Select the Breadcrumb', 'greenhouseculture'),
    'description' => __('After enable the breadcrumb, you need to install Yoast SEO, Rank Math or Breadcrumb NavXT plugin for added breadcrumb option.', 'greenhouseculture'),
    'section' => 'greenhouseculture_extra_options',
    'settings' => 'greenhouseculture_options[greenhouseculture-breadcrumb-selection-option]',
    'type' => 'select',
    'priority' => 15,
));