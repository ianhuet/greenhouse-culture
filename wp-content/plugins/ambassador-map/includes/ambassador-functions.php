<?php
if ( ! defined('ABSPATH') ) exit;

function ghc_create_ambassador_role() {
  add_role('ambassador', 'Ambassador', [
    'read' => true,
    'edit_posts' => false,
    'upload_files' => true
  ]);
}

function ghc_remove_ambassador_role() {
  remove_role('ambassador');
}

function ghc_add_user_profile_fields($user) {
  if (!current_user_can('edit_user', $user->ID)) {
    return;
  }
  
  $latitude = get_user_meta($user->ID, 'latitude', true);
  $longitude = get_user_meta($user->ID, 'longitude', true);
  $ambassador_bio = get_user_meta($user->ID, 'ambassador_bio', true);
  $ambassador_tags = get_user_meta($user->ID, 'ambassador_tags', true);
  $tags_string = is_array($ambassador_tags) ? implode(', ', $ambassador_tags) : '';
  ?>
  <h3>Ambassador Information</h3>
  <table class="form-table">
    <tr>
      <th><label for="ambassador_bio">Ambassador Bio</label></th>
      <td>
        <textarea name="ambassador_bio" id="ambassador_bio" rows="5" cols="30"><?php echo esc_textarea($ambassador_bio); ?></textarea>
        <p class="description">Extended bio for ambassador profile (optional, uses Description field if empty)</p>
      </td>
    </tr>
    <tr>
      <th><label for="latitude">Latitude</label></th>
      <td>
        <input type="text" name="latitude" id="latitude" value="<?php echo esc_attr($latitude); ?>" placeholder="e.g., 53.3498" />
        <p class="description">Required for map display</p>
      </td>
    </tr>
    <tr>
      <th><label for="longitude">Longitude</label></th>
      <td>
        <input type="text" name="longitude" id="longitude" value="<?php echo esc_attr($longitude); ?>" placeholder="e.g., -6.2603" />
        <p class="description">Required for map display</p>
      </td>
    </tr>
    <tr>
      <th><label for="ambassador_tags">Tags</label></th>
      <td>
        <input type="text" name="ambassador_tags" id="ambassador_tags" value="<?php echo esc_attr($tags_string); ?>" />
        <p class="description">Comma-separated list of skills/topics (e.g., "JavaScript, React, Frontend")</p>
      </td>
    </tr>
  </table>
  <p><em>Use <a href="https://www.latlong.net/" target="_blank">LatLong.net</a> to find coordinates.</em></p>
  <?php
}

function ghc_save_user_profile_fields($user_id) {
  if (!current_user_can('edit_user', $user_id)) {
    return;
  }
  
  if (isset($_POST['latitude'])) {
    update_user_meta($user_id, 'latitude', sanitize_text_field($_POST['latitude']));
  }
  
  if (isset($_POST['longitude'])) {
    update_user_meta($user_id, 'longitude', sanitize_text_field($_POST['longitude']));
  }
  
  if (isset($_POST['ambassador_bio'])) {
    update_user_meta($user_id, 'ambassador_bio', sanitize_textarea_field($_POST['ambassador_bio']));
  }
  
  if (isset($_POST['ambassador_tags'])) {
    $tags_string = sanitize_text_field($_POST['ambassador_tags']);
    $tags_array = array_map('trim', explode(',', $tags_string));
    $tags_array = array_filter($tags_array);
    update_user_meta($user_id, 'ambassador_tags', $tags_array);
  }
}

function ghc_get_ambassador_popup_html($title, $content, $permalink, $image_url) {
  $profile_image = '';
  if ($image_url) {
    $profile_image = '<div class="ambPopup_image"><img src="'.esc_url($image_url).'" alt="'.esc_attr($title).'"></div>';
  }

  return <<<HTML
    <div class="ambPopup">
      {$profile_image}

      <div class="ambPopup__body">
        <h3 class="ambPopupBody__title">'.esc_html($title).'</h3>
        <div class="ambPopupBody__content">'.wp_kses_post($content).'</div>
        <a class="ambPopupBody__link" href="'.esc_url($permalink).'">View full profile</a>
      </div>
    </div>
HTML;
}

