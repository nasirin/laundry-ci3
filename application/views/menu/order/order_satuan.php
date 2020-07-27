<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/dist/css/adminlte.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu Pesanan Satuan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pesanan satuan</li>
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
      <div class="btn btn-info" data-toggle="modal" data-target="#modal-form">
        <i class="fa fa-plus-circle"></i> Tambah data
      </div>
      <a href="<?= base_url('laporan/Laporan_inventory/print') ?>" class="btn btn-success">
        <i class="fa fa-download"></i> Cetak Laporan
      </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped table-responsive-md">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Pelanggan</th>
            <th>Jasa</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($order as $data) { ?>
            <tr>
              <td>
                <a href="" data-toggle="modal" id="tgl" data-target="#modal-detail<?= $data->id_order_satuan ?>" data-tooltip="tooltip" title="Tekan untuk melihat detail">
                  <?= $data->kode_order_satuan ?>
                </a>
              </td>
              <?php if ($data->id_member == null) { ?>
                <td><?= $data->nama_pelanggan_satuan ?></td>
              <?php } else { ?>
                <td><?= ucwords($data->nama_member) ?> <small>(member)</small></td>
              <?php } ?>
              <td><?= $data->nama_product_satuan ?></td>
              <td><?= $data->jumlah_satuan ?></td>
              <td><?= indo_currency($data->total_harga_satuan) ?></td>
              <td><?= $data->status_satuan ?></td>
              <td>
                <a href="#modal-edit<?= $data->id_order_satuan ?>" class="btn btn-warning btn-xs float-left m-1" data-toggle="modal" data-tooltip="tooltip" title="Ubah Data"> <i class="fa fa-edit"></i> </a>
                <?php if ($this->fungsi->user_login()->id_level == 1) { ?>
                  <a href="<?= site_url('order/order_satuan/del/') . $data->id_order_satuan ?>" class="btn btn-danger btn-xs float-left tombol-hapus m-1" data-tooltip="tooltip" title="Hapus Data"><i class="fa fa-trash"></i> </a>
                <?php } ?>
                <a href="#" class="btn btn-success btn-xs float-left m-1" data-tooltip="tooltip" title="Pesanan Selesai"><i class="fa fa-thumbs-up"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title mx-auto">Form Tambah Pesanan</h4>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('order/order_satuan/add') ?>" method="post" role="form">
          <!-- FORM BODY -->
          <!-- nama member -->
          <div class="form-group">
            <label>Member</label> <small class="float-right">Optional</small>
            <select class="select2" name="member" style="width: 100%;">
              <option value="">-- Select --</option>
              <?php foreach ($member as $data) { ?>
                <option value="<?= $data->id_member ?>" <?= $data->status_member == 2 ? 'disabled' : '' ?>><?= ucfirst($data->nama_member) ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- nama pelanggan -->
          <div class="form-group">
            <label>Nama pelanggan</label> <small class="float-right">Optional</small>
            <input type="text" class="form-control" name="nama" placeholder="Nama pelanggan">
          </div>
          <!-- product -->
          <div class="form-group">
            <label>Jasa*</label>
            <select class="select2" name="idproduct" id="product" style="width: 100%;" required <?= set_value('product') ?>>
              <option value="">-- Select --</option>
              <?php foreach ($product as $data) { ?>
                <option value="<?= $data->id_product_satuan . '/' . $data->harga_product_satuan . '/' . $data->durasi_satuan ?>" <?= $data->status_satuan == 2 ? 'disabled' : '' ?>><?= strtoupper($data->nama_product_satuan) . ' - ' . number_format($data->harga_product_satuan) ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- parfume -->
          <div class="form-group">
            <label>Pewangi</label> <small class="float-right">Optional</small>
            <select class="select2" name="idinventory" style="width: 100%;">
              <option value="">-- Select --</option>
              <?php foreach ($inventory as $data) { ?>
                <option value="<?= $data->id_inventory ?>" <?= $data->quantity_inventory <= 0 ? 'disabled' : '' ?>><?= $data->varian_inventory ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- promo -->
          <div class="form-group">
            <label>Promo</label> <small class="float-right">Optional</small>
            <select class="select2" name="idpromo" id="promo" style="width: 100%;" <?= set_value('promo') ?>>
              <option value=""> -- Select -- </option>
              <?php foreach ($promo as $data) { ?>
                <option value="<?= $data->id_promo . '/' . $data->value_jenis_promo ?>" <?= $data->status_promo == 2 ? 'disabled' : '' ?>><?= $data->nama_promo ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- jumlah cucian -->
          <div class="form-group">
            <label> jumlah* </label>
            <input type="number" min="0" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah pakaian" required <?= set_value('jumlah') ?>>
          </div>
          <!-- Total harga -->
          <div class="form-group">
            <label> Total Harga </label> <small class="float-right">Rp.</small>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="number" name="total" id="total" class="form-control" placeholder="Total Harga" readonly <?= set_value('total') ?>>
            </div>
          </div>
          <!-- periode -->
          <div class="form-group">
            <label>Selesai</label>
            <div class="input-group">
              <input type="text" class="form-control" id="edate" name="akhir" readonly <?= set_value('edate') ?>>
            </div>
          </div>
          <!-- note -->
          <div class="form-group">
            <label> Catatan</label> <small class="float-right"> Optional</small>
            <textarea name="keterangan" class="form-control"></textarea>
          </div>
          <!-- pembayaran -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label> Pembayaran </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-info"><i class="fa fa-money-bill"></i></span>
                  </div>
                  <input type="text" name="pembayaran" id="pembayaran" class="form-control" placeholder="Pembayaran" id="pembayaran" <?= set_value('pembayaran') ?> required>
                </div>
              </div>
            </div>
            <!-- kembalian -->
            <div class="col-md-6">
              <div class="form-group">
                <label> Kembalian </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success"><i class="fa fa-money-bill"></i></span>
                  </div>
                  <input type="text" name="kembalian" id="kembalian" class="form-control" placeholder="Kembalian" readonly <?= set_value('kembalian') ?>>
                </div>
              </div>
            </div>
          </div>

          <!-- FORM FOOTER -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($order as $data) {
  $pelanggan = $data->nama_pelanggan_satuan;
  $jumlah = $data->jumlah_satuan;
  $total = $data->total_harga_satuan;
  $note = $data->keterangan_satuan;
  $enddate = $data->tanggal_keluar_satuan;
  $product = $data->nama_product_satuan;
  $parfume = $data->varian_inventory;
  $promo = $data->nama_promo;
  $karyawan = $data->nama_karyawan;
  // $member = $data->id_member;
?>
  <div class="modal fade" id="modal-edit<?= $data->id_order_satuan ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title mx-auto">Form Ubah Pesanan</h4>
        </div>
        <div class="modal-body">
          <form action="<?= site_url('order/order_satuan/edit/' . $data->id_order_satuan) ?>" method="post" role="form">
            <!-- FORM BODY -->
            <input type="hidden" name="idorder_k" value="<?= $data->id_order_satuan ?>">
            <!-- code -->
            <div class="form_group">
              <label> Kode </label>
              <input type="hidden" name="idorder" value="<?= $data->id_order_satuan ?>">
              <input type="text" class="form-control" name="code" value="<?= $data->kode_order_satuan ?>" readonly>
            </div>
            <br>
            <!-- nama member -->
            <?php if ($pelanggan == null) { ?>
              <div class="form-group">
                <label>Member</label> <small class="float-right badge badge-success">Active : <?= ucwords($data->nama_member) ?></small>
                <select class="select2" name="member" style="width: 100%;" <?= $pelanggan ? 'disabled' : '' ?>>
                  <option value="">-- Select --</option>
                  <?php foreach ($member as $data) { ?>
                    <option value="<?= $data->id_member ?>" <?= $data->status_member == 2 ? 'disabled' : '' ?>><?= ucwords($data->nama_member) ?></option>
                  <?php } ?>
                </select>
              </div>
            <?php } else { ?>
              <!-- nama pelanggan -->
              <div class="form-group">
                <label>Pelanggan</label> <small class="float-right">Optional</small>
                <input type="text" class="form-control" name="nama" value="<?= $pelanggan ?>" placeholder="Customer name" <?= $pelanggan == null ? 'readonly' : '' ?>>
              </div>
            <?php } ?>
            <!-- product -->
            <div class="form-group">
              <label>Jasa</label>
              <input type="text" class="form-control" name="jasa" readonly value="<?= $product ?>">
            </div>
            <!-- parfume -->
            <div class="form-group">
              <label>Pewangi</label> <small class="float-right badge badge-success">Active : <?= ucwords($parfume) ?></small>
              <select class="select2" name="idinventory" style="width: 100%;">
                <option value="">-- Select --</option>
                <?php foreach ($inventory as $data) { ?>
                  <option value="<?= $data->id_inventory ?>" <?= $data->quantity_inventory <= 0 ? 'disabled' : '' ?>><?= $data->varian_inventory ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- promo -->
            <div class="form-group">
              <label>Promo</label>
              <input type="text" class="form-control" placeholder="Empty" name="promo" value="<?= $promo ?>" readonly>
            </div>
            <!-- jumlah cucian -->
            <div class="form-group">
              <label> jumlah </label> <small class="float-right">/Kg</small>
              <input type="number" min="0" name="jumlah" value="<?= $jumlah ?>" class="form-control" readonly>
            </div>
            <!-- Total harga -->
            <div class="form-group">
              <label> Total Harga </label> <small class="float-right">Rp.</small>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                </div>
                <input type="number" name="total" value="<?= $total ?>" class="form-control" placeholder="Total Price" readonly>
              </div>
            </div>
            <!-- periode -->
            <div class="form-group">
              <label>Selesai</label>
              <div class="input-group">
                <input type="text" class="form-control" name="akhir" value="<?= $enddate ?>" readonly>
              </div>
            </div>
            <!-- note -->
            <div class="form-group">
              <label> Catatan</label> <small class="float-right"> Optional</small>
              <textarea name="keterangan" class="form-control"><?= $note ?></textarea>
            </div>
            <!-- karyawan -->
            <div class="form-group">
              <label> Karyawan </label>
              <input type="text" class="form-control" name="karyawan" value="<?= $karyawan ?>" readonly>
            </div>

            <!-- FORM FOOTER -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning" name="edit">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- MODAL DETAIL -->
<?php foreach ($order as $data) {
  $promo = intval($data->value_jenis_promo * $data->jumlah_satuan * $data->harga_product_satuan / 100);
  $subtotal = intval($data->jumlah_satuan * $data->harga_product_satuan);
?>
  <div class="modal fade" id="modal-detail<?= $data->id_order_satuan ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="<?= base_url('assets/img/laundryLogo.png') ?>" class="img-circle elevation-3 brand-image" style="width:30px">
                <span class="brand-text font-weight-light"> <b>Ship Laundry</b> </span>
                <small class="float-right text-gray"><?= date('d-M-Y'); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <hr>
          <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
              <?php if ($data->id_member != null) { ?>
                <address>
                  <strong><?= ucwords($data->nama_member) ?></strong><br>
                  <span><?= $data->kode_member ?></span><br>
                  <span><?= $data->notelp_member ?></span><br>
                  <span><?= $data->email ?></span>
                  <span><?= ucfirst($data->alamat_member) ?></span><br>
                </address>
              <?php } else { ?>
                <address>
                  <strong><?= ucwords($data->nama_pelanggan_satuan) ?></strong>
                </address>
              <?php } ?>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
              <b>Nota : </b><?= $data->kode_order_satuan ?><br>
              <b>Tanggal Masuk:</b> <?= $data->tanggal_masuk_satuan ?><br>
              <b>Tanggal Keluar:</b> <?= $data->tanggal_keluar_satuan ?><br>
            </div>
            <!-- /.col -->
          </div>
          <br>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>jumlah</th>
                    <th>Jasa</th>
                    <th>Biaya</th>
                    <th>Pewangi</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $data->jumlah_satuan ?></td>
                    <td><?= $data->nama_product_satuan ?></td>
                    <td><?= $data->harga_product_satuan . '/Kg' ?></td>
                    <td><?= $data->varian_inventory ?></td>
                    <td><?= $data->keterangan_satuan ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <p class="lead">Detail pembayaran:</p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td><?= indo_currency($subtotal) ?></td>
                  </tr>
                  <tr>
                    <th>Promo (<?= $data->value_jenis_promo ?> %)</th>
                    <td><?= indo_currency($promo) ?></td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td><?= indo_currency($data->total_harga_satuan) ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- accepted payments column -->
            <div class="col-12">
              <p class="lead">Syarat ketentuan:</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
              </p>
            </div>
          </div>
          <div class="row no-print">
            <div class="col-12">
              <button type="button" class="btn btn-default" OnClick="javascript:window.print()"><i class="fa fa-print">Print</i>
              </button>
              <!-- <a href="<?= site_url('order/cetak') ?>" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Select2 -->
<script src="<?= base_url('assets/lte') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/lte') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url('assets/login') ?>/js/popper.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/lte') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(document).ready(function() {
    // datatable
    $(function() {
      $("#example1").DataTable({
        "order": [
          [0, "desc"]
        ],
        "autoWidth": false,
      });
    });
    $('.select2').select2();
    // Format mata uang
    $("#kembalian").inputmask({
      prefix: 'Rp ',
      radixPoint: ',',
      groupSeparator: ".",
      alias: "numeric",
      autoGroup: true,
      digits: 0
    });

    // perhitungan
    $('#jumlah').on("input", function() {
      var jumlah = $('#jumlah').val();
      var produk = $('#product').val();
      var produk = produk.split('/');
      var produk = produk[1];
      var promo = $('#promo').val();
      var promo = promo.split('/');
      var promo = promo[1];
      var total = produk * jumlah;
      var diskon = total * promo / 100;
      var hasil = total - diskon;
      if (promo == null) {
        $('#total').val(total);
      } else {
        $('#total').val(hasil);
      }
    });
    $('#pembayaran').on("input", function() {
      var pembayaran = $('#pembayaran').val();
      var total = $('#total').val();
      var kembalian = pembayaran - total;
      $('#kembalian').val(kembalian);
    });

    // DATE
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    var date = new Date();
    var sdate = date.getDate();
    var bulan = date.getMonth();
    var tahun = date.getFullYear();
    $('#product').change(function() {
      var produk = $('#product').val();
      var produk = produk.split('/');
      var produk = produk[2];
      var convert1 = parseInt(sdate);
      var convert2 = parseInt(produk);
      var edate = convert1 + convert2;
      // result hasil
      $('#edate').val(edate + '-' + months[bulan] + '-' + tahun);
    });

    // tanggal

    // tooltip
    $('[data-tooltip="tooltip"]').tooltip();

  });
</script>   