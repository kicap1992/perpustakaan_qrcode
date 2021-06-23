<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		$this->load->model('m_tabel_ss');
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
			$main['list_buku'] = $this->model->tampil_data_keseluruhan("tb_list_buku");
			$main['list_kategori'] = $this->model->tampil_data_keseluruhan("tb_kategori");
			$main['list_rak_buku'] = $this->model->tampil_data_where("tb_map_perpustakaan",array('kategori' => 'rak_buku'));
			$this->load->view('admin/index',$main);
		}
			
	}


	function buku() 
	{
		if ($this->input->post("proses") == "hapus_datanya") {
			// print_r('sini hapus');
			$id = $this->input->post('id');
			
			$this->model->delete('tb_list_buku',array('no' => $id));
			$this->session->set_flashdata('success', 'Buku  Berhasil Dihapus');

		}

		elseif ($this->input->post("proses") == "edit") {
			$id = $this->input->post('id');
			$judul = $this->input->post('judul');
			$kategori = $this->input->post('kategori');
			$pengarang = $this->input->post('pengarang');
			$tahun_terbit = $this->input->post('tahun_terbit');
			$tingkat = $this->input->post('tingkat');

			$this->model->update('tb_list_buku',array('no' => $id),array('judul' => $judul, 'kategori' => $kategori, 'pengarang' => $pengarang, 'tahun_terbit' => $tahun_terbit, 'tingkat' => $tingkat));
			$this->session->set_flashdata('success', 'List Buku  Berhasil Diedit');
		}
		elseif ($this->input->post("proses") == "cek_kategori") {
			// print_r('sini cek kategori');
			$cek_data = $this->model->tampil_data_keseluruhan('tb_kategori');
			print_r(json_encode($cek_data->result()));
		}
		elseif ($this->input->post("proses") == "tambah") {
			$data = $this->model->serialize($this->input->post('data'));
			$this->model->insert("tb_list_buku",$data);
			$this->session->set_flashdata('success', 'List Buku Baru Berhasil Ditambah');
			$cek_data_last = $this->model->tampil_data_last('tb_list_buku','no')->result();
			print_r($cek_data_last[0]->no);
		}
		elseif ($this->uri->segment(3) == "tables") {
			$list = $this->m_tabel_ss->get_datatables("tb_list_buku a",array('a.judul','b.kategori','a.pengarang','a.tahun_terbit'),array(null, 'a.judul','b.kategori','a.pengarang','a.tahun_terbit',null),array('no' => 'asc'),'tb_kategori b', 'a.kategori = b.no');
	    $data = array();
	    $no = $_POST['start'];
	    foreach ($list as $field) {
	      $no++;
	      $row = array();
	      // $row[] = $no;
	      $row[] = $field->judul;
	      $row[] = $field->kategori;
	      $row[] = $field->pengarang;
	      $row[] = $field->tahun_terbit;
	      // $row[] = '<center><a href="'.$no.'.html"><button type="button" title="Edit List Buku" class="btn btn-primary btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-edit"></i></button></a> &nbsp <button type="button" title="Lihat Penempatan Buku" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button>';
	      $row[] = '<center><a data-toggle="modal" href="#sini_modalnya"><button type="button" title="Edit List Buku" data-nonya="'.$field->nomornya.'" data-judul="'.$field->judul.'" data-pengarang="'.$field->pengarang.'" data-tahun_terbit="'.$field->tahun_terbit.'" data-kategori="'.$field->nomor_kategori.'" data-tingkat="'.$field->tingkat.'" class="lihat_informasi btn btn-primary btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-edit"></i></button></a> <a href="'.base_url('admin/print/'.$field->nomornya).'" target="_blank" class="btn btn-success btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list"></i></button></a></center>';
	      $data[] = $row;
		  }

	    $output = array(
	      "draw" => $_POST['draw'],
	      "recordsTotal" => $this->m_tabel_ss->count_all("tb_list_buku a",'tb_kategori b', 'a.kategori = b.no'),
	      "recordsFiltered" => $this->m_tabel_ss->count_filtered("tb_list_buku a",array('a.judul','b.kategori','a.pengarang','a.tahun_terbit'),array(null, 'a.judul','b.kategori','a.pengarang','a.tahun_terbit',null),array('no' => 'asc'),'tb_kategori b', 'a.kategori = b.no'),
	      "data" => $data,
	    );
	    //output dalam format JSON
	    echo json_encode($output);
		}
		else{
			$main['list_buku'] = $this->model->tampil_data_keseluruhan("tb_list_buku");
			$main['list_kategori'] = $this->model->tampil_data_keseluruhan("tb_kategori");
			$main['list_rak_buku'] = $this->model->tampil_data_where("tb_map_perpustakaan",array('kategori' => 'rak_buku'));
			// $main["kategori"] = $this->model->tampil_data_keseluruhan("tb_kategori");
			$this->load->view('admin/menu/buku',$main);
		}
		
	}
	
	function kategori()
	{
		if ($this->input->post("proses") == "hapus_datanya") {
			// print_r('sini hapus');
			$id = $this->input->post('id');
			print_r($id);
			$dir = 'images/kategori/'.$id.'/';
			$files = glob($dir.'*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}
			rmdir($dir);
			$this->model->delete('tb_kategori',array('no' => $id));
			$this->session->set_flashdata('success', 'Kategori  Berhasil Dihapus');

		}

		elseif ($this->input->post("proses") == "edit_datanya") {
			// print_r("sini edit data");
			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');
			// $tingkat = $this->input->post('tingkat');
			$rak = $this->input->post('rak');
			if ($this->input->post('foto') == 1) {
				// print_r('ada')
				$dir = 'images/kategori/'.$id.'/';

				if( is_dir($dir) === false )
				{
			 	   mkdir($dir);
				}

				$files = glob($dir.'*'); // get all file names
				foreach($files as $file){ // iterate files
				  if(is_file($file))
				    unlink($file); // delete file
				}


				// $countfiles = count($_FILES['files']['name']);
				// for($index = 0;$index < $countfiles;$index++){
				
					$filename = $_FILES['files']['name'];
					$path = $dir.$filename;
					move_uploaded_file($_FILES['files']['tmp_name'],$path);
				// }
				// print_r($countfiles);
			}
			// print_r($_FILES['files']);
			// print_r($kategori);
			// print_r($tingkat);
			// print_r($rak);
			// $this->model->update("tb_kategori",array('no' => $id),array("kategori" => $kategori, 'rak_buku' => $rak ,'tingkat' => $tingkat));
			$this->model->update("tb_kategori",array('no' => $id),array("kategori" => $kategori, 'rak_buku' => $rak ));
			$this->session->set_flashdata('success', 'Kategori  Berhasil Diedit');
		}
		elseif ($this->input->post("proses") == "cari_semuanya_id_edit") {
			$rak_buku = $this->input->post("rak");
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");
			$html = '<script type="text/javascript">
							canvas.__eventListeners = {}
							canvas.discardActiveObject();
							canvas.renderAll(); 
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
				          // selectable : false

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
				      canvas.on("mouse:up", function(options) {
				        // console.log(options.target._objects);
				        if (options.target == null || typeof options.target._objects == "undefined") {
				          // console.log("sini kosong");
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

				          toastr.error("<center><b>Sila Klik <i>'."'".'Rak Buku'."'".'</i> Untuk Melanjutkan</b></center>");
				        }else{
				          // console.log("sini ada");
				          var idnya = options.target._objects[0].id;
				          idnya = idnya.slice(idnya.lastIndexOf("_") + 1);
				          console.log(idnya);
				          $("#id_rak_buku_edit").val(idnya);
				          
				        }
				      });
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
		elseif ($this->input->post("proses") == "cari_semuanya_id") {
			$rak_buku = $this->input->post("rak");
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");
			$html = '<script type="text/javascript">
							canvas.__eventListeners = {}
							canvas.discardActiveObject();
							canvas.renderAll();
							canvas.forEachObject(function(object){ 
					      object.selectable = false; 
							});
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
				      canvas.on("mouse:up", function(options) {
				       	$("#sini_html").html(null);
				      });
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
		elseif ($this->input->post("proses") == "cari_semuanya") {
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");
			
			if (count($cek_data->result()) > 0) {
				$html.= '<script>
						//canvas.__eventListeners = {}
						canvas.discardActiveObject();
						canvas.renderAll();
						function AddRakBuku(left,top,width,height,id,angle,nama){
			        const rect = new fabric.Rect({
			          angle : angle,
			          id : "rak_buku_"+id,
			          // lockMovementX: true,
			          // lockMovementY: true,
			          // lockScalingX : true,
			          // lockScalingY : true,
			          // lockRotation : true,
			          // left: left,
			          // top: top,
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
			          // text : "heheh"
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


			      canvas.on("mouse:up", function(options) {
			        // console.log(options.target._objects);
			        if (options.target == null || typeof options.target._objects == "undefined") {
			          // console.log("sini kosong");
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

			          toastr.error("<center><b>Sila Klik <i>'."'".'Rak Buku'."'".'</i> Untuk Melanjutkan</b></center>");
			        }else{
			          // console.log("sini ada");
			          var idnya = options.target._objects[0].id;
			          idnya = idnya.slice(idnya.lastIndexOf("_") + 1);
				    		swal({
				          text: "Kategori Baru Akan Tersimpan Doi Rak Buku Ini",
				          icon: "info",
				          buttons: true,
				          dangerMode: false,
				        })
				        .then((logout) => {
				          if (logout) {
				          	$("#id_rak_buku_terpilih").val(idnya);
					          // console.log($("#id_rak_buku_terpilih").val());
					          $("#button_tambah_rak").attr({"disabled":""});
					          $("#button_tambah_rak").html("Rak Buku Telah Terpilih");
					          $("#sini_html").html(null);
					          $("#sini_modalnya").modal("hide");
				          } else {
				            
				          }
				        });
					          
			          
			         
			        }
			      });
					';
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
							$html.="AddRakBuku(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
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
		elseif ($this->input->post("proses") == "tambah") {
			// $file = $_FILES['file'];
			$data = $this->input->post('data');
			$data = $this->model->serialize(json_decode($data));
			$cek_data = $this->model->tampil_data_where("tb_kategori", array('kategori' => $data['kategori']));
			if (count($cek_data->result()) > 0) {
				$this->session->set_flashdata('error', 'Kategori Yang Dimasukkan Telah Ada Dalam Sistem Sebelumnya, Silakan Cek Di List Kategori');
			}
			else
			{
				$foto = $_FILES['files'];
				$this->model->insert("tb_kategori",$data);
				$data_last = $this->model->cek_last_ai('tb_kategori')->result();
				$data_last = $data_last[0]->no - 1;
				$dir = 'images/kategori/'.$data_last.'/';
				if( is_dir($dir) === false )
				{
			 	   mkdir($dir);
				}
				move_uploaded_file($foto['tmp_name'],$dir.$foto['name']);
				// $this->model->update('tb_kategori',array('no' => $data_last->result()[0]->no),array('foto' => $_FILES['file']['name']));
				$this->session->set_flashdata('success', 'Kategori Baru Berhasil Ditambah');
				// print_r($data_last->result()[0]->no);
				// print_r($data_last[0]->no);

			}
			// print_r($file);
			// print_r($kategori);
		}
		elseif ($this->uri->segment(3) == 'tables') {
			$list = $this->m_tabel_ss->get_datatables('tb_kategori',array('kategori'),array(null, 'kategori',null),array('no' => 'asc'),null,null);
	    $data = array();
	    $no = $_POST['start'];
	    foreach ($list as $field) {
	      $no++;
	      $row = array();
	      $row[] = $no;
	      $row[] = $field->kategori;
	      // $row[] = '<a data-toggle="modal" data-id="'.$field->no.'" data-rak="'.$field->rak_buku.'" data-tingkat="'.$field->tingkat.'" data-kategori="'.$field->kategori.'" title="Lihat Informasi" class="lihat_informasi" href="#sini_modalnya" ><button class=" btn btn-primary">Lihat Detail</button></a>';
	      $row[] = '<a data-toggle="modal" data-id="'.$field->no.'" data-rak="'.$field->rak_buku.'"  data-kategori="'.$field->kategori.'" title="Lihat Informasi" class="lihat_informasi" href="#sini_modalnya" ><button class=" btn btn-primary">Lihat Detail</button></a>';
	      $data[] = $row;
		  }

	    $output = array(
	      "draw" => $_POST['draw'],
	      "recordsTotal" => $this->m_tabel_ss->count_all('tb_kategori',null,null),
	      "recordsFiltered" => $this->m_tabel_ss->count_filtered('tb_kategori',array('kategori'),array(null, 'kategori',null),array('no' => 'asc'),null,null),
	      "data" => $data,
	    );
	    //output dalam format JSON
	    echo json_encode($output);
		}
		else{
			// $list = 
			$main['list_buku'] = $this->model->tampil_data_keseluruhan("tb_list_buku");
			$main['list_kategori'] = $this->model->tampil_data_keseluruhan("tb_kategori");
			$main['list_rak_buku'] = $this->model->tampil_data_where("tb_map_perpustakaan",array('kategori' => 'rak_buku'));
			$this->load->view('admin/menu/kategori',$main);
		}	
	}

	function rak_buku()
	{
		if ($this->input->post("proses") == "hapus") {
			$id = $this->input->post("id");
			$this->model->delete("tb_map_perpustakaan",array('no' => $id));

		}

		elseif ($this->input->post("proses") == "update") {
			// print_r("sini proses update");
			$id = $this->input->post("id");
			$data = $this->input->post("data");
			$kategori = $this->input->post("kategori");
			// print_r($id);
			// print_r($data);
			// print_r($kategori);
			$this->model->update("tb_map_perpustakaan",array('no' => $id,'kategori' => $kategori),array('ket' => $data));
		}

		elseif ($this->input->post("proses") == "cari_semuanya") {
			$cek_data = $this->model->tampil_data_keseluruhan("tb_map_perpustakaan");
			
			if (count($cek_data->result()) > 0) {
				// $jumlah_rak_buku = count($this->model->tampil_data_where('tb_map_perpustakaan',array('kategori' => 'rak_buku'))->result());

				// for ($i=0; $i < ; $i++) { 
				// 	# code...
				// }

				// foreach ($cek_data->result() as $key => $value) {
				// 	$nama_kategori[$key] = '';
				// }

				$html= "<script>";
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
						$html.="AddRakBuku(".$ket->left.",".$ket->top.",".$ket->width.",".$ket->height.",".$value->no.",".$ket->angle.",'".$nama_kategori."');";
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
		elseif ($this->input->post("proses") == "cek_id") {
			$cek_data = $this->model->cek_last_ai('tb_map_perpustakaan')->result();
			
			print_r($cek_data[0]->no);
		}
		elseif ($this->input->post("proses") == "tambah") {
			// print_r("sini tambah");
			$datanya = $this->input->post("data");
			$kategori = $this->input->post("kategori");
			// print_r($datanya);
			// print_r($kategori);
			// $cek_data = $this->model->tampil_data_where("tb_map_perpustakaan","kategori = '".$kategori."' order by no desc limit 1");
			// if (count($cek_data) > 0) {
			// 	# code...
			// }
			// print_r($cek_data->result());
			$this->model->insert("tb_map_perpustakaan",array("ket" => $datanya,"kategori" => $kategori));
		}
		else{
			$main['list_buku'] = $this->model->tampil_data_keseluruhan("tb_list_buku");
			$main['list_kategori'] = $this->model->tampil_data_keseluruhan("tb_kategori");
			$main['list_rak_buku'] = $this->model->tampil_data_where("tb_map_perpustakaan",array('kategori' => 'rak_buku'));
			$this->load->view('admin/menu/rak_buku',$main);
		}
		
	}

	function print()
	{
		// print_r($this->uri->segment(3));
		$cek_data = $this->model->tampil_data_where('tb_list_buku',array('no' => $this->uri->segment(3)))->result();
		if (count($cek_data) > 0) {
			$this->model->qrcode_buku("buku/".$this->uri->segment(3));
			$pdf = new FPDF('L','mm',array(60,100));
			$pdf->AddPage();
			$pdf->Image(base_url('images/buku/'.md5('buku/'.$cek_data[0]->no).'.png'),5,7,30);
			$pdf->SetFont('Times','',9);
			$pdf->Ln(2);
			$pdf->cell(2);
	    $pdf->Cell(45,5,'Judul :',0,0,'R');
      $pdf->Cell(50,5,''.$cek_data[0]->judul,0,0,'L');
      $pdf->Ln(6);
      $pdf->SetFont('Times','',9);
	    $pdf->Cell(45,5,'Kode Buku :',0,0,'R');
      $pdf->Cell(50,5,''.$cek_data[0]->no,0,0,'L');
			$pdf->Ln(6);
      $pdf->SetFont('Times','',9);
	    $pdf->Cell(45,5,'Pengarang :',0,0,'R');
      $pdf->Cell(50,5,''.$cek_data[0]->pengarang,0,0,'L');
      $pdf->Ln(6);
      $pdf->SetFont('Times','',9);
			$pdf->cell(2);
      $pdf->Cell(45,5,'Tahun Terbit :',0,0,'R');
      $pdf->Cell(50,5,''.$cek_data[0]->tahun_terbit,0,0,'L');
			// print_r('ada');
			$pdf->output();
		}else{
			redirect('/admin/buku');
		}
	}

	function logout()	
	{
		$this->session->unset_userdata('admin');
		$this->session->set_flashdata('success', 'Anda Berhasil Logout');
		redirect(base_url());
	}

	// function get_data_user()
 //  {
    
 //  }

 //  function hehehe(){
 //  	for ($i=1; $i < 50; $i++) { 
 //  		$this->model->insert("tb_list_buku",array("judul" => "judul_ini_dia_".$i,'pengarang' => "pengarang_ini_dia_".$i,'kategori' => "kategori_ini_dia_".$i,'tahun_terbit' => "tahun terbit_ini_dia_".$i));
 //  	}

 //  }


}
?>