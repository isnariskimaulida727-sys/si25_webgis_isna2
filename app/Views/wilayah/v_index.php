<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <div class="card-tools">
        <a href ="<?= base_url('Wilayah/Input') ?>" class="btn btn-flat btn-primary btn-sm">
          <i class="fas fa-plus"></i> Tambah
        </a>
      </div>
    </div>

    <div class="card-body">
     <?php 
     //notif insert data
     if (session()->getFlashdata('insert')) {
  echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> '; 
  echo session()->getFlashdata('insert');
  echo '</h5></div>';
}

  //notif update data
     if (session()->getFlashdata('update')) {
  echo '<div class="alert alert-primary alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> '; 
  echo session()->getFlashdata('update');
  echo '</h5></div>';
}

 //notif delete data
     if (session()->getFlashdata('delete')) {
  echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> '; 
  echo session()->getFlashdata('delete');
  echo '</h5></div>';
}

?>
      <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th>Nama Wilayah</th>
            <th>Warna</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($wilayah as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value['nama_wilayah'] ?></td>
              <td style="background-color:<?= $value['warna'] ?>;"></td>
              <td class="text-center">
                <a href="<?= base_url('Wilayah/Edit/'.$value['id_wilayah']) ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                <a href="<?= base_url('Wilayah/Delete/'.$value['id_wilayah']) ?>" onclick="return confirm('Yakin Hapus Data ?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div id="map" style="width: 100%; height: 800px;"></div>
</div>

<script>
  // --- Pilihan BaseMap ---
  var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  });

  var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri &mdash; Source: Esri, USGS, etc.'
  });

  // light_all // itu awalnya gitu dipt3
  var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap & CartoDB'
  });

  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap & CartoDB'
  });

  // --- Inisialisasi Peta ---
  var map = L.map('map', {
    layers: [peta2] // default tampilan awal satellite
  });

  // --- Kontrol Layer ---
  var baseMaps = {
    "OpenStreetMap": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Night": peta4
  };
  L.control.layers(baseMaps).addTo(map);

 // --- bagian kie aneh ---
  var allLayers = [];
  <?php foreach ($wilayah as $key => $value) { ?>
    var layer = L.geoJSON(<?= json_encode(json_decode($value['geojson'])) ?>, {
      style: {
        color: "#110FAA",        // warna garis tepi
        fillColor: "<?= $value['warna'] ?>",    // warna isi
        fillOpacity: 0.8,                       // tingkat transparansi //tadi harusnya 0.6
        weight: 1.5                               // ketebalan garis tepi//1.5
      }
    }).bindPopup("<?= $value['nama_wilayah'] ?>").addTo(map);
    allLayers.push(layer);
  <?php } ?>

  // --- Zoom otomatis ke seluruh wilayah ---
  if (allLayers.length > 0) {
    var group = L.featureGroup(allLayers);
    map.fitBounds(group.getBounds());
  }
  // smpe kie
</script>

<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>