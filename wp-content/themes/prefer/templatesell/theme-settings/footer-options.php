<?php
/*Footer Options*/
$wp_customize->add_section('prefer_footer_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Footer Settings', 'prefer'),
    'panel' => 'prefer_panel',
));


/*Copyright Setting*/
$wp_customize->add_setting('prefer_options[prefer-footer-copyright]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('prefer_options[prefer-footer-copyright]', array(
    'label' => __('Copyright Text', 'prefer'),
    'description' => __('Enter your own copyright text.', 'prefer'),
    'section' => 'prefer_footer_section',
    'settings' => 'prefer_options[prefer-footer-copyright]',
    'type' => 'text',
    'priority' => 15,
));
