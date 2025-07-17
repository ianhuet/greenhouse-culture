<?php
/**
 * Social Sharing Hook *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('prefer_social_sharing')) :
    function prefer_social_sharing($post_id)
    {
        $prefer_url = get_the_permalink($post_id);
        $prefer_title = get_the_title($post_id);
        $prefer_image = get_the_post_thumbnail_url($post_id);
        
        //sharing url
        $prefer_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $prefer_title . '&url=' . $prefer_url);
        $prefer_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $prefer_url);
        $prefer_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $prefer_url . '&media=' . $prefer_image . '&description=' . $prefer_title);
        $prefer_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $prefer_title . '&url=' . $prefer_url);
        
        ?>
        <div class="meta_bottom">
            <div class="post-share">
                <a data-tooltip="<?php esc_attr_e('Share it','prefer'); ?>" class="tooltip"  target="_blank" href="<?php echo $prefer_facebook_sharing_url; ?>"><i class="fa fa-facebook"></i><?php esc_html_e('Facebook','prefer'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Tweet it','prefer'); ?>" class="tooltip"  target="_blank" href="<?php echo $prefer_twitter_sharing_url; ?>"><i
                            class="fa fa-twitter"></i> <?php esc_html_e('Twitter','prefer'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Pin it','prefer'); ?>" class="tooltip"  target="_blank" href="<?php echo $prefer_pinterest_sharing_url; ?>"><i
                            class="fa fa-pinterest"></i><?php esc_html_e('Pinterest','prefer'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Share Now','prefer'); ?>" class="tooltip"  target="_blank" href="<?php echo $prefer_linkedin_sharing_url; ?>"><i class="fa fa-linkedin"></i><?php esc_html_e('Linkedin','prefer'); ?></a>
            </div>
        </div>
        <?php
    }
endif;
add_action('prefer_social_sharing', 'prefer_social_sharing', 10);