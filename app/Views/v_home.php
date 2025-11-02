<div id="map" style="width: 100%; height: 800px;"></div>

<script>
    // --- Tile Layers tanpa Mapbox ---
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping'
    });

    //light_all/{z}/{x}/{y}{r}.png' (itu td diganti, klo ini dhps gpp) utk /rastertiles
    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap contributors &copy; Carto'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap contributors &copy; Carto'
    });

    // --- Inisialisasi Map ---
    var map = L.map('map', {
        center: [-7.186308, 109.024625],
        zoom: 12,
        layers: [peta2]
    });

    // --- Kontrol Layer ---
    var baseMaps = {
        "OpenStreetMap": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Night": peta4,
    };

    L.control.layers(baseMaps).addTo(map);
</script>