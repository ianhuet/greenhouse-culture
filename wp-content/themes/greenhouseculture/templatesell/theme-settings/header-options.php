<?php
/*Footer Options*/
$wp_customize->add_section('greenhouseculture_header_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Header Settings', 'greenhouseculture'),
    'panel' => 'greenhouseculture_panel',
));


/*Header Search Enable Option*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_search]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture_enable_search'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_search]', array(
    'label'     => __( 'Enable Search', 'greenhouseculture' ),
    'description' => __('It will help to display the search in Menu.', 'greenhouseculture'),
    'section'   => 'greenhouseculture_header_section',
    'settings'  => 'greenhouseculture_options[greenhouseculture_enable_search]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );


/*Header Offcanvas Enable Option*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_offcanvas]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture_enable_offcanvas'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_offcanvas]', array(
    'label'     => __( 'Enable Offcanvas Sidebar', 'greenhouseculture' ),
    'description' => __('It will help to display the Offcanvas sidebar in Menu.', 'greenhouseculture'),
    'section'   => 'greenhouseculture_header_section',
    'settings'  => 'greenhouseculture_options[greenhouseculture_enable_offcanvas]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );