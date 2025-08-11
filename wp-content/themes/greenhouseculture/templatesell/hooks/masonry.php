<?php
/**
 * Masonry Start Class and Id functions
 *
 * @since Prefer 1.0.0
 *
 */
if (!function_exists('prefer_masonry_start')) :
    function prefer_masonry_start()
    { ?>
        <div class="masonry-start"><div id="masonry-loop">
        
        <?php
    }
endif;
add_action('prefer_masonry_start_hook', 'prefer_masonry_start', 10, 1);

/**
 * Masonry end Div
 *
 * @since Prefer 1.0.0
 *
 */
if (!function_exists('prefer_masonry_end')) :
    function prefer_masonry_end()
    { ?>
        </div>
        </div>
        
        <?php
    }
endif;
add_action('prefer_masonry_end_hook', 'prefer_masonry_end', 10, 1);