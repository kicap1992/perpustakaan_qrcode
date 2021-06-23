
<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('home/head'); ?>
  <body>
    <div class="modal fade" id="sini_modalnya" aria-hidden="true" role="dialog" tabindex="-1">
      <div class="modal-dialog" style="width:95%;max-width: 1121px;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="getCroppedCanvasTitle">Peta Perpustakaan</h4>
          </div>
          <div class="modal-body row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div id="sini_input_edit"></div>
                <div class="form-group" style="overflow-x: scroll;  ">
                  <br><p style="display: none;">asdsad</p>
                  <center>
                   <canvas id="c" width="1050" height="950" style="border:1px solid #ccc;pointer-events:none;"></canvas>
                   <br><p style="display: none;">asdsad</p><br>
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
    <div class="site-wrap">
      
      <?php $this->load->view('home/top'); ?>

      <?php $this->load->view('home/header'); ?>

    

      <?php $this->load->view('home/foto'); ?>

      <input type="hidden" id="sini_htmlnya" >
      <section class="site-section">
        
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="topnav">
                  <a class="active" href="#"  id="semua">Semua</a>
                  <a href="#" id="judul">Judul</a>
                  <a href="#" id="pengarang">Pengarang</a>
                  <a href="#" id="kategori">Kategori</a>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="row form-group">
                
                <div class="col-md-3"></div>
                <div class="col-md-6" id="sini_inputan">
                  
                </div>
                <div class="col-md-3"></div>

              </div>
              <div class="row form-group" >
                <div class="col-md-12">
                  <center><button type="button" id="button_cari" class="btn btn-primary btn-md text-white" onclick="cari_buku()">Cari Buku</button></center>
                </div>
              </div>
            </div>
              
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12 col-lg-12">
                <div class="card-content" style="overflow-x: auto">
                  <div class="form-horizontal" id="sini_html">
                    
                  </div> 
                </div> 
              </div>  
            </div>
            
            <!-- sini nanti tabel buku -->

          </div>
        </div>
      </section>
   
      <?php $this->load->view('home/footer'); ?>    
  </div>

    <?php $this->load->view('home/script'); ?>
    
    <script src="<?=base_url()?>sweet-alert/toastr/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>sweet-alert/toastr/toastr.min.css">
    
    <script type="text/javascript">

      $(document).on("click", "#semua", function () {
        $("#semua").attr('class','active');
        $("#judul").removeAttr('class');
        $("#pengarang").removeAttr('class');
        $("#kategori").removeAttr('class');
        var html = '<input type="text" id="inputannya" class="form-control" placeholder="Masukkan Judul,Pengarang,Kategori Buku">';
        $("#sini_inputan").html(html);
        $("#button_cari").attr('onclick',"cari_buku('semua')");
      });



      $(document).on("click", "#judul", function () {
        $("#judul").attr('class','active');
        $("#semua").removeAttr('class');
        $("#pengarang").removeAttr('class');
        $("#kategori").removeAttr('class');
        var html = '<input type="text" id="inputannya" class="form-control" placeholder="Masukkan Judul">';
        $("#sini_inputan").html(html);
        $("#button_cari").attr('onclick',"cari_buku('judul')");
      });

      $(document).on("click", "#pengarang", function () {
        $("#pengarang").attr('class','active');
        $("#semua").removeAttr('class');
        $("#judul").removeAttr('class');
        $("#kategori").removeAttr('class');
        var html = '<input type="text" id="inputannya" class="form-control" placeholder="Masukkan Nama Pengarang">';
        $("#sini_inputan").html(html);
        $("#button_cari").attr('onclick',"cari_buku('pengarang')");
      });

      $(document).on("click", "#kategori", function () {
        $("#kategori").attr('class','active');
        $("#semua").removeAttr('class');
        $("#judul").removeAttr('class');
        $("#pengarang").removeAttr('class');

        $.ajax({
          url: "<?=base_url()?>home/cari",
          type: 'post',
          data: {proses : 'cari_kategori'},
          // dataType: 'json',
         
          success: function (response) {            
            $("#sini_inputan").html(response);
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

        $("#button_cari").attr('onclick',"cari_buku('kategori')");
      });

      document.getElementById("semua").click();

      function cari_buku(e){
        var id,kategori;
        id = $("#inputannya").val();
        kategori = e;
        // console.log(kategori);
        if (id == '' || id == null) {
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
          if (kategori == 'kategori') {
            toastr.info("<center>Kategori Harus Terpilih</center>");
          }else{
            toastr.info("<center>Inputan Harus Terisi</center>");
          }          
          $("#inputannya").focus();
        }else{
          cari_datanya(id,kategori);
        }
          
       

        
      }

      function cari_datanya(a,b){
        $.ajax({
          url: "<?=base_url()?>home/cari",
          type: 'post',
          data: {proses : 'cari', id : a, kategori : b},
          // dataType: 'json',
          beforeSend: function(res) {                   
           $("#sini_html").html('<center><h2 class="h4 text-black">Loading Data</h2></center>');
           $("#button_cari").html("Loading Data");
          },
          success: function (response) {            
            $("#sini_html").html(response);
            $("#button_cari").html("Cari Buku");
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

      
    </script>
    <script src="<?=base_url()?>assets/fabric.min.js"></script> 
    <script type="text/javascript">
      var canvas = this.__canvas = new fabric.Canvas('c');
      // create a rect object
     

      fabric.Object.prototype.transparentCorners = true;
      // fabric.Object.prototype.cornerColor = 'blue';
      fabric.Object.prototype.cornerStyle = 'circle';
      function cari_rak_buku(a,b,c,d,e,f,g){
        var html = '<div class="form-group"><label class="text-black" for="fname">Judul</label><textarea class="form-control" style="resize: none" disabled="">'+b+'</textarea></div>';

        const aa = $.ajax({
          url: "<?=base_url()?>",
          type: 'post',
          data: {proses : "cek_foto_detail" , id : g},
          async : false
        });

        // console.log(aa.responseText)
        html += '<div class="form-group"><label class="text-black" for="fname">Foto Rak Buku</label><br>'+aa.responseText+'</div>';
        html += '<div class="form-group"><label class="text-black" for="fname">Kategori</label><input  class="form-control" value="'+c+'" disabled=""></div>';
        html += '<div class="form-group"><label class="text-black" for="fname">Pengarang</label><textarea class="form-control" style="resize: none" disabled="">'+d+'</textarea></div>';
        html += '<div class="form-group"><label class="text-black" for="fname">Tahun Terbit</label><input  class="form-control" value="'+e+'" disabled=""></div>';
        html += '<div class="form-group"><label class="text-black" for="fname">Tingkat Ke</label><input  class="form-control" value="'+f+'" disabled=""></div>';
        html += '<div class="form-group"><label class="text-black" for="fname">Peta Buku</label></div>';
        $("#sini_input_edit").html(html);
        
        $.ajax({
          url: "<?=base_url()?>home/cari",
          type: 'post',
          data: {proses : "cari_rak_buku", rak : a},
          // dataType: 'json',
          // beforeSend: function(res) { 
          //   document.getElementById("sini_html").innerHTML = "Paragraph changed!";  
          //   $("#sini_html").html(null);              
          // },
          success: function (response) {
            // console.log(response);

            $("#sini_htmlnya").html(response);
            // $("#sini_html").html(null);
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
      }
    </script>
    <script src="<?=base_url()?>assets/js/main.js"></script> 
  </body>
</html>