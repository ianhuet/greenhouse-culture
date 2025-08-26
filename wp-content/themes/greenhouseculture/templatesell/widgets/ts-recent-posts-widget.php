<?php
/**
 * Greenhouseculture Featured Post Widget.
 *
 * @since 1.0.0
 */
if (!class_exists('Greenhouseculture_Featured_Post')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Greenhouseculture_Featured_Post extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'title'    => esc_html__( 'Recent Posts', 'greenhouseculture' ),
                'cat'     => 0,
                'post-number'=> 5,

           );
            return $defaults;
        }

        public function __construct()
        {
            $opts = array(
                'classname' => 'greenhouseculture-featured-post',
                'description' => esc_html__('Displays Featured Post in Sidebars. Place it in Sidebar Widget Area.', 'greenhouseculture'),
            );

            parent::__construct('greenhouseculture-featured-post', esc_html__('Greenhouseculture Featured Post', 'greenhouseculture'), $opts);
        }


        public function widget($args, $instance)
        {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];


            if (!empty($title)) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            }
            $cat_id = !empty($instance['cat']) ? $instance['cat'] : '';

            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : '';

            $query_args = array(
                'post_type' => 'post',
                'cat' => absint($cat_id),
                'posts_per_page' => absint($post_number),
                'ignore_sticky_posts' => true
            );

          
            $i = 1;
            $query = new WP_Query($query_args);
            ?> 
            <ul class="list-unstyled">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    ?>
                    <li>
                        <figure class="widget_featured_thumbnail">
                            <?php
                            if (has_post_thumbnail()) {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('greenhouseculture-related-size'); ?>
                                        <div class="widget_bg_overlay"></div>
                                    </a>

                                <?php
                            }
                            ?>
                        </figure>
                        <span class="widget_featured_post_num"><?php echo $i; ?></span>
                        <div class="widget_featured_content">
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="post-date">
                                    <?php greenhouseculture_posted_on(); ?>

                                </div><!-- .entry-meta -->
                        </div>
                    </li>


                    <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif; ?></ul><?php


            echo $args['after_widget'];

        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['cat'] = absint($new_instance['cat']);
            $instance['post-number'] = absint($new_instance['post-number']);
            return $instance;
        }
        public function form($instance)
        {
            $instance  = wp_parse_args( (array )$instance, $this->defaults() );
            
            ?>
            <p>
                <label
                for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'greenhouseculture'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p class="custom-dropdown-posts">
                <label for="<?php echo esc_attr($this->get_field_name('cat')); ?>">
                    <strong><?php esc_html_e('Select Category: ', 'greenhouseculture'); ?></strong>
                </label>
                <?php
                $cat_args = array(
                    'orderby' => 'name',
                    'hide_empty' => 0,
                    'id' => $this->get_field_id('cat'),
                    'name' => $this->get_field_name('cat'),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'selected' => absint($instance['cat']),
                    'show_option_all' => esc_html__('Show Recent Posts', 'greenhouseculture')
                );
                wp_dropdown_categories($cat_args);
                ?>
            </p>

            <p>
                <label
                for="<?php echo esc_attr($this->get_field_id('post-number')); ?>"><?php esc_html_e('Number of Posts to Display:', 'greenhouseculture'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post-number')); ?>"
                name="<?php echo esc_attr($this->get_field_name('post-number')); ?>" type="number"
                value="<?php echo esc_attr($instance['post-number']); ?>"/>
            </p>

            <?php
        }
    }

endif;