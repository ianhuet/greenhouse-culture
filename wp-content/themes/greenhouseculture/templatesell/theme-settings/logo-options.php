<?php
/*Logo Section*/
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_logo_width_option]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['greenhouseculture_logo_width_option'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'greenhouseculture_options[greenhouseculture_logo_width_option]', array(
   'label'     => __( 'Logo Width', 'greenhouseculture' ),
   'description' => __('Adjust the logo width. Minimum is 100px and maximum is 700px.', 'greenhouseculture'),
   'section'   => 'title_tagline',
   'settings'  => 'greenhouseculture_options[greenhouseculture_logo_width_option]',
   'type'      => 'range',
   'priority'  => 15,
   'input_attrs' => array(
          'min' => 100,
          'max' => 700,
        ),
) );