<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Greenhouseculture
 */
global $greenhouseculture_theme_options;
$social_share = absint($greenhouseculture_theme_options['greenhouseculture-single-social-share']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrap">
        <div class="post-media">
            <?php greenhouseculture_post_thumbnail(); ?>
        </div>
        <div class="post-content">
            <div class="post-cats">
                <?php greenhouseculture_entry_meta(); ?>
            </div>
            <?php
            if (is_singular()) :
                the_title('<h1 class="post-title entry-title">', '</h1>');
            else :
                the_title('<h2 class="post-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                ?>
            <?php endif; ?>
            <div class="post-date">
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        greenhouseculture_posted_on();
                        greenhouseculture_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </div>

            <div class="content post-excerpt entry-content clearfix">
                <?php
                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'greenhouseculture'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()

                ));
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'greenhouseculture'),
                    'after' => '</div>',

                ));
                ?>
            </div><!-- .entry-content -->
            <footer class="post-footer entry-footer">
                <?php
                if( 1 == $social_share ){
                    do_action( 'greenhouseculture_social_sharing' ,get_the_ID() );
                }
                ?>
            </footer><!-- .entry-footer -->
            <?php the_post_navigation(); ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->