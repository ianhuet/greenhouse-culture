<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Greenhouseculture
 */
$GLOBALS['greenhouseculture_theme_options'] = greenhouseculture_get_options_value();
global $greenhouseculture_theme_options;
$enable_slider = absint($greenhouseculture_theme_options['greenhouseculture_enable_slider']);
$enable_box = $greenhouseculture_theme_options['greenhouseculture_enable_promo'];
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
//wp_body_open hook from WordPress 5.2
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}else {
    do_action( 'wp_body_open' );
}
?>
<div id="page" class="site ">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'greenhouseculture' ); ?></a>

	<?php
    /**
     * Hook - greenhouseculture_action_header.
     *
     * @hooked greenhouseculture_add_main_header - 10
     */
    do_action( 'greenhouseculture_action_header' );
    ?>

	 <?php if ($enable_slider == 1 && (is_home() || is_front_page())) { ?>
        <section class="slider-wrapper">
            <?php
            /*
            * Slider Section Hook
            */
                do_action('greenhouseculture_action_slider');
            ?>
        </section>
    <?php } ?>

    <?php if ($enable_box == 1 && (is_home() || is_front_page() ) )  { ?>
        <section class="promo-slider-wrapper">
            <?php

            /*
            * Boxes Section Hook
            */
            do_action('greenhouseculture_action_boxes');
            ?>
        </section>
    <?php } ?>

    <?php if (is_active_sidebar('below-slider-area') && (is_home() || is_front_page())) { ?>
        <section class="post-area slider-below-widget-wrapper">
            <div class="container">
                <?php
                /*
                * Widget area below slider
                */
                dynamic_sidebar( 'below-slider-area' ); ?>
            </div>
        </section>
    <?php } ?>
