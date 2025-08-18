<?php
/**
 * Goto Top functions
 *
 * @since Greenhouseculture 1.0.0
 *
 */

if (!function_exists('greenhouseculture_go_to_top')) :
    function greenhouseculture_go_to_top()
    {
    ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'greenhouseculture'); ?>">
                <i class="fa fa-angle-double-up"></i>
            </a>
<?php
    } endif;
add_action('greenhouseculture_go_to_top_hook', 'greenhouseculture_go_to_top', 10, 1);