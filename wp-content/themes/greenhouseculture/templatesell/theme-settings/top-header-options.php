<?php
/*Top Header Options*/
$wp_customize->add_section( 'prefer_top_header_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Top Header', 'prefer' ),
   'panel' 		 => 'prefer_panel',
) );

/*callback functions header section*/
if ( !function_exists('prefer_header_active_callback') ) :
  function prefer_header_active_callback(){
      global $prefer_theme_options;
      $enable_header = absint($prefer_theme_options['prefer_enable_top_header']);
      if( 1 == $enable_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Enable Top Header Section*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_top_header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['prefer_enable_top_header'],
   'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_top_header]', array(
   'label'     => __( 'Enable Top Header', 'prefer' ),
   'description' => __('Checked to show the top header section like search and social icons', 'prefer'),
   'section'   => 'prefer_top_header_section',
   'settings'  => 'prefer_options[prefer_enable_top_header]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );

/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_top_header_social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['prefer_enable_top_header_social'],
   'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_top_header_social]', array(
   'label'     => __( 'Enable Social Icons', 'prefer' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'prefer'),
   'section'   => 'prefer_top_header_section',
   'settings'  => 'prefer_options[prefer_enable_top_header_social]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'prefer_header_active_callback'
) );

/*Enable Menu in top Header*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_top_header_menu]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer_enable_top_header_menu'],
    'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control( 'prefer_options[prefer_enable_top_header_menu]', array(
    'label'     => __( 'Menu in Header', 'prefer' ),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'prefer'),
    'section'   => 'prefer_top_header_section',
    'settings'  => 'prefer_options[prefer_enable_top_header_menu]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'prefer_header_active_callback'
) );
