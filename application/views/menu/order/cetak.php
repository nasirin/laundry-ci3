<section class="content">
    <?php foreach ($order as $data) {
        $promo = intval($data->value_jenis_promo * $data->berat_kiloan * $data->harga_product_kiloan / 100);
        $subtotal = intval($data->berat_kiloan * $data->harga_product_kiloan);
    ?>
        <div class="modal fade" id="modal-detail<?= $data->id_order_kiloan ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img src="<?= base_url('assets/img/laundryLogo.png') ?>" class="img-circle elevation-3 brand-image" style="width:30px">
                                    <span class="brand-text font-weight-light">Ship Laundry</span>
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
                                        <span><?= $data->email_member ?></span>
                                        <span><?= $data->alamat_member ?></span><br>
                                    </address>
                                <?php } else { ?>
                                    <address>
                                        <strong><?= ucwords($data->nama_pelanggan) ?></strong>
                                    </address>
                                <?php } ?>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <b>Nota : </b><?= $data->kode_order_kiloan ?><br>
                                <b>Tanggal Masuk:</b> <?= $data->tanggal_masuk_kiloan ?><br>
                                <b>Tanggal Keluar:</b> <?= $data->tanggal_keluar_kiloan ?><br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Berat</th>
                                            <th>Jasa</th>
                                            <th>Biaya</th>
                                            <th>Pewangi</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $data->berat_kiloan ?></td>
                                            <td><?= $data->nama_product_kiloan ?></td>
                                            <td><?= $data->harga_product_kiloan . '/Kg' ?></td>
                                            <td><?= $data->varian_inventory ?></td>
                                            <td><?= $data->keterangan_kiloan ?></td>
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
                                            <td><?= indo_currency($data->total_harga_kiloan) ?></td>
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
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>