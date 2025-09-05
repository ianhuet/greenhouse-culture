<?php
/*Single Page Options*/
$wp_customize->add_section('greenhouseculture_single_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Single Page Settings', 'greenhouseculture'),
    'panel' => 'greenhouseculture_panel',
));

/*Featured Image Option*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-single-page-featured-image]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-single-page-featured-image'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-single-page-featured-image]', array(
    'label' => __('Enable Featured Image on Single Posts', 'greenhouseculture'),
    'description' => __('You can hide images on single post from here.', 'greenhouseculture'),
    'section' => 'greenhouseculture_single_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-single-page-featured-image]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Single Page Sidebar Layout*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-sidebar-single-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-sidebar-single-page'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control(
    new Greenhouseculture_Radio_Image_Control(
        $wp_customize,
    'greenhouseculture_options[greenhouseculture-sidebar-single-page]', array(
    'choices' => greenhouseculture_sidebar_position_array(),
    'label' => __('Select Sidebar', 'greenhouseculture'),
    'description' => __('From Appearance > Customize > Widgets and add the widgets on the respected widget areas.', 'greenhouseculture'),
    'section' => 'greenhouseculture_single_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-sidebar-single-page]',
    'type' => 'select',
    'priority' => 15,
)));

/*Related Post Options*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-single-page-related-posts]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-single-page-related-posts'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-single-page-related-posts]', array(
    'label' => __('Related Posts', 'greenhouseculture'),
    'description' => __('2 posts of same category will appear.', 'greenhouseculture'),
    'section' => 'greenhouseculture_single_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-single-page-related-posts]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*callback functions related posts*/
if (!function_exists('greenhouseculture_related_post_callback')) :
    function greenhouseculture_related_post_callback()
    {
        global $greenhouseculture_theme_options;
        $related_posts = absint($greenhouseculture_theme_options['greenhouseculture-single-page-related-posts']);
        if (1 == $related_posts) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Related Post Title*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-single-page-related-posts-title]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-single-page-related-posts-title]', array(
    'label' => __('Related Posts Title', 'greenhouseculture'),
    'description' => __('Enter the suitable title.', 'greenhouseculture'),
    'section' => 'greenhouseculture_single_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-single-page-related-posts-title]',
    'type' => 'text',
    'priority' => 15,
    'active_callback' => 'greenhouseculture_related_post_callback'
));

/*Social Share Options*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-single-social-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-single-social-share'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-single-social-share]', array(
    'label' => __('Social Sharing', 'greenhouseculture'),
    'description' => __('Enable Social Sharing on Single Posts.', 'greenhouseculture'),
    'section' => 'greenhouseculture_single_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-single-social-share]',
    'type' => 'checkbox',
    'priority' => 15,
));
