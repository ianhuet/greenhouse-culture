<?php
/*Blog Page Options*/
$wp_customize->add_section('prefer_blog_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Blog Settings', 'prefer'),
    'panel' => 'prefer_panel',
));
/*Blog Page Sidebar Layout*/

$wp_customize->add_setting('prefer_options[prefer-sidebar-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-sidebar-blog-page'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control( new Prefer_Radio_Image_Control(
        $wp_customize,
    'prefer_options[prefer-sidebar-blog-page]', array(
    'choices' => prefer_blog_sidebar_position_array(),
    'label' => __('Blog and Archive Sidebar', 'prefer'),
    'description' => __('This sidebar will work blog and archive pages.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-sidebar-blog-page]',
    'type' => 'select',
    'priority' => 15,
)));


/*Blog Page column number*/
$wp_customize->add_setting('prefer_options[prefer-column-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-column-blog-page'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control('prefer_options[prefer-column-blog-page]', array(
    'choices' => array(
        'one-column' => __('Single Layout', 'prefer'),
        'masonry-post' => __('Masonry Layout', 'prefer'),
    
    ),
    'label' => __('Blog Layout Options', 'prefer'),
    'description' => __('Change your blog or archive page layout.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-column-blog-page]',
    'type' => 'select',
    'priority' => 15,
));


/*Image Layout Options For Blog Page*/
$wp_customize->add_setting('prefer_options[prefer-blog-image-layout]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-blog-image-layout'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control('prefer_options[prefer-blog-image-layout]', array(
    'choices' => array(
        'full-image' => __('Full Image', 'prefer'),
        'left-image' => __('Left Image', 'prefer'),
        'right-image' => __('Right Image', 'prefer'),
    
    ),
    'label' => __('Blog Page Layout', 'prefer'),
    'description' => __('This will work only on Full layout Option', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-blog-image-layout]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page Show content from*/
$wp_customize->add_setting('prefer_options[prefer-content-show-from]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-content-show-from'],
    'sanitize_callback' => 'prefer_sanitize_select'
));

$wp_customize->add_control('prefer_options[prefer-content-show-from]', array(
    'choices' => array(
        'excerpt' => __('Show from Excerpt', 'prefer'),
        'content' => __('Show from Content', 'prefer'),
    ),
    'label' => __('Select Content Display From', 'prefer'),
    'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-content-show-from]',
    'type' => 'select',
    'priority' => 15,
));


/*Blog Page excerpt length*/
$wp_customize->add_setting('prefer_options[prefer-excerpt-length]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-excerpt-length'],
    'sanitize_callback' => 'absint'

));

$wp_customize->add_control('prefer_options[prefer-excerpt-length]', array(
    'label' => __('Excerpt Length', 'prefer'),
    'description' => __('Enter the number per Words to show the content in blog page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-excerpt-length]',
    'type' => 'number',
    'priority' => 15,
));

/*Blog Page Pagination Options*/
$wp_customize->add_setting('prefer_options[prefer-pagination-options]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-pagination-options'],
    'sanitize_callback' => 'prefer_sanitize_select'

));

$wp_customize->add_control('prefer_options[prefer-pagination-options]', array(
    'choices' => array(
        'numeric' => __('Numeric Pagination', 'prefer'),
        'ajax' => __('Ajax Pagination', 'prefer'),
    ),
    'label' => __('Pagination Types', 'prefer'),
    'description' => __('Choose Required Pagination Type', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-pagination-options]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page read more text*/
$wp_customize->add_setting('prefer_options[prefer-read-more-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('prefer_options[prefer-read-more-text]', array(
    'label' => __('Read More Text', 'prefer'),
    'description' => __('Read more text for blog and archive page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-read-more-text]',
    'type' => 'text',
    'priority' => 15,
));

/*Exclude Category in Blog Page*/
$wp_customize->add_setting('prefer_options[prefer-blog-exclude-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-blog-exclude-category'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('prefer_options[prefer-blog-exclude-category]', array(
    'label' => __('Exclude categories in Blog Listing', 'prefer'),
    'description' => __('Enter categories ids with comma separated eg: 2,7,14,47.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-blog-exclude-category]',
    'type' => 'text',
    'priority' => 15,
));


/*Social Share in blog page*/
$wp_customize->add_setting('prefer_options[prefer-show-hide-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-show-hide-share'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-show-hide-share]', array(
    'label' => __('Show Social Share', 'prefer'),
    'description' => __('Options to Enable Social Share in blog and archive page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-show-hide-share]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Category Show hide*/
$wp_customize->add_setting('prefer_options[prefer-show-hide-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-show-hide-category'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-show-hide-category]', array(
    'label' => __('Show Category', 'prefer'),
    'description' => __('Option to hide the category on the blog page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-show-hide-category]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Date Show hide*/
$wp_customize->add_setting('prefer_options[prefer-show-hide-date]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-show-hide-date'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-show-hide-date]', array(
    'label' => __('Show Date', 'prefer'),
    'description' => __('Option to hide the date on the blog page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-show-hide-date]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Author Show hide*/
$wp_customize->add_setting('prefer_options[prefer-show-hide-author]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['prefer-show-hide-author'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
));

$wp_customize->add_control('prefer_options[prefer-show-hide-author]', array(
    'label' => __('Show Author', 'prefer'),
    'description' => __('Option to hide the author on the blog page.', 'prefer'),
    'section' => 'prefer_blog_page_section',
    'settings' => 'prefer_options[prefer-show-hide-author]',
    'type' => 'checkbox',
    'priority' => 15,
));