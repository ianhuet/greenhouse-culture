<?php
/**
 * Added prefer Page.
*/

/**
 * Add a new page under Appearance
 */
function greenhouseculture_menu() {
	add_menu_page( __( 'Greenhouseculture Options', 'greenhouseculture' ), __( 'Greenhouseculture Options', 'greenhouseculture' ), 'edit_theme_options', 'greenhouseculture-theme', 'greenhouseculture_page' );
}
add_action( 'admin_menu', 'greenhouseculture_menu' );

/**
 * Enqueue styles for the help page.
 */
function greenhouseculture_admin_scripts() {
	if(is_admin()){
		wp_enqueue_style( 'greenhouseculture-admin-style', get_template_directory_uri() . '/templatesell/about/about.css', array(), '' );
 }
}
add_action( 'admin_enqueue_scripts', 'greenhouseculture_admin_scripts' );

/**
 * Add the theme page
 */
function greenhouseculture_page() {
	?>
	<div class="das-wrap">
		<div class="greenhouseculture-panel">
			<div class="greenhouseculture-logo">
				<img class="ts-logo" src="<?php echo esc_url( get_template_directory_uri() . '/templatesell/about/images/greenhouseculture-logo.png' ); ?>" alt="Logo">
			</div>
			<a href="https://www.templatesell.com/item/greenhouseculture-plus/" target="_blank" class="btn btn-success pull-right"><?php esc_html_e( 'Upgrade Pro $49', 'greenhouseculture' ); ?></a>
			<p>
			<?php esc_html_e( 'A perfect theme for blog and magazine site. With masonry layout and multiple blog page layout, this theme is the awesome and minimal theme.', 'greenhouseculture' ); ?></p>
			<a class="btn btn-primary" href="<?php echo esc_url (admin_url( '/customize.php?' ));
				?>"><?php esc_html_e( 'Theme Options - Click Here', 'greenhouseculture' ); ?></a>
		</div>

		<div class="greenhouseculture-panel">
			<div class="greenhouseculture-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'Looking for theme Documentation?', 'greenhouseculture' ); ?></h3>
				</div>
				<a href="http://www.docs.templatesell.net/prefer" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Documentation - Click Here', 'greenhouseculture' ); ?></a>
			</div>
		</div>
		<div class="greenhouseculture-panel">
			<div class="greenhouseculture-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'If you like the theme, please leave a review', 'greenhouseculture' ); ?></h3>
				</div>
				<a href="https://wordpress.org/support/theme/prefer/reviews/#new-post" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Rate this theme', 'greenhouseculture' ); ?></a>
			</div>
		</div>
	</div>
	<?php
}
