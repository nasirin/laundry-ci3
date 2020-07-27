<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu Member</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Member</li>
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
        <i class="fa fa-plus-circle"></i> Tambah data
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Kode member</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($row->result() as $key => $data) { ?>
            <tr>
              <td>
                <a href="" data-toggle="modal" data-target="#modal-detail<?= $data->id_member ?>"> <?= $data->kode_member ?></a>
              </td>
              <td><?= $data->nama_member ?></td>
              <td><?= $data->notelp_member ?></td>
              <td><?= $data->email?></td>
              <?php if ($data->status_member == 1) { ?>
                <td><span class="badge badge-success">Active</span></td>
              <?php } else { ?>
                <td><span class="badge badge-danger">Non Active</span></td>
              <?php } ?>
              <td>
                <a href="#modal-edit<?= $data->id_member ?>" class="btn btn-warning btn-xs float-left m-1" data-toggle="modal"> <i class="fa fa-edit"></i> </a>
                <?php if ($data->id_level != 1) { ?>
                  <a href="<?= site_url('member/del/') . $data->id_member ?>" class="btn btn-danger btn-xs float-left tombol-hapus m-1"><i class="fa fa-trash"></i> </a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- modal tambah -->
<section class="content">
  <div class="container">
    <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title mx-auto">Form Tambah Data Member</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <?= form_open_multipart('member/add') ?>
            <div class="card-body">
              <!-- nama -->
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="Member name" required>
              </div>
              <!-- jenis kelamin -->
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="gender" required>
                  <option value="">-- Select --</option>
                  <option value="laki"> Laki - laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
              <!-- email -->
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email address ... ">
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
                  <input type="text" name="notelp" class="form-control" data-inputmask="'mask': ['9999 9999 9999', '+6299 9999 9999 9']" data-mask>
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
</section>

<!-- modal ubah -->
<section class="content">
  <?php foreach ($row->result() as $data) { ?>
    <div class="container">
      <div class="modal fade" id="modal-edit<?= $data->id_member ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title mx-auto">Form Ubah Data Member</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
              <?php echo form_open_multipart('member/edit/' . $data->id_member) ?>
              <div class="card-body">
                <input type="hidden" name="idmb" value="<?= $data->id_member ?>">
                <!-- NIP -->
                <div class="form-group">
                  <label>Kode member</label>
                  <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $data->kode_member ?>" readonly>
                </div>
                <!-- nama -->
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" placeholder="Member name" value="<?= $data->nama_member ?>" required>
                </div>
                <!-- jenis kelamin -->
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="gender" required>
                    <option value="">-- Select --</option>
                    <option value="laki" <?= $data->gender_member == 'laki' ? 'selected' : '' ?>> Laki - laki</option>
                    <option value="perempuan" <?= $data->gender_member == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>
                <!-- email -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email address ... " value="<?= $data->email ?>">
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
                    <input type="text" name="notelp" class="form-control" data-inputmask="'mask': ['9999 9999 9999', '+6299 9999 9999 9']" data-mask value="<?= $data->notelp_member ?>">
                  </div>
                </div>
                <!-- status -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" required>
                    <option value="">-- Select --</option>
                    <option value="1" <?= $data->status_member == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="2" <?= $data->status_member == 2 ? 'selected' : '' ?>>Non Active </option>
                  </select>
                </div>
                <!-- photo -->
                <div class="form-group">
                  <label>Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="img">
                      <label class="custom-file-label"><?= $data->photo_member ? $data->photo_member : 'Choose file' ?></label>
                    </div>
                  </div>
                </div>
                <!-- alamat -->
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" rows="3" placeholder="Address ..."><?= $data->alamat_member ?></textarea>
                </div>
                <!-- button -->
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-warning" name="edit">Change</button>
                </div>
              </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    <?php } ?>
</section>

<!-- modal detail -->
<?php foreach ($row->result() as $data) { ?>
  <div class="container">
    <div class="modal fade" id="modal-detail<?= $data->id_member ?>">
      <div class="modal-dialog">
        <div class="card card-widget widget-user col-md-8 p-0 mx-auto">
          <div class="widget-user-header bg-info">
            <h2 class="widget-user-username"><strong><?= $data->nama_member ?></strong></h2>
            <p class="widget-user-desc"><?= $data->kode_member ?></p>

          </div>
          <div class="widget-user-image">
            <img class="img-circle elevation-2" src="<?= $data->photo_member == null ? base_url('assets/img/member/default.png') : base_url('assets/img/member/') . $data->photo_member ?>" alt="User Avatar">
          </div>
          <div class="card-footer">
            <ul class="nav flex-column">
              <li class="nav-item mb-3">
                <b class="float-left">Level :</b>
                <span class="float-right"> <?= $data->nama_level ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Jenis Kelamin :</b>
                <span class="float-right"> <?= $data->gender_member == 'laki' ? 'Laki - laki' : 'Perempuan' ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Email :</b>
                <span class="float-right"> <?= $data->email ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Telepon :</b>
                <span class="float-right"> <?= $data->notelp_member ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Status :</b>
                <span class="float-right"> <?= $data->status_member == 1 ? 'Active' : 'Non Active' ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Tanggal daftar:</b>
                <span class="float-right"> <?= $data->created ?> </span>
              </li>
              <li class="nav-item mb-3">
                <b class="float-left">Alamat :</b>
                <span class="float-right"> <?= $data->alamat_member ?> </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

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
  // datatable
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
</script>
<!-- phone number -->
<script>
  $(function() {
    //Money Euro
    $('[data-mask]').inputmask()
  })
</script>