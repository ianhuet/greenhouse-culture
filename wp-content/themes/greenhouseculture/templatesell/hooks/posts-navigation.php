<?php
/**
 * Post Navigation Function
 *
 * @since Greenhouseculture 1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('greenhouseculture_posts_navigation')) :
    function greenhouseculture_posts_navigation()
    {
        global $greenhouseculture_theme_options;
        $greenhouseculture_pagination_option = $greenhouseculture_theme_options['greenhouseculture-pagination-options'];
        if ('numeric' == $greenhouseculture_pagination_option) {
            echo "<div class='pagination'>";
                the_posts_pagination();
            echo "</div>";
        } elseif ('ajax' == $greenhouseculture_pagination_option) {
            $page_number = get_query_var('paged');
            if ($page_number == 0) {
                $output_page = 2;
            } else {
                $output_page = $page_number + 1;
            }
            echo "<div class='ajax-pagination text-center'><div class='show-more' data-number='esc_attr($output_page)'><i class='fa fa-refresh'></i>" . __('View More', 'greenhouseculture') . "</div><div id='free-temp-post'></div></div>";
        } else {
            return false;
        }
    }
endif;
add_action('greenhouseculture_action_navigation', 'greenhouseculture_posts_navigation', 10);