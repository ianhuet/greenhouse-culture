/* global L, setTimeout */
document.addEventListener('DOMContentLoaded', function () {
  if (typeof L === 'undefined') {
    console.warn('Leaflet not loaded - ambassador map disabled');
    return;
  }

  function applyFilters() {
    var term = (searchEl.value || '').trim().toLowerCase();
    var anyFilter = !!term.length || !!activeTags.size;
    cluster.clearLayers();
    var matched = [];

    allResults.forEach(function (o) {
      var textMatch = !term || o.text.includes(term);
      var tagMatch = !activeTags.size || o.terms.some(s => activeTags.has(s));

      if (textMatch && tagMatch) {
        matched.push(o);
        cluster.addLayer(o.marker);
      }
    });

    clearBtn.classList.toggle('show', anyFilter);
    if (matched.length) {
      var gb = L.featureGroup(matched.map(m => m.marker)).getBounds();
      if (gb.isValid()) map.fitBounds(gb, {padding: [35, 35], maxZoom: 12});
    } else {
      fitAll();
    }

    anyFilter
      ? panelEl.classList.add('show')
      : panelEl.classList.remove('show');

    renderList(anyFilter ? matched : allResults);
  }
  function fitAll() {
    if (cluster.getLayers().length) {
      var b = cluster.getBounds();
      if (b.isValid()) map.fitBounds(b, {padding: [28, 28]});
    }
  }
  function renderList(items) {
    countEl.textContent = items.length;

    listEl.innerHTML =
      items.map(m => m.card).join('') ||
      '<div class="ambResultPanel__list_noResult">No results.</div>';
  }

  var map = L.map('ambassadors-map', {scrollWheelZoom: true}).setView(
    [53.35, -6.26],
    6
  );
  L.tileLayer(
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
    {attribution: '&copy; OpenStreetMap, &copy; CARTO'}
  ).addTo(map);

  var greenIcon = new (L.Icon.extend({
    options: {
      iconAnchor: [18, 50],
      iconSize: [36, 52],
      iconUrl: window.ambassadorMapData.iconUrl,
      popupAnchor: [0, -44],
    },
  }))();
  var cluster = L.markerClusterGroup({
    showCoverageOnHover: false,
    spiderfyOnMaxZoom: true,
  });

  var allResults = [];
  var activeTags = new Set();
  var rows = window.ambassadorMapData.rows;
  var isPrivate = window.ambassadorMapData.isPrivate;

  var countEl = document.getElementById('amb-count');
  var clearBtn = document.getElementById('amb-clear');
  var listEl = document.getElementById('amb-list');
  var panelEl = document.getElementById('amb-panel');
  var searchEl = document.getElementById('amb-search');
  var tagsBox = document.getElementById('amb-tags');

  rows.forEach(function (item) {
    var marker = L.marker([parseFloat(item.lat), parseFloat(item.lng)], {
      title: item.title || '',
      icon: greenIcon,
    });

    if (isPrivate) {
      marker.bindPopup(item.html || '<strong>' + (item.title || '') + '</strong>', {
        className: 'amb-leaflet-popup',
        maxWidth: 380,
      });
    }

    cluster.addLayer(marker);

    allResults.push({
      card: item.card,
      id: item.id,
      marker: marker,
      terms: item.terms || [],
      text: (item.text || '').toLowerCase(),
    });
  });
  map.addLayer(cluster);
  fitAll();

  if (tagsBox) {
    tagsBox.addEventListener('click', function (e) {
      var tag = e.target.closest('.ambTagsBox__tag');

      if (!tag) return;

      var slug = tag.getAttribute('data-term');
      tag.classList.toggle('active');
      tag.classList.contains('active')
        ? activeTags.add(slug)
        : activeTags.delete(slug);
      applyFilters();
    });
  }

  searchEl.addEventListener('input', applyFilters);

  clearBtn.addEventListener('click', function () {
    searchEl.value = '';
    activeTags.clear();

    if (tagsBox) {
      const activeTags = tagsBox.querySelectorAll('.ambTagsBox__tag.active');
      activeTags.forEach(c => c.classList.remove('active'));
    }

    applyFilters();
  });

  listEl.addEventListener('click', function (e) {
    var row = e.target.closest('[data-id]');
    if (!row) return;

    var id = parseInt(row.getAttribute('data-id'), 10);
    var m = allResults.find(x => x.id === id);
    if (!m) return;

    map.setView(m.marker.getLatLng(), 13, {animate: true});
    setTimeout(() => m.marker.openPopup(), 200);
  });

  setTimeout(() => map.invalidateSize(), 250);
});
