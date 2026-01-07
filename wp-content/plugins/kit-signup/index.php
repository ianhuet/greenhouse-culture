<?php
/**
 * Plugin Name: Kit Newsletter Signup
 * Description: Newsletter signup form integrated with Kit API v4. Shortcode: [kit_signup]
 * Version:     1.0.0
 * Author:      Greenhouse Culture
 * License:     GPL-2.0+
 */

if (!defined('ABSPATH')) exit;

define('KIT_SIGNUP_API_KEY', 'kit_16285884175424ac0af932d4186790d0');
define('KIT_SIGNUP_FORM_ID', 8497275);
define('KIT_SIGNUP_MESSAGE_ERROR', 'Unable to sign-up. Please try again.');
define('KIT_SIGNUP_MESSAGE_SUCCESS', 'Successfully subscribed! Check your email.');
define('KIT_SIGNUP_PLACEHOLDER_EMAIL', 'Email Address');
define('KIT_SIGNUP_PLACEHOLDER_NAME', 'Name');
define('KIT_SIGNUP_BUTTON_TEXT', 'Sign-Up');

require_once plugin_dir_path(__FILE__) . 'includes/kit-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/kit-admin.php';

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'kit_signup_action_links');

function kit_signup_action_links($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=kit-signup') . '">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

add_shortcode('kit_signup', 'kit_signup_render_form');
add_shortcode('kit_signup_panel', 'kit_signup_render_panel');

function kit_signup_render_panel($atts) {
    $settings = kit_signup_get_settings();

    ob_start();
    ?>
    <section class="kit-signup-panel">
        <h3><?php echo esc_html($settings['panel_title']); ?></h3>
        <div class="kit-signup-panel-content">
            <div>
                <?php echo wp_kses_post(wpautop($settings['panel_content'])); ?>
            </div>
            <?php echo kit_signup_render_form([]); ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function kit_signup_render_form($atts) {
    $nonce = wp_create_nonce('kit_signup_nonce');

    ob_start();
    ?>
    <form class="kit-signup-form" method="post">
        <input type="hidden" name="kit_signup_nonce" value="<?php echo esc_attr($nonce); ?>">
        <div class="kit-signup-honeypot" aria-hidden="true">
            <input type="text" name="kit_signup_website" tabindex="-1" autocomplete="off">
        </div>

        <input
            type="text"
            name="kit_signup_name"
            placeholder="<?php echo esc_attr(KIT_SIGNUP_PLACEHOLDER_NAME); ?>"
            required
        >
        <input
            type="email"
            name="kit_signup_email"
            placeholder="<?php echo esc_attr(KIT_SIGNUP_PLACEHOLDER_EMAIL); ?>"
            required
        >

        <button type="submit"><?php echo esc_html(KIT_SIGNUP_BUTTON_TEXT); ?></button>
        <div class="kit-signup-message" aria-live="polite"></div>
    </form>
    <?php
    return ob_get_clean();
}

add_action('wp_ajax_kit_signup_submit', 'kit_signup_handle_ajax');
add_action('wp_ajax_nopriv_kit_signup_submit', 'kit_signup_handle_ajax');

add_action('wp_enqueue_scripts', 'kit_signup_enqueue_scripts');

function kit_signup_enqueue_scripts() {
    wp_enqueue_style(
        'kit-signup-css',
        plugin_dir_url(__FILE__) . 'assets/css/kit-signup.css',
        [],
        '1.0.0'
    );

    wp_enqueue_script(
        'kit-signup-js',
        plugin_dir_url(__FILE__) . 'assets/js/kit-signup.js',
        [],
        '1.0.0',
        true
    );

    wp_localize_script('kit-signup-js', 'kitSignupData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'messageSuccess' => KIT_SIGNUP_MESSAGE_SUCCESS,
        'messageError' => KIT_SIGNUP_MESSAGE_ERROR
    ]);
}
