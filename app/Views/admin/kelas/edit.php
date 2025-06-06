<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title"><b>Form Edit Kelas</b></h4>
          </div>
          <div class="card-body mx-5 my-3">

            <form action="<?= base_url('admin/kelas/editKelasPost'); ?>" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= esc($kelas->id_kelas); ?>">
              <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">

              <div class="form-group mt-4">
                <label for="kelas">Kelas / Tingkat</label>
                <input type="text" id="kelas" class="form-control <?= invalidFeedback('kelas') ? 'is-invalid' : ''; ?>" name="kelas" placeholder="'X', 'XI', '11'" , value="<?= old('kelas') ?? $kelas->kelas  ?? '' ?>" required>
                <div class="invalid-feedback">
                  <?= invalidFeedback('kelas'); ?>
                </div>
              </div>
              </div>
              <button type="submit" class="btn btn-primary mt-4">Simpan</button>
            </form>

            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>