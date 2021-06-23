<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/head'); ?>
    <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo base_url('sweet-alert/bootstrap-validator/css/bootstrapValidator.min.css');?>">
    <style type="text/css">
      .has-error .help-block {
        color: red;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <?php $this->load->view('admin/sidebar'); ?>

        <?php $this->load->view('admin/topnavbar'); ?>

        <!-- page content -->
          <div class="modal fade" id="sini_modalnya" aria-hidden="true" role="dialog" tabindex="-1">
            <div class="modal-dialog" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="getCroppedCanvasTitle">Detail Buku</h4>
                </div>
                <div class="modal-body row">
                  <div class="col-xs-12">
                    <div id="sini_input_edit">
                      
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div id="sini_footer" style="display: inline;"></div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <div class="right_col" role="main">
          
          <?php $this->load->view('admin/menu_atas'); ?>

          

          <div class="row">

            <div class="col-md-5 col-sm-5 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Form Penambahan Buku<!-- <small>different form elements</small> --></h2>
                  <!-- <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul> -->
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- <br /> -->
                  <form class="form-horizontal form-label-left input_mask" id="sini_form">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <!-- <input type="text" class="form-control" placeholder="Judul Buku" data-bv-notempty="true" data-bv-notempty-message="Judul Buku Harus Terisi" name="judul" id="judul"> -->
                        <textarea style="resize: none;" class="form-control" placeholder="Judul Buku" data-bv-notempty="true" data-bv-notempty-message="Judul Buku Harus Terisi" name="judul" id="judul"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control" data-bv-notempty="true" data-bv-notempty-message="Kategori Harus Terpilih" name="kategori" id="kategori">
                          <option disabled="" selected="">-Pilih Kategori Buku</option>
                          <?php foreach ($list_kategori->result() as $key => $value): ?>
                            <option value="<?=$value->no?>"><?=$value->kategori?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Pengarang </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <!--  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" data-bv-notempty="true" data-bv-notempty-message="Pengarang Harus Terisi" name="pengarang" id="pengarang"> -->
                       <textarea style="resize: none;" placeholder="Pengarang Buku" class="form-control" required="required" type="text" data-bv-notempty="true" data-bv-notempty-message="Pengarang Harus Terisi" name="pengarang" id="pengarang"></textarea>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun Terbit </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control" data-bv-notempty="true" data-bv-notempty-message="Tahun Terbit Harus Terpilih" name="tahun_terbit" id="tahun_terbit">
                          <option disabled="" selected="">-Pilih Tahun Terbit</option>
                          <?php  
                            for ($i=1992; $i < date('Y'); $i++) { ?>
                              <option value="<?=$i?>"><?=$i?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tingkat Ke</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="hidden" id="sini_html" >
                        <select class="form-control" name="tingkat" id="tingkat">
                          <option selected="" disabled="">-Pilih Tingkat Ke</option>
                          <option value="1">Tingkat 1</option>
                          <option value="2">Tingkat 2</option>
                          <option value="3">Tingkat 3</option>
                          <option value="4">Tingkat 4</option>
                        </select>
                      </div>
                    </div>


                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Peletakan Buku </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control">
                          <option disabled="" selected="">-Pilih Tempat / Rak Buku</option>
                          <option>Option one</option>
                          <option>Option two</option>
                          <option>Option three</option>
                          <option>Option four</option>
                        </select>
                      </div>
                    </div> -->

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="reset" class="btn btn-danger">Cancel</button>
                        <!-- <button class="btn btn-warning" type="reset">Reset</button> -->
                        <button type="submit" class="btn btn-success" id="tambah">Tambah Buku</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-7 col-sm-7 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List Buku</h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="overflow: auto">
                  <table id="table1" class="table table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <!-- <th>No</th> -->
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          </div>


          
        </div>
        <!-- /page content -->

        <?php $this->load->view('admin/footer'); ?>
      </div>
    </div>

    <?php $this->load->view('admin/script'); ?>
    <script src="<?=base_url()?>/assets_admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
    <!-- <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script> -->
    <script src="<?php echo base_url('sweet-alert/bootstrap-validator/js/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?=base_url()?>sweet-alert/block/jquery.blockUI.js"></script> 
    <script type="text/javascript">
      $(document).ready(function(){

        $('#sini_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
              // valid: 'fa fa-check',
              invalid: 'fa fa-close',
              validating: 'fa fa-circle-o-notch'
            },
          excluded: ':disabled'
        })

        $("#tambah").click(function (){
          $('#sini_form').submit();
          var data = $('#sini_form').serializeArray();
          var error = $('#sini_form').find(".has-error").length;
          console.log(error)
          if (error == 0) {
            $.ajax({
              url: "<?=base_url()?>admin/buku",
              type: 'post',
              data: {data : data, proses : 'tambah'},
              // dataType: 'json',
              beforeSend: function(res) {                   
                $.blockUI({ 
                  message: "<h3>Pesanan Sedang Diproses</h3>", 
                  css: { 
                  border: 'none', 
                  padding: '15px', 
                  backgroundColor: '#000', 
                  '-webkit-border-radius': '10px', 
                  '-moz-border-radius': '10px', 
                  opacity: .5, 
                  color: '#fff' 
                } }); 
              },
              success: function (response) {
                console.log(response);
                window.open('<?=base_url()?>admin/print/'+response, '_blank');
                location.reload();
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                // console.log('gagal');
                swal({
                  // title: "Submit Keperluan ?",
                  text: "Koneksi Internet Anda Mungkin Hilang Atau Terputus, Halaman Akan Terefresh Kembali",
                  icon: "warning",
                  buttons: {
                      cancel: false,
                      confirm: true,
                    },
                  // dangerMode: true,
                })
                .then((hehe) =>{
                  location.reload();
                });
              } 
            });
          }
        })
      })
    </script>

    <script type="text/javascript">
      var table;
      $(document).ready(function() {
   
        //datatables
        table = $('#table1').DataTable({ 
          // "searching": false,
          "ordering": false,
          "processing": true, 
          "serverSide": true, 
          "order": [], 
           
          "ajax": {
            "url": "<?php echo base_url('admin/buku/tables')?>",
            "type": "POST"
          },

           
          "columnDefs": [
            { 
              "targets": [ 0 ], 
              "orderable": false, 
            },
          ],
 
        });
 
      });
     
    </script>

    <script type="text/javascript">
      function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
      }
      $(document).off("click", ".lihat_informasi").on("click", ".lihat_informasi",async function () {
        var judul = $(this).data('judul');
        var id = $(this).data('nonya');
        var kategori = $(this).data('kategori');
        var tahun_terbit = $(this).data('tahun_terbit');
        var pengarang = $(this).data('pengarang');
        var tingkat = $(this).data('tingkat');
        console.log(id);
        // console.log(kategori);
        // console.log(tahun_terbit);
        // console.log(pengarang);
        var body = '<div class="form-group"><label class="control-label">Judul Buku</label><textarea class="form-control" style="resize :none" id="judul_edit" disabled="">'+judul+'</textarea><div>';
        body += '<div class="form-group"><label class="control-label">Kategori</label>';
        body +='<select class="form-control" name="tingkat" id="kategori_edit" disabled>';
        body +='<option disabled="">-Pilih Kategori Buku</option>';

        var ini_dia = $.ajax({
          url: "<?=base_url()?>admin/buku",
          type: 'post',
          data: {proses : "cek_kategori"},
          async : false
          // dataType: 'json',
          // success: function (response) {
          //   var response = JSON.parse(response);
          //   // console.log(response);
          //   response.forEach(function(e) {
          //     if (e.no == kategori) {
          //       body +='<option selected="" value="'+e.no+'">'+e.kategori+'</option>';
          //     }else{
          //       body +='<option value="'+e.no+'">'+e.kategori+'</option>';
          //     }
          //   });
          // },
          // error: function(XMLHttpRequest, textStatus, errorThrown) { 
          //   // console.log('gagal');
          //   swal({
          //     // title: "Submit Keperluan ?",
          //     text: "Koneksi Internet Anda Mungkin Hilang Atau Terputus, Halaman Akan Terefresh Kembali",
          //     icon: "warning",
          //     buttons: {
          //         cancel: false,
          //         confirm: true,
          //       },
          //     // dangerMode: true,
          //   })
          //   .then((hehe) =>{
          //     location.reload();
          //   });
          // } 
        });
        ini_dia = JSON.parse(ini_dia.responseText);
        ini_dia.forEach(function(e) {
          if (e.no == kategori) {
            body +='<option selected="" value="'+e.no+'">'+e.kategori+'</option>';
          }else{
            body +='<option value="'+e.no+'">'+e.kategori+'</option>';
          }
        });
        console.log(ini_dia)
        // await sleep(200);
        body += '</select></div>';
        body += '<div class="form-group"><label class="control-label">Pengarang Buku</label><textarea class="form-control" style="resize :none" id="pengarang_edit" disabled="">'+pengarang+'</textarea><div>';
        // console.log(body);
        body += '<div class="form-group"><label class="control-label">Tahun Terbit</label>';
        body += '<select class="form-control" id="tahun_terbit_edit" disabled="">';
        body += '<option disabled="">-Pilih Tahun Terbit</option>'
        for (var i = 1992; i <= new Date().getFullYear(); i++) {
          if (i == tahun_terbit) {
            body += '<option selected="" value="'+i+'">'+i+'</option>';
          }else{
            body += '<option value="'+i+'">'+i+'</option>';
          }
        }
        body += '</select></div>';
        body += '<div class="form-group"><label class="control-label">Tingkat</label>';
        body += '<select class="form-control" id="tingkat_edit" disabled="">';
        body += '<option disabled="">-Pilih Tingkat Ke</option>'
        for (var i = 1; i <= 4; i++) {
          if (i == tingkat) {
            body += '<option selected="" value="'+i+'">'+i+'</option>';
          }else{
            body += '<option value="'+i+'">'+i+'</option>';
          }
        }
        body += '</select></div>';

        // body += '<div class="form-group"><label class="control-label">Peta Kategori</label></div>';
        $("#sini_input_edit").html(body);
        var footer = '<button type="button" class="edit_buku_button btn btn-info" onclick="edit_buku('+id+','+"'"+judul+"'"+','+"'"+kategori+"'"+','+"'"+pengarang+"'"+','+tahun_terbit+','+tingkat+')">Edit Kategori</button><button type="button" class="btn btn-danger" onclick="hapus_buku('+id+')">Hapus Kategori</button>';
        $("#sini_footer").html(footer);
        
      })

      function edit_buku(id,judul,kategori,pengarang,tahun_terbit,tingkat){
        console.log(id+ ', '+tingkat)
        $("#judul_edit").removeAttr('disabled');
        $("#kategori_edit").removeAttr('disabled');
        $("#pengarang_edit").removeAttr('disabled');
        $("#tahun_terbit_edit").removeAttr('disabled');
        $("#tingkat_edit").removeAttr('disabled');
        $(".edit_buku_button").attr({
          'class' : 'edit_buku_button btn btn-primary',
          'onclick' : 'edit_buku_konfirm('+id+',"'+judul+'","'+kategori+'","'+pengarang+'",'+tahun_terbit+','+tingkat+')'
        })
      }

      function edit_buku_konfirm(id,judul,kategori,pengarang,tahun_terbit,tingkat) {
        
        var judul_edit = $("#judul_edit").val();
        var kategori_edit = $("#kategori_edit").val();
        var pengarang_edit = $("#pengarang_edit").val();
        var tahun_terbit_edit = $("#tahun_terbit_edit").val();
        var tingkat_edit = $("#tingkat_edit").val();

        if (judul_edit == judul && kategori_edit == kategori && pengarang_edit == pengarang && tahun_terbit_edit == tahun_terbit && tingkat_edit == tingkat) {
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          };

          toastr.warning("<center><b>Belum Ada Perubahan Data Buku</b></center>");
          $("#judul_edit").focus();
        }else{
          $.ajax({
            url: "<?=base_url()?>admin/buku",
            type: 'post',
            data: {proses : "edit" , id : id, judul : judul_edit , kategori : kategori_edit , pengarang : pengarang_edit , tahun_terbit : tahun_terbit_edit, tingkat : tingkat_edit},
            // dataType: 'json',\
            beforeSend: function(res) {
              $("#sini_modalnya").modal("hide");                   
              $.blockUI({ 
                message: "<h4>Informasi Buku Sedang Diedit</h4>", 
                css: { 
                  border: 'none', 
                  padding: '15px', 
                  backgroundColor: '#000', 
                  '-webkit-border-radius': '10px', 
                  '-moz-border-radius': '10px', 
                  opacity: .5, 
                  color: '#fff' 
                } 
              }); 
            },
            success: function (response) {
              // console.log(response); 
              location.reload();           
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              // console.log('gagal');
              swal({
                // title: "Submit Keperluan ?",
                text: "Koneksi Internet Anda Mungkin Hilang Atau Terputus, Halaman Akan Terefresh Kembali",
                icon: "warning",
                buttons: {
                    cancel: false,
                    confirm: true,
                  },
                // dangerMode: true,
              })
              .then((hehe) =>{
                location.reload();
              });
            } 
          });
        }
      }

      function hapus_buku(id){
        swal({
          title: "Yakin ingin hapus buku ini?",
          text: " Buku akan terhapus permanen dari sistem",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((logout) => {
          if (logout) {
            // console.log(id)
            $.ajax({
              url: "<?=base_url()?>admin/buku",
              type: 'post',
              data: {proses : "hapus_datanya", id : id},
              // dataType: 'json',
              beforeSend: function(res) { 
                $("#sini_modalnya").modal("hide");
                $.blockUI({ 
                  message: "<h4>Kategori Sedang Diedit</h4>", 
                  css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                  } 
                });     
              },
              success: function (response) {
                
                console.log(response);

                // $("#sini_html").html(response);
                // 
                location.reload();
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                // console.log('gagal');
                swal({
                  // title: "Submit Keperluan ?",
                  text: "Koneksi Internet Anda Mungkin Hilang Atau Terputus, Halaman Akan Terefresh Kembali",
                  icon: "warning",
                  buttons: {
                      cancel: false,
                      confirm: true,
                    },
                  // dangerMode: true,
                })
                .then((hehe) =>{
                  location.reload();
                });
              } 
            });
          } 
        });
      }
    </script>
  </body>
</html>
