<?php
if ( ! defined('ABSPATH') ) exit;

function ghc_get_ambassador_popup_html($title, $content, $permalink, $image_url) {
  $profile_image = null;
  if ($img_url) {
    $profile_image = '<div class="ambPopup_image"><img src="'.esc_url($img_url).'" alt="'.esc_attr($title).'"></div>';
  }

  return <<<HTML
    <div class="ambPopup">
      {$profile_image}

      <div class="ambPopup__body">
        <h3 class="ambPopupBody__title">{esc_html($title)}</h3>
        <div class="ambPopupBody__content">{$content}</div>
        <a class="ambPopupBody__link" href="{esc_url($permalink)}">View full profile</a>
      </div>
    </div>
HTML;
}

function ghc_get_ambassador_card_html($title, $content, $permalink, $img_url, $term_names) {
  $card_image = '<div class="amb-row-img amb-row-img--placeholder">🌱</div>';
  if ($img_url) {
    $card_image = '<img class="amb-row-img" src="'.esc_url($img_url).'" alt="'.esc_attr($title).'">';
  }

  // if ($term_names) {
  //   <div class="amb-row-tags">';
  //   foreach ($term_names as $tn) { <span class="amb-tag">'.esc_html($tn).'</span>'; }
  //   </div>';
  // }

  return <<<HTML
    <article class="amb-card-row" data-id="{esc_attr($a->ID)}">
      <div class="amb-row-left">
        {$card_image}
      </div>
      
      <div class="amb-row-body">
        <h4 class="amb-row-title">{esc_html($title)}</h4>

        {$term_names}

        <div class="amb-row-actions">
          <a href="{esc_url($permalink)}" class="amb-btn">View profile</a>
          <button class="amb-btn amb-btn--ghost" data-focus="{esc_attr($a->ID)}">Show on map</button>
        </div>
      </div>
    </article>
HTML;
}

function ghc_get_ambassador_data_rows() {
  $ambassadors = get_posts([
    'post_status'    => 'publish',
    'post_type'      => 'ambassador',
    'posts_per_page' => -1,
  ]);

  $rows = [];
  foreach ($ambassadors as $a) {
    $lat = get_post_meta($a->ID,'latitude',true);
    $lng = get_post_meta($a->ID,'longitude',true);
    if (!$lat || !$lng) continue;

    $content    = apply_filters('the_content',$a->post_content);
    $img_url    = get_the_post_thumbnail_url($a->ID,'medium');
    $permalink  = get_permalink($a);
    $term_names = wp_get_post_terms($a->ID,'amb_tag',['fields'=>'names']);
    $term_slugs = wp_get_post_terms($a->ID,'amb_tag',['fields'=>'slugs']);
    $title      = get_the_title($a);

    $card = ghc_get_ambassador_card_html($title, $content, $permalink, $img_url, $term_names);
    $popup = ghc_get_ambassador_popup_html($title, $content, $permalink, $img_url);

    $rows[] = [
      'card'  => $card,
      'html'  => $popup,
      'id'    => $a->ID,
      'lat'   => $lat,
      'lng'   => $lng,
      'terms' => $term_slugs,
      'text'  => wp_strip_all_tags($title.' '.$a->post_content),
      'title' => $title,
    ];
  }

  return $rows;
}

function ghc_get_ambassador_terms_html() {
  $terms = get_terms(['taxonomy'=>'amb_tag','hide_empty'=>true]);
  $chips_html = '';
  if ( ! is_wp_error($terms) && $terms ) {
    foreach ($terms as $t) {
      $chips_html .= '<span class="amb-chip" data-term="'.esc_attr($t->slug).'">'.esc_html($t->name).'</span>';
    }
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