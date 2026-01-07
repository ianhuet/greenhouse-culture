<?php

if (!defined('ABSPATH')) exit;

function kit_signup_get_settings() {
    $defaults = [
        'append_to_pages' => false,
        'append_to_posts' => false,
        'append_to_events' => false,
        'panel_title' => 'Greenhouse Culture Newsletter',
        'panel_content' => '<p>We warmly invite you to stay connected as the programme evolves. Sign up for our newsletter to receive updates on the Biodiversity Ambassador Programme, Greenhouse Culture projects, new resources, and ways to engage with us.</p>
<p>Join a growing community of people who care about restoring balance, protecting wild places, and honouring the rich web of life we all depend on.</p>'
    ];
    return wp_parse_args(get_option('kit_signup_settings', []), $defaults);
}

function kit_signup_admin_menu() {
    add_options_page(
        'Kit Signup Settings',
        'Kit Signup',
        'manage_options',
        'kit-signup',
        'kit_signup_settings_page'
    );
}
add_action('admin_menu', 'kit_signup_admin_menu');

function kit_signup_register_settings() {
    register_setting('kit_signup_options', 'kit_signup_settings', [
        'sanitize_callback' => 'kit_signup_sanitize_settings'
    ]);
}
add_action('admin_init', 'kit_signup_register_settings');

function kit_signup_sanitize_settings($input) {
    return [
        'append_to_pages' => !empty($input['append_to_pages']),
        'append_to_posts' => !empty($input['append_to_posts']),
        'append_to_events' => !empty($input['append_to_events']),
        'panel_title' => sanitize_text_field($input['panel_title'] ?? ''),
        'panel_content' => wp_kses_post($input['panel_content'] ?? '')
    ];
}

function kit_signup_settings_page() {
    $settings = kit_signup_get_settings();
    ?>
    <div class="wrap">
        <h1>Kit Signup Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('kit_signup_options'); ?>

            <h2>Auto-append Form</h2>
            <p>Display the signup form after content on these post types:</p>

            <table class="form-table">
                <tr>
                    <th scope="row">Pages</th>
                    <td>
                        <label>
                            <input type="checkbox" name="kit_signup_settings[append_to_pages]" value="1" <?php checked($settings['append_to_pages']); ?>>
                            Append form after page content
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Posts</th>
                    <td>
                        <label>
                            <input type="checkbox" name="kit_signup_settings[append_to_posts]" value="1" <?php checked($settings['append_to_posts']); ?>>
                            Append form after post content
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Events</th>
                    <td>
                        <label>
                            <input type="checkbox" name="kit_signup_settings[append_to_events]" value="1" <?php checked($settings['append_to_events']); ?>>
                            Append form after event content
                        </label>
                    </td>
                </tr>
            </table>

            <p class="description">To exclude individual pages/posts/events, use the "Hide Kit Signup Form" checkbox in each editor.</p>

            <h2>Panel Content</h2>
            <p>Content displayed in the signup panel (used by [kit_signup_panel] shortcode and auto-append):</p>

            <table class="form-table">
                <tr>
                    <th scope="row"><label for="panel_title">Panel Title</label></th>
                    <td>
                        <input type="text" id="panel_title" name="kit_signup_settings[panel_title]" value="<?php echo esc_attr($settings['panel_title']); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="panel_content">Panel Content</label></th>
                    <td>
                        <textarea id="panel_content" name="kit_signup_settings[panel_content]" rows="8" class="large-text"><?php echo esc_textarea($settings['panel_content']); ?></textarea>
                        <p class="description">Separate paragraphs with blank lines.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function kit_signup_add_meta_box() {
    $settings = kit_signup_get_settings();
    $post_types = [];

    if ($settings['append_to_pages']) $post_types[] = 'page';
    if ($settings['append_to_posts']) $post_types[] = 'post';
    if ($settings['append_to_events']) $post_types[] = 'event';

    if (empty($post_types)) return;

    add_meta_box(
        'kit_signup_exclude',
        'Kit Signup',
        'kit_signup_meta_box_callback',
        $post_types,
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'kit_signup_add_meta_box');

function kit_signup_meta_box_callback($post) {
    wp_nonce_field('kit_signup_meta_box', 'kit_signup_meta_box_nonce');
    $excluded = get_post_meta($post->ID, '_kit_signup_exclude', true);
    ?>
    <label>
        <input type="checkbox" name="kit_signup_exclude" value="1" <?php checked($excluded, '1'); ?>>
        Hide Kit Signup form on this <?php echo esc_html(get_post_type_object($post->post_type)->labels->singular_name); ?>
    </label>
    <?php
}

function kit_signup_save_meta_box($post_id) {
    if (!isset($_POST['kit_signup_meta_box_nonce'])) return;
    if (!wp_verify_nonce($_POST['kit_signup_meta_box_nonce'], 'kit_signup_meta_box')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['kit_signup_exclude'])) {
        update_post_meta($post_id, '_kit_signup_exclude', '1');
    } else {
        delete_post_meta($post_id, '_kit_signup_exclude');
    }
}
add_action('save_post', 'kit_signup_save_meta_box');

function kit_signup_append_to_content($content) {
    if (!is_singular() || !is_main_query()) {
        return $content;
    }

    $settings = kit_signup_get_settings();
    $post_type = get_post_type();
    $post_id = get_the_ID();

    $should_append = false;

    if ($post_type === 'page' && $settings['append_to_pages']) {
        $should_append = true;
    } elseif ($post_type === 'post' && $settings['append_to_posts']) {
        $should_append = true;
    } elseif ($post_type === 'event' && $settings['append_to_events']) {
        $should_append = true;
    }

    if (!$should_append) {
        return $content;
    }

    if (get_post_meta($post_id, '_kit_signup_exclude', true) === '1') {
        return $content;
    }

    $panel = kit_signup_render_panel([]);

    return $content . $panel;
}
add_filter('the_content', 'kit_signup_append_to_content', 20);
