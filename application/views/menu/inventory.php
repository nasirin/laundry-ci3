<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css"> 

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu bahan baku</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Bahan baku</li>
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
      <div class="btn btn-info float-left " data-toggle="modal" data-target="#modal-form"> <i class="fa fa-plus-circle"></i> Tambah data
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped table-responsive-md">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Varian</th>
            <th>Ukuran <small>/ml</small></th>
            <th>Supplier</th>
            <th>Harga</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datainv as $data) { ?>
            <tr>
              <td class="text-primary"><?= $data->kode_inventory ?></td>
              <td><?= $data->nama_barang ?></td>
              <td><?= $data->varian_inventory ?></td>
              <?php if ($data->quantity_inventory != 0) { ?>
                <td><span class="text-success"><?= $data->quantity_inventory ?></span></td>
              <?php } else { ?>
                <td><span class="text-danger"><?= $data->quantity_inventory ?></span></td>
              <?php } ?>
              <td><?= $data->supplier_inventory ?></td>
              <td><?= indo_currency($data->harga_beli) ?></td>
              <td>
                <a href="#modal-edit<?= $data->id_inventory ?>" class="btn btn-warning btn-xs float-left" data-toggle="modal"> <i class="fa fa-edit"></i> </a>
                <?php if ($this->fungsi->user_login()->id_level == 1) { ?>
                  <a href="<?= site_url('inventory/del/') . $data->id_inventory ?>" class="btn btn-danger btn-xs float-left tombol-hapus"><i class="fa fa-trash"></i> </a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
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
            <h4 class="modal-title mx-auto">Form Tambah Data Bahan Baku</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form role="form" action="<?= site_url('inventory/add') ?>" method="POST">
              <div class="card-body">
                <!-- nama -->
                <div class="form-group">
                  <label>Nama Bahan</label>
                  <input type="text" class="form-control" name="nama" placeholder="Empleyee name" value="" required>
                </div>
                <!-- varian -->
                <div class="form-group">
                  <label>Varian</label>
                  <input type="text" class="form-control" name="varian" placeholder="varian..." value="" required>
                </div>
                <!-- qty -->
                <div class="form-group">
                  <label>Ukuran</label><small> /ml</small>
                  <input type="number" class="form-control" name="qty" placeholder="Quantity" value="" required>
                </div>
                <!-- harga beli -->
                <div class="form-group">
                  <label>Harga</label>
                  <input type="number" class="form-control" name="beli" placeholder="Price" value="">
                </div>
                <!-- supplier -->
                <div class="form-group">
                  <label>Supplier</label>
                  <input type="text" class="form-control" name="supplier" placeholder="Supplier" value="">
                </div>
                <!-- button -->
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="add">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>

<!-- modal ubah -->
<?php foreach ($datainv as $key => $data) { ?>
  <section class="content">
    <div class="container">
      <div class="modal fade" id="modal-edit<?= $data->id_inventory ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title mx-auto">Form Ubah Data Bahan Baku</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
              <form role="form" action="<?= site_url('inventory/edit/') . $data->id_inventory ?>" method="POST">
                <div class="card-body">
                  <input type="hidden" name="idinv" value="<?= $data->id_inventory ?>">
                  <!-- kode inventory -->
                  <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Product code" value="<?= $data->kode_inventory ?>" readonly>
                  </div>
                  <!-- nama -->
                  <div class="form-group">
                    <label for="nama">Nama Bahan</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Empleyee name" value="<?= $data->nama_barang ?>" required>
                  </div>
                  <!-- varian -->
                  <div class="form-group">
                    <label for="varian">Varian</label>
                    <input type="varian" class="form-control" id="varian" name="varian" placeholder="varian" value="<?= $data->varian_inventory ?>" required>
                  </div>
                  <!-- qty -->
                  <div class="form-group">
                    <label for="qty">Ukuran</label><small>/ml</small>
                    <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" value="<?= $data->quantity_inventory ?>" required>
                  </div>
                  <!-- prince -->
                  <div class="form-group">
                    <label for="beli">Harga</label>
                    <input type="number" class="form-control" id="beli" name="beli" placeholder="Price" value="<?= $data->harga_beli ?>">
                  </div>
                  <!-- Supplier -->
                  <div class="form-group">
                    <label for="supplier">Supplier</label> <small class="float-right">Optional</small>
                    <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Phone Number" value="<?= $data->supplier_inventory ?>">
                  </div>
                  <!-- button -->
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" name="edit">Ubah</button>
                  </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
  </section>
<?php } ?>

<!-- DataTables -->
<script src="<?= base_url('assets/lte') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "order": [[0, "desc"]],
      "autoWidth": false,
    });
  });
</script>