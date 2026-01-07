<?php
if ( ! defined('ABSPATH') ) exit;

function ghc_register_settings_page() {
  add_options_page(
    'Ambassador Map Settings',
    'Ambassador Map',
    'manage_options',
    'ambassador-map-settings',
    'ghc_render_settings_page'
  );
}
add_action('admin_menu', 'ghc_register_settings_page');

function ghc_register_settings() {
  register_setting('ghc_ambassador_settings', 'ghc_ambassador_categories', [
    'type' => 'array',
    'sanitize_callback' => 'ghc_sanitize_categories',
    'default' => []
  ]);
}
add_action('admin_init', 'ghc_register_settings');

function ghc_sanitize_categories($input) {
  if (!is_array($input)) {
    return [];
  }

  $sanitized = [];
  foreach ($input as $category) {
    if (empty($category['name'])) {
      continue;
    }

    $subcategories = [];
    if (!empty($category['subcategories']) && is_array($category['subcategories'])) {
      foreach ($category['subcategories'] as $sub) {
        $trimmed = trim(sanitize_text_field($sub));
        if ($trimmed) {
          $subcategories[] = $trimmed;
        }
      }
    }

    $sanitized[] = [
      'name' => sanitize_text_field($category['name']),
      'slug' => sanitize_title($category['name']),
      'subtext' => sanitize_text_field($category['subtext'] ?? ''),
      'description' => sanitize_textarea_field($category['description'] ?? ''),
      'subcategories' => $subcategories
    ];
  }

  return $sanitized;
}

function ghc_get_categories() {
  return get_option('ghc_ambassador_categories', []);
}

