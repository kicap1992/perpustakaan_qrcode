    <!-- jQuery -->
    <script src="<?=base_url()?>/assets_admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>/assets_admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>/assets_admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>/assets_admin/vendors/nprogress/nprogress.js"></script>  
    <script src="<?=base_url()?>/assets_admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> 
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>/assets_admin/build/js/custom.min.js"></script>
    <script src="<?=base_url()?>login_assets/js/main.js"></script>
    <script src="<?=base_url()?>sweet-alert/sweetalert.js"></script>
    <script src="<?=base_url()?>sweet-alert/toastr/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>sweet-alert/toastr/toastr.min.css">

    <script type="text/javascript">
      function logout(){
        swal({
          title: "Yakin ingin Logout?",
          text: "Anda akan keluar dari sistem",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((logout) => {
          if (logout) {

            window.location.href ='<?php echo base_url("admin/logout") ?>';
          } else {
            swal("Terima kasih kerana masih di sistem");
          }
        });
      }
    </script>
    <?php if ($this->session->flashdata('success')): ?>
      <script type="text/javascript">
        swal({
          title: "Berhasil",
          text: "<?=$this->session->flashdata('success')?>",
          icon: "success",
          showLoaderOnConfirm: true,
        })
          
        
      </script>
    <?php elseif ($this->session->flashdata('error')): ?>
      <script type="text/javascript">
        swal({
          title: "Gagal",
          text: "<?=$this->session->flashdata('error')?>",
          icon: "error",
          showLoaderOnConfirm: true,
        })
          
        
      </script>
      
    <?php endif ?>