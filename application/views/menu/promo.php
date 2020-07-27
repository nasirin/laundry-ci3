<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/daterangepicker/daterangepicker.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu Promo</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Promo</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- alert -->
<?php if ($this->session->has_userdata('success')): ?>
  <div class="success" data-success="<?= $this->session->flashdata('success') ?>"></div>
<?php elseif($this->session->has_userdata('error')): ?>
  <div class="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
<?php elseif($this->session->has_userdata('sending')): ?>
  <div class="success" data-success="<?= $this->session->flashdata('sending') ?>"></div>
<?php endif ?>

<!-- Main content -->
<section class="content">

  <div class="card">
    <?php if ($this->session->userdata('level') == 1) { ?>
      <div class="card-header">
        <div class="btn btn-info float-left " data-toggle="modal" data-target="#modal-form">
          <i class="fa fa-plus-circle"></i> Tambah data
        </div>
      </div>
    <?php } ?>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Diskon</th>
            <th>Periode</th>
            <th>Status</th>
            <?php if ($this->session->userdata('level') == 1) { ?>
              <th>Action</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datapromo as $data) {
            $tag = 'Hai kak, kami mengadakan promo menarik lagi nih AYO cek di: shiplaundry.com';

          ?>
            <tr>
              <td class="text-info">
                <a href="" data-toggle="modal" data-tooltip="tooltip" title="Detail Promo" data-target="#modal-detail<?= $data->id_promo ?>"><?= $data->kode_promo ?></a>
              </td>
              <td><?= $data->nama_promo ?></td>
              <td><?= $data->value_jenis_promo . ' %' ?></td>
              <td><?= $data->mulai_promo . ' - ' . $data->akhir_promo  ?></td>
              <?php if ($data->status_promo == 1) { ?>
                <td><span class="badge badge-success">Active</span></td>
              <?php } else { ?>
                <td><span class="badge badge-danger">Non Active</span></td>
              <?php } ?>
              <?php if ($this->session->userdata('level') == 1) { ?>
                <td>
                  <a href="#modal-edit<?= $data->id_promo ?>" class="btn btn-warning btn-xs float-left mr-2" data-toggle="modal" data-tooltip="tooltip" title="Ubah data"> <i class="fa fa-edit"></i> </a>
                  <a href="<?= site_url('promo/del/') . $data->id_promo ?>" class="btn btn-danger btn-xs float-left tombol-hapus mr-2" data-tooltip="tooltip" title="Hapus Data"><i class="fa fa-trash"></i> </a>
                  <a href="<?= site_url('promo/share/') . $data->id_promo ?>" class="btn btn-default btn-xs float-left" data-tooltip="tooltip" title="Bagikan"><i class="fa fa-share"></i> </a>
                  <!-- <a href="whatsapp://send?text=<?= $tag . ' ' . $data->nama_promo . ' ' . $data->value_jenis_promo . '% ' . $data->keterangan_promo . ' Buruan Promo terbatas sampai: ' . $data->akhir_promo . ', shiplaundry.com' ?>" class="btn btn-default btn-xs float-left" data-tooltip="tooltip" title="Bagikan"><i class="fa fa-share"></i> </a> -->
                </td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  <!-- modal tambah -->
  <div class="container">
    <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title mx-auto">Form Tambah Data Promo</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <?= form_open_multipart('promo/add') ?>
            <div class="card-body">
              <!-- nama -->
              <div class="form-group">
                <label>Nama Promo</label>
                <input type="text" class="form-control" name="nama" placeholder="Promo name" value="" required>
              </div>
              <!-- nama -->
              <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" name="jenis" placeholder="Promo name" required>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="value" placeholder="Value Type promo" value="" required>
              </div>
              <!-- periode -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mulai tanggal</label>
                    <div class="input-group">
                      <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="mulai" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Berakhir</label>
                    <div class="input-group">
                      <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="akhir">
                    </div>
                  </div>
                </div>
              </div>
              <!-- photo -->
              <div class="form-group">
                <label>Photo</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="img">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </div>
              </div>
              <!-- status -->
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                  <option value="">-- Select --</option>
                  <option value="1">Active</option>
                  <option value="2">Non Active</option>
                </select>
              </div>
              <!-- keterangan -->
              <div class="form-group">
                <label>Informasi</label>
                <textarea name="ket" class="form-control" placeholder="Information"></textarea>
              </div>
              <!-- button -->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add">Tambah</button>
              </div>
              <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal ubah -->
  <?php foreach ($datapromo as $data) { ?>
    <div class="container">
      <div class="modal fade" id="modal-edit<?= $data->id_promo ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title mx-auto">Form Ubah Data Promo</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
              <?= form_open_multipart('promo/edit/' . $data->id_promo) ?>
              <div class="card-body">
                <input type="hidden" name="idpromo" value="<?= $data->id_promo ?>">
                <!-- code -->
                <div class="form-group">
                  <label>Kode Promo</label>
                  <input type="text" class="form-control" name="code" placeholder="Promo name" value="<?= $data->kode_promo ?>" readonly>
                </div>
                <!-- nama -->
                <div class="form-group">
                  <label>Nama Promo</label>
                  <input type="text" class="form-control" name="nama" placeholder="Promo name" value="<?= $data->nama_promo ?>" required>
                </div>
                <!-- nilai promo -->
                <div class="form-group">
                  <label>Jumlah</label> <small>Optional</small>
                  <input type="int" class="form-control" name="value" placeholder="Value Type promo" value="<?= $data->value_jenis_promo ?>">
                </div>
                <!-- periode -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mulai tanggal</label>
                      <div class="input-group">
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="mulai" value="<?= $data->mulai_promo ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Berakhir</label>
                      <div class="input-group">
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="akhir" value="<?= $data->akhir_promo ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- photo -->
                <div class="form-group">
                  <label>Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="text" class="custom-file-input" name="img">
                      <label class="custom-file-label"><?= $data->photo_promo ?></label>
                    </div>
                  </div>
                </div>
                <!-- status -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" required>
                    <option value="">-- Select --</option>
                    <option value="1" <?= $data->status_promo == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="2" <?= $data->status_promo == 2 ? 'selected' : '' ?>>Non Active</option>
                  </select>
                </div>
                <!-- keterangan -->
                <div class="form-group">
                  <label>informasi</label>
                  <textarea name="ket" class="form-control" placeholder="Information"> <?= $data->keterangan_promo ?></textarea>
                </div>
                <!-- button -->
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="edit">Chages data</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <!-- modal detail promo -->
  <?php foreach ($datapromo as $data) { ?>
    <div class="container">
      <div class="modal fade" id="modal-detail<?= $data->id_promo ?>">
        <div class="modal-dialog">
          <div class="card card-widget widget-user col-md-8 p-0 mx-auto">
            <div class="widget-user-header bg-info">
              <h2 class="widget-user-username"><strong><?= $data->nama_promo ?></strong></h2>
              <p class="widget-user-desc"><?= $data->kode_promo ?></p>

            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="<?= $data->photo_promo != null ? base_url('assets/img/promo/') . $data->photo_promo : base_url('assets/img/promo/default.png') ?>" alt="User Avatar">
            </div>
            <div class="card-footer">
              <ul class="nav flex-column">
                <li class="nav-item mb-3">
                  <b class="float-left">Value :</b>
                  <span class="float-right"> <?= $data->value_jenis_promo . ' %' ?> </span>
                </li>
                <li class="nav-item mb-3">
                  <b class="float-left">Periode :</b>
                  <span class="float-right"> <?= $data->mulai_promo . ' - ' . $data->akhir_promo ?> </span>
                </li>
                <li class="nav-item mb-3">
                  <b class="float-left">Status :</b>
                  <span class="float-right"> <?= $data->status_promo == 1 ? 'Active' : 'Non Active' ?> </span>
                </li>
                <li class="nav-item mb-3">
                  <b class="float-left">Description :</b>
                  <span class="float-right"> <?= $data->keterangan_promo ?> </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>


<!-- InputMask -->
<script src="<?= base_url('assets/lte') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/lte') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets/lte') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/lte') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  // datatable
  $(function() {
    $("#example1").DataTable({
      "order": [
        [0, "desc"]
      ],
      "autoWidth": false,
    });
  });
  // daterange
  $(function() {

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

  })

  // photo
  $(document).ready(function() {
    bsCustomFileInput.init();
  });

  // tooltip
  $('[data-tooltip="tooltip"]').tooltip();
</script>