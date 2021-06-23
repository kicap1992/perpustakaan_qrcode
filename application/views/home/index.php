<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('home/head'); ?>
  <body>
  
    <div class="site-wrap">

      <?php $this->load->view('home/top'); ?>

      <?php $this->load->view('home/header'); ?>

    

      <?php $this->load->view('home/foto'); ?>


      
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
               <div class="row form-group" id="sini_html">
                <table id="table1" class="table table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Kategori</th>
                      <th>Pengarang</th>
                      <th>Tahun Terbit</th>
                      <th>Peletakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Judulasdas</td>
                      <td>Kategoriasdasd</td>
                      <td>Pengarangasdsa</td>
                      <td>Tahun Terbitasdsa</td>
                      <td>Peletakanasdsd</td>
                    </tr>
                  </tbody>
                </table>
               </div>    
            </div>
            
            <!-- sini nanti tabel buku -->

          </div>
        </div>
      </section>


      
      
      <?php $this->load->view('home/footer'); ?>
    </div>

    <?php $this->load->view('home/script'); ?>
    <!-- <script src="<?=base_url()?>sweet-alert/block/jquery.blockUI.js"></script> -->
    <script src="<?=base_url()?>assets/js/datatables/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/datatables/jquery.dataTables.min.js"></script>
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
        $("#sini_inputan").html(null);
      });

      $(document).on("click", "#pengarang", function () {
        $("#pengarang").attr('class','active');
        $("#semua").removeAttr('class');
        $("#judul").removeAttr('class');
        $("#kategori").removeAttr('class');
        $("#sini_inputan").html(null);
      });

      $(document).on("click", "#kategori", function () {
        $("#kategori").attr('class','active');
        $("#semua").removeAttr('class');
        $("#judul").removeAttr('class');
        $("#pengarang").removeAttr('class');
        $("#sini_inputan").html(null);
      });

      document.getElementById("semua").click();

      function cari_buku(e){
        var id,kategori;
        if (e == 'semua') {
          id = $("#inputannya").val();
          kategori = e;
          // console.log(kategori);
          cari_datanya(id,kategori);
        }

        
      }

      function cari_datanya(a,b){
        $.ajax({
          url: "<?=base_url()?>home/cari",
          type: 'post',
          data: {proses : 'cari', id : a, kategori : b},
          // dataType: 'json',
          // beforeSend: function(res) {                   
          //   $.blockUI({ 
          //     message: "<h3>Pesanan Sedang Diproses</h3>", 
          //     css: { 
          //     border: 'none', 
          //     padding: '15px', 
          //     backgroundColor: '#000', 
          //     '-webkit-border-radius': '10px', 
          //     '-moz-border-radius': '10px', 
          //     opacity: .5, 
          //     color: '#fff' 
          //   } }); 
          // },
          success: function (response) {
            console.log(response);
            // $.noConflict();
            $("#sini_html").html(response);
            // location.reload();
            // jQuery.noConflict();
            // $.unblockUI();
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
    <script>
      $(document).ready(function(){
        //jQuery.noConflict()
        // $.noConflict();
        $("#tabel1").DataTable();
      })
    </script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    
  </body>
</html>