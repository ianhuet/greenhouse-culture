<?php
/*Top Header Options*/
$wp_customize->add_section( 'greenhouseculture_top_header_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Top Header', 'greenhouseculture' ),
   'panel' 		 => 'greenhouseculture_panel',
) );

/*callback functions header section*/
if ( !function_exists('greenhouseculture_header_active_callback') ) :
  function greenhouseculture_header_active_callback(){
      global $greenhouseculture_theme_options;
      $enable_header = absint($greenhouseculture_theme_options['greenhouseculture_enable_top_header']);
      if( 1 == $enable_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Enable Top Header Section*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_top_header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['greenhouseculture_enable_top_header'],
   'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_top_header]', array(
   'label'     => __( 'Enable Top Header', 'greenhouseculture' ),
   'description' => __('Checked to show the top header section like search and social icons', 'greenhouseculture'),
   'section'   => 'greenhouseculture_top_header_section',
   'settings'  => 'greenhouseculture_options[greenhouseculture_enable_top_header]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );

/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_top_header_social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['greenhouseculture_enable_top_header_social'],
   'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_top_header_social]', array(
   'label'     => __( 'Enable Social Icons', 'greenhouseculture' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'greenhouseculture'),
   'section'   => 'greenhouseculture_top_header_section',
   'settings'  => 'greenhouseculture_options[greenhouseculture_enable_top_header_social]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'greenhouseculture_header_active_callback'
) );

/*Enable Menu in top Header*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_top_header_menu]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture_enable_top_header_menu'],
    'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_enable_top_header_menu]', array(
    'label'     => __( 'Menu in Header', 'greenhouseculture' ),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'greenhouseculture'),
    'section'   => 'greenhouseculture_top_header_section',
    'settings'  => 'greenhouseculture_options[greenhouseculture_enable_top_header_menu]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'greenhouseculture_header_active_callback'
) );
