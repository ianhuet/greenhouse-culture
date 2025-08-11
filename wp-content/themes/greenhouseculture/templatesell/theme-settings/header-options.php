<?php
/*Footer Options*/
$wp_customize->add_section('prefer_header_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Header Settings', 'prefer'),
    'panel' => 'prefer_panel',
));


/*Header Search Enable Option*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_search]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer_enable_search'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_search]', array(
    'label'     => __( 'Enable Search', 'prefer' ),
    'description' => __('It will help to display the search in Menu.', 'prefer'),
    'section'   => 'prefer_header_section',
    'settings'  => 'prefer_options[prefer_enable_search]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );


/*Header Offcanvas Enable Option*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_offcanvas]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer_enable_offcanvas'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_offcanvas]', array(
    'label'     => __( 'Enable Offcanvas Sidebar', 'prefer' ),
    'description' => __('It will help to display the Offcanvas sidebar in Menu.', 'prefer'),
    'section'   => 'prefer_header_section',
    'settings'  => 'prefer_options[prefer_enable_offcanvas]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );