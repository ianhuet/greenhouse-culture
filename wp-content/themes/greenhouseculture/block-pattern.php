<?php
/**
 * Register block patterns.
 * Include this file in your theme, and update image paths, prefix and text domain.
 *
 * @link https://developer.wordpress.org/block-editor/developers/block-api/block-patterns/
 */

/**
 * Make sure that block patterns are enabled before registering.
 * Requires WordPress version 5.5 or Gutenberg version 7.8.
 */
if ( function_exists( 'register_block_pattern' ) ) {


	/**
	 * Check if the register_block_pattern_category exists.
	 * Requires WordPress 5.5 or Gutenberg version 8.2.
	 */
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'profile', array( 'label' => __( 'Users Profile', 'prefer-blog' ) ) );
		register_block_pattern_category( 'contact', array( 'label' => __( 'Contact Form', 'prefer-blog' ) ) );
	}

	/**
	 * Profile block with social links.
	*/
	/**
	 * Register the pattern.
	 */
	register_block_pattern(
		'prefer/profile',
		array(
			'title'       => __( 'Author Profile', 'prefer-blog' ),
			'categories'  => array( 'profile' ),
			'keywords'    => array( __( 'Profile', 'prefer-blog' ), __( 'User', 'prefer-blog' ) ),
			'description' => __( 'A profile pattern with photo, text content, social media links and latest posts.', 'prefer-blog' ),
			'content'     => '
				<!-- wp:columns {"verticalAlignment":"center"} -->
				<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":33.33} -->
				<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:image {"id":62,"sizeSlug":"large"} -->
				<figure class="wp-block-image size-large"><img src="' . esc_url( get_theme_file_uri( 'images/author.jpg' ) ) . '" alt="" class="wp-image-62"/></figure>
				<!-- /wp:image --></div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"center","width":66.66} -->
				<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:heading {"className":"author_title"} -->
				<h2 class="author_title">Ashley Graham</h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"author_designation"} -->
				<p class="author_designation"><em>Administrator</em></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph -->
				<p>At 29 years old, my favorite compliment is being told that I look like my mom. Seeing myself in her image, like this daughter up top, makes me so proud of how far I’ve come, and so thankful for where I come from.</p>
				<!-- /wp:paragraph -->

				<!-- wp:social-links -->
				<ul class="wp-block-social-links"><!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /-->

				<!-- wp:social-link {"url":"#","service":"facebook"} /-->

				<!-- wp:social-link {"url":"#","service":"twitter"} /-->

				<!-- wp:social-link {"url":"#","service":"instagram"} /-->

				<!-- wp:social-link {"url":"#","service":"linkedin"} /-->

				<!-- wp:social-link {"url":"#","service":"youtube"} /--></ul>
				<!-- /wp:social-links --></div>
				<!-- /wp:column --></div>
				<!-- /wp:columns -->',
		)
	);

/**
	 * Contact block with phone, email, map and form.
	 *
	 * Images are from fontawesome icons
	*/
	/**
	 * Register the pattern.
	 */
	register_block_pattern(
		'prefer/contact',
		array(
			'title'       => __( 'Contact Form', 'prefer-blog' ),
			'categories'  => array( 'contact' ),
			'keywords'    => array( __( 'Contact', 'prefer-blog' ), __( 'User', 'prefer-blog' ) ),
			'description' => __( 'A contact form pattern with form, email ,phone, etc.', 'prefer-blog' ),
			'content'     => '
				<!-- wp:columns -->
				<div class="wp-block-columns"><!-- wp:column {"width":40} -->
				<div class="wp-block-column" style="flex-basis:40%"><!-- wp:heading -->
				<h2>Contact Information</h2>
				<!-- /wp:heading -->

				<!-- wp:media-text {"mediaId":350,"mediaLink":"' . esc_url( get_theme_file_uri( 'images/email-icon.png' ) ) . '","mediaType":"image","mediaWidth":15,"verticalAlignment":"center"} -->
				<div class="wp-block-media-text alignwide is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:15% auto"><figure class="wp-block-media-text__media"><img src="' . esc_url( get_theme_file_uri( 'images/email-icon.png' ) ) . '" alt="" class="wp-image-350"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"className":"m_b_0 font-20"} -->
				<p class="m_b_0 font-20"><strong>Mail Information</strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"m_b_0"} -->
				<p class="m_b_0">info@templatesell.com</p>
				<!-- /wp:paragraph --></div></div>
				<!-- /wp:media-text -->

				<!-- wp:media-text {"mediaId":351,"mediaLink":"' . esc_url( get_theme_file_uri( 'images/map-icon.png' ) ) . '","mediaType":"image","mediaWidth":15,"verticalAlignment":"center"} -->
				<div class="wp-block-media-text alignwide is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:15% auto"><figure class="wp-block-media-text__media"><img src="' . esc_url( get_theme_file_uri( 'images/map-icon.png' ) ) . '" alt="" class="wp-image-351"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"className":"m_b_0 font-20"} -->
				<p class="m_b_0 font-20"><strong>Our Main Office Address</strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"m_b_0"} -->
				<p class="m_b_0">FA - 154 Careon Street, California, USA</p>
				<!-- /wp:paragraph --></div></div>
				<!-- /wp:media-text -->

				<!-- wp:media-text {"mediaId":352,"mediaLink":"' . esc_url( get_theme_file_uri( 'images/phone-icon.png' ) ) . '","mediaType":"image","mediaWidth":15,"verticalAlignment":"center"} -->
				<div class="wp-block-media-text alignwide is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:15% auto"><figure class="wp-block-media-text__media"><img src="' . esc_url( get_theme_file_uri( 'images/phone-icon.png' ) ) . '" alt="" class="wp-image-352"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"className":"m_b_0 font-20"} -->
				<p class="m_b_0 font-20"><strong>Call Us Now</strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"m_b_0"} -->
				<p class="m_b_0">+435-64773728, +062-35363782</p>
				<!-- /wp:paragraph --></div></div>
				<!-- /wp:media-text --></div>
				<!-- /wp:column -->

				<!-- wp:column -->
				<div class="wp-block-column"><!-- wp:heading -->
				<h2>Type Message</h2>
				<!-- /wp:heading -->

				<!-- wp:shortcode -->
				[contact-form-7 id="356" title="Contact form 1"]
				<!-- /wp:shortcode --></div>
				<!-- /wp:column --></div>
				<!-- /wp:columns -->

				',
		)
	);

}