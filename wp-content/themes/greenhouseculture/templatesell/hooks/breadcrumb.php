<?php
/**
 * Functions to manage breadcrumbs
 */
if (!function_exists('greenhouseculture_breadcrumb_options')) :
    function greenhouseculture_breadcrumb_options()
    {
        global $greenhouseculture_theme_options;
        if (1 == $greenhouseculture_theme_options['greenhouseculture-extra-breadcrumb']) {
            greenhouseculture_breadcrumbs();
        }
    }
endif;
add_action('greenhouseculture_breadcrumb_options_hook', 'greenhouseculture_breadcrumb_options');

/**
 * BreadCrumb Settings
 */
if (!function_exists('greenhouseculture_breadcrumbs')):
    function greenhouseculture_breadcrumbs()
    {
        global $greenhouseculture_theme_options;
        $breadcrumb_from = $greenhouseculture_theme_options['greenhouseculture-breadcrumb-selection-option'];        
        if ((function_exists('yoast_breadcrumb')) && ($breadcrumb_from == 'yoast-breadcrumb')) {
            yoast_breadcrumb();
        } elseif ((function_exists('bcn_display')) && ($breadcrumb_from == 'navxt-breadcrumb')) {
            bcn_display();
        }else{

            if (!function_exists('greenhouseculture_breadcrumb_trail')) {
                require get_template_directory() . '/templatesell/breadcrumbs/breadcrumbs.php';
            }
            $breadcrumb_args = array(
                'container' => 'div',
                'show_browse' => false
            );        
            greenhouseculture_breadcrumb_trail($breadcrumb_args);
        }
    }
endif;
add_action('greenhouseculture_breadcrumbs_hook', 'greenhouseculture_breadcrumbs');