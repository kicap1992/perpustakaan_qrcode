<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/head'); ?>
    <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?=base_url()?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet"> -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <?php $this->load->view('admin/sidebar'); ?>

        <?php $this->load->view('admin/topnavbar'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          
          <?php $this->load->view('admin/menu_atas'); ?>

          <div class="modal fade" id="sini_modalnya" aria-hidden="true" role="dialog" tabindex="-1">
            <div class="modal-dialog" style="width:95%;max-width: 1121px;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="getCroppedCanvasTitle">Peta Perpustakaan</h4>
                </div>
                <div class="modal-body row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div id="sini_input_edit"></div>
                      <div class="form-group" style="overflow-x: auto">
                        <center>
                         <canvas id="c" width="1050" height="950" style="border:1px solid #ccc;"></canvas>
                         <input type="hidden" id="id_rak_buku_edit" name="rak_buku">
                        </center>
                      </div>
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

         

          <div class="row">

            <div class="col-md-5 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Form Penambahan Kategori<!-- <small>different form elements</small> --></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- <br /> -->
                  <form class="form-horizontal form-label-left input_mask" id="sini_form">

                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12">Kategori Baru</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <!-- <input type="hidden" id="sini_html" > -->
                        <input type="text" class="form-control" placeholder="Masukkan Kategori Baru" name="kategori" id="kategori">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12">Foto Penempatan </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <a data-toggle="modal" class="tampilkan_modal" href="#sini_modalnya" ><button style="width: 100%" class="btn btn-primary" id="button_tambah_rak">Pilih Penempatan Kategori</button></a>
                        <input type="hidden" id="id_rak_buku_terpilih" name="rak_buku">
                        <input type="hidden" id="sini_html" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12">Foto Rak Buku </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input data-bv-notempty="true" data-bv-notempty-message="Foto Minimal 1" type="file" name="files" id="files" class="form-control" onchange="previewImage(0);" >
                        <div id="ubah_sini" style="text-align: center"></div>
                      </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-warning" onclick="reset1()">Reset</button>
                        <button type="button" class="btn btn-success" onclick="tambah()">Tambah Kategori</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-7 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List Kategori</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="overflow: auto">
                  <table id="table1" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kategori</th>
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
    <script src="<?=base_url()?>sweet-alert/block/jquery.blockUI.js"></script> 

    <script type="text/javascript">
      function reset1(){
        console.log("sini");
        $("#kategori").val(null);
        $("#id_rak_buku_terpilih").val(null);
        $('#files').val(null);
        $('#ubah_sini').html("");
        // $("#tingkat").val(null);
        // $("#tingkat").val($("#tingkat option:first").val());
        $("#button_tambah_rak").html("Pilih Penempatan Kategori");
        $("#button_tambah_rak").removeAttr("disabled");
      }

      var kategori = $("#kategori");
      var rak_buku = $("#id_rak_buku_terpilih");
      // var tingkat = $("#tingkat");
      // var nama_foto = foto.files[0]['name'];
      // nama_foto = nama_foto.split('.').pop().trim();
      // console.log(nama_foto);
      function tambah(){
        var data = $('#sini_form').serializeArray();
        // console.log(kategori.val());
        // console.log(foto.files[0]['name']);
        // console.log(foto.files[0]['size']);
        if (kategori.val() == "" || kategori.val() == null) {
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

          toastr.error("<center><b>Inputan Kategori Tidak Bisa Kosong</b></center>");
          kategori.focus();
        }
        else if (rak_buku.val() == "" || rak_buku.val() == null) {
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

          toastr.error("<center><b>Rak Buku Harus Terpilih</b></center>");
          $(".tampilkan_modal").click();
        }
        
        else{
          if ($("#files")[0].files.length == 0) {
            $('#files').val(null);
            toastnya('files','Maksimal 1 Foto diupload')
            $('#ubah_sini').html("");
          }
          else
          {
            // console.log(data)
            let form_data = new FormData();
            data = JSON.stringify(data);
            form_data.append('data', data);
            form_data.append('proses', 'tambah');
            form_data.append("files", document.getElementById('files').files[0]);
            $.ajax({
              url: "<?=base_url()?>admin/kategori",
              type: 'post',
              data: form_data,
              // data: {proses : "tambah",data : data},
              contentType: false,
              processData: false,

              beforeSend: function(res) {                   
                $.blockUI({ 
                  message: "<h4>Kategori Sedang Ditambah</h4>", 
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
      }
    </script>

    <script type="text/javascript">
        var table;
        $(document).ready(function() {
     
            //datatables
            table = $('#table1').DataTable({ 
              // "searching": false,
              // "ordering": false,
              "processing": true, 
              "serverSide": true, 
              "order": [], 
               
              "ajax": {
                "url": "<?php echo base_url('admin/kategori/tables')?>",
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

    <script src="<?=base_url()?>assets/fabric.min.js"></script> 

    <script type="text/javascript">
      var canvas = this.__canvas = new fabric.Canvas('c');
      // create a rect object
     

      fabric.Object.prototype.transparentCorners = true;
      // fabric.Object.prototype.cornerColor = 'blue';
      fabric.Object.prototype.cornerStyle = 'circle';

     
     
      $(document).off("click", ".tampilkan_modal").on("click", ".tampilkan_modal", function () {
        $.ajax({
          url: "<?=base_url()?>admin/kategori",
          type: 'post',
          data: {proses : "cari_semuanya"},
          // dataType: 'json',
          
          success: function (response) {
            // console.log(response);
            $("#sini_input_edit").html("");
            $("#sini_footer").html("");
            $("#sini_html").html(response);
            // 
            // location.reload();
            
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

      })
        
    </script>
    <script type="text/javascript">
      var edit_foto_num = 0;
      $(document).off("click", ".lihat_informasi").on("click", ".lihat_informasi", function () {
        var rak = $(this).data('rak');
        var id = $(this).data('id');
        // console.log(id);
        var kategori = $(this).data('kategori');
        // var tingkat = $(this).data('tingkat');
        var body = '<div class="form-group"><label class="control-label">Kategori</label><input type="text" class="form-control" value="'+kategori+'" name="kategori" id="kategori_edit" disabled=""><div><br>';
      
        body += '<div class="form-group"><label class="control-label">Foto Rak</label><div id="sini_foto_edit"></div><input data-bv-notempty="true" data-bv-notempty-message="Foto Minimal 1" type="file" name="files" id="files_edit" class="form-control" onchange="previewImage(1);" style="display :none"><div id="ubah_sini_edit"></div><br><button type="button" id="button_foto_edit" class="btn btn-warning" onclick="edit_foto()" style="display : none">Upload Foto Baru</button><div><br>';

        body += '<div class="form-group"><label class="control-label">Peta Kategori</label></div>';
        $("#sini_input_edit").html(body);
        var footer = '<button type="button" class="edit_kategori_button btn btn-info" onclick="edit_kategori('+id+','+rak+','+"'"+kategori+"'"+')">Edit Kategori</button><button type="button" class="btn btn-danger" onclick="hapus_kategori('+id+')">Hapus Kategori</button>';
        $("#sini_footer").html(footer);

        let foto = $.ajax({
          url: "<?=base_url()?>admin/",
          type: 'post',
          async : false,
          data: {id : id, proses : 'cek_foto_detail'},
        });
        // console.log(foto.responseText)
        $("#sini_foto_edit").html(foto.responseText)

        $.ajax({
          url: "<?=base_url()?>admin/kategori",
          type: 'post',
          data: {proses : "cari_semuanya_id", rak : rak},
          // dataType: 'json',
          
          success: function (response) {
            // console.log(response);

            $("#sini_html").html(response);
            
            // location.reload();
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
      })

      function edit_kategori(id,rak,kategori){
        // console.log(id);
        $("#id_rak_buku_edit").val(rak);
        $("#kategori_edit").removeAttr('disabled');
        $("#tingkat_edit").removeAttr('disabled');
        $(".edit_kategori_button").attr({
          'class' : 'edit_kategori_button btn btn-primary',
          'onclick' : 'konfirm_edit_kategori('+id+','+rak+',"'+kategori+'")'
        })
        $("#button_foto_edit").attr({
          'style' : 'display : block',
        })

        $.ajax({
          url: "<?=base_url()?>admin/kategori",
          type: 'post',
          data: {proses : "cari_semuanya_id_edit", rak : rak},
          // dataType: 'json',
          
          success: function (response) {
            // console.log(response);

            $("#sini_html").html(response);
            
            // location.reload();
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

        $("#kategori_edit").focus();
      }

      function edit_foto() {
        edit_foto_num = 1;
        $("#files_edit").attr('style','display : block');
        $("#sini_foto_edit").attr('style','display : none');
        $("#button_foto_edit").html('Cancel Upload Foto');
        $("#button_foto_edit").attr({
          'class' : 'btn btn-danger',
          'onclick' : 'cancel_foto_edit()',
        });
      }

      function cancel_foto_edit() {
        edit_foto_num = 0;
        $("#files_edit").attr('style','display : none');
        $("#files_edit").val(null);
        $("#sini_foto_edit").attr('style','display : block');
        $("#button_foto_edit").html('Upload Foto Baru');
        $("#button_foto_edit").attr({
          'class' : 'btn btn-warning',
          'onclick' : 'edit_foto()',
        });
      }

      function konfirm_edit_kategori(id,e,f){
        console.log(edit_foto_num)
        var id = id;
        var kategori = $("#kategori_edit").val();
        // var tingkat = $("#tingkat_edit").val();
        var rak = $("#id_rak_buku_edit").val();
        if (e == rak && f == kategori && edit_foto_num == 0 ) {
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

          toastr.warning("<center><b>Belum Ada Data Yang Berubah</b></center>");
          $("#kategori_edit").focus();
        }
        else
        {
          if (edit_foto_num == 0) {
            $.ajax({
              url: "<?=base_url()?>admin/kategori",
              type: 'post',
              data: {proses : "edit_datanya", id : id, rak : rak,  kategori : kategori, foto : 0},
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
          else if (edit_foto_num == 1) 
          {
            if ($("#files_edit")[0].files.length == 0) {
              $('#files_edit').val(null);
              toastnya('files_edit','Maksimal 1 Foto diupload')
              $('#ubah_sini_edit').html("");
            }
            else
            {
              let form_data = new FormData();
              form_data.append('proses', 'edit_datanya');
              form_data.append('rak', rak);
              form_data.append('id', id);
              form_data.append('kategori', kategori);
              form_data.append('foto', 1);
              form_data.append("files", document.getElementById('files_edit').files[0]);
              $.ajax({
                url: "<?=base_url()?>admin/kategori",
                type: 'post',
                data : form_data,
                contentType: false,
                processData: false,
                // data: {proses : "edit_datanya", id : id, rak : rak,  kategori : kategori},
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
          }
        }
          
      }

      function hapus_kategori(id){
        swal({
          title: "Yakin ingin hapus kategori ini?",
          text: "Kategori & List Buku yang dimasukkan dalam kategori ini akan terhapus permanen",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((logout) => {
          if (logout) {
            $.ajax({
              url: "<?=base_url()?>admin/kategori",
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
    
    <script type="text/javascript">
      function toastnya(id,mesej){
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

        toastr.error("<center>"+mesej+"</center>");
        $("#"+id).focus();
      }

      function previewImage(e) {
        if (e == 0) {
          var file = document.getElementById('files');
          var nama_file = 'files'
          var ubah = 'ubah_sini'
          var nomor = 0
        }
        else if (e == 1) {
          var file = document.getElementById('files_edit');
          var nama_file = 'files_edit'
          var ubah = 'ubah_sini_edit'
          var nomor = 1
        }
        
        if ($("#"+nama_file)[0].files.length == 0) {        
          $("#"+nama_file).val(null);
          toastnya(nama_file,'Maksimal 1 Foto diupload')
          $('#'+ubah).html("");
        }
        else if (cek_nama_foto(nomor) == 0) {
          // console.log('foto salah')
          $('#'+ubah).html("");
          $("#"+nama_file).val(null);
          toastnya(nama_file,'Foto harus berektensi .jpg , .jpeg dan .png')
        }
        else if (cek_nama_foto(nomor) == 2) {
          // console.log('foto salah')
          $('#'+ubah).html("");
          $('#'+nama_file).val(null);
          toastnya(nama_file,'Saiz foto maksimal 1.5 mb')
        }
        else{
          var text = ''
          ii = 0 ;
          for (var i = 0; i < file.files.length; i++) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(nama_file).files[i]);

            oFReader.onload = function(oFREvent) {
              // document.getElementById("image-preview").src = oFREvent.target.result;
              // console.log(oFREvent.target.result);

              // text+='<center><img class="example-image" src="'+oFREvent.target.result+'" width="100px" height="100px" alt=""/></center>';
              if (ii==0) {
                // text +='<center> <a class="example-image-link" href="'+oFREvent.target.result+'" data-lightbox="example-set" >Klik Untuk Melihat Foto</a></center>';
                text+='<br><center><img class="example-image" src="'+oFREvent.target.result+'" width="100px" height="100px" alt=""/></center>';
                console.log(ii);
              }
              if (ii > 0) {
                text+='<center> <a class="example-image-link" href="'+oFREvent.target.result+'" data-lightbox="example-set" ></a></center>';
                console.log('heeh');
              }
              // console.log(ii);
              $('#'+ubah).html(text);
              ii += 1;
            };
            // console.log(i);
          }
        }      
      }

      function cek_nama_foto(e){
        let id;
        if (e == 0) {
          id = "#files";
        }else if (e == 1) {
          id = "#files_edit";
        }
        var kembali = 0
        for (var i = 0; i < $(id)[0].files.length; i++) {
          var name = $(id)[0].files[i].name;
          var size = $(id)[0].files[i].size;
          name = name.split('.').pop().trim();
            // console.log(name);
          if (name !== 'jpg' && name !== 'jpeg' && name !== 'png') {
            kembali = 0
          }
          else if (size > 1000000) {
            kembali = 2
          }
          else{
            kembali = 1
          }
        }
        return kembali
      }
    </script>
    <script type="text/javascript">
      // function sleep(ms) {
      //     return new Promise(resolve => setTimeout(resolve, ms));
      //   }
      // hehe();
      // async function hehe (){
      //   await sleep(1000);
      //   $("#sini_htmlnya").html('<script src="<?=base_url()?>assets/dist/js/lightbox-plus-jquery.min.js"></'+'script>');
      // }
    </script>
  </body>
</html>
