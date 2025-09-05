<?php
/**
 * Masonry Start Class and Id functions
 *
 * @since Greenhouseculture 1.0.0
 *
 */
if (!function_exists('greenhouseculture_masonry_start')) :
    function greenhouseculture_masonry_start()
    { ?>
        <div class="masonry-start"><div id="masonry-loop">

        <?php
    }
endif;
add_action('greenhouseculture_masonry_start_hook', 'greenhouseculture_masonry_start', 10, 1);

/**
 * Masonry end Div
 *
 * @since Greenhouseculture 1.0.0
 *
 */
if (!function_exists('greenhouseculture_masonry_end')) :
    function greenhouseculture_masonry_end()
    { ?>
        </div>
        </div>

        <?php
    }
endif;
add_action('greenhouseculture_masonry_end_hook', 'greenhouseculture_masonry_end', 10, 1);