<?php
/*Slider Options*/

$wp_customize->add_section( 'prefer_slider_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Slider Settings', 'prefer' ),
   'panel' 		 => 'prefer_panel',
) );

/*callback functions slider*/
if ( !function_exists('prefer_slider_active_callback') ) :
  function prefer_slider_active_callback(){
      global $prefer_theme_options;
      $enable_slider = absint($prefer_theme_options['prefer_enable_slider']);
      if( 1 == $enable_slider ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Slider Enable Option*/
$wp_customize->add_setting( 'prefer_options[prefer_enable_slider]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['prefer_enable_slider'],
   'sanitize_callback' => 'prefer_sanitize_checkbox'
) );

$wp_customize->add_control(
    'prefer_options[prefer_enable_slider]', 
    array(
       'label'     => __( 'Enable Slider', 'prefer' ),
       'description' => __('You can select the category for the slider below. More Options are available on premium version.', 'prefer'),
       'section'   => 'prefer_slider_section',
       'settings'  => 'prefer_options[prefer_enable_slider]',
        'type'      => 'checkbox',
       'priority'  => 15,
   )
 );        

/*Slider Category Selection*/
$wp_customize->add_setting( 'prefer_options[prefer-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['prefer-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Prefer_Customize_Category_Dropdown_Control(
        $wp_customize,
        'prefer_options[prefer-select-category]',
        array(
            'label'     => __( 'Select Category For Slider', 'prefer' ),
            'description' => __('Choose one category to show the slider. More settings are in pro version.', 'prefer'),
            'section'   => 'prefer_slider_section',
            'settings'  => 'prefer_options[prefer-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 15,
        )
    )

);