<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/dist/css/adminlte.min.css">
<!-- datatables -->
<link rel="stylesheet" href="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Menu Jasa Kiloan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jasa kiloan</li>
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

<!-- MAIN CONTENT -->
<section class="content">
    <div class="card">
        <?php if ($this->session->userdata('level')==1) {?>
            <div class="card-header">
                <div class="btn btn-info folat-left" data-toggle="modal" data-target="#modal-form">
                    <i class="fa fa-plus-circle"></i> Tambah data
                </div>
            </div>            
        <?php }?>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-responsive-md">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <?php if ($this->session->userdata('level') == 1) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataproduct as $data) { ?>
                        <tr>
                            <td>
                                <a href="#modal-detail<?= $data->id_product_kiloan ?>" data-toggle="modal"><?= $data->kode_product_kiloan ?></a>
                            </td>
                            <td><?= ucfirst($data->nama_product_kiloan) ?></td>
                            <td><?= indo_currency($data->harga_product_kiloan) ?></td>
                            <td><?= $data->durasi_kiloan . ' day' ?></td>
                            <?php if ($data->status_kiloan == 1) { ?>
                                <td><span class="badge badge-success">Active</span></td>
                            <?php } else { ?>
                                <td><span class="badge badge-danger">Non Active</span></td>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == 1) { ?>
                                <td>
                                    <a href="#modal-edit<?= $data->id_product_kiloan ?>" data-toggle="modal" class="btn btn-warning btn-xs m-1"><i class="fa fa-edit"></i></a>
                                    <a href="<?= site_url('product/product_kiloan/del/') . $data->id_product_kiloan ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus m-1"><i class="fa fa-trash"></i></a>
                                </td>
                            <?php } ?>
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
                <h4 class="modal-title mx-auto">Form Tambah Data Jasa</h4>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('product/product_kiloan/add') ?>" method="POST">
                    <!-- FORM BODY -->
                    <!-- nama product -->
                    <div class="form-group">
                        <label> Nama Jasa *</label>
                        <input type="text" name="nama" class="form-control" placeholder="Product name ... " required>
                    </div>
                    <!-- durasi -->
                    <div class="form-group">
                        <label> Durasi * </label> <small class="float-right">/Day</small>
                        <input type="number" min="0" name="durasi" class="form-control" placeholder="Washing time" required>
                    </div>
                    <!-- harga -->
                    <div class="form-group">
                        <label> Harga * </label> <small class="float-right">Rp.</small>
                        <input type="number" min="0" name="harga" class="form-control" placeholder="Washing costs" required>
                    </div>
                    <!-- status -->
                    <div class="form-group">
                        <label> Status * </label>
                        <select name="status" class="form-control" required>
                            <option value="">--select--</option>
                            <option value="1">Active</option>
                            <option value="2">Non Active</option>
                        </select>
                    </div>
                    <!-- inventory -->
                    <div class="row">
                        <!-- nama inventory -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bahan baku *</label>
                                <select name="idinv[]" class="select2" multiple="multiple" data-placeholder="Choose material" required>
                                    <?php foreach ($inventory as $data) { ?>
                                        <option value="<?= $data->id_inventory ?>"><?= $data->nama_barang ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- qty inventory -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah bahan *</label> <small class="float-right">/ml</small>
                                <select name="qty[]" class="select2" multiple="multiple" data-placeholder="Quantity" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
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

<!-- MODAL UBAH -->
<?php foreach ($dataproduct as $data) { ?>
    <div class="modal fade" id="modal-edit<?= $data->id_product_kiloan ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title mx-auto">Form Ubah Data Jasa</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('product/product_kiloan/edit/') . $data->id_product_kiloan ?>" method="POST">
                        <!-- FORM BODY -->
                        <input type="hidden" name="idproduct" value="<?= $data->id_product_kiloan ?>">
                        <!-- code -->
                        <div class="form-group">
                            <label> Kode Jasa </label>
                            <input type="text" class="form-control" value="<?= $data->kode_product_kiloan ?>" readonly>
                        </div>
                        <!-- nama product -->
                        <div class="form-group">
                            <label> Nama Jasa</label>
                            <input type="text" name="nama" class="form-control" placeholder="Product name ... " value="<?= $data->nama_product_kiloan ?>" required>
                        </div>
                        <!-- durasi -->
                        <div class="form-group">
                            <label> Durasi </label> <small class="float-right">/Day</small>
                            <input type="number" name="durasi" class="form-control" placeholder="Washing time" value="<?= $data->durasi_kiloan ?>" required>
                        </div>
                        <!-- harga -->
                        <div class="form-group">
                            <label> Harga </label> <small class="float-right">Rp.</small>
                            <input type="number" name="harga" class="form-control" placeholder="Washing costs" value="<?= $data->harga_product_kiloan ?>" required>
                        </div>
                        <!-- status -->
                        <div class="form-group">
                            <label> status </label>
                            <select name="status" class="form-control" required>
                                <option value="">--select--</option>
                                <option value="1" <?= $data->status_kiloan == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="2" <?= $data->status_kiloan == 2 ? 'selected' : '' ?>>Non Active</option>
                            </select>
                        </div>
                        <!-- inventory -->
                        <div class="row">
                            <!-- nama inventory -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bahan baku</label> <small> Optional</small>
                                    <select name="idinv[]" class="select2" multiple="multiple" data-placeholder="Choose material">
                                        <?php foreach ($inventory as $data) { ?>
                                            <option value="<?= $data->id_inventory ?>"><?= $data->nama_barang ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- qty inventory -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Bahan</label> <small class="float-right">/ml</small>
                                    <select name="qty[]" class="select2" multiple="multiple" data-placeholder="Quantity">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                </div>
                            </div>
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
<div class="container">
    <?php foreach ($detail as $data) { ?>
        <div class="fade modal" id="modal-detail<?= $data->id_product_kiloan ?>">
            <div class="modal-dialog">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username"><strong><?= ucfirst($data->nama_product_kiloan) ?></strong></h3>
                        <h5 class="widget-user-desc"><?= $data->kode_product_kiloan ?></h5>
                    </div>
                    <div class="card-footer p-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                Harga <span class="float-right"><?= indo_currency($data->harga_product_kiloan) ?></span>
                            </li>
                            <li class="nav-item">
                                Durasi <span class="float-right "><?= $data->durasi_kiloan . ' day' ?></span>
                            </li>
                            <li class="nav-item">
                                Bahan Baku :
                                <table class="table">
                                    <?php
                                        $id = $data->id_product_kiloan;
                                        $detail = $this->db->query("
                                            SELECT * FROM detail_product
                                            LEFT JOIN inventory ON inventory.id_inventory=detail_product.id_detail_inventory
                                            WHERE id_detail_product_kiloan='$id' ")->result_array();
                                    ?>
                                    <tr>
                                        <?php foreach ($detail as $value): ?>
                                        <td align="center"><small><?= $value['nama_barang'] ?></small></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <?php foreach ($detail as $value): ?>
                                        <td align="center"><small><?= $value['jumlah_inventory'] ?></small></td>
                                        <?php endforeach ?>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Select2 -->
<script src="<?= base_url('assets/lte') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/lte') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- photo -->
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
    $(document).ready(function() {

        $('.select2').select2();
    });
</script>