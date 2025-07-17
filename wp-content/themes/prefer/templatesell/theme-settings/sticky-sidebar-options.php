<?php 
/*Sticky Sidebar*/
$wp_customize->add_section( 'prefer_sticky_sidebar', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sticky Sidebar Settings', 'prefer' ),
   'panel' 		 => 'prefer_panel',
) );

/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'prefer_options[prefer-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer-enable-sticky-sidebar'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer-enable-sticky-sidebar]', array(
    'label'     => __( 'Enable Sticky Sidebar', 'prefer' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'prefer'),
    'section'   => 'prefer_sticky_sidebar',
    'settings'  => 'prefer_options[prefer-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );