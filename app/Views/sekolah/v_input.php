<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
    </div>

    <div class="card-body">
      <?php 
    echo form_open_multipart('Sekolah/InsertData');
$validation = \Config\Services::validation();
     ?>

      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Nama Sekolah</label>
            <input name="nama_sekolah" value="<?= old('nama_sekolah') ?>" placeholder="Nama Sekolah" class="form-control">
          <p class="text-danger"><?= $validation?->getError('status') ?></p>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label>Akreditasi</label>
            <input name="akreditasi" value="<?= old('akreditasi') ?>" placeholder="Akreditasi" class="form-control">
            <p class="text-danger"><?= $validation?->getError('akreditasi') ?></p>
          </div>
        </div>
      </div>

       <div class="col-sm-4">
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
              <option value="">--Pilih Status--</option>
              <option value="Negeri">Negeri</option>
              <option value="Swasta">Swasta</option>
            </select>
            <p class="text-danger"><?= $validation?->getError('status') ?></p> 
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label>Status</label>
            <select name="id_jenjang" class="form-control">
              <option value="">--Pilih Jenjang--</option>
           <?php foreach ($jenjang as $key => $value) { ?>
             <option value="<?= $value['id_jenjang'] ?>"><?= $value['jenjang'] ?></option>
          <?php } ?>

            </select>
            <p class="text-danger"><?= $validation?->getError('id_jenjang') ?></p> 
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Coordinat Sekolah</label>
       <div id="map" style="width: 100%; height: 400px;"></div>
        <input name="coordinat" id="Coordinat" value="<?= old('coordinat') ?>" placeholder="Coordinat Sekolah" class="form-control" readonly>
            <p class="text-danger"><?= $validation?->getError('coordinat') ?></p>
 </div>

 <div class="row">
   <div class="col-sm-4">
          <div class="form-group">
            <label>Provinsi</label>
            <select name="id_provinsi" id="id_provinsi" class="form-control select2">
              <option value="">--Pilih Provinsi--</option>
              <?php foreach ($provinsi as $key => $value) { ?>
             <option value="<?= $value['id_provinsi'] ?>"><?= $value['nama_provinsi'] ?></option>
<?php } ?>
            </select>
            <p class="text-danger"><?= $validation?->getError('id_provinsi') ?></p>
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            <label>Kabupaten</label>
            <select name="id_kabupaten" id="id_kabupaten" class="form-control select2">
            </select>
            <p class="text-danger"><?= $validation?->getError('id_kabupaten') ?></p>
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            <label>Kecamatan</label>
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
            </select>
            <p class="text-danger"><?= $validation?->getError('id_kecamatan') ?></p>
          </div>
        </div>
 </div>

<div class="row">
  <div class="col-sm-8">
 <div class="form-group">
        <label>Alamat</label>
     <input name="alamat" value="<?= old('alamat') ?>" placeholder="Alamat Sekolah" class="form-control">
            <p class="text-danger"><?= $validation?->getError('alamat') ?></p>
 </div>
 </div>

  <div class="col-sm-4">
          <div class="form-group">
            <label>Wilayah Administrasi</label>
            <select name="id_wilayah" class="form-control">
               <option value="">--Pilih Wilayah Administrasi--</option>
              <?php foreach ($wilayah as $key => $value) { ?>
             <option value="<?= $value['id_wilayah'] ?>"><?= $value['nama_wilayah'] ?></option>
<?php } ?>
            </select>
            <p class="text-danger"><?= $validation?->getError('id_wilayah') ?></p>
          </div>
        </div>
 </div>

  <label>Foto Sekolah</label>
     <input type="file" accept=".jpg" name="foto" value="<?= old('foto') ?>" class="form-control" required>
            <p class="text-danger"><?= $validation?->getError('foto') ?></p>
 </div>

      <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
      <a href="<?= base_url('Sekolah') ?>" class="btn btn-success btn-flat">Kembali</a> 
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

   $('#id_provinsi').change(function(){
    var id_provinsi = $('#id_provinsi').val();
    $.ajax({
      type: "POST",
      url: "<?= base_url('Sekolah/Kabupaten') ?>",
      data: {
        id_provinsi: id_provinsi,
      },
      success: function(response){
        $('#id_kabupaten').html(response);
      }
    });
   });

   $('#id_kabupaten').change(function(){
    var id_kabupaten = $('#id_kabupaten').val();
    $.ajax({
      type: "POST",
      url: "<?= base_url('Sekolah/Kecamatan') ?>",
      data: {
        id_kabupaten: id_kabupaten,
      },
      success: function(response){
        $('#id_kecamatan').html(response);
      }
    });
   });
    });
</script>

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
        center: [<?= $web['coordinat_wilayah'] ?>],
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

    L.control.layers(baseMaps).addTo(map); //var/L.
    
    var coordinatInput = document.querySelector("[name=coordinat]");
    var curLocation = [<?= $web['coordinat_wilayah'] ?>];
    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation,{
      draggable: 'true',
      });

      //mengambil coordinat saat marker digeser
      marker.on('dragend', function(e){
        var position = marker.getLatLng();
        marker.setLatLng(position, {
          curLocation
        }).bindPopup(position).update();
        $("#Coordinat").val(position.lat + "," + position.lng);
      })
      //mengambil coordinat saat map onclick
      map.on("click", function(e){
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker){
          marker = L.marker(e.latlng).addTo(map);
} else {
  marker.setLatLng(e.latlng);
}
    coordinatInput.value=lat+','+lng;
      });
      map.addLayer(marker);
</script>