function ghc_render_settings_page() {
  if (!current_user_can('manage_options')) {
    return;
  }

  $categories = ghc_get_categories();
  ?>
  <div class="wrap">
    <h1>Ambassador Map Settings</h1>

    <form method="post" action="options.php" id="ghc-categories-form">
      <?php settings_fields('ghc_ambassador_settings'); ?>

      <h2>Categories</h2>
      <p class="description">Define categories and subcategories for ambassador classification.</p>

      <div id="ghc-categories-container">
        <?php if (empty($categories)): ?>
          <div class="ghc-category-row" data-index="0">
            <div class="ghc-category-header">
              <input type="text"
                     name="ghc_ambassador_categories[0][name]"
                     placeholder="Category name"
                     class="regular-text ghc-category-name">
              <button type="button" class="button ghc-remove-category">Remove</button>
            </div>
            <div class="ghc-category-fields">
              <label>Subtext:</label>
              <input type="text"
                     name="ghc_ambassador_categories[0][subtext]"
                     placeholder="Short tagline or subtext"
                     class="regular-text">
            </div>
            <div class="ghc-category-fields">
              <label>Description:</label>
              <textarea name="ghc_ambassador_categories[0][description]"
                        rows="2"
                        class="large-text"
                        placeholder="Longer description of this category"></textarea>
            </div>
            <div class="ghc-subcategories">
              <label>Subcategories (one per line):</label>
              <textarea name="ghc_ambassador_categories[0][subcategories_raw]"
                        rows="4"
                        class="large-text ghc-subcategories-input"
                        placeholder="Bees&#10;Birds&#10;Butterflies"></textarea>
            </div>
          </div>
        <?php else: ?>
          <?php foreach ($categories as $index => $category): ?>
            <div class="ghc-category-row" data-index="<?php echo esc_attr($index); ?>">
              <div class="ghc-category-header">
                <input type="text"
                       name="ghc_ambassador_categories[<?php echo esc_attr($index); ?>][name]"
                       value="<?php echo esc_attr($category['name']); ?>"
                       placeholder="Category name"
                       class="regular-text ghc-category-name">
                <button type="button" class="button ghc-remove-category">Remove</button>
              </div>
              <div class="ghc-category-fields">
                <label>Subtext:</label>
                <input type="text"
                       name="ghc_ambassador_categories[<?php echo esc_attr($index); ?>][subtext]"
                       value="<?php echo esc_attr($category['subtext'] ?? ''); ?>"
                       placeholder="Short tagline or subtext"
                       class="regular-text">
              </div>
              <div class="ghc-category-fields">
                <label>Description:</label>
                <textarea name="ghc_ambassador_categories[<?php echo esc_attr($index); ?>][description]"
                          rows="2"
                          class="large-text"
                          placeholder="Longer description of this category"><?php echo esc_textarea($category['description'] ?? ''); ?></textarea>
              </div>
              <div class="ghc-subcategories">
                <label>Subcategories (one per line):</label>
                <textarea name="ghc_ambassador_categories[<?php echo esc_attr($index); ?>][subcategories_raw]"
                          rows="4"
                          class="large-text ghc-subcategories-input"
                          placeholder="Bees&#10;Birds&#10;Butterflies"><?php
                  echo esc_textarea(implode("\n", $category['subcategories'] ?? []));
                ?></textarea>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <p>
        <button type="button" class="button" id="ghc-add-category">Add Category</button>
      </p>

      <?php submit_button('Save Categories'); ?>
    </form>
  </div>

  <style>
    .ghc-category-row {
      background: #fff;
      border: 1px solid #c3c4c7;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 4px;
    }
    .ghc-category-header {
      display: flex;
      gap: 10px;
      align-items: center;
      margin-bottom: 10px;
    }
    .ghc-category-name {
      font-weight: 600;
    }
    .ghc-category-fields {
      margin-bottom: 10px;
    }
    .ghc-category-fields label,
    .ghc-subcategories label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }
    .ghc-subcategories-input {
      font-family: monospace;
    }
    #ghc-categories-container:empty::after {
      content: "No categories defined. Click 'Add Category' to create one.";
      color: #666;
      font-style: italic;
    }
  </style>

  <script>
    (function() {
      var container = document.getElementById('ghc-categories-container');
      var addBtn = document.getElementById('ghc-add-category');
      var form = document.getElementById('ghc-categories-form');

      function getNextIndex() {
        var rows = container.querySelectorAll('.ghc-category-row');
        var max = -1;
        rows.forEach(function(row) {
          var idx = parseInt(row.getAttribute('data-index'), 10);
          if (idx > max) max = idx;
        });
        return max + 1;
      }

      addBtn.addEventListener('click', function() {
        var index = getNextIndex();
        var row = document.createElement('div');
        row.className = 'ghc-category-row';
        row.setAttribute('data-index', index);
        row.innerHTML =
          '<div class="ghc-category-header">' +
            '<input type="text" name="ghc_ambassador_categories[' + index + '][name]" placeholder="Category name" class="regular-text ghc-category-name">' +
            '<button type="button" class="button ghc-remove-category">Remove</button>' +
          '</div>' +
          '<div class="ghc-category-fields">' +
            '<label>Subtext:</label>' +
            '<input type="text" name="ghc_ambassador_categories[' + index + '][subtext]" placeholder="Short tagline or subtext" class="regular-text">' +
          '</div>' +
          '<div class="ghc-category-fields">' +
            '<label>Description:</label>' +
            '<textarea name="ghc_ambassador_categories[' + index + '][description]" rows="2" class="large-text" placeholder="Longer description of this category"></textarea>' +
          '</div>' +
          '<div class="ghc-subcategories">' +
            '<label>Subcategories (one per line):</label>' +
            '<textarea name="ghc_ambassador_categories[' + index + '][subcategories_raw]" rows="4" class="large-text ghc-subcategories-input" placeholder="Bees&#10;Birds&#10;Butterflies"></textarea>' +
          '</div>';
        container.appendChild(row);
      });

      container.addEventListener('click', function(e) {
        if (e.target.classList.contains('ghc-remove-category')) {
          e.target.closest('.ghc-category-row').remove();
        }
      });

      form.addEventListener('submit', function() {
        container.querySelectorAll('.ghc-subcategories-input').forEach(function(textarea) {
          var baseName = textarea.name.replace('[subcategories_raw]', '');
          var lines = textarea.value.split('\n').filter(function(line) {
            return line.trim();
          });

          var existing = form.querySelectorAll('input[name^="' + baseName + '[subcategories]"]');
          existing.forEach(function(el) { el.remove(); });

          lines.forEach(function(line, i) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = baseName + '[subcategories][' + i + ']';
            input.value = line.trim();
            form.appendChild(input);
          });
        });
      });
    })();
  </script>
  <?php
}
