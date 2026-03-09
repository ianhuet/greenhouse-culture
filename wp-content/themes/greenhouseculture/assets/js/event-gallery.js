jQuery(function ($) {
  var frame;
  var supportersFrame;
  var MAX_ITEMS = 18;

  // ===========================
  // Gallery
  // ===========================

  $('#event-gallery-btn').on('click', function () {
    var current = $('#event_gallery').val();
    var ids = current ? current.split(',').filter(Boolean) : [];

    if (ids.length >= MAX_ITEMS) {
      alert('Maximum ' + MAX_ITEMS + ' images/videos allowed in the gallery.');
      return;
    }

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select Gallery Images / Videos',
      button: {text: 'Add to Gallery'},
      multiple: true,
      library: {type: ['image', 'video']},
    });

    frame.on('select', function () {
      var selection = frame.state().get('selection');
      var current = $('#event_gallery').val();
      var ids = current ? current.split(',').filter(Boolean) : [];

      if (ids.length + selection.length > MAX_ITEMS) {
        alert(
          'Maximum ' +
            MAX_ITEMS +
            ' images/videos allowed. You can add ' +
            (MAX_ITEMS - ids.length) +
            ' more.'
        );
      }

      selection.each(function (attachment) {
        if (ids.length >= MAX_ITEMS) return;

        var id = String(attachment.get('id'));
        var type = attachment.get('type');
        var url = attachment.get('url');

        if (ids.indexOf(id) !== -1) return;
        ids.push(id);

        var preview;
        if (type === 'video') {
          preview =
            '<video src="' +
            url +
            '" width="100" height="80" style="object-fit:cover;"></video>';
        } else {
          var thumb =
            attachment.get('sizes') && attachment.get('sizes').thumbnail
              ? attachment.get('sizes').thumbnail.url
              : url;
          preview =
            '<img src="' +
            thumb +
            '" width="100" height="80" style="object-fit:cover;" />';
        }

        $('#event-gallery-preview').append(
          '<div style="position:relative;">' +
            preview +
            '<button type="button" class="remove-gallery-item button" data-id="' +
            id +
            '" style="position:absolute;top:0;right:0;">✕</button>' +
            '</div>'
        );
      });

      $('#event_gallery').val(ids.filter(Boolean).join(','));
    });

    frame.open();
  });

  $(document).on('click', '.remove-gallery-item', function () {
    var removeId = String($(this).data('id'));
    $(this).parent().remove();

    var ids = $('#event_gallery')
      .val()
      .split(',')
      .filter(function (id) {
        return id && id !== removeId;
      });
    $('#event_gallery').val(ids.join(','));
  });

  // ===========================
  // Supporters
  // ===========================

  $('#event-supporters-btn').on('click', function () {
    if (supportersFrame) {
      supportersFrame.open();
      return;
    }

    supportersFrame = wp.media({
      title: 'Select Supporter Logos',
      button: {text: 'Add Logos'},
      multiple: true,
      library: {type: ['image']},
    });

    supportersFrame.on('select', function () {
      var selection = supportersFrame.state().get('selection');
      var current = $('#event_supporters').val();
      var ids = current ? current.split(',').filter(Boolean) : [];

      selection.each(function (attachment) {
        var id = String(attachment.get('id'));
        if (ids.indexOf(id) !== -1) return;
        ids.push(id);

        var thumb =
          attachment.get('sizes') && attachment.get('sizes').thumbnail
            ? attachment.get('sizes').thumbnail.url
            : attachment.get('url');

        $('#event-supporters-preview').append(
          '<div class="supporter-preview-item" style="position:relative; width:100px; height:80px; overflow:hidden;">' +
            '<img src="' +
            thumb +
            '" style="width:100%; height:100%; object-fit:contain;" />' +
            '<button type="button" class="remove-supporter-item button" data-id="' +
            id +
            '" ' +
            'style="position:absolute;top:2px;right:2px;background:red;color:#fff;border:none;cursor:pointer;border-radius:3px;padding:1px 5px;font-size:12px;">✕</button>' +
            '</div>'
        );
      });

      $('#event_supporters').val(ids.join(','));
    });

    supportersFrame.open();
  });

  $(document).on('click', '.remove-supporter-item', function () {
    var removeId = String($(this).data('id'));
    $(this).closest('.supporter-preview-item').remove();

    var ids = $('#event_supporters')
      .val()
      .split(',')
      .filter(function (id) {
        return id && id !== removeId;
      });
    $('#event_supporters').val(ids.join(','));
  });
});
