<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/head'); ?>
    <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('sweet-alert/bootstrap-validator/css/bootstrapValidator.min.css');?>">
    <style type="text/css">
      .has-error .help-block {
        color: red;
      }
      .controls {
        display: inline-block;
      }
    </style>
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
                      <button id="add" onclick="Add()" class="btn btn-success" style="font-weight: bold;">Tambah Rak Buku</button>
                      <button id="add" onclick="Add_meja()" class="btn btn-success" style="font-weight: bold;">Tambah Meja</button>
                      <button id="add" onclick="Add_kursi()" class="btn btn-success" style="font-weight: bold;">Tambah Kursi</button>
                      <br><br>
                    
                      <div class="form-group fabric-canvas-wrapper">
                        <input type="hidden" id="sini_idnya" >
                        <input type="hidden" id="sini_html" >
                        <canvas id="c" width="1050" height="950" style="border:1px solid #ccc;"></canvas>
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

    <script src="<?=base_url()?>sweet-alert/block/jquery.blockUI.js"></script> 
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
      var canvas = this.__canvas = new fabric.Canvas('c');
      // create a rect object
      var deleteIcon = "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23F44336;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";

      var img = document.createElement('img');
      img.src = deleteIcon;

      fabric.Object.prototype.transparentCorners = false;
      fabric.Object.prototype.cornerColor = 'blue';
      fabric.Object.prototype.cornerStyle = 'circle';

      // function sleep(ms) {
      //   return new Promise(resolve => setTimeout(resolve, ms));
      // }

      function Add() {
        // console.log('Taking a break...');
        const aa = $.ajax({
          url: "<?=base_url()?>admin/rak_buku",
          type: 'post',
          data: {proses : "cek_id"},
          async : false
        });
        // await sleep(1000);
        // console.log(aa.responseText)
        var rect = new fabric.Rect({
          id : "rak_buku_" + aa.responseText,
          angle:0,
          left: 400,
          top: 350,
          fill: 'aqua',
          width: 150,
          height: 50,
          objectCaching: false,
          stroke: 'blue',
          strokeWidth: 4,
        });
        var datanya = '{"left":"400","top":"350","width":"150","height":"50","angle":"0"}';
        // console.log(rect);
        canvas.add(rect);
        simpan(datanya,"simpan","rak_buku",null);
        canvas.setActiveObject(rect);
      }

      function Add_meja() {
        // console.log('Taking a break...');
        $.ajax({
          url: "<?=base_url()?>admin/rak_buku",
          type: 'post',
          data: {proses : "cek_id"},
          // dataType: 'json',
          // success: function (response) {
          //   $("#sini_idnya").val(response);
          //   // location.reload();
          // }
          
        }).then(res => {
          var rect = new fabric.Rect({
            id : "meja_" + res,
            angle:0,
            left: 400,
            top: 350,
            fill: 'orange',
            width: 75,
            height: 75,
            objectCaching: false,
            stroke: 'yellow',
            strokeWidth: 2,
            cornerSize: 6
          });
          var datanya = '{"left":"400","top":"350","width":"75","height":"75","angle":"0"}';
          // console.log(rect);
          canvas.add(rect);
          simpan(datanya,"simpan","meja",null);
          canvas.setActiveObject(rect);
        })
        // await sleep(1000);
          
      }

      function Add_kursi() {
        // console.log('Taking a break...');
        $.ajax({
          url: "<?=base_url()?>admin/rak_buku",
          type: 'post',
          data: {proses : "cek_id"},
          // async: false,
          // dataType: 'json',
          // success: function (response) {
          //   $("#sini_idnya").val(response);
          //   // location.reload();
          // }
          
        }).then(res =>{
          // console.log(res)
          var rect = new fabric.Rect({
            id : "kursi_" + res,
            angle:0,
            left: 400,
            top: 350,
            fill: 'lime',
            width: 25,
            height: 25,
            objectCaching: false,
            stroke: 'green',
            strokeWidth: 1,
            cornerSize: 3
          });
          var datanya = '{"left":"400","top":"350","width":"25","height":"25","angle":"0"}';
          // console.log(rect);
          canvas.add(rect);
          simpan(datanya,"simpan","kursi",null);
          canvas.setActiveObject(rect);
        })
        // .catch(err => {
        //   console.log(err);
        // })
        // console.log($("#sini_idnya").val())
        // await sleep(1000);
        
      }
      

      function AddRakBuku(left,top,width,height,id,angle){
        var rect = new fabric.Rect({
          angle : angle,
          id : "rak_buku_"+id,
          left: left,
          top: top,
          fill: 'aqua',
          width: width,
          height: height,
          objectCaching: false,
          stroke: 'blue',
          strokeWidth: 4,
          centeredRotation: false,
        });

        // console.log(rect);
        canvas.add(rect);
      }

      function AddMeja(left,top,width,height,id,angle){
        var rect = new fabric.Rect({
          angle : angle,
          id : "meja_"+id,
          left: left,
          top: top,
          fill: 'orange',
          width: width,
          height: height,
          objectCaching: false,
          stroke: 'yellow',
          strokeWidth: 2,
          centeredRotation: false,
          cornerSize: 6
        });

        // console.log(rect);
        canvas.add(rect);
      }

      function AddKursi(left,top,width,height,id,angle){
        var rect = new fabric.Rect({
          angle : angle,
          id : "kursi_"+id,
          left: left,
          top: top,
          fill: 'lime',
          width: width,
          height: height,
          objectCaching: false,
          stroke: 'green',
          strokeWidth: 1,
          centeredRotation: false,
          cornerSize: 3
        });

        // console.log(rect);
        canvas.add(rect);
      }

      fabric.Object.prototype.controls.deleteControl = new fabric.Control({
        x: 0.5,
        y: -0.5,
        offsetY: 16,
        cursorStyle: 'pointer',
        mouseUpHandler: deleteObject,
        render: renderIcon,
        cornerSize: 24
      });

      // AddRakBuku(600,100,200,100,"sini_1",360);

      function deleteObject(eventData, target) {
        // console.log(target['id']);
        var id = target['id'].slice(target['id'].lastIndexOf('_') + 1);
        // console.log(id);
        $.ajax({
          url: "<?=base_url()?>admin/rak_buku",
          type: 'post',
          data: {proses : "hapus" , id : id},
          // dataType: 'json',
          success: function (response) {
            // console.log(response);
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
        var canvas = target.canvas;
        canvas.remove(target);
        canvas.requestRenderAll();
      }

      function renderIcon(ctx, left, top, styleOverride, fabricObject) {
        var size = this.cornerSize;
        ctx.save();
        ctx.translate(left, top);
        ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
        ctx.drawImage(img, -size/2, -size/2, size, size);
        ctx.restore();
      }

      

      canvas.on('object:moved', function(options) {
        console.log(options)
        var obj = canvas.getActiveObject();
        var datanya;
        var id = options['target']['id'].slice(options['target']['id'].lastIndexOf('_') + 1);
        var kategori = options['target']['id'].slice(0,options['target']['id'].lastIndexOf('_') + 1);
        kategori = kategori.substring(0, kategori.length - 1);   
        // console.log(obj);     
        datanya = '{"left":"'+options['target']['left']+'","top":"'+options['target']['top']+'","width":"'+Math.floor(obj.getScaledWidth())+'","height":"'+Math.floor(obj.getScaledHeight())+'","angle":"'+options['target']['angle']+'"}';
        simpan(datanya,'update',kategori,id);
      });

      canvas.on('object:rotated', function(options) {
        // console.log(options)
        var obj = canvas.getActiveObject();
        var datanya;
        var id = options['target']['id'].slice(options['target']['id'].lastIndexOf('_') + 1);
        var kategori = options['target']['id'].slice(0,options['target']['id'].lastIndexOf('_') + 1);
        kategori = kategori.substring(0, kategori.length - 1);        
        datanya = '{"left":"'+options['target']['left']+'","top":"'+options['target']['top']+'","width":"'+Math.floor(obj.getScaledWidth())+'","height":"'+Math.floor(obj.getScaledHeight())+'","angle":"'+options['target']['angle']+'"}';
        simpan(datanya,'update',kategori,id);
      });

      canvas.on('object:scaled', function(options) {
        var obj = canvas.getActiveObject();
        var datanya;
        var id = options['target']['id'].slice(options['target']['id'].lastIndexOf('_') + 1);
        var kategori = options['target']['id'].slice(0,options['target']['id'].lastIndexOf('_') + 1);
        kategori = kategori.substring(0, kategori.length - 1);        
        datanya = '{"left":"'+options['target']['left']+'","top":"'+options['target']['top']+'","width":"'+Math.floor(obj.getScaledWidth())+'","height":"'+Math.floor(obj.getScaledHeight())+'","angle":"'+options['target']['angle']+'"}';
        simpan(datanya,'update',kategori,id);

      });

      // canvas.on('mouse:up', function(options) {
      //   console.log(options);
      // });

      function simpan(datanya,proses,kategori,id){
        if (proses == "simpan") {
          // console.log("sini berlaku simpan");
          // console.log(datanya);
          $.ajax({
            url: "<?=base_url()?>admin/rak_buku",
            type: 'post',
            data: {data :datanya , proses : "tambah" ,kategori : kategori},
            // dataType: 'json',
            beforeSend: function(res) { 
              $.blockUI({ 
                message: "<h4>Sedang Diproses</h4>", 
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
              $.unblockUI();
              console.log(response);
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

        else if (proses == "update") {
          // console.log("sini berlaku update");
          // console.log(datanya);
          $.ajax({
            url: "<?=base_url()?>admin/rak_buku",
            type: 'post',
            data: {data :datanya , proses : "update" ,kategori : kategori , id : id},
            // dataType: 'json',
            beforeSend: function(res) { 
              $.blockUI({ 
                message: "<h4>Sedang Diproses</h4>", 
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
              $.unblockUI();
              // console.log(response);
              // location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              $.unblockUI();
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

      $.ajax({
        url: "<?=base_url()?>admin/rak_buku",
        type: 'post',
        data: {proses : "cari_semuanya"},
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

      // canvas.on('object:skewing', function(options) {
      //   console.log(options);
      // });
      resizeCanvas();
    </script>
  </body>
</html>
