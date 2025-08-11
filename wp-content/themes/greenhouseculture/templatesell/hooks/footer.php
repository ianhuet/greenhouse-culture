<?php
/**
 * Goto Top functions
 *
 * @since Prefer 1.0.0
 *
 */

if (!function_exists('prefer_go_to_top')) :
    function prefer_go_to_top()
    {
    ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'prefer'); ?>">
                <i class="fa fa-angle-double-up"></i>
            </a>
<?php
    } endif;
add_action('prefer_go_to_top_hook', 'prefer_go_to_top', 10, 1);