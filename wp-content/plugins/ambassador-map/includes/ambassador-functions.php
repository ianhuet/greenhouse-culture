<?php
if ( ! defined('ABSPATH') ) exit;

// User Type: Amabassador

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
  
  $address = get_user_meta($user->ID, 'ambassador_address', true);
  $ambassador_bio = get_user_meta($user->ID, 'ambassador_bio', true);
  $ambassador_tags = get_user_meta($user->ID, 'ambassador_tags', true);
  $latitude = get_user_meta($user->ID, 'latitude', true);
  $longitude = get_user_meta($user->ID, 'longitude', true);
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
      <th><label for="ambassador_address">Address</label></th>
      <td>
        <input type="text" name="ambassador_address" id="ambassador_address" value="<?php echo esc_attr($address); ?>" placeholder="e.g., 123 Main St, Dublin, Ireland" style="width: 400px;" />
        <button type="button" id="geocode_address" class="button" style="margin-left: 10px;">Look up coordinates</button>
        <p class="description">Enter your address and click "Look up coordinates" to auto-populate latitude/longitude</p>
        <div id="geocode_status" style="margin-top: 5px;"></div>
      </td>
    </tr>
    <tr>
      <th><label for="latitude">Latitude</label></th>
      <td>
        <input type="text" name="latitude" id="latitude" value="<?php echo esc_attr($latitude); ?>" placeholder="e.g., 53.3498" />
        <p class="description">Required for map display (auto-populated from address lookup)</p>
      </td>
    </tr>
    <tr>
      <th><label for="longitude">Longitude</label></th>
      <td>
        <input type="text" name="longitude" id="longitude" value="<?php echo esc_attr($longitude); ?>" placeholder="e.g., -6.2603" />
        <p class="description">Required for map display (auto-populated from address lookup)</p>
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
  <p><em>Use the address lookup above or <a href="https://www.latlong.net/" target="_blank">LatLong.net</a> to find coordinates.</em></p>
  
  <script>
  jQuery(document).ready(function($) {
    $('#geocode_address').on('click', function() {
      var address = $('#ambassador_address').val();
      var statusDiv = $('#geocode_status');
      
      if (!address) {
        statusDiv.html('<span style="color: red;">Please enter an address first.</span>');
        return;
      }
      
      $(this).prop('disabled', true).text('Looking up...');
      statusDiv.html('<span style="color: blue;">Searching for coordinates...</span>');
      
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'ghc_geocode',
          address: address,
          nonce: '<?php echo wp_create_nonce('ghc_geocode_nonce'); ?>'
        },
        success: function(response) {
          if (response.success) {
            $('#latitude').val(response.data.latitude);
            $('#longitude').val(response.data.longitude);
            statusDiv.html('<span style="color: green;">✓ Coordinates found: ' + response.data.display_name + '</span>');
          } else {
            statusDiv.html('<span style="color: red;">Error: ' + response.data.message + '</span>');
          }
        },
        error: function() {
          statusDiv.html('<span style="color: red;">Error: Failed to connect to geocoding service.</span>');
        },
        complete: function() {
          $('#geocode_address').prop('disabled', false).text('Look up coordinates');
        }
      });
    });
  });
  </script>
  <?php
}

