
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
                <div class="form-group" style="overflow-x: auto">
                  <div id="sini_dia_htmlnya"></div>
                  <center>
                    <div>
                      <canvas id="c" width="1050" height="950" style="border:1px solid #ccc;pointer-events:none;"></canvas>
                      <br><br>
                    </div>
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
              <center>
                <h2>Arahkan Qrcode buku ke kamera</h2>
                <input type="hidden" name="sini_modal_cek" id="modal_berubah" value="1" onchange="cek_modalnya_berubah(value)">
                <!-- <button type="button" onclick="tukar_modalnya('tutup')" id="tukar_modalnya_button"> sini tukat modal</button> -->
                <!-- <select style="display: none"></select> -->
                <canvas id="ini_canvas_kamera" ></canvas>
              </center>
            </div>

            
          </div>
        </div>

        <hr>
        <div class="container">
          <div class="row">
             <div class="col-md-12">
              <div class="row form-group">
                
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <center><h2>Masukkan Kode Buku</h2>
                  <input type="text" class="form-control" id="kode_bukunya" placeholder="Masukkan Kode Buku" minlength="1" maxlength="3"></center>
                </div>
                <div class="col-md-3"></div>

              </div>
              <div class="row form-group" >
                <div class="col-md-12">
                  <center><button type="button" class="btn btn-primary btn-md text-white" onclick="kode_buku()">Cari Rak Buku</button></center>
                </div>
              </div>
            </div>

            
          </div>
        </div>

        
      </section>
   
      <?php $this->load->view('home/footer'); ?>    
  </div>

    <?php $this->load->view('home/script'); ?>

    <!-- <script type="text/javascript" src="<?=base_url()?>qrcode/js/jquery.js"></script> -->
    <script type="text/javascript" src="<?=base_url()?>qrcode/js/qrcodelib.js"></script>
    <script type="text/javascript" src="<?=base_url()?>qrcode/js/webcodecamjquery.js"></script>
    <!-- <script type="text/javascript">$('#sini_modalnya').modal("show");</script> -->
    <script type="text/javascript">
       function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
          textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
              this.oldValue = this.value;
              this.oldSelectionStart = this.selectionStart;
              this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
              this.value = this.oldValue;
              this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
              this.value = "";
            }
          });
        });
      }


      // Install input filters.
      setInputFilter(document.getElementById("kode_bukunya"), function(value) { return /^-?\d*$/.test(value); });

      function kode_buku(){
        const kode = $("#kode_bukunya").val();
        // console.log(kode);
        cari_rak_buku(kode);
      }
      var arg = {
        resultFunction: function(result) {
          // console.log (result)
          var kode =  result.code;
          kode = kode.split('/')[1]
          if ($.isNumeric(kode)  == true) {
            cari_rak_buku(kode);
          }else{
            swal({
              title: "Error",
              text: "Qrcode yang discan tiada dalam sistem",
              icon: "error",
              button : false,
              timer : 3000
            })
          }
          // cari_rak_buku(kode.split('/')[1]);
          
          // stopnya_p();
        }
      };
      
      var decoder = $("#ini_canvas_kamera").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
      decoder.play();
      var source = new EventSource("<?=base_url()?>home/coba");
      source.onmessage = function(event) {
        if($("#sini_modalnya").is(":visible")) {
          decoder.stop()
          // console.log("matikan")
        }else{
          decoder.play()
          // console.log("jalankan")
        }
      };

    </script>
    <script src="<?=base_url()?>assets/fabric.min.js"></script>
    <script type="text/javascript">
      var canvas = this.__canvas = new fabric.Canvas('c');
      // create a rect object
      fabric.Object.prototype.selectable = false;
      // canvas.item(0).selectable = false;
      canvas.renderAll();

      fabric.Object.prototype.transparentCorners = true;
      // fabric.Object.prototype.cornerColor = 'blue';
      fabric.Object.prototype.cornerStyle = 'circle';
      canvas.off('mouse:down', eventHandler)
      function cari_rak_buku(e){
        console.log(e)
        $.ajax({
          url: "<?=base_url()?>home/cari",
          type: 'post',
          data: {proses : "cari_buku_qr", id : e},
          // dataType: 'json',
          // beforeSend: function(res) { 
          //   document.getElementById("sini_html").innerHTML = "Paragraph changed!";  
          //   $("#sini_html").html(null);              
          // },
          success: function (response) {
            console.log(response);

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