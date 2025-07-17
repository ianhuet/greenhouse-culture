<?php 
/**
 * Prefer Slider Function
 * @since Prefer 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $prefer_theme_options;
$slide_id = absint($prefer_theme_options['prefer-select-category']);
        $slick_args = array(
            'slidesToShow'      => 1,
            'slidesToScroll'    => 1,
            'dots'              => false,
            'arrows'            => false,
        );
      $args = array(
			'posts_per_page' => 3,
			'paged' => 1,
			'cat' => $slide_id,
			'post_type' => 'post'
		);
		$slider_query = new WP_Query($args);
		if ($slider_query->have_posts()): ?>
    <div class="container">
    <div class="modern-slider" data-slick='<?php echo $slick_args_encoded; ?>'>
				<?php while ($slider_query->have_posts()) : $slider_query->the_post(); 
          if(has_post_thumbnail()){
          $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_src( $image_id,'',true );
        ?>
				<div class="slider-items slider-height">
          <div class="slide-wrap">
              <div class="entry-meta">
                <ul>
                  <li>
                      <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                        echo '<a class="s-cat" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">'.esc_html( $categories[0]->name ).'</a>';
                      }                                 
                      ?>
                  </li>
                  <li><?php prefer_posted_on(); ?></li>
                </ul>
              </div>
              <!-- <div class="img-cover" style="background-image: url(<?php //echo esc_url($image_url[0]);?>)">
              </div> -->
              <?php the_post_thumbnail('full'); ?>
            	<div class="caption">
                    <div class="inner-wrapper">
              		    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                      <div class="btn-wrapper">
                        <a class="more-btn" href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'prefer'); ?></a>
                      </div>
                  </div>
            	</div>
          </div>
        </div>
        <?php } endwhile;
        wp_reset_postdata(); ?>
    </div>
  </div>
<?php endif; ?>