<?php
/* Primary Color Section Inside Core Color Option */
$wp_customize->add_setting( 'greenhouseculture_options[greenhouseculture_primary_color]',
    array(
        'default'           => $default['greenhouseculture_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'greenhouseculture_options[greenhouseculture_primary_color]',
        array(
            'label'       => esc_html__( 'Primary Color', 'greenhouseculture' ),
            'description' => esc_html__( 'Change your whole site color from here. More are available in premium version.', 'greenhouseculture' ),
            'section'     => 'colors',
        )
    )
);

