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
  }
  function fitAll() {
    if (cluster.getLayers().length) {
      var b = cluster.getBounds();
      if (b.isValid()) map.fitBounds(b, {padding: [28, 28]});
    }
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

  var clearBtn = document.getElementById('amb-clear');
  var searchEl = document.getElementById('amb-search');
  var tagsBox = document.getElementById('amb-tags');

  rows.forEach(function (item) {
    var markerOptions = {icon: greenIcon};
    markerOptions.title = item.title;

    var marker = L.marker(
      [parseFloat(item.lat), parseFloat(item.lng)],
      markerOptions
    );

    marker.bindPopup(item.html, {
      className: 'amb-leaflet-popup',
      maxWidth: 380,
    });

    cluster.addLayer(marker);

    allResults.push({
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

      searchEl.value = '';
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

  setTimeout(() => map.invalidateSize(), 250);
});
