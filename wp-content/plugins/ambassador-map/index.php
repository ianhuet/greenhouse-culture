<?php
/**
 * Plugin Name: Ambassador Map
 * Description: Interactive Leaflet map with clusters, search, tag chips, and a results panel. Shortcode: [ambassador_map]
 * Version:     1.0.0
 * Author:      Greenhouse Culture & Aarthy Adhibagavan
 * License:     GPL-2.0+
 */

if ( ! defined('ABSPATH') ) exit;

require_once plugin_dir_path(__FILE__) . 'includes/ambassador-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/ambassador-settings.php';

register_activation_hook(__FILE__, 'ghc_create_ambassador_role');
register_deactivation_hook(__FILE__, 'ghc_remove_ambassador_role');

add_action('init', function() {
  add_action('show_user_profile', 'ghc_add_user_profile_fields');
  add_action('edit_user_profile', 'ghc_add_user_profile_fields');
  add_action('personal_options_update', 'ghc_save_user_profile_fields');
  add_action('edit_user_profile_update', 'ghc_save_user_profile_fields');
});

add_action('wp_ajax_ghc_geocode', 'ghc_handle_geocode_ajax');

if ( ! function_exists('ghc_enqueue_leaflet_and_cluster') ) {
  function ghc_enqueue_leaflet_and_cluster() {
    wp_enqueue_style('leaflet-css','https://unpkg.com/leaflet/dist/leaflet.css',[],null);
    wp_enqueue_script('leaflet-js','https://unpkg.com/leaflet/dist/leaflet.js',[],null,true);

    wp_enqueue_style('markercluster-css','https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css',[],null);
    wp_enqueue_style('markercluster-default-css','https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css',[],null);
    wp_enqueue_script('markercluster-js','https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js',['leaflet-js'],null,true);
    
    wp_enqueue_style('ambassador-map-css', plugin_dir_url(__FILE__) . 'assets/css/ambassador-map.css', [], '1.0.0');
    wp_enqueue_script('ambassador-map-js', plugin_dir_url(__FILE__) . 'assets/js/ambassador-map.js', ['leaflet-js', 'markercluster-js'], '1.0.0', true);
  }
  add_action('wp_enqueue_scripts','ghc_enqueue_leaflet_and_cluster');
}

add_shortcode('ambassador_map', function ($atts) {
  $atts = shortcode_atts([
    'private' => 'true'
  ], $atts);

  $is_private = filter_var($atts['private'], FILTER_VALIDATE_BOOLEAN);

  $rows = ghc_get_ambassador_data_rows();
  $tags = ghc_get_ambassador_unique_tags();
  $tags_html = ghc_get_ambassador_tags_html($tags);

  $svg_data = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="36" height="52" viewBox="0 0 36 52"><path d="M18 0c9.94 0 18 8.06 18 18 0 12.61-14.03 27.28-17.32 31a1 1 0 0 1-1.36 0C14.03 45.28 0 30.61 0 18 0 8.06 8.06 0 18 0z" fill="%236bb766"/><circle cx="18" cy="18" r="7" fill="white"/></svg>';

  wp_localize_script('ambassador-map-js', 'ambassadorMapData', [
    'rows' => $rows,
    'iconUrl' => $svg_data,
    'isPrivate' => $is_private
  ]);

  return ghc_render_ambassador_map_html($tags_html, $is_private);
});
