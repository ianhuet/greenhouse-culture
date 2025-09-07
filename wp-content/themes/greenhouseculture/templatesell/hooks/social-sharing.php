<?php
/**
 * Social Sharing Hook *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('greenhouseculture_social_sharing')) :
    function greenhouseculture_social_sharing($post_id)
    {
        $greenhouseculture_url = get_the_permalink($post_id);
        $greenhouseculture_title = get_the_title($post_id);
        $greenhouseculture_image = get_the_post_thumbnail_url($post_id);

        //sharing url
        $greenhouseculture_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $greenhouseculture_title . '&url=' . $greenhouseculture_url);
        $greenhouseculture_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $greenhouseculture_url);
        $greenhouseculture_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $greenhouseculture_url . '&media=' . $greenhouseculture_image . '&description=' . $greenhouseculture_title);
        $greenhouseculture_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $greenhouseculture_title . '&url=' . $greenhouseculture_url);

        ?>
        <div class="meta_bottom">
            <div class="post-share">
                <a data-tooltip="<?php esc_attr_e('Share it','greenhouseculture'); ?>" class="tooltip"  target="_blank" href="<?php echo $greenhouseculture_facebook_sharing_url; ?>"><i class="fa fa-facebook"></i><?php esc_html_e('Facebook','greenhouseculture'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Tweet it','greenhouseculture'); ?>" class="tooltip"  target="_blank" href="<?php echo $greenhouseculture_twitter_sharing_url; ?>"><i
                            class="fa fa-twitter"></i> <?php esc_html_e('Twitter','greenhouseculture'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Pin it','greenhouseculture'); ?>" class="tooltip"  target="_blank" href="<?php echo $greenhouseculture_pinterest_sharing_url; ?>"><i
                            class="fa fa-pinterest"></i><?php esc_html_e('Pinterest','greenhouseculture'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Share Now','greenhouseculture'); ?>" class="tooltip"  target="_blank" href="<?php echo $greenhouseculture_linkedin_sharing_url; ?>"><i class="fa fa-linkedin"></i><?php esc_html_e('Linkedin','greenhouseculture'); ?></a>
            </div>
        </div>
        <?php
    }
endif;
add_action('greenhouseculture_social_sharing', 'greenhouseculture_social_sharing', 10);