function ghc_get_ambassador_card_html($title, $content, $permalink, $img_url, $term_names, $user_id) {
  $card_image = '<div class="amb-row-img amb-row-img--placeholder">🌱</div>';
  if ($img_url) {
    $card_image = '<img class="amb-row-img" src="'.esc_url($img_url).'" alt="'.esc_attr($title).'">';
  }

  $tags_html = '';
  if ($term_names && is_array($term_names) && !empty($term_names)) {
    $tags_html = '<div class="amb-row-tags">';
    foreach ($term_names as $tag) {
      $tags_html .= '<span class="amb-tag">'.esc_html($tag).'</span>';
    }
    $tags_html .= '</div>';
  }

  return <<<HTML
    <article class="amb-card-row" data-id="'.esc_attr($user_id).'">
      <div class="amb-row-left">
        {$card_image}
      </div>
      
      <div class="amb-row-body">
        <h4 class="amb-row-title">'.esc_html($title).'</h4>

        {$tags_html}

        <div class="amb-row-actions">
          <a href="'.esc_url($permalink).'" class="amb-btn">View profile</a>
          <button class="amb-btn amb-btn--ghost" data-focus="'.esc_attr($user_id).'">Show on map</button>
        </div>
      </div>
    </article>
HTML;
}

function ghc_get_ambassador_data_rows() {
  $ambassadors = get_users([
    'role' => 'ambassador',
    'meta_query' => [
      'relation' => 'AND',
      [
        'key' => 'latitude',
        'value' => '',
        'compare' => '!='
      ],
      [
        'key' => 'longitude', 
        'value' => '',
        'compare' => '!='
      ]
    ]
  ]);

  $rows = [];
  foreach ($ambassadors as $user) {
    $lat = get_user_meta($user->ID, 'latitude', true);
    $lng = get_user_meta($user->ID, 'longitude', true);
    if (!$lat || !$lng) continue;

    $title = $user->display_name ?: $user->user_login;
    $content = get_user_meta($user->ID, 'ambassador_bio', true) ?: $user->description;
    $img_url = get_avatar_url($user->ID, ['size' => 150]);
    $permalink = get_author_posts_url($user->ID);
    $term_names = get_user_meta($user->ID, 'ambassador_tags', true) ?: [];
    $term_slugs = array_map('sanitize_title', $term_names);

    $card = ghc_get_ambassador_card_html($title, $content, $permalink, $img_url, $term_names, $user->ID);
    $popup = ghc_get_ambassador_popup_html($title, $content, $permalink, $img_url);

    $rows[] = [
      'card'  => $card,
      'html'  => $popup,
      'id'    => $user->ID,
      'lat'   => $lat,
      'lng'   => $lng,
      'terms' => $term_slugs,
      'text'  => wp_strip_all_tags($title.' '.$content),
      'title' => $title,
    ];
  }

  return $rows;
}

function ghc_get_ambassador_terms_html() {
  $ambassadors = get_users(['role' => 'ambassador']);
  $all_tags = [];
  
  foreach ($ambassadors as $user) {
    $user_tags = get_user_meta($user->ID, 'ambassador_tags', true);
    if ($user_tags && is_array($user_tags)) {
      $all_tags = array_merge($all_tags, $user_tags);
    }
  }
  
  $unique_tags = array_unique($all_tags);
  $chips_html = '';
  
  foreach ($unique_tags as $tag) {
    $slug = sanitize_title($tag);
    $chips_html .= '<span class="amb-chip" data-term="'.esc_attr($slug).'">'.esc_html($tag).'</span>';
  }
  
  return $chips_html;
}

function ghc_render_ambassador_map_html($chips_html) {
  $chips_section = $chips_html ? '<div id="amb_chips" class="amb-chipbar">'.$chips_html.'</div>' : '';

  return <<<HTML
    <div class="amb-wrap">
      <div class="amb-inner">
        <div class="amb-header">
          <div class="amb-controls">
            <div class="amb-searchbar">
              <input id="amb_search" class="amb-input" type="text" placeholder="Search ambassadors, skills, topics…">
              <button id="amb_clear" class="amb-chip amb-clear" type="button">Clear filters ✕</button>
            </div>

            {$chips_section}
          </div>
        </div>

        <div class="amb-layout">
          <div id="amb_map"></div>

          <aside class="amb-panel">
            <div class="amb-panel-head">
              <span class="amb-count"><span id="amb_count">0</span> result(s)</span>
            </div>

            <div id="amb_list" class="amb-list"></div>
          </aside>
        </div>
      </div>
    </div>
HTML;
}