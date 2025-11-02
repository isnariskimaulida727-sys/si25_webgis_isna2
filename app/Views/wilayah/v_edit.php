<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
    </div>

    <div class="card-body">
      <?php 
      $validation = session()->get('validation');
      echo form_open('Wilayah/UpdateData/'.$wilayah['id_wilayah']) ?>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Nama Wilayah</label>
            <input name="nama_wilayah" value="<?= $wilayah['nama_wilayah'] ?>" class="form-control">
            <p class="text-danger"><?= $validation?->getError('nama_wilayah') ?></p>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label>Warna Wilayah</label>
            <input name="warna" value="<?=$wilayah['warna'] ?>" class="form-control my-colorpicker1">
            <p class="text-danger"><?= $validation?->getError('warna') ?></p>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>GeoJSON</label>
        <textarea name="geojson" class="form-control" rows="10"><?= $wilayah['geojson'] ?></textarea>
        <p class="text-danger"><?= $validation?->getError('geojson') ?></p>
      </div>

      <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
      <a href="<?= base_url('Wilayah') ?>" class="btn btn-success btn-flat">Kembali</a>

      <?= form_close(); ?>
    </div>
  </div>
</div>

<script>
  $('.my-colorpicker1').colorpicker();
</script>