<?php
/*Single Page Options*/
$wp_customize->add_section('prefer_single_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Single Page Settings', 'prefer'),
    'panel' => 'prefer_panel',
));

/*Featured Image Option*/
$wp_customize->add_setting('prefer_options[prefer-single-page-featured-image]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-single-page-featured-image'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-single-page-featured-image]', array(
    'label' => __('Enable Featured Image on Single Posts', 'prefer'),
    'description' => __('You can hide images on single post from here.', 'prefer'),
    'section' => 'prefer_single_page_section',
    'settings' => 'prefer_options[prefer-single-page-featured-image]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Single Page Sidebar Layout*/
$wp_customize->add_setting('prefer_options[prefer-sidebar-single-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-sidebar-single-page'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control( 
    new Prefer_Radio_Image_Control(
        $wp_customize,
    'prefer_options[prefer-sidebar-single-page]', array(
    'choices' => prefer_sidebar_position_array(),
    'label' => __('Select Sidebar', 'prefer'),
    'description' => __('From Appearance > Customize > Widgets and add the widgets on the respected widget areas.', 'prefer'),
    'section' => 'prefer_single_page_section',
    'settings' => 'prefer_options[prefer-sidebar-single-page]',
    'type' => 'select',
    'priority' => 15,
)));

/*Related Post Options*/
$wp_customize->add_setting('prefer_options[prefer-single-page-related-posts]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-single-page-related-posts'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-single-page-related-posts]', array(
    'label' => __('Related Posts', 'prefer'),
    'description' => __('2 posts of same category will appear.', 'prefer'),
    'section' => 'prefer_single_page_section',
    'settings' => 'prefer_options[prefer-single-page-related-posts]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*callback functions related posts*/
if (!function_exists('prefer_related_post_callback')) :
    function prefer_related_post_callback()
    {
        global $prefer_theme_options;
        $related_posts = absint($prefer_theme_options['prefer-single-page-related-posts']);
        if (1 == $related_posts) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Related Post Title*/
$wp_customize->add_setting('prefer_options[prefer-single-page-related-posts-title]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('prefer_options[prefer-single-page-related-posts-title]', array(
    'label' => __('Related Posts Title', 'prefer'),
    'description' => __('Enter the suitable title.', 'prefer'),
    'section' => 'prefer_single_page_section',
    'settings' => 'prefer_options[prefer-single-page-related-posts-title]',
    'type' => 'text',
    'priority' => 15,
    'active_callback' => 'prefer_related_post_callback'
));

/*Social Share Options*/
$wp_customize->add_setting('prefer_options[prefer-single-social-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-single-social-share'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-single-social-share]', array(
    'label' => __('Social Sharing', 'prefer'),
    'description' => __('Enable Social Sharing on Single Posts.', 'prefer'),
    'section' => 'prefer_single_page_section',
    'settings' => 'prefer_options[prefer-single-social-share]',
    'type' => 'checkbox',
    'priority' => 15,
));
