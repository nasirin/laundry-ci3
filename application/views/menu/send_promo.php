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
  <a href="<?= base_url('promo') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
</section>

<div class="content">
  <div class="card">
    <div class="card-body">
      <form action="<?= base_url('promo/sending') ?>" method="POST">
        <div class="row justify-content-md-center">
          <div class="col-md-5">
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required autofocus="">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" name="message" id="message" rows="4" cols="50" style="resize: vertical; height:100%;"><?php echo"{$tag} {$teks['nama_promo']} {$teks['value_jenis_promo']}% {$teks['keterangan_promo']}.\nBuruan Promo terbatas sampai: " . date('d M Y',strtotime($teks['akhir_promo'])) . " shiplaundry.com" ?>
              </textarea> 
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success float-right"><i class="fa fa-paper-plane"></i> Sending</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>