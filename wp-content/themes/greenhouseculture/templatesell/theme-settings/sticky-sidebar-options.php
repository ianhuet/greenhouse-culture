<?php 
/*Sticky Sidebar*/
$wp_customize->add_section( 'greenhouseculture_sticky_sidebar', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sticky Sidebar Settings', 'greenhouseculture' ),
   'panel' 		 => 'greenhouseculture_panel',
) );

/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture-enable-sticky-sidebar'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture-enable-sticky-sidebar]', array(
    'label'     => __( 'Enable Sticky Sidebar', 'greenhouseculture' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'greenhouseculture'),
    'section'   => 'greenhouseculture_sticky_sidebar',
    'settings'  => 'greenhouseculture_options[greenhouseculture-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );