<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		$this->load->library('pdf');
	}
	
	function index()
	{
		if ($this->input->post('proses') == 'cek_foto_detail') {
			// header('Access-Control-Allow-Origin: *');
			$html = '';
			foreach (glob('images/kategori/'.$this->input->post('id').'/*.*') as $key => $value){ 
				// print_r($key);
				// if ($key == 0) {
					// $html .= '<center> <a class="example-image-link" href="'.base_url().$value.'" data-lightbox="example-set" >Klik Untuk Melihat Foto</a></center>';
					$html .= '<a href="'.base_url().$value.'" target="_blank"><img class="example-image" src="'.base_url().$value.'" width="100px" height="100px" alt=""/></a>';
				// }else{
				// 	$html .= '<a class="example-image-link" href="'.base_url().$value.'" data-lightbox="example-set" ></a>';
				// }
			}
			print_r($html);
		}else{
			$this->load->view('home/index2');
		}
		
	}

	function kembali(){
		$this->load->view('home/kembali');
	}

	function cari()
	{
		if ($this->input->post("proses") == "cari_buku_qr") {
			// $rak_buku = $this->input->post("rak");
			$id = $this->input->post("id");
			$cek_buku = $this->model->custom_query("SELECT *,(SELECT b.rak_buku from tb_kategori b where b.no = a.kategori) as rak_buku,(SELECT b.kategori from tb_kategori b where b.no = a.kategori) kategori_buku FROM `tb_list_buku` a where a.no = $id")->result();
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");

			if (count($cek_buku) > 0) {
				$html = '<script type="text/javascript">
								var html  = '."'".'<div class="form-group"><label class="text-black" for="fname" style="text-align:left">Judul</label><textarea class="form-control" style="resize: none" disabled="">'.$cek_buku[0]->judul.'</textarea></div>'."'".';
								html  += '."'".'<div class="form-group"><label class="text-black" for="fname">Pengarang</label><input class="form-control" disabled="" value="'.$cek_buku[0]->pengarang.'"></div>'."'".';
								html  += '."'".'<div class="form-group"><label class="text-black" for="fname">Kategori</label><input class="form-control" disabled="" value="'.$cek_buku[0]->kategori_buku.'"></div>'."'".';
								html  += '."'".'<div class="form-group"><label class="text-black" for="fname">Tahun Terbit</label><input class="form-control" disabled="" value="'.$cek_buku[0]->tahun_terbit.'"></div>'."'".';
								html  += '."'".'<div class="form-group"><label class="text-black" for="fname">Tingkat Ke</label><input class="form-control" disabled="" value="'.$cek_buku[0]->tingkat.'"></div>'."'".';
								$("#sini_dia_htmlnya").html(html);

								// canvas.__eventListeners = {}
								// canvas.discardActiveObject();
								// canvas.renderAll(); 
					      function AddRakBuku(left,top,width,height,id,angle,nama){
					        const rect = new fabric.Rect({
					          angle : angle,
					          id : "rak_buku_"+id,
					          originX: "center",
					          originY: "center",
					          fill: "aqua",
					          fillText: "heheh",
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
					          selectable : false

					        });


					        // console.log(rect);
					        canvas.add(group);
					      }

					      function AddRakBukuPilihan(left,top,width,height,id,angle,nama){
					        const rect = new fabric.Rect({
					          angle : angle,
					          id : "rak_buku_"+id,
					          originX: "center",
					          originY: "center",
					          fill: "red",
					          width: width,
					          height: height,
					          objectCaching: false,
					          stroke: "pink",
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
					          selectable : false

					        });


					        // console.log(rect);
					        canvas.add(group);
					      }

					      function AddMeja(left,top,width,height,id,angle){
					        var rect = new fabric.Rect({
					          angle : angle,
					          id : "meja_"+id,
					          left: left,
					          top: top,
					          fill: "orange",
					          width: width,
					          height: height,
					          objectCaching: false,
					          stroke: "yellow",
					          strokeWidth: 2,
					          centeredRotation: false,
					          cornerSize: 6,
					          selectable : false
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
					          fill: "lime",
					          width: width,
					          height: height,
					          objectCaching: false,
					          stroke: "green",
					          strokeWidth: 1,
					          centeredRotation: false,
					          cornerSize: 3,
					          selectable : false
					        });

					        // console.log(rect);
					        canvas.add(rect);
					      }
					      

					    </script>';
				if (count($cek_data->result()) > 0) {
					$html .= "<script>";
					foreach ($cek_data->result() as $key => $value) {
						$ket = json_decode($value->ket);
						if ($value->kategori == 'rak_buku') {
						
							$nama_kategori = '';
							$cek_nama_kategori = $this->model->tampil_data_where('tb_kategori', array('rak_buku' => $value->no))->result();
							foreach ($cek_nama_kategori as $key1 => $value1) {
								$nama_kategori .= $value1->kategori . '  \n';
							}
							// $nama_kategori = substr($nama_kategori, 0, -1);
							$nama_kategori = substr_replace($nama_kategori, "", -1);
							$nama_kategori = substr_replace($nama_kategori, "", -2);
							if ($value->no === $cek_buku[0]->rak_buku) {
								$html.="AddRakBukuPilihan(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
							}else{
								$html.="AddRakBuku(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
							}
							
							
						}
						elseif ($value->kategori == 'meja') {
							$html.="AddMeja(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.");
							";
						}

						elseif ($value->kategori == 'kursi') {
							$html.="AddKursi(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.");
							";
						}

						
					}
					
					$html .= "$('#sini_modalnya').modal('show')</script>";
					print_r($html);
				}
			}else{
				$html = '<script type="text/javascript">
			        swal({
			          title: "Error",
			          text: "Qrcode yang discan tiada dalam sistem",
			          icon: "success",
			          button: false,
			          timer : 3000
			        })
			          
			        
			      </script>';
				// print_r($cek_buku[0]->rak_buku);
			  print_r($html);
			}
		}
		elseif ($this->input->post("proses") == "cari_rak_buku") {
			$rak_buku = $this->input->post("rak");
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");
			$html = '<script type="text/javascript">
							// canvas.__eventListeners = {}
							// canvas.discardActiveObject();
							// canvas.renderAll(); 
				      function AddRakBuku(left,top,width,height,id,angle,nama){
				        const rect = new fabric.Rect({
				          angle : angle,
				          id : "rak_buku_"+id,
				          originX: "center",
				          originY: "center",
				          fill: "aqua",
				          fillText: "heheh",
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
				          selectable : false

				        });


				        // console.log(rect);
				        canvas.add(group);
				      }

				      function AddRakBukuPilihan(left,top,width,height,id,angle,nama){
				        const rect = new fabric.Rect({
				          angle : angle,
				          id : "rak_buku_"+id,
				          originX: "center",
				          originY: "center",
				          fill: "red",
				          width: width,
				          height: height,
				          objectCaching: false,
				          stroke: "pink",
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
				          selectable : false

				        });


				        // console.log(rect);
				        canvas.add(group);
				      }

				      function AddMeja(left,top,width,height,id,angle){
				        var rect = new fabric.Rect({
				          angle : angle,
				          id : "meja_"+id,
				          left: left,
				          top: top,
				          fill: "orange",
				          width: width,
				          height: height,
				          objectCaching: false,
				          stroke: "yellow",
				          strokeWidth: 2,
				          centeredRotation: false,
				          cornerSize: 6,
				          selectable : false
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
				          fill: "lime",
				          width: width,
				          height: height,
				          objectCaching: false,
				          stroke: "green",
				          strokeWidth: 1,
				          centeredRotation: false,
				          cornerSize: 3,
				          selectable : false
				        });

				        // console.log(rect);
				        canvas.add(rect);
				      }
				      
				    </script>';
			if (count($cek_data->result()) > 0) {
				$html .= "<script>";
				foreach ($cek_data->result() as $key => $value) {
					$ket = json_decode($value->ket);
					if ($value->kategori == 'rak_buku') {
						

						$nama_kategori = '';
						$cek_nama_kategori = $this->model->tampil_data_where('tb_kategori', array('rak_buku' => $value->no))->result();
						foreach ($cek_nama_kategori as $key1 => $value1) {
							$nama_kategori .= $value1->kategori . '  \n';
						}
						// $nama_kategori = substr($nama_kategori, 0, -1);
						$nama_kategori = substr_replace($nama_kategori, "", -1);
						$nama_kategori = substr_replace($nama_kategori, "", -2);
						if ($value->no === $rak_buku) {
							$html.="AddRakBukuPilihan(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
						}else{
							$html.="AddRakBuku(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
						}
					}
					elseif ($value->kategori == 'meja') {
						$html.="AddMeja(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.");
						";
					}

					elseif ($value->kategori == 'kursi') {
						$html.="AddKursi(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.");
						";
					}

					
				}
				
				$html .= "</script>";
				print_r($html);
			}
		}
		elseif ($this->input->post('proses') == 'cari') {
			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');
			// print_r($kategori);
			if ($kategori == 'semua') {
				$cari_data = $this->model->custom_query("SELECT *,b.kategori as ini_kategori, b.no as no_kategori FROM tb_list_buku a join tb_kategori b on a.kategori = b.no where   a.judul like '%$id%' OR a.pengarang like '%$id%' OR a.kategori like '%$id%' OR a.tahun_terbit like '%$id%'");
			}elseif ($kategori == 'judul') {
				$cari_data = $this->model->custom_query("SELECT *,b.kategori as ini_kategori, b.no as no_kategori FROM tb_list_buku a join tb_kategori b on a.kategori = b.no where  a.judul like '%$id%'");
			}elseif ($kategori == 'pengarang') {
				$cari_data = $this->model->custom_query("SELECT *,b.kategori as ini_kategori, b.no as no_kategori FROM tb_list_buku a join tb_kategori b on a.kategori = b.no where  a.pengarang like '%$id%'");
			}elseif ($kategori == 'kategori') {
				$cari_data = $this->model->custom_query("SELECT *,b.kategori as ini_kategori, b.no as no_kategori FROM tb_list_buku a join tb_kategori b on a.kategori = b.no where  b.no = $id");
			}

			$html = '<script src="'.base_url().'assets/js/jquery-3.3.1.min.js"></script>
					<script src="'.base_url().'assets/js/datatables/jquery.min.js"></script>
    			<script src="'.base_url().'assets/js/datatables/jquery.dataTables.min.js"></script>

    			<table id="tabel-data" class="table table-striped table-bordered" width="100%">
	          <thead>
	            <tr>
	              <th>Judul</th>
	              <th>Kategori</th>
	              <th>Pengarang</th>
	              <th>Tahun Terbit</th>
	              <th>Peletakan</th>
	            </tr>
	          </thead>
	          <tbody>';

	    foreach ($cari_data->result() as $key => $value) {
	    	$html .= '<tr>
	    							<td>'.$value->judul.'</td>
	    							<td>'.$value->ini_kategori.'</td>
	    							<td>'.$value->pengarang.'</td>
	    							<td>'.$value->tahun_terbit.'</td>
	    							<td align="center"><a data-toggle="modal" href="#sini_modalnya"><button type="button" id="button_rak_buku" class="btn btn-info btn-md text-white" onclick="cari_rak_buku('.$value->rak_buku.','."'".$value->judul."'".','."'".$value->ini_kategori."'".','."'".$value->pengarang."'".','."'".$value->tahun_terbit."'".','.$value->tingkat.','.$value->no_kategori.')">Lihat</button></a></td>
	    						</tr>';
	    }
	          	
	    $html .= '</tbody>
	        </table>
    			<script>
		        $(document).ready(function(){
		            $("#tabel-data").DataTable({
		              "aLengthMenu": [[10, 20, 30, ,40, -1], [10, 20, 30, 40 ,"All"]],
		              "iDisplayLength": 10,
				          // "pageLength": 5,
				          "searching": false,
				          "paging":   true,
				          "ordering": true,
				          "info":     false,
				          "lengthChange": false

		            });
		            
		        });
		    </script>';
			print_r($html);
		}

		elseif ($this->input->post('proses') == 'cari_kategori') {
			$cari_data = $this->model->tampil_data_keseluruhan("tb_kategori");
			$html = '<select id="inputannya" class="form-control">
								<option selected="" disabled="">-Pilih Kategori Buku</option>';

			foreach ($cari_data->result() as $key => $value) {
				$html .= '<option value="'.$value->no.'">'.$value->kategori.'</option>';
			}
			$html .= '</selected>';

			print_r($html);
		}
	}

	function login() 
	{
		if ($this->input->post('button_login')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek_data = $this->model->tampil_data_where('tb_login',array('username' => $username, 'password' => $password));
			// print_r(count($cek_data->result()));
			if (count($cek_data->result()) > 0) {
				$this->session->set_flashdata('success', 'Selamat Kembali Admin');
				$this->session->set_userdata('admin', array('level' => 'admin'));
				redirect('admin');
			}else{
				$this->session->set_flashdata('error', 'Username dan Password Salah \n Sila Input Kembali Username dan Password');
				redirect('home/login');
			}
		}else{
			$this->load->view('home/login');
		}
		
	}

	
	

	// function bikin_qrcode() {
	// 	print_r($this->model->qrcode_buku("buku/1"));
	// }

	

	// function try22() {
		
	// 	'<!DOCTYPE html>
	// 	<html>
	// 	<head>
	// 		<title></title>
	// 	</head>
	// 	<body>
	// 		<a href="https://api.whatsapp.com/send?phone=+62%20822-9324-6583">coba</a>
	// 	</body>
	// 	</html>'
		
	// }

	function coba() {
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		$array = array('coba' => 'heheheh', "sini" => "hahaha");
		echo "data: ".json_encode($array). "\n\n";
	}
}
?>