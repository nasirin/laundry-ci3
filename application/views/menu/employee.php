<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu Employee</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- alert -->
<?php if ($this->session->has_userdata('success')) { ?>
  <div class="success" data-success="<?= $this->session->flashdata('success') ?>"></div>
<?php } elseif ($this->session->has_userdata('error')) { ?>
  <div class="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
<?php } ?>

<!-- Main content -->
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="btn btn-info float-left " data-toggle="modal" data-target="#modal-form">
        <i class="fa fa-plus"></i> Tambah data
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped table-responsive-md">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Level</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datakar->result() as $key => $data) { ?>
            <tr>
              <td>
                <a href="" data-toggle="modal" data-target="#modal-detail<?= $data->id_karyawan ?>"> <?= $data->NIP ?></a>
              </td>
              <td><?= $data->nama_karyawan ?></td>
              <td><?= $data->email ?></td>
              <td><?= $data->notelp_karyawan ?></td>
              <td><?= $data->nama_level ?></td>
              <?php if ($data->status_karyawan == 1) { ?>
                <td><span class="badge badge-success">Active</span></td>
              <?php } else { ?>
                <td><span class="badge badge-danger">Non Active</span></td>
              <?php } ?>
              <td>
                <a href="#modal-edit<?= $data->id_karyawan ?>" class="btn btn-warning btn-xs float-left" data-toggle="modal"> <i class="fa fa-edit"></i> </a>
                <?php if ($data->id_level != 1) { ?>
                  <a href="<?= site_url('employee/del/') . $data->id_karyawan ?>" class="btn btn-danger btn-xs float-left tombol-hapus"><i class="fa fa-trash"></i> </a>
                <?php } ?>
              </td>
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
            <h4 class="modal-title mx-auto">Form Tambah Data Karyawan</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <?= form_open_multipart('employee/add') ?>
            <div class="card-body">
              <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" required>
                  <option value="">-- Select --</option>
                  <option value="1">Admin</option>
                  <option value="2">Kasir</option>
                </select>
              </div>
              <!-- nama -->
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="Empleyee name" value="" required>
              </div>
              <!-- email -->
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email address ..." value="" required>
              </div>
              <!-- password -->
              <div class="form-group">
                <label>Password</label><small> Optional</small>
                <input type="text" class="form-control" name="password" placeholder="Default 12345" value="">
              </div>
              <!-- notelp -->
              <div class="form-group">
                <label>Telepon</label>
                <div class="input-group">
                  <input type="text" name="notelp" class="form-control" data-inputmask="'mask': ['9999 9999 9999', '+6299 9999 9999 9']" data-mask>
                </div>
              </div>
              <!-- baranch -->
              <div class="form-group">
                <label>Toko</label>
                <select class="form-control" name="branch" required>
                  <option value="">-- Select --</option>
                  <option value="1">Toko 1</option>
                  <option value="2">Toko 2</option>
                </select>
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
                  <option value="2">Non Active </option>
                </select>
              </div>
              <!-- alamat -->
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Address ..."></textarea>
              </div>
            </div>
            <!-- button -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="add">Tambah</button>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal ubah -->
  <?php foreach ($datakar->result() as $data) { ?>
    <div class="container">
      <div class="modal fade" id="modal-edit<?= $data->id_karyawan ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title mx-auto">Form Ubah Data Karyawan</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
              <?php echo form_open_multipart('employee/edit/' . $data->id_karyawan) ?>
              <div class="card-body">
                <input type="hidden" name="idkar" value="<?= $data->id_karyawan ?>">
                <!-- NIP -->
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $data->NIP ?>" readonly>
                </div>
                <!-- level -->
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control" name="level">
                    <option value="">-- Select --</option>
                    <option value="1" <?= $data->id_level == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= $data->id_level == 2 ? 'selected' : '' ?>>Kasir</option>
                  </select>
                </div>
                <!-- nama -->
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" placeholder="Empleyee name" value="<?= $data->nama_karyawan ?>" required>
                </div>
                <!-- email -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email address ..." value="<?= $data->email ?>" required>
                </div>
                <!-- password -->
                <div class="form-group">
                  <label>Password</label><small> Optional</small>
                  <input type="text" class="form-control" name="password" placeholder="Default 12345">
                </div>
                <!-- notelp -->
                <div class="form-group">
                  <label>Telepon</label>
                  <div class="input-group">
                    <input type="text" name="notelp" class="form-control" data-inputmask="'mask': ['9999 9999 9999', '+6299 9999 9999 9']" data-mask value="<?= $data->notelp_karyawan ?>">
                  </div>
                </div>
                <!-- baranch -->
                <div class="form-group">
                  <label>Toko</label>
                  <select class="form-control" name="branch" disabled>
                    <option value="">-- Select --</option>
                    <option value="<?= $data->branch_karyawan ?>" <?= $data->branch_karyawan == 1 ? 'selected' : '' ?>>Toko 1</option>
                    <option value="<?= $data->branch_karyawan ?>" <?= $data->branch_karyawan == 2 ? 'selected' : '' ?>>Toko 2</option>
                  </select>
                </div>
                <!-- photo -->
                <div class="form-group">
                  <label>Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="img">
                      <label class="custom-file-label"><?= $data->photo_karyawan ?></label>
                    </div>
                  </div>
                </div>
                <!-- status -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" required>
                    <option value="">-- Select --</option>
                    <option value="1" <?= $data->status_karyawan == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="2" <?= $data->status_karyawan == 2 ? 'selected' : '' ?>>Non Active </option>
                  </select>
                </div>
                <!-- alamat -->
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" rows="3" placeholder="Address ..."><?= $data->alamat_karyawan ?></textarea>
                </div>
              </div>
              <!-- button -->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" name="edit">Ubah</button>
              </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

    <!-- detail -->
    <?php foreach ($datakar->result() as $data) { ?>
      <div class="container">
        <div class="modal fade" id="modal-detail<?= $data->id_karyawan ?>">
          <div class="modal-dialog">
            <div class="card card-widget widget-user col-md-8 p-0 mx-auto">
              <div class="widget-user-header bg-info">
                <h2 class="widget-user-username"><strong><?=ucwords($data->nama_karyawan)?></strong></h2>
                <p class="widget-user-desc"><?= $data->NIP ?></p>

              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?= $data->photo_karyawan ? base_url('assets/img/karyawan/') . $data->photo_karyawan : base_url('assets/img/karyawan/default.png') ?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <ul class="nav flex-column">
                  <li class="nav-item mb-3">
                    <b class="float-left">Level :</b>
                    <span class="float-right"> <?= $data->nama_level ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Gaji :</b>
                    <span class="float-right"> <?= $data->salary ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Email :</b>
                    <span class="float-right"> <?= $data->email ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Telepon :</b>
                    <span class="float-right"> <?= $data->notelp_karyawan ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Toko :</b>
                    <span class="float-right"> <?= $data->branch == 1 ? 'Toko 1' : 'Toko 2' ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Status :</b>
                    <span class="float-right"> <?= $data->status_karyawan == 1 ? 'Active' : 'Non Active' ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Tanggal Daftar:</b>
                    <span class="float-right"> <?= $data->created ?> </span>
                  </li>
                  <li class="nav-item mb-3">
                    <b class="float-left">Alamat :</b>
                    <span class="float-right"> <?= $data->alamat_karyawan ?> </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
</section>

<!-- JAVA SCRIPT -->
<!-- InputMask -->
<script src="<?= base_url('assets/lte') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/lte') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/lte') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
  // data tables
  $(function() {
    $("#example1").DataTable({
      "order": [
        [0, "desc"]
      ],
      "autoWidth": false,
    });
  });
  // photo
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
  // notelp
  $(function() {
    $('[data-mask]').inputmask()
  });
</script>