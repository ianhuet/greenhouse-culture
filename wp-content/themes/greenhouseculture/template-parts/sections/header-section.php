<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Greenhouseculture
 */
$GLOBALS['greenhouseculture_theme_options'] = greenhouseculture_get_options_value();
global $greenhouseculture_theme_options;
$enable_header = absint($greenhouseculture_theme_options['greenhouseculture_enable_top_header']);
$enable_menu   = absint($greenhouseculture_theme_options['greenhouseculture_enable_top_header_menu']);
$enable_social = absint($greenhouseculture_theme_options['greenhouseculture_enable_top_header_social']);
// Offcanvas and search removed - hardcoded to be disabled
?>
<div class="js-canvi-content canvi-content">
<header class="header-1">
		<?php if( $enable_header == 1 ){ ?>
			<section class="top-bar-area">
				<div class="container">
					<?php if( $enable_menu == 1 ) { ?>
						<nav id="top-nav" class="left-side">
	                        <div class="top-menu">
	    						<?php
	    						$wp_nav_menu( array(
	    							'theme_location' => 'top',
	    							'menu_id'        => '',
	    							'container' => 'ul',
	                                'menu_class'      => '',
									'echo' => false,
	    						) );
	    						?>
							</div>
						</nav><!-- .top-nav -->
					<?php } ?>
					
					<?php if( $enable_social == 1 ){ ?>
						<div class="right-side">
							<div class="social-links">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_id'        => 'social-menu',
										'menu_class'     => 'greenhouseculture-social-menu',
									) );
								?>
							</div>
						</div>
					<?php } ?>
				</div>
			</section>
			<?php } ?>		
	<?php $header_image = esc_url(get_header_image());
	$header_class = ($header_image == "") ? '' : 'header-image';
	?>
	<section class="main-header <?php echo esc_attr($header_class); ?>" style="background-image:url(<?php echo esc_url($header_image) ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
		<div class="head_one clearfix">
			<div class="container">
				<div class="logo">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				endif;
				$greenhouseculture_description = get_bloginfo( 'description', 'display' );
				if ( $greenhouseculture_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $greenhouseculture_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-logo -->
		</div>
	</div>
	<div class="menu-area">
		<div class="container">					
			<nav id="site-navigation">
				<!-- Hamburger menu and search removed -->

				<button class="bar-menu">
					<div class="line-menu line-half first-line"></div>
					<div class="line-menu"></div>
					<div class="line-menu line-half last-line"></div>
					<a><?php _e('Menu', 'greenhouseculture'); ?></a>
				</button>
				<div class="main-menu menu-caret">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id' => 'primary-menu',
						'container' => 'ul',
						'menu_class' => ''
					));
					?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</div>
</setion><!-- #masthead -->
</header>

