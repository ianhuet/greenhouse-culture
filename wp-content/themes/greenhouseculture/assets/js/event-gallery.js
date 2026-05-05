document.addEventListener('DOMContentLoaded', function () {
  let frame;
  let supportersFrame;
  const MAX_ITEMS = 18;

  // ===========================
  // Helpers
  // ===========================

  function updateGalleryInput() {
    const ids = [
      ...document.querySelectorAll('#event-gallery-preview .gallery-item'),
    ]
      .map(el => el.dataset.id)
      .filter(Boolean);

    console.log('NEW ORDER:', ids);
    document.getElementById('event_gallery').value = ids.join(',');
  }

  function getIds(inputId) {
    const val = document.getElementById(inputId).value;
    return val ? val.split(',').filter(Boolean) : [];
  }

  // ===========================
  // SortableJS — Gallery
  // ===========================

  const galleryPreview = document.getElementById('event-gallery-preview');

  if (galleryPreview) {
    Sortable.create(galleryPreview, {
      animation: 150,
      ghostClass: 'sortable-ghost',
      chosenClass: 'sortable-chosen',
      dragClass: 'sortable-drag',
      onEnd: function () {
        updateGalleryInput();
      },
    });
  }

  // ===========================
  // Gallery — Add Button
  // ===========================

  document
    .getElementById('event-gallery-btn')
    ?.addEventListener('click', function () {
      const ids = getIds('event_gallery');

      if (ids.length >= MAX_ITEMS) {
        alert(`Maximum ${MAX_ITEMS} images/videos allowed in the gallery.`);
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
        const selection = frame.state().get('selection');
        const ids = getIds('event_gallery');

        if (ids.length + selection.length > MAX_ITEMS) {
          alert(
            `Maximum ${MAX_ITEMS} images/videos allowed. You can add ${MAX_ITEMS - ids.length} more.`
          );
        }

        selection.each(function (attachment) {
          if (ids.length >= MAX_ITEMS) return;

          const id = String(attachment.get('id'));
          const type = attachment.get('type');
          const url = attachment.get('url');

          if (ids.includes(id)) return;
          ids.push(id);

          const sizes = attachment.get('sizes');
          const thumb = sizes?.thumbnail?.url ?? url;

          const mediaEl =
            type === 'video'
              ? `<video src="${url}" width="100" height="80" style="object-fit:cover;"></video>`
              : `<img src="${thumb}" width="100" height="80" style="object-fit:cover;" />`;

          const item = document.createElement('div');
          item.className = 'gallery-item';
          item.dataset.id = id;
          item.innerHTML = `
    ${mediaEl}
    <button type="button" class="remove-gallery-item button" data-id="${id}">✕</button>
`;

          galleryPreview.appendChild(item);
        });

        document.getElementById('event_gallery').value = ids
          .filter(Boolean)
          .join(',');
      });

      frame.open();
    });

  // ===========================
  // Gallery — Remove
  // ===========================

  galleryPreview?.addEventListener('click', function (e) {
    const btn = e.target.closest('.remove-gallery-item');
    if (!btn) return;

    btn.closest('.gallery-item').remove();
    updateGalleryInput();
  });

  // ===========================
  // Supporters — Add Button
  // ===========================

  document
    .getElementById('event-supporters-btn')
    ?.addEventListener('click', function () {
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
        const selection = supportersFrame.state().get('selection');
        const ids = getIds('event_supporters');
        const preview = document.getElementById('event-supporters-preview');

        selection.each(function (attachment) {
          const id = String(attachment.get('id'));
          if (ids.includes(id)) return;
          ids.push(id);

          const sizes = attachment.get('sizes');
          const thumb = sizes?.thumbnail?.url ?? attachment.get('url');

          const item = document.createElement('div');
          item.className = 'supporter-preview-item';
          item.innerHTML = `
    <img src="${thumb}" />
    <button type="button" class="remove-supporter-item button" data-id="${id}">✕</button>
`;

          preview.appendChild(item);
        });

        document.getElementById('event_supporters').value = ids.join(',');
      });

      supportersFrame.open();
    });

  // ===========================
  // Supporters — Remove
  // ===========================

  document
    .getElementById('event-supporters-preview')
    ?.addEventListener('click', function (e) {
      const btn = e.target.closest('.remove-supporter-item');
      if (!btn) return;

      const removeId = String(btn.dataset.id);
      btn.closest('.supporter-preview-item').remove();

      const ids = getIds('event_supporters').filter(id => id !== removeId);
      document.getElementById('event_supporters').value = ids.join(',');
    });

  // ===========================
  // Debug — log on save
  // ===========================

  document.addEventListener('click', function (e) {
    if (e.target.matches('#publish, #save-post')) {
      console.log(
        'Saving gallery value:',
        document.getElementById('event_gallery').value
      );
    }
  });
});
