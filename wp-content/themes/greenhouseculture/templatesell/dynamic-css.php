<?php
/**
 * Dynamic css
 *
 * @since Greenhouseculture 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('greenhouseculture_dynamic_css')) :

    function greenhouseculture_dynamic_css()
    {
        global $greenhouseculture_theme_options;

        /* Color Options Options */
        $greenhouseculture_primary_color              = esc_attr($greenhouseculture_theme_options['greenhouseculture_primary_color']);
        $greenhouseculture_logo_width              = absint($greenhouseculture_theme_options['greenhouseculture_logo_width_option']);

        $custom_css = '';

        //Primary  Background 
        if (!empty($greenhouseculture_primary_color)) {
            $custom_css .= "
            #toTop,
            a.effect:before,
            .show-more,
            .modern-slider .slide-wrap .more-btn,
            a.link-format,
            .comment-form #submit:hover, 
            .comment-form #submit:focus,
            .meta_bottom .post-share a:hover,
            .tabs-nav li:before,
            .footer-wrap .widget-title:after,
            .post-slider-section .s-cat,
            .sidebar-3 .widget-title:after,
            .bottom-caption .slick-current .slider-items span,
            aarticle.format-status .post-content .post-format::after,
            article.format-chat .post-content .post-format::after, 
            article.format-link .post-content .post-format::after,
            article.format-standard .post-content .post-format::after, 
            article.format-image .post-content .post-format::after, 
            article.hentry.sticky .post-content .post-format::after, 
            article.format-video .post-content .post-format::after, 
            article.format-gallery .post-content .post-format::after, 
            article.format-audio .post-content .post-format::after, 
            article.format-quote .post-content .post-format::after{ 
                background-color: ". $greenhouseculture_primary_color."; 
                border-color: ".$greenhouseculture_primary_color.";
            }";

        }
        if (!empty($greenhouseculture_primary_color)) {
            $custom_css .= "
            #author:active, 
            #email:active, 
            #url:active, 
            #comment:active, 
            #author:focus, 
            #email:focus, 
            #url:focus, 
            #comment:focus,
            #author:hover, 
            #email:hover, 
            #url:hover, 
            #comment:hover{  
                border-color: ".$greenhouseculture_primary_color.";
            }";

        }

        

        //Primary Color
        if (!empty($greenhouseculture_primary_color)) {
            $custom_css .= "
            .comment-form .logged-in-as a:last-child:hover, 
            .comment-form .logged-in-as a:last-child:focus,
            .post-cats > span a:hover, 
            .post-cats > span a:focus,
            .main-header a:hover, 
            .main-header a:focus, 
            .main-header a:active,
            .top-menu > ul > li > a:hover,
            .main-menu ul li.current-menu-item > a, 
            .header-2 .main-menu > ul > li.current-menu-item > a,
            .main-menu ul li:hover > a,
            .post-navigation .nav-links a:hover, 
            .post-navigation .nav-links a:focus,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            ul.trail-items li a:hover span,
            .author-socials a:hover,
            .post-date a:focus, 
            .post-date a:hover,
            .post-excerpt a:hover, 
            .post-excerpt a:focus, 
            .content a:hover, 
            .content a:focus,
            .post-footer > span a:hover, 
            .post-footer > span a:focus,
            .widget a:hover, 
            .widget a:focus,
            .footer-menu li a:hover, 
            .footer-menu li a:focus,
            .footer-social-links a:hover,
            .footer-social-links a:focus,
            .site-footer a:hover, 
            .post-cats > span i, 
            .post-cats > span a,
            .site-footer a,
            .promo-three .post-category a,
            .site-footer a:focus, .content-area p a{ 
                color : ". $greenhouseculture_primary_color."; 
            }";
        }

        //Logo Width
        if (!empty($greenhouseculture_logo_width)) {
            $custom_css .= "
            .header-1 .head_one .logo{ 
                max-width : ". $greenhouseculture_logo_width."px; 
            }";
        }

        wp_add_inline_style('greenhouseculture-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'greenhouseculture_dynamic_css', 99);