function ghc_save_user_profile_fields($user_id) {
  if (!current_user_can('edit_user', $user_id)) {
    return;
  }
  
  if (isset($_POST['ambassador_address'])) {
    update_user_meta($user_id, 'ambassador_address', sanitize_text_field($_POST['ambassador_address']));
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

// Admin: Amabassador address lookup

function ghc_geocode_address($address) {
  if (empty($address)) {
    return ['error' => 'Address is required'];
  }
  
  $api_url = 'https://nominatim.openstreetmap.org/search';
  $params = [
    'addressdetails' => 1,
    'format' => 'json',
    'limit' => 1,
    'q' => $address
  ];
  
  $request_url = add_query_arg($params, $api_url);
  
  $response = wp_remote_get($request_url, [
    'timeout' => 10,
    'user-agent' => 'WordPress Ambassador Plugin/1.0 (' . home_url() . ')'
  ]);
  
  if (is_wp_error($response)) {
    return ['error' => 'Failed to connect to geocoding service'];
  }
  
  $body = wp_remote_retrieve_body($response);
  $data = json_decode($body, true);
  
  if (empty($data)) {
    return ['error' => 'Address not found'];
  }
  
  $result = $data[0];
  
  return [
    'success' => true,
    'latitude' => $result['lat'],
    'longitude' => $result['lon'],
    'display_name' => $result['display_name']
  ];
}

function ghc_handle_geocode_ajax() {
  check_ajax_referer('ghc_geocode_nonce', 'nonce');
  
  if (!current_user_can('edit_users')) {
    wp_die('Permission denied');
  }
  
  $address = sanitize_text_field($_POST['address'] ?? '');
  
  if (empty($address)) {
    wp_send_json_error(['message' => 'Address is required']);
  }
  
  $result = ghc_geocode_address($address);
  
  if (isset($result['error'])) {
    wp_send_json_error(['message' => $result['error']]);
  }
  
  wp_send_json_success($result);
}

// UI: Amabassador Map

function ghc_get_ambassador_unique_tags() {
  $ambassadors = get_users(['role' => 'ambassador']);
  $all_tags = [];
  
  foreach ($ambassadors as $user) {
    $user_tags = get_user_meta($user->ID, 'ambassador_tags', true);
    if ($user_tags && is_array($user_tags)) {
      $user_tags = array_map('strtolower', $user_tags);
      $all_tags = array_merge($all_tags, $user_tags);
    }
  }
  
  return array_unique($all_tags);
}

function ghc_get_ambassador_card_html($id, $title, $content, $img_url, $tags = []) {
  $row_id = esc_attr($id);
  $escaped_title = esc_html($title);
  $profile_img = ghc_get_ambassador_image_html($title, $img_url);
  $tags_list = join(', ', $tags);

  return <<<HTML
    <div class="ambResultPanel__list__row" data-id="{$row_id}">
      {$profile_img}

      <div>
        <h4>{$escaped_title}</h4>
        <p>{$tags_list}</p>
      </div>
    </div>
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

    $id = $user->ID;
    $title = $user->display_name ?: $user->user_login;
    $content = get_user_meta($user->ID, 'ambassador_bio', true) ?: $user->description;
    $img_url = get_avatar_url($user->ID, ['size' => 150]);
    $tag_names = get_user_meta($user->ID, 'ambassador_tags', true) ?: [];
    $tag_slugs = array_map('sanitize_title', $tag_names);

    $card = ghc_get_ambassador_card_html($id, $title, $content, $img_url, $tag_names);
    $popup = ghc_get_ambassador_popup_html($title, $content, $img_url, $tag_names);

    $rows[] = [
      'card'  => $card,
      'html'  => $popup,
      'id'    => $user->ID,
      'lat'   => $lat,
      'lng'   => $lng,
      'terms' => $tag_slugs,
      'text'  => wp_strip_all_tags($title.' '.$content),
      'title' => $title,
    ];
  }

  return $rows;
}

function ghc_get_ambassador_image_html($title, $img_url = '') {
  $profile_image = '';

  if ($img_url) {
    $profile_image = '<img src="'.esc_url($img_url).'" alt="'.esc_attr($title).'">';
  }

  return $profile_image;
}

function ghc_get_ambassador_tags_html($tags = []) {
  if (!is_array($tags) || empty($tags)) {
    return '';
  }

  $tags_html = '<div class="ambTagsBox">';
  foreach ($tags as $tag) {
    $slug = sanitize_title($tag);
    $tags_html .= '<span class="ambTagsBox__tag" data-term="'.esc_attr($slug).'" id="amb-tag">'.esc_html($tag).'</span>';
  }
  $tags_html .= '</div>';

  return $tags_html;
}

function ghc_get_ambassador_popup_html($title, $content, $img_url, $tags = []) {
  $escaped_title = esc_html($title);
  $formatted_content = nl2br(esc_html($content));
  $profile_image = ghc_get_ambassador_image_html($title, $img_url);
  $tags_html = ghc_get_ambassador_tags_html($tags);

  return <<<HTML
    <div class="ambPopup">
      <h3 class="ambPopup__title">{$escaped_title}</h3>

      <div class="ambPopup__body">
        {$profile_image}

        <div class="ambPopupBody__content">{$formatted_content}</div>
      </div>

      <div class="ambPopup__tagsBox ambTagsBox" id="amb-tags">{$tags_html}</div>
    </div>
HTML;
}

function ghc_render_ambassador_map_html($tags_html) {
  return <<<HTML
    <div class="ambassador-map">
      <div class="ambHeader">
        <div class="ambHeader__searchBox">
          <input class="ambHeader__searchBox__input" id="amb-search" placeholder="Search ambassadors, skills, topics…" type="text">
          <button class="ambHeader__searchBox__clear" id="amb-clear" type="button">Clear filters</button>
        </div>

        <div class="ambHeader__tagsBox ambTagsBox" id="amb-tags">{$tags_html}</div>
      </div>

      <div class="ambBody">
        <div class="ambMap" id="ambassadors-map"></div>

        <aside class="ambResultPanel" id="amb-panel">
          <div class="ambResultPanel__header">
            <p class="ambResultPanel__header__count"><span id="amb-count">0</span> result(s)</p>
          </div>

          <div class="ambResultPanel__list" id="amb-list"></div>
        </aside>
      </div>
    </div>
  HTML;
}
