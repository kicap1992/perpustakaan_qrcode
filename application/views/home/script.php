    <script src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery-ui.js"></script>
    <script src="<?=base_url()?>assets/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.stellar.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.countdown.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>assets/js/aos.js"></script>

    

    <script src="<?=base_url()?>sweet-alert/sweetalert.js"></script>
    <?php if ($this->session->flashdata('success')): ?>
      <script type="text/javascript">
        swal({
          title: "Terima Kasih",
          text: "<?=$this->session->flashdata('success')?>",
          icon: "success",
          showLoaderOnConfirm: true,
        })
          
        
      </script>
    <?php endif ?>