<?php
/*Slider Options*/

$wp_customize->add_section( 'greenhouseculture_slider_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Slider Settings', 'greenhouseculture' ),
   'panel' 		 => 'greenhouseculture_panel',
) );

/*callback functions slider*/
if ( !function_exists('greenhouseculture_slider_active_callback') ) :
  function greenhouseculture_slider_active_callback(){
      global $greenhouseculture_theme_options;
      $enable_slider = absint($greenhouseculture_theme_options['greenhouseculture_enable_slider']);
      if( 1 == $enable_slider ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Slider Enable Option*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_enable_slider]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['greenhouseculture_enable_slider'],
   'sanitize_callback' => 'greenhouseculture_sanitize_checkbox'
) );

$wp_customize->add_control(
    'greenhouseculture_options[greenhouseculture_enable_slider]',
    array(
       'label'     => __( 'Enable Slider', 'greenhouseculture' ),
       'description' => __('You can select the category for the slider below. More Options are available on premium version.', 'greenhouseculture'),
       'section'   => 'greenhouseculture_slider_section',
       'settings'  => 'greenhouseculture_options[greenhouseculture_enable_slider]',
        'type'      => 'checkbox',
       'priority'  => 15,
   )
 );

/*Slider Category Selection*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Greenhouseculture_Customize_Category_Dropdown_Control(
        $wp_customize,
        'greenhouseculture_options[greenhouseculture-select-category]',
        array(
            'label'     => __( 'Select Category For Slider', 'greenhouseculture' ),
            'description' => __('Choose one category to show the slider. More settings are in pro version.', 'greenhouseculture'),
            'section'   => 'greenhouseculture_slider_section',
            'settings'  => 'greenhouseculture_options[greenhouseculture-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 15,
        )
    )

);