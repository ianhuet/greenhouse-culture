<?php
/*Blog Page Options*/
$wp_customize->add_section('greenhouseculture_blog_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Blog Settings', 'greenhouseculture'),
    'panel' => 'greenhouseculture_panel',
));
/*Blog Page Sidebar Layout*/

$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-sidebar-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-sidebar-blog-page'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control( new Greenhouseculture_Radio_Image_Control(
        $wp_customize,
    'greenhouseculture_options[greenhouseculture-sidebar-blog-page]', array(
    'choices' => greenhouseculture_blog_sidebar_position_array(),
    'label' => __('Blog and Archive Sidebar', 'greenhouseculture'),
    'description' => __('This sidebar will work blog and archive pages.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-sidebar-blog-page]',
    'type' => 'select',
    'priority' => 15,
)));


/*Blog Page column number*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-column-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-column-blog-page'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-column-blog-page]', array(
    'choices' => array(
        'one-column' => __('Single Layout', 'greenhouseculture'),
        'masonry-post' => __('Masonry Layout', 'greenhouseculture'),

    ),
    'label' => __('Blog Layout Options', 'greenhouseculture'),
    'description' => __('Change your blog or archive page layout.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-column-blog-page]',
    'type' => 'select',
    'priority' => 15,
));


/*Image Layout Options For Blog Page*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-image-layout]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-image-layout'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-image-layout]', array(
    'choices' => array(
        'full-image' => __('Full Image', 'greenhouseculture'),
        'left-image' => __('Left Image', 'greenhouseculture'),
        'right-image' => __('Right Image', 'greenhouseculture'),

    ),
    'label' => __('Blog Page Layout', 'greenhouseculture'),
    'description' => __('This will work only on Full layout Option', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-image-layout]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page Show content from*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-content-show-from]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-content-show-from'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-content-show-from]', array(
    'choices' => array(
        'excerpt' => __('Show from Excerpt', 'greenhouseculture'),
        'content' => __('Show from Content', 'greenhouseculture'),
    ),
    'label' => __('Select Content Display From', 'greenhouseculture'),
    'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-content-show-from]',
    'type' => 'select',
    'priority' => 15,
));


/*Blog Page excerpt length*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-excerpt-length]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-excerpt-length'],
    'sanitize_callback' => 'absint'

));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-excerpt-length]', array(
    'label' => __('Excerpt Length', 'greenhouseculture'),
    'description' => __('Enter the number per Words to show the content in blog page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-excerpt-length]',
    'type' => 'number',
    'priority' => 15,
));

/*Blog Page Pagination Options*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-pagination-options]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-pagination-options'],
    'sanitize_callback' => 'greenhouseculture_sanitize_select'

));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-pagination-options]', array(
    'choices' => array(
        'numeric' => __('Numeric Pagination', 'greenhouseculture'),
        'ajax' => __('Ajax Pagination', 'greenhouseculture'),
    ),
    'label' => __('Pagination Types', 'greenhouseculture'),
    'description' => __('Choose Required Pagination Type', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-pagination-options]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page read more text*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-read-more-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-read-more-text]', array(
    'label' => __('Read More Text', 'greenhouseculture'),
    'description' => __('Read more text for blog and archive page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-read-more-text]',
    'type' => 'text',
    'priority' => 15,
));

/*Exclude Category in Blog Page*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-exclude-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-exclude-category'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-exclude-category]', array(
    'label' => __('Exclude categories in Blog Listing', 'greenhouseculture'),
    'description' => __('Enter categories ids with comma separated eg: 2,7,14,47.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-exclude-category]',
    'type' => 'text',
    'priority' => 15,
));


/*Social Share in blog page*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-show-hide-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-show-hide-share'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-show-hide-share]', array(
    'label' => __('Show Social Share', 'greenhouseculture'),
    'description' => __('Options to Enable Social Share in blog and archive page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-show-hide-share]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Category Show hide*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-show-hide-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-show-hide-category'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-show-hide-category]', array(
    'label' => __('Show Category', 'greenhouseculture'),
    'description' => __('Option to hide the category on the blog page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-show-hide-category]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Date Show hide*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-show-hide-date]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-show-hide-date'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-show-hide-date]', array(
    'label' => __('Show Date', 'greenhouseculture'),
    'description' => __('Option to hide the date on the blog page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-show-hide-date]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Author Show hide*/
$wp_customize->add_setting('greenhouseculture_options[greenhouseculture-show-hide-author]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['greenhouseculture-show-hide-author'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
));

$wp_customize->add_control('greenhouseculture_options[greenhouseculture-show-hide-author]', array(
    'label' => __('Show Author', 'greenhouseculture'),
    'description' => __('Option to hide the author on the blog page.', 'greenhouseculture'),
    'section' => 'greenhouseculture_blog_page_section',
    'settings' => 'greenhouseculture_options[greenhouseculture-show-hide-author]',
    'type' => 'checkbox',
    'priority' => 15,
));