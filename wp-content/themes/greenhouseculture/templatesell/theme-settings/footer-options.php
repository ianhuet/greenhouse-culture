<?php
/*Footer Options*/
$wp_customize->add_section('greenhouseculture_footer_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Footer Settings', 'greenhouseculture'),
    'panel' => 'greenhouseculture_panel',
));


/*Copyright Setting*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-footer-copyright]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-footer-copyright]', array(
    'label' => __('Copyright Text', 'greenhouseculture'),
    'description' => __('Enter your own copyright text.', 'greenhouseculture'),
    'section' => 'greenhouseculture_footer_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-footer-copyright]',
    'type' => 'text',
    'priority' => 15,
));
