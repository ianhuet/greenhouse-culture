<?php
/**
 * Greenhouseculture Promo Unique
 * @since Greenhouseculture 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $greenhouseculture_theme_options;
$promo_cat = absint($greenhouseculture_theme_options['greenhouseculture-promo-select-category']);

if( $promo_cat > 0 && is_home() )
{ ?>
    <section class="greenhouseculture-promo-section">
        <?php if ( is_front_page() && is_home() )
        {  ?>
            <div class="container">
                <div class="promo-section promo-three">
                    <?php
                    $args = array(
                        'cat' => $promo_cat ,
                        'posts_per_page' => 3,
                        'order'=> 'DESC'
                    );

                    $query = new WP_Query($args);

                    if($query->have_posts()):
                        while($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>">
                                    <?php

                                    if(has_post_thumbnail())
                                    {

                                        $image_id  = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id,'greenhouseculture-promo-post',true);
                                        ?>

                                        <figure>
                                            <img src="<?php echo esc_url($image_url[0]);?>">
                                            <span class="inset"></span>
                                        </figure>
                                    <?php   } ?>
                                </a>
                                <div class="promo-content">
                                    <div class="post-category">
                                        <?php
                                           $categories = get_the_category();
                                           if ( ! empty( $categories ) ) {
                                              echo '<a class="s-cat" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">'.esc_html( $categories[0]->name ).'</a>';
                                          }
                                        ?>
                                    </div>

                                    <h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-date">
                                        <div class="entry-meta">
                                            <?php
                                            greenhouseculture_posted_by();
                                            greenhouseculture_posted_on();
                                            greenhouseculture_blog_read_time();
                                            ?>
                                        </div><!-- .entry-meta -->
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>
        <?php } ?>
    </section>
<?php   }