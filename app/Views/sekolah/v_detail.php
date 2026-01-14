<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
    </div>

    <div class="card-body">
        <div class="row">
             <div class="col-sm-6">
                 <div id="map" style="width: 100%; height: 400px;"></div>
     </div>

         <div class="col-sm-6">
            <img src="<?= base_url('foto/'.$sekolah['foto']) ?>" width="100%" height= "400px">
</div>

 <div class="col-sm-12">
    <table class="table table-bordered">
        <tr>
            <th>Nama Sekolah</th>
            <th width="30px">:</th>
            <td><?= $sekolah['nama_sekolah'] ?></td>
            </tr>
             <tr>
            <th>Jenjang Sekolah</th>
            <th>:</th>
            <td><?= $sekolah['jenjang'] ?></td>
            </tr>
             <tr>
            <th>Status Sekolah</th>
            <th>:</th>
            <td><?= $sekolah['status'] ?></td>
            </tr>
             <tr>
            <th>Akreditasi Sekolah</th>
            <th>:</th>
            <td><?= $sekolah['akreditasi'] ?></td>
            </tr>
             <tr>
            <th>Alamat Sekolah</th>
            <th>:</th>
            <td><?= $sekolah['alamat'] ?>, <?= $sekolah['nama_kecamatan'] ?>, <?= $sekolah['nama_kabupaten'] ?>, <?= $sekolah['nama_provinsi'] ?></td>
            </tr>
        </table>
        <a href="<?= base_url('Sekolah') ?>" class="btn btn-success btn-flat">Kembali</a>
    </div>
</div>

    </div>
  </div>
</div>

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
        center: [<?= $sekolah['coordinat']?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta2]
    });

    // --- Kontrol Layer ---
    var baseMaps = {
        "OpenStreetMap": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Night": peta4,
    };

      L.geoJSON(<?= json_encode(json_decode($sekolah['geojson'])) ?>, {
      style: {
        color: "#110FAA",        // warna garis tepi
        fillColor: "<?= $sekolah['warna'] ?>",    // warna isi
        fillOpacity: 1,                       // tingkat transparansi //tadi harusnya 0.6
        weight: 1.5                               // ketebalan garis tepi//1.5
      }
    }).bindPopup("<?= $sekolah['nama_wilayah'] ?>").addTo(map);

    var icon = L.icon({
    iconUrl: '<?= base_url('marker/'.$sekolah['marker']) ?>',
    iconSize:     [30, 40], // size of the icon
});
    L.marker([<?=$sekolah['coordinat'] ?>],{
        icon: icon
    }).addTo(map);
    </script>