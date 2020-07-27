<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Storage</span>
            <span class="info-box-number">
              10
              <small>%</small>
            </span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Promo</span>
            <span class="info-box-number"><?= $promo ?></span>
          </div>
        </div>
      </div>

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-basket"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Order Amount</span>
            <span class="info-box-number"><?= indo_currency($amount[0]['total']) ?></span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Members</span>
            <span class="info-box-number"><?= $members ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- ============================== CHART ============================== -->
    <!-- =================================================================== -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md">

                <div class="chart">
                  <canvas id="myChart" height="70"></canvas>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">TOTAL PENDAPATAN</span>
                </div>
                
              </div>
              
              <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">TOTAL MODAL</span>
                </div>
                
              </div>
              
              <div class="col-sm-4 col-6">
                <div class="description-block">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">TOTAL KEUNTUNGAN</span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ChartJS -->
<script src="<?= base_url('assets/lte') ?>/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url('assets/lte') ?>/dist/js/pages/dashboard2.js"></script>

<script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
      type: 'line',

      data: {
          labels: [
            <?php foreach ($bulan as $value): ?>
              <?= '"' . $value['name'] . '"' .', '; ?>
            <?php endforeach ?>
          ],
          datasets: [{
              label: 'Sales',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: [
                <?php foreach ($bulan as $value): ?>
                  <?php
                    $index      = $value['id_bulan'];
                    $perbulan   = $this->db->query("SELECT COUNT(id_order_kiloan) AS total FROM order_kiloan WHERE SUBSTRING(tanggal_masuk_kiloan,6,2) = '$index' ")->result_array();
                  ?>
                  <?= '"' . $perbulan[0]['total'] . '"' .', '; ?>
                <?php endforeach ?>
              ]
          }]
      },

      options: {}
  });
</script>