
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/head'); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <?php $this->load->view('admin/sidebar'); ?>

        <?php $this->load->view('admin/topnavbar'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          
          <?php $this->load->view('admin/menu_atas'); ?>

          

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2 style="font-weight: bold;">Form Map Perpustakaan</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <center>
                    <div class="form-horizontal" style="overflow-x: auto">
                      <div class="form-group fabric-canvas-wrapper">
                        <input type="hidden" id="sini_idnya" >
                        <input type="hidden" id="sini_html" >
                        <canvas id="c"  style="border:1px solid #ccc;pointer-events:none;"></canvas>
                      </div>
                    </div>
                    
                  </center>
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
    <script src="<?=base_url()?>assets/fabric.min.js"></script> 

    

    <script type="text/javascript">
      function resizeCanvas() {
        const outerCanvasContainer = $('.fabric-canvas-wrapper')[0];
        
        const ratio = canvas.getWidth() / canvas.getHeight();
        const containerWidth   = outerCanvasContainer.clientWidth;
        const containerHeight  = outerCanvasContainer.clientHeight;

        const scale = containerWidth / canvas.getWidth();
        const zoom  = canvas.getZoom() * scale;
        canvas.setDimensions({width: containerWidth, height: containerWidth / ratio});
        canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
      }

      $(window).resize(resizeCanvas);

      var canvas = new fabric.Canvas('c', {
          width: 1050,
          height: 950
      });

      function AddRakBuku(left,top,width,height,id,angle,nama){
        const rect = new fabric.Rect({
          angle : angle,
          id : "rak_buku_"+id,
          originX: "center",
          originY: "center",
          fill: "aqua",
          width: width,
          height: height,
          objectCaching: false,
          stroke: "blue",
          strokeWidth: 4,
          centeredRotation: false,
        })

        var t = new fabric.IText(nama, {
          fill: "#000000",
          fontSize: 11,
          textAlign: "center",
          originX: "center",
          originY: "center",

        });

        var group = new fabric.Group([ rect, t ], {
          lockMovementX: true,
          lockMovementY: true,
          lockScalingX : true,
          lockScalingY : true,
          lockRotation : true,
          left: left,
          top: top,
          // selectable : false

        });


        // console.log(rect);
        canvas.add(group);
      }

      function AddMeja(left,top,width,height,id,angle){
        var rect = new fabric.Rect({
          angle : angle,
          id : "meja_"+id,
          // left: left,
          // top: top,
          fill: 'orange',
          width: width,
          height: height,
          objectCaching: false,
          stroke: 'yellow',
          strokeWidth: 2,
          centeredRotation: false,
          cornerSize: 6,
          originX: "center",
          originY: "center",
        });

        var t = new fabric.IText("Meja", {
          fill: "#000000",
          fontSize: 14,
          textAlign: "center",
          originX: "center",
          originY: "center",

        });

        var group = new fabric.Group([ rect, t ], {
          lockMovementX: true,
          lockMovementY: true,
          lockScalingX : true,
          lockScalingY : true,
          lockRotation : true,
          left: left,
          top: top,
          // selectable : false

        });

        // console.log(rect);
        canvas.add(group);
      }

      function AddKursi(left,top,width,height,id,angle){
        var rect = new fabric.Rect({
          angle : angle,
          id : "kursi_"+id,
          // left: left,
          // top: top,
          fill: 'lime',
          width: width,
          height: height,
          objectCaching: false,
          stroke: 'green',
          strokeWidth: 1,
          centeredRotation: false,
          cornerSize: 3,
          originX: "center",
          originY: "center"
        });

        var t = new fabric.IText("Kursi", {
          fill: "#000000",
          fontSize: 10,
          textAlign: "center",
          originX: "center",
          originY: "center",

        });

        var group = new fabric.Group([ rect, t ], {
          lockMovementX: true,
          lockMovementY: true,
          lockScalingX : true,
          lockScalingY : true,
          lockRotation : true,
          left: left,
          top: top,
          // selectable : false

        });

        // console.log(rect);
        canvas.add(group);
      }

      
      $.ajax({
        url: "<?=base_url()?>admin/rak_buku",
        type: 'post',
        data: {proses : "cari_semuanya"},
        // dataType: 'json',
        success: function (response) {
          console.log(response);
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

      resizeCanvas();

    </script>
  
  </body>
</html>
