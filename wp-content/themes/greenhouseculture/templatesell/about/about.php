<?php
/**
 * Added prefer Page.
*/

/**
 * Add a new page under Appearance
 */
function prefer_menu() {
	add_menu_page( __( 'Prefer Options', 'prefer' ), __( 'Prefer Options', 'prefer' ), 'edit_theme_options', 'prefer-theme', 'prefer_page' );
}
add_action( 'admin_menu', 'prefer_menu' );

/**
 * Enqueue styles for the help page.
 */
function prefer_admin_scripts() {
	if(is_admin()){
		wp_enqueue_style( 'prefer-admin-style', get_stylesheet_directory_uri() . '/templatesell/about/about.css', array(), '' );
 }
} 
add_action( 'admin_enqueue_scripts', 'prefer_admin_scripts' );

/**
 * Add the theme page
 */
function prefer_page() {
	?>
	<div class="das-wrap">
		<div class="prefer-panel">
			<div class="prefer-logo">
				<img class="ts-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/templatesell/about/images/prefer-logo.png' ); ?>" alt="Logo">
			</div>
			<a href="https://www.templatesell.com/item/prefer-plus/" target="_blank" class="btn btn-success pull-right"><?php esc_html_e( 'Upgrade Pro $49', 'prefer' ); ?></a>
			<p>
			<?php esc_html_e( 'A perfect theme for blog and magazine site. With masonry layout and multiple blog page layout, this theme is the awesome and minimal theme.', 'prefer' ); ?></p>
			<a class="btn btn-primary" href="<?php echo esc_url (admin_url( '/customize.php?' ));
				?>"><?php esc_html_e( 'Theme Options - Click Here', 'prefer' ); ?></a>
		</div>

		<div class="prefer-panel">
			<div class="prefer-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'Looking for theme Documentation?', 'prefer' ); ?></h3>
				</div>
				<a href="http://www.docs.templatesell.net/prefer" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Documentation - Click Here', 'prefer' ); ?></a>
			</div>
		</div>
		<div class="prefer-panel">
			<div class="prefer-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'If you like the theme, please leave a review', 'prefer' ); ?></h3>
				</div>
				<a href="https://wordpress.org/support/theme/prefer/reviews/#new-post" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Rate this theme', 'prefer' ); ?></a>
			</div>
		</div>
	</div>
	<?php
}
