<?php $this->load->view('home/meta')?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php $this->load->view('home/nav')?>
    <?php $this->load->view('home/asside')?>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents?>
    </div>
    
    <?php $this->load->view('home/footer')?>
  </div>
  <?php $this->load->view('home/js')?>
</body>
</html>
