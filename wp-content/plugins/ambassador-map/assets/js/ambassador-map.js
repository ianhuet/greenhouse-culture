/* global L, setTimeout */
document.addEventListener('DOMContentLoaded', function () {
	if (typeof L === 'undefined') {
		console.warn('Leaflet not loaded - ambassador map disabled');
		return;
	}

	var map = L.map('amb_map', {scrollWheelZoom: true}).setView(
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
	var all = [];
	var rows = window.ambassadorMapData.rows;

	function fitAll() {
		if (cluster.getLayers().length) {
			var b = cluster.getBounds();
			if (b.isValid()) map.fitBounds(b, {padding: [28, 28]});
		}
	}

	rows.forEach(function (item) {
		var marker = L.marker([parseFloat(item.lat), parseFloat(item.lng)], {
			title: item.title || '',
			icon: greenIcon,
		}).bindPopup(
			item.html || '<strong>' + (item.title || '') + '</strong>',
			{maxWidth: 380, className: 'amb-leaflet-popup'}
		);
		cluster.addLayer(marker);
		all.push({
			card: item.card,
			id: item.id,
			marker: marker,
			terms: item.terms || [],
			text: (item.text || '').toLowerCase(),
		});
	});
	map.addLayer(cluster);
	fitAll();

	var listEl = document.getElementById('amb_list'),
		countEl = document.getElementById('amb_count');
	function renderList(items) {
		listEl.innerHTML =
			items.map(m => m.card).join('') ||
			'<div style="padding:14px;color:#667b6c">No results.</div>';
		countEl.textContent = items.length;
	}
	renderList(all);

	var searchEl = document.getElementById('amb_search');
	var chipWrap = document.getElementById('amb_chips');
	var clearBtn = document.getElementById('amb_clear');
	var activeTags = new Set();

	function applyFilters() {
		var term = (searchEl.value || '').trim().toLowerCase();
		var anyFilter = term.length || activeTags.size;
		cluster.clearLayers();
		var matched = [];
		all.forEach(function (o) {
			var textMatch = !term || o.text.includes(term);
			var tagMatch =
				!activeTags.size || o.terms.some(s => activeTags.has(s));
			if (textMatch && tagMatch) {
				matched.push(o);
				cluster.addLayer(o.marker);
			}
		});
		renderList(matched);
		clearBtn.classList.toggle('show', anyFilter);
		if (matched.length) {
			var gb = L.featureGroup(matched.map(m => m.marker)).getBounds();
			if (gb.isValid())
				map.fitBounds(gb, {padding: [35, 35], maxZoom: 12});
		} else {
			fitAll();
		}
	}

	searchEl.addEventListener('input', applyFilters);
	if (chipWrap) {
		chipWrap.addEventListener('click', function (e) {
			var chip = e.target.closest('.amb-chip');
			if (!chip) return;
			var slug = chip.getAttribute('data-term');
			chip.classList.toggle('active');
			chip.classList.contains('active')
				? activeTags.add(slug)
				: activeTags.delete(slug);
			applyFilters();
		});
	}
	clearBtn.addEventListener('click', function () {
		searchEl.value = '';
		activeTags.clear();
		if (chipWrap)
			chipWrap
				.querySelectorAll('.amb-chip.active')
				.forEach(c => c.classList.remove('active'));
		applyFilters();
	});

	document.getElementById('amb_list').addEventListener('click', function (e) {
		var btn = e.target.closest('[data-focus]');
		if (!btn) return;
		var id = parseInt(btn.getAttribute('data-focus'), 10);
		var m = all.find(x => x.id === id);
		if (!m) return;
		map.setView(m.marker.getLatLng(), 13, {animate: true});
		setTimeout(() => m.marker.openPopup(), 200);
	});

	setTimeout(() => map.invalidateSize(), 250);
});
