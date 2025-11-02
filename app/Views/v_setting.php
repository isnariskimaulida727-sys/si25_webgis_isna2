<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php 
if (session()->getFlashdata('pesan')) {
  echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> ';
  echo session()->getFlashdata('pesan');
  echo '</h5></div>';
}
?>

              <?php echo form_open('Admin/UpdateSetting') ?>

              

               <div class="row">
                <div class="col-sm-7">
                <div class="form-group">
                <label>Nama Website</label>
               <input name="nama_web" value="<?= isset($web['nama_web']) ? $web['nama_web'] : '' ?>" class="form-control" placeholder="Nama Website" required>
               </div>
               </div>
                 <div class="col-sm-3">
                <div class="form-group">
                <label>Coordinat Wilayah</label>
                <input name="coordinat_wilayah" value="<?= isset($web['coordinat_wilayah'])  ? $web['coordinat_wilayah'] : '' ?>" class="form-control" placeholder="Coordinat Website" required>
               </div>
            </div>

                <div class="col-sm-2">
  <div class="form-group">
    <label>Zoom View</label>
    <div class="input-group">
      <input type="number" value="<?= isset($web['zoom_view'])  ? $web['zoom_view'] : '' ?>" name="zoom_view" min="0" max="20" class="form-control" placeholder="Coordinat Website" required>
      <div class="input-group-append">
        <span class="input-group-text">
          <i class="fas fa-search-plus"></i>
        </span>
      </div>
    </div>
  </div>
</div>
</div>

<button class="btn btn-primary" type="submit" >Simpan</button>
               

               

              <?php echo form_close() ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-12">
        <div id="map" style="width: 100%; height: 800px;"></div>
          </div>




        <script>
    // --- Tile Layers tanpa Mapbox ---
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping'
    });

    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap contributors &copy; Carto'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap contributors &copy; Carto'
    });

    // --- Inisialisasi Map ---
    var map = L.map('map', {
        center: [<?= isset($web['coordinat_wilayah'])  ? $web['coordinat_wilayah'] : '' ?>],
        zoom: <?= isset($web['zoom_view'])  ? $web['zoom_view'] : '' ?>,
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